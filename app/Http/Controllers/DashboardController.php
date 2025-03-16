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
            $transactions = Transaction::whereBetween('created_at', [Carbon::today('America/Toronto')->format('Y-m-') ."1 00:00:00", Carbon::today('America/Toronto')->format('Y-m-d')." 23:59:59"])->orderBy('created_at','DESC')->get();
            return view('transactions')->with([
                'user' => $user,
                'transactions' => $transactions,
                'transactionsTotalCount' => Transaction::whereBetween('created_at', [Carbon::today('America/Toronto')->format('Y-m-') ."1 00:00:00", Carbon::today('America/Toronto')->format('Y-m-d')." 23:59:59"])->totalCount(),
            ]);
        }
        abort(403);
    }

    public function getTransactions($rawFirstDay, $rawSecondDay) {
        if(Auth::check()) {
            $user = Auth::user();
            $firstDay = new Carbon($rawFirstDay, 'America/Toronto');
            $secondDay = new Carbon($rawSecondDay, 'America/Toronto');
            
            $transactions = Transaction::whereBetween('created_at', [$firstDay->format('Y-m-d')." 00:00:00", $secondDay->format('Y-m-d')." 23:59:59"])->orderBy('created_at','DESC')->get();
            
            $transactionsTotalCount = Transaction::whereBetween('created_at', [$firstDay->format('Y-m-d')." 00:00:00", $secondDay->format('Y-m-d')." 23:59:59"])->totalCount();

            return view('transactions')->with([
                'user' => $user,
                'transactions' => $transactions,
                'transactionsTotalCount' => $transactionsTotalCount,
                'firstDay' => $firstDay,
                'secondDay' => $secondDay
            ]);
        }
        abort(403);
    }
}