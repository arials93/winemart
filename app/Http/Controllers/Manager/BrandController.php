<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Manager\ManagerController;
use Illuminate\Http\Request;
use App\Http\Requests\ManagerCreateBrand;
use App\Http\Requests\ManagerUpdateBrand;
use Illuminate\Support\Facades\Storage;
use App\Brand;
use App\Activity;
class BrandController extends ManagerController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            // tìm kiếm nhãn hiệu
            $brand = Brand::where('name', 'LIKE', '%'.$request->search.'%')->paginate(10);
        } else {
            $brand = Brand::paginate(10);
        }
        // $categorys;
        return view('manager.brands.index', ['data' => $brand]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManagerCreateBrand $request)
    {
        $data = $request->all();
        $path = $request->file('image')->store('brands', 'public');
        $data['image'] = $path;
        $brand = Brand::create($data);

        //lưu lịch sử hoạt động
        $this->save_activity('Đã tạo nhãn hiệu <b class="text-primary">'.$brand->name.'</b>');
        return redirect()->route('manager.brands.edit', $brand->id)->with('msg', 'Đã tạo nhãn hiệu thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('manager.brands.edit', ['data' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManagerUpdateBrand $request, $id)
    {
        $data = $request->all();
        // dd($data);
        $brand = Brand::findOrFail($id);
        $old_name = $brand->name;

        if($request->file('image')) {
            $path = $request->file('image')->store('brands', 'public');
            $data['image'] = $path;

            // xóa hình cũ
            if(Storage::disk('public')->exists($brand->image)) {
                Storage::disk('public')->delete($brand->image);
            }
        }

        $brand->update($data);
        //lưu lịch sử hoạt động
        $this->save_activity('Đã chỉnh sửa thông tin nhãn hiệu <b class="text-primary">'.$old_name);
        return redirect()->route('manager.brands.edit', $brand->id)->with('msg', 'Đã cập nhật nhãn hiệu thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $old_name = $brand->name;
        // xóa hình
        if(Storage::disk('public')->exists($brand->image)) {
            Storage::disk('public')->delete($brand->image);
        }
        $brand->delete();
        //lưu lịch sử hoạt động
        $this->save_activity('Đã xóa nhãn hiệu <b class="text-primary">'.$old_name.'</b>');
        return redirect(url()->previous())->with('msg', 'Đã xóa nhãn hiệu thành công');
    }
}
