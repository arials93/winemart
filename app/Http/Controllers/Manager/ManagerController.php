<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Activity;

/*
* Common controller for Manager system
*/
class ManagerController extends Controller
{
    public function __construct() {
        // require to login as admin
        $this->middleware(['auth', 'managers']);
    }

    public function save_activity($content) {
        //lưu lịch sử hoạt động
        Activity::create([
            'content' => $content,
            'user_id' => auth()->user()->id

        ]);
    }
}
