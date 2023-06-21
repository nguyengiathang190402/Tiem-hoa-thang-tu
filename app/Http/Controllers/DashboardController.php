<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        // dd(11);
        return view('Backend.dashboard');
    }
}
