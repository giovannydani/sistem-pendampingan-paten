<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.manage-admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manage-admin.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user)
    {
        // $role = UserRole::where('code', 'ADM')->first();

        // RoleUser::create([
        //     'user_id' => $user->id,
        //     'role_id' => $role->id,
        // ]);

        $user->update([
            'role' => UserRole::ADMIN->value,
        ]);

        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // return $user;
        // $roleUser->delete();
        $user->update([
            'role' => UserRole::USER->value,
        ]);

        return 'success';
    }

    public function data()
    {
        // $role = UserRole::where('code', 'ADM')->first();
        // $data = RoleUser::where('role_id', $role->id)->with('user:id,name')->get();

        $data = User::Admin()->get();

        return DataTables::of($data)->make(true);
    }

    public function dataCreate()
    {
        // $exclude = UserRole::where('code', 'ADM')->first()->users->pluck('id')->toArray();
        $data = User::User()->get();

        return DataTables::of($data)->make(true);
    }
}