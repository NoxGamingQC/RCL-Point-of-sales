<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index() {
        if(Auth::check()) {
            $user = Auth::user();
            $transactions = Transaction::where('is_canceled', false)->get();
            $todayTransactions = Transaction::whereDate('created_at', Carbon::today('America/Toronto'))->where('is_canceled', false)->get();
            $yesterdayTransactions = Transaction::whereDate('created_at', Carbon::yesterday('America/Toronto'))->where('is_canceled', false)->get();
            $yesterdayCount = 0;
            $todayTransactionCount = 0;

            foreach($yesterdayTransactions as $yesterdayTransaction) {
                $yesterdayCount += $yesterdayTransaction->price; 
            }
            foreach($todayTransactions as $todayTransaction) {
                $todayTransactionCount += $todayTransaction->price; 
            }
            return view('dashboard')->with([
                'user' => $user,
                'transaction' => $transactions,
                'yesterday_count' => explode('.', number_format($yesterdayCount, 2))[0] . ',' . explode('.', number_format($yesterdayCount, 2))[1] . ' $',
                'today_count' => explode('.', number_format($todayTransactionCount, 2))[0] . ',' . explode('.', number_format($todayTransactionCount, 2))[1] . ' $',
            ]);
        }
        abort(403);
    }

    public function transactions() {
        if(Auth::check()) {
            $user = Auth::user();
            $transactions = Transaction::orderBy('created_at','DESC')->get();
            return view('transactions')->with([
                'user' => $user,
                'transactions' => $transactions
            ]);
        }
        abort(403);
    }
}