<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Manager\ManagerController;
use Illuminate\Http\Request;
use App\Http\Requests\ManagerCreateCountry;
use App\Http\Requests\ManagerUpdateCountry;
use App\Country;
use App\Activity;

class CountryController extends ManagerController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            // tìm kiếm quốc gia
            $country = Country::where('name', 'LIKE', '%'.$request->search.'%')->paginate(10);
        } else {
            $country = Country::paginate(10);
        }
        // $country;
        return view('manager.countries.index', ['data' => $country]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManagerCreateCountry $request)
    {
        $data = $request->all();
        $country = Country::create($data);

        //lưu lịch sử hoạt động
        $this->save_activity('Đã tạo quốc gia <b class="text-primary">'.$country->name.'</b>');
        return redirect()->route('manager.countries.edit', $country->id)->with('msg', 'Đã tạo quốc gia thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('manager.countries.edit', ['data' => $country]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManagerUpdateCountry $request, $id)
    {
        $data = $request->all();
        $country = Country::findOrFail($id);
        $old_name = $country->name;
        $country->update($data);
        //lưu lịch sử hoạt động
        $this->save_activity('Đã chỉnh sửa tên quốc gia từ <b class="text-primary">'
                             .$old_name.'</b> thành <b class="text-primary">'.$country->name.'</b>');
        return redirect()->route('manager.countries.edit', $country->id)->with('msg', 'Đã cập nhật quốc gia thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $old_name = $country->name;
        $country->delete();
        //lưu lịch sử hoạt động
        $this->save_activity('Đã xóa quốc gia <b class="text-primary">'.$old_name.'</b>');
        return redirect(url()->previous())->with('msg', 'Đã xóa quốc gia thành công');
    }
}
