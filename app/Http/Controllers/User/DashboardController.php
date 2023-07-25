<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_ajuan' => count(auth()->user()->applications),
            'total_ajuan_admin_process' => count(auth()->user()->applications_process),
            'total_ajuan_revision' => count(auth()->user()->applications_revision),
            'total_ajuan_finish' => count(auth()->user()->applications_finish),
        ];

        return view('user.dashboard', $data);
    }
}
