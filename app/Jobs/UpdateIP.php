<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UpdateIP  implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // Optional: set timeout / tries / backoff
    public $tries = 3;
    public $backoff = 60; // seconds between retries

    /**
     * Create a new job instance.
     *
     * If you later want to send a custom IP, accept it as a constructor parameter.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * This fetches the public IP (via ipify) and POSTs it to the configured remote endpoint.
     */
    public function __invoke()
    {
        try {
            $ipProvider = config('services.ip_provider.url', 'https://api.ipify.org?format=json');
            $remoteEndpoint = config('services.remote_endpoint.url', env('REMOTE_ENDPOINT'));

            if (! $remoteEndpoint) {
                Log::warning('SendIpToRemote: REMOTE_ENDPOINT not configured.');
                return;
            }

            // Fetch public IP (returns JSON like {"ip":"x.x.x.x"})
            $response = Http::timeout(10)->get($ipProvider);

            if (! $response->successful()) {
                Log::warning('SendIpToRemote: failed to fetch public IP', ['status' => $response->status()]);
                return;
            }

            $data = $response->json();
            $ip = $data['ip'] ?? null;

            if (! $ip) {
                Log::warning('SendIpToRemote: ip not found in provider response', ['body' => $response->body()]);
                return;
            }

            // POST the IP to remote endpoint (include any auth header if needed)
            $postResponse = Http::timeout(10)
                ->withHeaders([
                    'Accept' => 'application/json',
                ])
                ->post($remoteEndpoint, [
                    'ip' => $ip,
                    'host' => gethostname(),
                    'timestamp' => now()->toISOString(),
                ]);

            if (! $postResponse->successful()) {
                Log::warning('SendIpToRemote: failed to post IP', [
                    'status' => $postResponse->status(),
                    'body' => $postResponse->body(),
                ]);
            } else {
                Log::info('SendIpToRemote: IP posted successfully', ['ip' => $ip]);
            }
        } catch (\Throwable $e) {
            // Ensure we bubble or log errors so the job can be retried according to $tries
            Log::error('SendIpToRemote: exception', ['message' => $e->getMessage()]);
            throw $e;
        }
    }
}
