<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Manager\ManagerController;
use Illuminate\Http\Request;
use App\Http\Requests\ManagerCreateSize;
use App\Http\Requests\ManagerUpdateSize;
use App\Size;
use App\Activity;

class SizeController extends ManagerController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            // tìm kiếm size
            $sizes = Size::where('capacity', 'LIKE', '%'.$request->search.'%')->paginate(10);
        } else {
            $sizes = Size::paginate(10);
        }
        // $size;
        return view('manager.sizes.index', ['data' => $sizes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.sizes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManagerCreateSize $request)
    {
        $data = $request->all();
        $size = Size::create($data);
        //lưu lịch sử hoạt động
        $this->save_activity('Đã tạo kích cỡ <b class="text-primary">'.$size->capacity.'</b>');
        return redirect()->route('manager.sizes.edit', $size->id)->with('msg', 'Đã tạo kích cỡ thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $size = Size::findOrFail($id);
        return view('manager.sizes.edit', ['data' => $size]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManagerUpdateSize $request, $id)
    {
        $data = $request->all();
        $size = Size::findOrFail($id);
        $old_capacity = $size->capacity;
        $size->update($data);
        //lưu lịch sử hoạt động
        $this->save_activity('Đã chỉnh sửa kích cỡ sản phẩm từ <b class="text-primary">'
                             .$old_capacity.'</b> thành <b class="text-primary">'.$size->capacity.'</b>');
        return redirect()->route('manager.sizes.edit', $size->id)->with('msg', 'Đã cập nhật kích cỡ thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        $old_capacity = $size->capacity;
        $size->delete();
        //lưu lịch sử hoạt động
        $this->save_activity('Đã xóa kích cỡ <b class="text-primary">'.$old_capacity.'</b>');
        return redirect(url()->previous())->with('msg', 'Đã xóa kích cỡ thành công');
    }
}
