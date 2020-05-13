<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Manager\ManagerController;
use Illuminate\Http\Request;
use App\Activity;

class DashboardController extends ManagerController
{
    public function index()
    {
        $data['activities'] = Activity::with('user')->take(4)->orderby('id', 'desc')->get();
        return view('manager.dashboard', $data);
    }
}
