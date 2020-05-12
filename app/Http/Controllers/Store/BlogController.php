<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('store.blogs');
    }

    public function blog()
    {
        return view('store.blog');
    }
}
