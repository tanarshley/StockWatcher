<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockWatcherController extends Controller
{

    public function showHome(){
        $title = 'StockWatcher';
        return view('stockwatcher.home', ['title' => $title]);
    }

    public function showAboutUs(){
        $title = 'StockWatcher';
        return view('stockwatcher.about-us', ['title' => $title]);
    }

    public function showContactUs(){
        $title = 'StockWatcher';
        return view('stockwatcher.contact-us', ['title' => $title]);
    }
}
