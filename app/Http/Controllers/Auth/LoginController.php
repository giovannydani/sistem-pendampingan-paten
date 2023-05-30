<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Traits\DashboardRoute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;

class LoginController extends Controller
{
    use DashboardRoute;

    public function index()
    {
        return view('auth.login');
    }

    // public function authenticate(Request $request) : RedirectResponse
    public function authenticate(Request $request)
    {
        // return $request;
        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // remember me
        $remember = false;
        if ($request->remember) {
            $remember = true;
        }
 
        if (Auth::attempt(credentials: $credentials, remember: $remember)) {
            $request->session()->regenerate();
 
            return redirect()->intended($this->getDashboardRoute());
            // if (Auth::user()->isAdmin) {
            //     return redirect()->intended(RouteServiceProvider::ADMINHOME);
            // }elseif (Auth::user()->isUser) {
            //     return redirect()->intended(RouteServiceProvider::HOME);
            // }
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function login($credentials, $remember)
    {
        if (Auth::attempt(credentials: $credentials, remember: $remember)) {
            // $request->session()->regenerate();
 
            if (Auth::user()->isAdmin) {
                return redirect()->intended(RouteServiceProvider::ADMINHOME);
            }elseif (Auth::user()->isUser) {
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }
    }
}
