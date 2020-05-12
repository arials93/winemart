<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('store.cart');
    }

    public function checkout()
    {
        return view('store.checkout');
    }
}
