<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Catalog;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index() {
        if(Auth::check()) {
            if(Auth::user()->is_authorized) {
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
                return view('view.dashboard.dashboard')->with([
                    'active_tab' => 'dashboard',
                    'user' => $user,
                    'transaction' => $transactions,
                    'yesterday_count' => explode('.', number_format($yesterdayCount, 2))[0] . ',' . explode('.', number_format($yesterdayCount, 2))[1] . ' $',
                    'today_count' => explode('.', number_format($todayTransactionCount, 2))[0] . ',' . explode('.', number_format($todayTransactionCount, 2))[1] . ' $',
                ]);
            } else {
                return redirect('/logout')->withErrors(['message' => 'Accès non authorisé']);
            }
        }
        return redirect('/')->withErrors(['message' => 'Accès non authorisé']);
    }

    public function transactions() {
        if(Auth::check()) {
            if(Auth::user()->is_authorized) {
                $user = Auth::user();
                $transactions = Transaction::whereBetween('created_at', [Carbon::today('America/Toronto')->format('Y-m-') ."1 00:00:00", Carbon::today('America/Toronto')->format('Y-m-d')." 23:59:59"])->orderBy('created_at','DESC')->get();
                return view('view.dashboard.transactions')->with([
                    'active_tab' => 'transactions',
                    'user' => $user,
                    'transactions' => $transactions,
                    'transactionsTotalCount' => Transaction::whereBetween('created_at', [Carbon::today('America/Toronto')->format('Y-m-') ."1 00:00:00", Carbon::today('America/Toronto')->format('Y-m-d')." 23:59:59"])->totalCount(),
                ]);
            } else {
                return redirect('/logout')->withErrors(['message' => 'Accès non authorisé']);
            }
        }
        return redirect('/')->withErrors(['message' => 'Accès non authorisé']);
    }

    public function getTransactions($firstDay, $secondDay) {
        if(Auth::check()) {
            if(Auth::user()->is_authorized) {
                $user = Auth::user();
                
                $transactions = Transaction::whereBetween('created_at', [new Carbon($firstDay)->format('Y-m-d')." 04:00:00", new Carbon($secondDay)->addDays(1)->format('Y-m-d') ." 03:59:59"])->orderBy('created_at','DESC')->get();
                
                $transactionsTotalCount = Transaction::whereBetween('created_at', [new Carbon($firstDay)->format('Y-m-d')." 04:00:00", new Carbon($secondDay)->addDays(1)->format('Y-m-d') ." 03:59:59"])->totalCount();

                return view('view.dashboard.transactions')->with([
                    'active_tab' => 'transactions',
                    'user' => $user,
                    'transactions' => $transactions,
                    'transactionsTotalCount' => $transactionsTotalCount,
                    'firstDay' => new Carbon($firstDay),
                    'secondDay' => new Carbon($secondDay)
                ]);
            } else {
                return redirect('/logout')->withErrors(['message' => 'Accès non authorisé']);
            }
        }
        return redirect('/')->withErrors(['message' => 'Accès non authorisé']);
    }

    public function getReports($firstDay, $secondDay) {
        if(Auth::check()) {
            if(Auth::user()->is_authorized) {
                $user = Auth::user();
                
                $transactions = Transaction::whereBetween('created_at', [new Carbon($firstDay)->format('Y-m-d')." 04:00:00", new Carbon($secondDay)->addDays(1)->format('Y-m-d') ." 03:59:59"])->orderBy('created_at','DESC')->get();
                $transactionsTotalCount = Transaction::whereBetween('created_at', [new Carbon($firstDay)->format('Y-m-d')." 04:00:00", new Carbon($secondDay)->addDays(1)->format('Y-m-d') ." 03:59:59"])->totalCount();
                $transactionCategories = Catalog::all()->sortBy('id');
                return view('view.dashboard.reports')->with([
                    'active_tab' => 'transactions',
                    'user' => $user,
                    'transactions' => $transactions,
                    'transactionsTotalCount' => $transactionsTotalCount,
                    'firstDay' => new Carbon($firstDay),
                    'secondDay' => new Carbon($secondDay),
                    'transaction_categories' => $transactionCategories
                ]);
            } else {
                return redirect('/logout')->withErrors(['message' => 'Accès non authorisé']);
            }
        }
        return redirect('/')->withErrors(['message' => 'Accès non authorisé']);
    }

    public function getInventory() {
        return view('view.dashboard.inventory')->with([
            'active_tab' => 'inventory',
        ]);
    }
}