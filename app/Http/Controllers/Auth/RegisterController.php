<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Jobs\SendVerificationEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Traits\DashboardRoute;
use App\Traits\PasswordValidationRules;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use PasswordValidationRules;
    use DashboardRoute;

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($newUser));

        // dispatch(new SendVerificationEmail($newUser));

        if (Auth::loginUsingId($newUser->id)) {
            $request->session()->regenerate();
 
            return redirect()->intended($this->getDashboardRoute());
            // if (Auth::user()->isAdmin) {
            //     return redirect()->intended(RouteServiceProvider::ADMINHOME);
            // }elseif (Auth::user()->isUser) {
            //     return redirect()->intended(RouteServiceProvider::HOME);
            // }
        }
    }
}
