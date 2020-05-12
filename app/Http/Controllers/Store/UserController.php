<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit()
    {
        return view('store.account.edit');
    }

    public function update(UpdateUserRequest $request)
    {   
        $user = auth()->user();
        $user->update($request->all());
        $user->save();
        return redirect()->route('store.account.edit');
    }
}
