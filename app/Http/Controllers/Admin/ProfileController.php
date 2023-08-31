<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Rules\NotSame;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Jobs\SendVerificationEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\PasswordValidationRules;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    use PasswordValidationRules;

    public function index()
    {
        // return auth()->user()->email;
        $data = [
            'user' => Auth::user()
        ];
        return view('admin.profile.index', $data);
    }

    public function changePassword(Request $request)
    {
        $rulesPassword = $this->passwordRules();
        $rulesPassword[] = new NotSame(comparison: $request->old_password, field: "Old Password");

        // dd( $rulesPassword);

        Validator::make(
            data: $request->all(),
            rules: [
                'old_password' => ['required', 'current_password'],
                'password' => $rulesPassword,
            ],
        )->validate();

        User::query()
        ->where('id', auth()->id())
        ->update([
            'password' => Hash::make($request->password)
        ]);
        
        Alert::toast('Success Mengubah Password', 'success');
        
        return redirect()->route('admin.profile.index');
    }
    
    public function changeDetail(Request $request)
    {
        Validator::make(
        data: $request->all(),
        rules: [
            'name' => ['required'],
            'email' => ['required', Rule::unique('users', 'email')->ignore(auth()->id())],
        ],
        )->validate();
        
        $oldEmail = auth()->user()->email;
        
        $dataUpdate = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        
        if ($oldEmail !== $request->email) {
            $dataUpdate['email_verified_at'] = null;
        }
        
        User::query()
        ->where('id', auth()->id())
        ->update($dataUpdate);
        
        $user = User::where('id', auth()->id())->first();
        
        if ($oldEmail !== $request->email) {
            dispatch(new SendVerificationEmail($user));
        }   

        Alert::toast('Success Mengubah Detail Akun', 'success');
        
        return redirect()->route('admin.profile.index');
    }
}
