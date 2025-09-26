<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\Catalog;
use App\Models\Item;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index() {
        if(Auth::check()) {
            if(Auth::user()->is_authorized) {
                $user = Auth::user();
                $transactionsSumByMonth = [];
                $transactionsSumByMonthLastYear = [];
                $transactionByCategories = [];
                $transactionColorsByMonth = [];
                $transactionByItems = [];
                $transactionColor = '';
                for($month = 1; $month <= 12; $month++) {
                    if (Carbon::now()->month >= $month) {
                        if(Transaction::where('is_canceled', false)->whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->get()->sum('price') > Transaction::where('is_canceled', false)->whereYear('created_at', date('Y')-1)->whereMonth('created_at', $month)->get()->sum('price')) {
                            $transactionColor = 'rgb(13, 121, 9)';
                        } elseif(Transaction::where('is_canceled', false)->whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->get()->sum('price') == Transaction::where('is_canceled', false)->whereYear('created_at', date('Y')-1)->whereMonth('created_at', $month)->get()->sum('price')) {
                            $transactionColor = 'rgba(247, 217, 47, 1)';
                        } else {
                            $transactionColor = 'rgba(233, 47, 14, 1)';
                        }
                        array_push( 
                            $transactionsSumByMonth,
                            Transaction::where('is_canceled', false)->whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->get()->sum('price') ? Transaction::where('is_canceled', false)->whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->get()->sum('price') : 0
                        );
                        array_push(
                            $transactionColorsByMonth,
                            '' .$transactionColor
                        );
                    }
                    array_push(
                        $transactionsSumByMonthLastYear,
                        Transaction::where('is_canceled', false)->whereYear('created_at', date('Y') -1 )->whereMonth('created_at', $month)->get()->sum('price')
                    );
                }
                $transactionCategories = Catalog::all()->sortBy('id');
                foreach($transactionCategories as $category) {
                    if($category->name !== 'Carte') {
                        array_push($transactionByCategories, [
                            'name' => $category->fullname,
                            'sum' =>  Transaction::where('is_canceled', false)->whereYear('created_at', date('Y'))->where('category_id', $category->id)->get()->sum('price'),
                        ]);
                    }
                }

                $transactionItems = Item::all()->sortBy('id');
                foreach($transactionItems as $item) {
                    if($item->name !== 'Carte') {
                        array_push($transactionByItems, [
                            'name' => str_replace('\'', '\\\'', $item->name),
                            'sum' =>  Transaction::where('is_canceled', false)->whereYear('created_at', date('Y'))->where('item_id', $item->id)->get()->sum('price'),
                        ]);
                    }
                }

                return view('view.dashboard.dashboard')->with([
                    'active_tab' => 'dashboard',
                    'user' => $user,
                    'categories_name' => collect($transactionByCategories)->pluck('name')->toArray(),
                    'categories_sum' => collect($transactionByCategories)->pluck('sum')->toArray(),
                    'items_name' => collect($transactionByItems)->pluck('name')->toArray(),
                    'items_sum' => collect($transactionByItems)->pluck('sum')->toArray(),
                    'transactions_sum_by_month' => $transactionsSumByMonth,
                    'transactions_sum_by_month_last_year' => $transactionsSumByMonthLastYear,
                    'transactions_color_by_month' => $transactionColorsByMonth
                ]);
            } else {
                return redirect('/logout')->withErrors(['mtransactionCategoriesessage' => 'Accès non authorisé']);
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
                $carbonStartDay = new Carbon($firstDay);
                $startDay = $carbonStartDay->format('Y-m-d') . " 07:00:00";
                $carbonEndDay = new Carbon($secondDay);
                $endDay = $carbonEndDay->addDays(1)->format('Y-m-d') ." 06:59:59";
                $transactions = Transaction::whereBetween('created_at', [$startDay, $endDay])->orderBy('created_at','DESC')->get();
                $transactionsTotalCount = Transaction::whereBetween('created_at', [$startDay, $endDay])->totalCount();

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

                $carbonStartDay = new Carbon($firstDay);
                $startDay = $carbonStartDay->format('Y-m-d') . " 07:00:00";
                $carbonEndDay = new Carbon($secondDay);
                $endDay = $carbonEndDay->addDays(1)->format('Y-m-d') ." 06:59:59";

                $transactions = Transaction::whereBetween('created_at', [$startDay, $endDay])->orderBy('created_at','DESC')->get();
                $transactionsTotalCount = Transaction::whereBetween('created_at', [$startDay, $endDay])->where('is_promotion', false)->totalCount();
                $promotionTotalCount = Transaction::whereBetween('created_at', [$startDay, $endDay])->where('is_promotion', true)->totalCount();
                $transactionCategories = Catalog::all()->sortBy('id');
                return view('view.dashboard.reports')->with([
                    'active_tab' => 'transactions',
                    'user' => $user,
                    'transactions' => $transactions,
                    'transactionsTotalCount' => $transactionsTotalCount,
                    'promotionTotalCount' => $promotionTotalCount,
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
        $catalog = Catalog::all();
        return view('view.dashboard.inventory')->with([
            'active_tab' => 'inventory',
            'catalog' => $catalog->sortBy('id')
        ]);
    }

    public function items() {
        $catalog = Catalog::all();

        return view('view.dashboard.items')->with([
            'catalog' => $catalog->sortBy('id')
        ]);
    }
}