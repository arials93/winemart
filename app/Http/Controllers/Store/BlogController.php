<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use App\BlogCategory;
class BlogController extends Controller
{
    public function index($id)
    {
        $blogs = Blog::where('cateblog_id',$id)->orderby('id','desc')->paginate(4);
        return view('store.blogs',['blogs' => $blogs]);
    }

    public function blog($id)
    {
        $blog = Blog::find($id);
        $cate_blog = BlogCategory::all();
        $recent_blog = Blog::orderByDesc('id')->take(3)->get();
        return view('store.blog',['blog' => $blog,'cate_blog' => $cate_blog,'recent_blog' => $recent_blog]);
    }
}
