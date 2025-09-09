<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    
    public function index() {
        return view('layouts.frontend.pages.index');
    }
}
