<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Manager\ManagerController;
use Illuminate\Http\Request;
use App\Http\Requests\ManagerCreateSubCategory;
use App\Http\Requests\ManagerUpdateSubCategory;
use Illuminate\Support\Facades\Storage;
use App\SubCategory;
use App\Category;

class SubCateController extends ManagerController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            // tìm kiếm loại sản phẩm con
            $sub_cates = SubCategory::where('name', 'LIKE', '%'.$request->search.'%')
                                      ->with('category')->paginate(10);
        } else {
            $sub_cates = SubCategory::with('category')->paginate(10);
        }
        // $categorys;
        return view('manager.sub-categories.index', ['data' => $sub_cates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cates = Category::all();
        return view('manager.sub-categories.create', ['cates' => $cates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManagerCreateSubCategory $request)
    {
        $data = $request->all();
        $path = $request->file('image')->store('categories', 'public');
        $data['image'] = $path;
        $sub_cate = SubCategory::create($data);

        //lưu lịch sử hoạt động
        $this->save_activity('Đã tạo loại sản phẩm con <b class="text-primary">'.$sub_cate->name.'</b>');
        return redirect()->route('manager.sub-categories.edit', $sub_cate->id)->with('msg', 'Đã tạo loại sản phẩm con thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sub_category = SubCategory::findOrFail($id);
        $cates = Category::all();
        $data = [
            "sub_category" => $sub_category,
            "cates" => $cates,
        ];
        return view('manager.sub-categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManagerUpdateSubCategory $request, $id)
    {
        $data = $request->all();
        $sub_category = SubCategory::findOrFail($id);
        $old_name = $sub_category->name;

        if($request->file('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $data['image'] = $path;

            // xóa hình cũ
            if(Storage::disk('public')->exists($sub_category->image)) {
                Storage::disk('public')->delete($sub_category->image);
            }
        }

        $sub_category->update($data);
        //lưu lịch sử hoạt động
        $this->save_activity('Đã chỉnh sửa thông tin loại sản phẩm con <b class="text-primary">'.$old_name);
        return redirect()->route('manager.sub-categories.edit', $sub_category->id)->with('msg', 'Đã cập nhật loại sản phẩm con thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_category = SubCategory::findOrFail($id);
        $old_name = $sub_category->name;
        // xóa hình
        if(Storage::disk('public')->exists($sub_category->image)) {
            Storage::disk('public')->delete($sub_category->image);
        }
        $sub_category->delete();
        //lưu lịch sử hoạt động
        $this->save_activity('Đã xóa loại sản phẩm con <b class="text-primary">'.$old_name.'</b>');
        return redirect(url()->previous())->with('msg', 'Đã xóa loại sản phẩm con thành công');
    }
}
