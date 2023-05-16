<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        return view('Frontend.index');
    }
    public function cart()
    {
        return view('Frontend.pages.cart');
    }

    public function single()
    {
        return view('Frontend.pages.single');
    }
}
