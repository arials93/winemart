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

    public function show_activities(Request $request) {
        if ($request->search) {
            // tìm kiếm nhật ký hoạt động bằng user name, user email, activity content
            $activities = Activity::with('user')
                                    ->where('content', 'LIKE', '%'.$request->search.'%')
                                    ->orWhereHas('user', function($query) use ($request) {
                                        $query->where('name', 'LIKE', '%'.$request->search.'%')
                                              ->orWhere('email', 'LIKE', '%'.$request->search.'%');
                                    })->orderby('id', 'desc')
                                    ->paginate(10);
        } else {
            $activities = Activity::with('user')->orderby('id', 'desc')->paginate(10);
        }
        // $country;
        return view('manager.activities.index', ['data' => $activities]);
    }
}
