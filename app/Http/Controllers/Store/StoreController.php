<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Blog;

class StoreController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::with('subcates')->get();
        $data['brands'] = Brand::all();
        $data['blogs'] = Blog::take(4)->orderby("id", "desc")->get();
        return view('store.index', $data);
    }
}
