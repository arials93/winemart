<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ManagerCreateBlogCategory;
use App\Http\Requests\ManagerUpdateBlogCategory;
use App\BlogCategory;

class BlogCategoryController extends ManagerController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            // tìm kiếm loại bài viết
            $blog_cates = BlogCategory::where('name', 'LIKE', '%'.$request->search.'%')->paginate(10);
        } else {
            $blog_cates = BlogCategory::paginate(10);
        }
        // $categorys;
        return view('manager.blog_categories.index', ['data' => $blog_cates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.blog_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManagerCreateBlogCategory $request)
    {
        $data = $request->all();
        $blog_cate = BlogCategory::create($data);

        //lưu lịch sử hoạt động
        $this->save_activity('Đã tạo loại bài viết <b class="text-primary">'.$blog_cate->name.'</b>');
        return redirect()->route('manager.blog-categories.edit', $blog_cate->id)->with('msg', 'Đã tạo loại bài viết thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog_cate = BlogCategory::findOrFail($id);
        return view('manager.blog_categories.edit', ['data' => $blog_cate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManagerUpdateBlogCategory $request, $id)
    {
        $data = $request->all();
        $blog_cate = BlogCategory::findOrFail($id);
        $old_name = $blog_cate->name;
        $blog_cate->update($data);
        //lưu lịch sử hoạt động
        $this->save_activity('Đã chỉnh sửa thông tin loại bài viết <b class="text-primary">'.$old_name);
        return redirect()->route('manager.blog-categories.edit', $blog_cate->id)->with('msg', 'Đã cập nhật loại bài viết thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog_cate = BlogCategory::findOrFail($id);
        $old_name = $blog_cate->name;
        $blog_cate->delete();
        //lưu lịch sử hoạt động
        $this->save_activity('Đã xóa loại bài viết <b class="text-primary">'.$old_name.'</b>');
        return redirect(url()->previous())->with('msg', 'Đã xóa loại bài viết thành công');
    }
}
