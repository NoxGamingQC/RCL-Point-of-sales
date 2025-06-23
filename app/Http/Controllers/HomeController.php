<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        return view('view.welcome')->with([
        ]);
    }

    public function history() {
        return view('view.about_us.history')->with([
        ]);
    }

    public function mission() {
        return view('view.about_us.mission')->with([
        ]);
    }

    public function ourTeam() {
        return view('view.about_us.our_team')->with([
        ]);
    }

    public function pictureGallery() {
        return view('view.picture_gallery')->with([
        ]);
    }

    public function tools() {
        return view('view.tools')->with([
        ]);
    }

    public function contact() {
        return view('view.contact_us')->with([
        ]);
    }
}