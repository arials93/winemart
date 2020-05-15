<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Manager\ManagerController;
use App\Http\Requests\ManagerCreateProduct;
use App\Http\Requests\ManagerUpdateProduct;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends ManagerController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            // tìm kiếm sản phẩm
            $products = \App\Product::where('name', 'LIKE', '%'.$request->search.'%')->paginate(10);
        } else {
            $products = \App\Product::with('category')->paginate(10);
        }
        // $categorys;
        return view('manager.products.index', ['data' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.products.create', $this->data_for_relationship());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManagerCreateProduct $request)
    {
        dd($request->all());
        $data = $request->all();
        $path = $path = $request->file('image')->store('products', 'public');
        $data['image'] = $path;
        $data['bestseller'] = $request->bestseller == 'true' ? true : false;
        // dd($data);
        $product = \App\Product::create($data);

        //lưu lịch sử hoạt động
        $this->save_activity('Đã tạo sản phẩm <b class="text-primary">'.$product->name.'</b>');
        return redirect()->route('manager.products.edit', $product->id)->with('msg', 'Đã tạo sản phẩm thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->data_for_relationship();
        $data['product'] = \App\Product::findOrFail($id);
        return view('manager.products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManagerUpdateProduct $request, $id)
    {
        $data = $request->all();
        $product = \App\Product::findOrFail($id);
        $old_name = $product->name;

        if($request->file('image')) {
            $path = $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;

            // xóa hình cũ
            if(Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
        }

        $product->update($data);
        //lưu lịch sử hoạt động
        $this->save_activity('Đã chỉnh sửa thông tin sản phẩm <b class="text-primary">'.$old_name);
        return redirect()->route('manager.products.edit', $product->id)->with('msg', 'Đã cập nhật sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = \App\Product::findOrFail($id);
        $old_name = $product->name;
        // xóa hình
        if(Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        //lưu lịch sử hoạt động
        $this->save_activity('Đã xóa sản phẩm <b class="text-primary">'.$old_name.'</b>');
        return redirect(url()->previous())->with('msg', 'Đã xóa sản phẩm thành công');
    }

    public function data_for_relationship() {
        $subcates = \App\SubCategory::all();
        $brands = \App\Brand::all();
        $countries = \App\Country::all();
        $sizes = \App\Size::all();

        return [
            'subcates' => $subcates,
            'brands' => $brands,
            'countries' => $countries,
            'sizes' => $sizes
        ];
    }
}
