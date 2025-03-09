<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        if(Auth::check()) {
            $user = Auth::user();
            return view('dashboard')->with([
                'user' => $user
            ]);
        }
        abort(403);
    }
}