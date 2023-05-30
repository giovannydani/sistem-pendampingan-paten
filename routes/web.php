<?php

use App\Enums\UserRole;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\User\DashboardController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => 'guest'], function (){
    Route::get('/', [LoginController::class, 'index'])->name('index');

    // forgot password
    Route::group(['controller' => ForgotPasswordController::class], function (){
        Route::get('/forgot-password', 'index')->name('password.request');
        Route::post('/forgot-password', 'handler')->name('password.email');
    });

    // reset password 
    Route::group(['controller' => ResetPasswordController::class], function (){
        Route::post('/reset-password', 'handler')->name('password.update');
        Route::get('/reset-password/{token}', 'index')->name('password.reset');
    });

    Route::group(['as' => 'auth.'], function (){
        Route::group(['prefix' => 'login', 'as' => 'login.', 'controller' => LoginController::class], function (){
            Route::get('/', 'index')->name('index');
            Route::post('/', 'authenticate')->name('store');
        });
        Route::group(['prefix' => 'register', 'as' => 'register.', 'controller' => RegisterController::class], function (){
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
        });
    });
});

Route::group(['middleware' => ['auth']], function (){

    Route::group(['middleware' => ['verified.not']], function (){
        // verify email
        Route::group(['controller' => VerifyEmailController::class], function (){
            Route::get('/email/verify', 'index')->name('verification.notice');
    
            Route::get('/email/verify/{id}/{hash}', 'handler')->middleware(['signed'])->name('verification.verify');
    
            Route::post('/email/verification-notification', 'resend')->middleware(['throttle:6,1'])->name('verification.send');
        });
    });

    Route::group(['as' => 'auth.'], function (){
        Route::post('/logout', function () {
            Auth::logout();
            return redirect()->route('auth.login.index');
        })->name('logout');
    });

    Route::group(['middleware' => ['verified']], function (){

        Route::group(['as' => 'user.', 'middleware' => [UserRole::getMiddlewareUserRole()]], function (){
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        });

        Route::group(['as' => 'admin.', 'prefix' => 'admin'], function (){
            Route::group(['middleware' => [UserRole::getMiddlewareSuperAdminAndAdminRole()]], function (){
                Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
            });
        });
    });
});
