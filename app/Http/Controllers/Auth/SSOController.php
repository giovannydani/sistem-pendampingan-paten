<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SSOController extends Controller
{
    public function umsIndex()
    {
        // 
    }

    public function umsStore(Request $request)
    {
        // $userInfo = null;

        // $user = User::query()
        // ->where('sso_id', $userInfo->id)
        // ->firstOr(function() use ($userInfo) {
        //     return User::create([
        //         'sso_id' => $userInfo->sso_id,
        //         'name' => $userInfo->name,
        //         'email' => $userInfo->email,
        //         'email_verified_at' => Carbon::now(),
        //         'password' => Hash::make(hash("sha256", rand())),
        //         'type' => UserType::SSOUMS,
        //     ]);
        // } );

        // Auth::login($user);

        // return redirect()->intended('/');
    }
}
