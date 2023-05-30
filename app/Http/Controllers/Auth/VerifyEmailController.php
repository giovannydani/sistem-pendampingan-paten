<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    public function index()
    {
        return view('auth.verify-email');
    }

    public function handler(EmailVerificationRequest $request)
    {
        $request->fulfill();

        if (Auth::user()->isUser) {
            return redirect(RouteServiceProvider::HOME);
        }elseif (Auth::user()->isAdmin) {
            return redirect(RouteServiceProvider::ADMINHOME);
        }
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
             
        return back()->with('message', 'Verification link sent!');
    }
}
