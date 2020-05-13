<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Manager\ManagerController;
use Illuminate\Http\Request;
use App\Http\Requests\ManagerCreateCategory;
use App\Http\Requests\ManagerUpdateCategory;
use App\Category;
use App\Activity;

class CateController extends ManagerController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            // tìm kiếm loại sản phẩm
            $cates = Category::where('name', 'LIKE', '%'.$request->search.'%')->paginate(10);
        } else {
            $cates = Category::paginate(10);
        }
        // $categorys;
        return view('manager.categories.index', ['data' => $cates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManagerCreateCategory $request)
    {
        $data = $request->all();
        $cate = Category::create($data);

        //lưu lịch sử hoạt động
        $this->save_activity('Đã tạo loại sản phẩm <b class="text-primary">'.$cate->name.'</b>');
        return redirect()->route('manager.categories.edit', $cate->id)->with('msg', 'Đã tạo loại sản phẩm thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('manager.categories.edit', ['data' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManagerUpdateCategory $request, $id)
    {
        $data = $request->all();
        $category = Category::findOrFail($id);
        $old_name = $category->name;
        $category->update($data);
        //lưu lịch sử hoạt động
        $this->save_activity('Đã chỉnh sửa tên loại sản phẩm từ <b class="text-primary">'
                             .$old_name.'</b> thành <b class="text-primary">'.$category->name.'</b>');
        return redirect()->route('manager.categories.edit', $category->id)->with('msg', 'Đã cập nhật loại sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $old_name = $category->name;
        $category->delete();
        //lưu lịch sử hoạt động
        $this->save_activity('Đã xóa loại sản phẩm <b class="text-primary">'.$old_name.'</b>');
        return redirect(url()->previous())->with('msg', 'Đã xóa loại sản phẩm thành công');
    }
}
