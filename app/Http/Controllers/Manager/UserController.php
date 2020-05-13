<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ManagerCreateAccount;
use App\Http\Requests\ManagerUpdateAccount;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    public function __construct() {
        // require to login as admin
        $this->middleware(['auth', 'supermanagers'])->except(['edit', 'update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // lấy tất cả user ngoại trừ bản thânvà phân trang
        if ($request->search) {
            // tìm kiếm tài khoản
            $search = $request->search;
            $users = User::where('id', '!=', auth()->user()->id)
            ->where(function($q) use ($search) {
                $q->where('name', 'LIKE', '%'.$search.'%')
                  ->orWhere('email', 'LIKE', '%'.$search.'%');
            })->paginate(10);
        } else {
            $users = User::where('id', '!=', auth()->user()->id)->paginate(10);
        }
        // $users;
        return view('manager.accounts.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManagerCreateAccount $request)
    {
        $data = $request->all();
        // mã hóa password trước khi lưu 
        $data['password'] = Hash::make($request->password);
        // is_Admin from string to bool
        $data['is_Admin'] = $data['is_Admin'] == 'true' ? true : false;
        $user = User::create($data);
        return redirect()->route('manager.account.edit', $user->id)->with('msg', 'Đã tạo tài khoản thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // chỉ super admin và chính nó được chỉnh sửa thông tin cá nhân
        if(auth()->user()->id == $id || auth()->user()->is_SuperAdmin) {
            $user = User::findOrFail($id);
            return view('manager.accounts.edit', ['user' => $user]);
        }

        abort(404); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManagerUpdateAccount $request, $id)
    {
        // chỉ super admin và chính nó được chỉnh sửa thông tin cá nhân
        if(auth()->user()->id == $id || auth()->user()->is_SuperAdmin) {
            // nhưng field không cần update
            // loại bỏ email vì email k thể update
            // loại bỏ password nếu k update password
            $except_field = ['except', 're-password', 'password'];
            $data = $request->except($except_field);
            
            // nếu có password được truyền lên server thì update luôn password
            if($request->password) {
                // loại bỏ password khỏi danh sách loại trừ
                unset($except_field['password']);
                $data = $request->except($except_field);
                // mã hóa password trước khi update
                $data['password'] = Hash::make($request->password);
            }

            // is_Admin from string to bool
            $data['is_Admin'] = $data['is_Admin'] == 'true' ? true : false;

            // nếu chỉnh sửa thông tin của chính mình thì is_Admin luôn luôn phải như cũ
            // k được chỉnh sửa quyền hạn của chính mình, chỉ SuperAdmin mới có quyền
            if($id == auth()->user()->id) {
                $data['is_Admin'] = auth()->user()->is_Admin;
            }

            $user = User::findOrFail($id);
            $user->update($data);
            return redirect()->route('manager.account.edit', $user->id)->with('msg', 'Đã cập nhật tài khoản thành công');
        }
        
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect(url()->previous())->with('msg', 'Đã xóa tài khoản thành công');
    }
}
