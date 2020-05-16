<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderby('id', 'desc')->paginate(6);
        return view('store.blogs', ['blogs' => $blogs]);
    }

    public function blog()
    {
        return view('store.blog');
    }
}
