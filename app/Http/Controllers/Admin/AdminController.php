<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
        return view('admin.manage-admin.addManual');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'name' => ['required', 'max:255'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required'],
            ],
        )->validate();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => Carbon::now(),
            'role' => UserRole::ADMIN,
        ]);

        return to_route('admin.manage-admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

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