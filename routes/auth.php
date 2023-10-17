<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\SSOController;

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

$authType = explode('|', config('app.auth'));

if (in_array('sso', $authType) && ! in_array('manual', $authType)){
    Route::get('/', [SSOController::class, 'umsIndex'])->name('index')->middleware(['guest']);
}elseif (in_array('sso', $authType) || in_array('manual', $authType)){
    Route::get('/', [LoginController::class, 'index'])->name('index');
}

if (in_array('manual', $authType)) {
    // forgot password
    Route::group(['controller' => ForgotPasswordController::class, 'middleware' => ['guest']], function (){
        Route::get('/forgot-password', 'index')->name('password.request');
        Route::post('/forgot-password', 'handler')->name('password.email');
    });
    
    // reset password 
    Route::group(['controller' => ResetPasswordController::class, 'middleware' => ['guest']], function (){
        Route::post('/reset-password', 'handler')->name('password.update');
        Route::get('/reset-password/{token}', 'index')->name('password.reset');
    });
}

Route::group(['as' => 'auth.', 'middleware' => ['guest']], function () use ($authType){
    if (in_array('manual', $authType)) {
        Route::group(['prefix' => 'login', 'as' => 'login.', 'controller' => LoginController::class], function (){
            Route::get('/', 'index')->name('index');
            Route::post('/', 'authenticate')->name('store');
        });
        Route::group(['prefix' => 'register', 'as' => 'register.', 'controller' => RegisterController::class], function (){
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
        });
    }

    if (in_array('sso', $authType) && in_array('manual', $authType)) {
        Route::group(['prefix' => 'sso', 'as' => 'sso.',  'controller' => SSOController::class, 'middleware' => ['guest']], function (){
            Route::group(['prefix' => 'ums', 'as' => 'ums.'], function (){
                Route::get('/', 'umsIndex')->name('umsIndex');
                Route::post('/', 'umsStore')->name('umsStore');
            });
        });   
    }

    if (in_array('sso', $authType) && ! in_array('manual', $authType)) {
        Route::group(['prefix' => 'login', 'as' => 'login.', 'controller' => SSOController::class, 'middleware' => ['guest']], function (){
            Route::get('/', 'umsIndex')->name('index');
            Route::post('/', 'umsStore')->name('store');
        });
    }
});

