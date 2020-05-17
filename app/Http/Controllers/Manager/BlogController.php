<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ManagerCreateBlog;
use App\Http\Requests\ManagerUpdateBlog;
use Illuminate\Support\Facades\Storage;
use App\BlogCategory;
use App\Blog;

class BlogController extends ManagerController
{
         /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            // tìm kiếm bài viết theo tác giả, loại bài viết, tên bài viết, nội dung bài viết
            $blogs = Blog::where('name', 'LIKE', '%'.$request->search.'%')
                           ->orWhere('sub_des', 'LIKE', '%'.$request->search.'%')
                           ->orWhere('description', 'LIKE', '%'.$request->search.'%')
                           ->orWhereHas('user', function($query) use ($request) {
                                $query->where('name', 'LIKE', '%'.$request->search.'%')
                                      ->orWhere('email', 'LIKE', '%'.$request->search.'%');
                           })->orWhereHas('blog_category', function($query) use ($request) {
                                $query->where('name', 'LIKE', '%'.$request->search.'%');
                           })->paginate(10);
        } else {
            $blogs = Blog::paginate(10);
        }
        // $xuất nhiều bài viết;
        return view('manager.blogs.index', ['data' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blog_cates = BlogCategory::all();
        return view('manager.blogs.create', ['blog_cates' => $blog_cates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManagerCreateBlog $request)
    {
        $data = $request->all();
        $path = $request->file('image')->store('blogs', 'public');
        $data['image'] = $path;
        $data['user_id'] = auth()->user()->id;
        $blog = Blog::create($data);
        //lưu lịch sử hoạt động
        $this->save_activity('Đã tạo bài viết <b class="text-primary">'.$blog->name.'</b>');
        return redirect()->route('manager.blogs.edit', $blog->id)->with('msg', 'Đã tạo bài viết thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['blog'] = Blog::findOrFail($id);
        $data['blog_cates'] = BlogCategory::all();
        return view('manager.blogs.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManagerUpdateBlog $request, $id)
    {
        $data = $request->all();
        $blog = Blog::findOrFail($id);
        $old_name = $blog->name;

        if($request->file('image')) {
            $path = $request->file('image')->store('blogs', 'public');
            $data['image'] = $path;

            // xóa hình cũ
            if(Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
        }

        $blog->update($data);
        //lưu lịch sử hoạt động
        $this->save_activity('Đã chỉnh sửa thông tin bài viết <b class="text-primary">'.$old_name);
        return redirect()->route('manager.blogs.edit', $blog->id)->with('msg', 'Đã cập nhật bài viết thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $old_name = $blog->name;
        // xóa hình
        if(Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();
        //lưu lịch sử hoạt động
        $this->save_activity('Đã xóa bài viết <b class="text-primary">'.$old_name.'</b>');
        return redirect(url()->previous())->with('msg', 'Đã xóa bài viết thành công');
    }
}
