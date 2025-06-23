<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LogoutController extends Controller
{
    

    use AuthenticatesUsers;
    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        $errors = $request->session()->get('errors');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if(isset($errors)) {
            if(count($errors->all()) > 0) {
                return redirect('/')->withErrors($errors->all());
            }
        } else {
            return redirect('/');
        }
    }
}