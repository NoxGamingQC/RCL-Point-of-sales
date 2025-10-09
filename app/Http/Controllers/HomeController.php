<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        return view('force-lock');
        return view('view.welcome')->with([
            'active_tab' => 'welcome'
        ]);
    }

    public function history() {
        return view('force-lock');
        return view('view.about_us.history')->with([
        ]);
    }

    public function mission() {
        return view('force-lock');
        return view('view.about_us.mission')->with([
        ]);
    }

    public function ourTeam() {
        return view('force-lock');
        return view('view.about_us.our_team')->with([
        ]);
    }

    public function pictureGallery() {
        return view('force-lock');
        return view('view.picture_gallery')->with([
            'active_tab' => 'picture_gallery'
        ]);
    }

    public function tools() {
        return view('force-lock');
        return view('view.tools')->with([
            'active_tab' => 'tools'
        ]);
    }

    public function contact() {
        return view('force-lock');
        return view('view.contact_us')->with([
            'active_tab' => 'contact_us'
        ]);
    }
}