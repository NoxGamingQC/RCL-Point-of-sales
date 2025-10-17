<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Branches;

class Branch
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->route('branch_id')) {
            return redirect('/'); 
        }
        $branch = Branches::where('branch_id', $request->route('branch_id'))->first();
        if($branch->is_active) {
            return $next($request);
        } else {
            abort(403, 'account_suspended');
        }

    }
}
