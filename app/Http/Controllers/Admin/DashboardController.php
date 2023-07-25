<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PatentDetail;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_user_count' => User::Verified()->count(),
            'user_count' => User::Verified()->User()->count(),
            'admin_count' => User::Verified()->AdminAndSuperAdmin()->count(),
            'total_ajuan_count' => PatentDetail::IsSubmited()->count(),
            'admin_process_ajuan_count' => PatentDetail::IsSubmited()->AdminProcess()->count(),
            'revision_ajuan_count' => PatentDetail::IsSubmited()->Revision()->count(),
            'finish_ajuan_count' => PatentDetail::IsSubmited()->Finish()->count(),
        ];

        return view('admin.dashboard', $data);
    }
}
