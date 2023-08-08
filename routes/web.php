<?php

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\AjuanController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Admin\PatentTypeController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\AjuanController as AdminAjuanController;
use App\Http\Controllers\Admin\Parameter\PatentCorrespondenceController;
use App\Http\Controllers\User\TemplateController as UserTemplateController;
use App\Http\Controllers\Admin\TemplateController as AdminTemplateController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\User\ProfileController as UserProfileController;

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

// Route::group(['middleware' => 'guest'], function (){
//     Route::get('/', [LoginController::class, 'index'])->name('index');

//     // forgot password
//     Route::group(['controller' => ForgotPasswordController::class], function (){
//         Route::get('/forgot-password', 'index')->name('password.request');
//         Route::post('/forgot-password', 'handler')->name('password.email');
//     });

//     // reset password 
//     Route::group(['controller' => ResetPasswordController::class], function (){
//         Route::post('/reset-password', 'handler')->name('password.update');
//         Route::get('/reset-password/{token}', 'index')->name('password.reset');
//     });

//     Route::group(['as' => 'auth.'], function (){
//         Route::group(['prefix' => 'login', 'as' => 'login.', 'controller' => LoginController::class], function (){
//             Route::get('/', 'index')->name('index');
//             Route::post('/', 'authenticate')->name('store');
//         });
//         Route::group(['prefix' => 'register', 'as' => 'register.', 'controller' => RegisterController::class], function (){
//             Route::get('/', 'index')->name('index');
//             Route::post('/', 'store')->name('store');
//         });
//     });
// });

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

        Route::group(['as' => 'address.', 'controller' => AddressController::class], function (){
            Route::post('/generate/district/{province}', 'generateDistrict')->name('generateDistrict');
            Route::post('/generate/subdistrict/{district}', 'generateSubdistrict')->name('generateSubdistrict');
        });
        

        Route::group(['as' => 'user.', 'middleware' => [UserRole::getMiddlewareUserRole()]], function (){
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

            // profile
            Route::group(['prefix' => 'profile', 'as' => 'profile.', 'controller' => UserProfileController::class], function (){
                Route::get('/', 'index')->name('index');
                Route::post('/change-password', 'changePassword')->name('change-password');
                Route::post('/change-detail', 'changeDetail')->name('change-detail');
            });

            // template
            Route::group(['prefix' => 'template', 'as' => 'template.', 'controller' => UserTemplateController::class], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/download/{templateDocument:id}', 'download')->name('download');
            });
            
            Route::group(['prefix' => 'ajuan', 'as' => 'ajuan.', 'controller' => AjuanController::class], function (){
                Route::get('/', 'index')->name('index');
                Route::post('/data/', 'data')->name('data');
                Route::post('/generate/', 'generateAdd')->name('generateAdd');
                Route::put('/{patentDetail:id}', 'store')->name('store');
                Route::get('/add/{patentDetail:id}', 'create')->name('create');
                Route::get('/detail/{patentDetail:id}', 'show')->name('show');
                Route::get('/log/{patentDetail:id}', 'log')->name('log');
                Route::get('/edit/{patentDetail:id}', 'edit')->name('edit');
                Route::put('/update/{patentDetail:id}', 'update')->name('update');
                Route::delete('/delete/{patentDetail:id}', 'destroy')->name('destroy');
                Route::delete('/add/{patentDetail:id}/inventor/{patentInventor}', 'destroyInventor')->name('destroyInventor');
            });
        });

        Route::group(['as' => 'admin.', 'prefix' => 'admin'], function (){
            Route::group(['middleware' => [UserRole::getMiddlewareSuperAdminAndAdminRole()]], function (){
                Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
                
                Route::group(['prefix' => 'parameter', 'as' => 'parameter.'], function (){
                    Route::group(['prefix' => 'korespondensi', 'as' => 'korespondensi.', 'controller' => PatentCorrespondenceController::class], function (){
                        Route::get('/', 'create')->name('index');
                        Route::post('/', 'store')->name('store');
                    });
                });

                Route::group(['prefix' => 'patent-type', 'as' => 'patent-type.', 'controller' => PatentTypeController::class], function (){
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'store')->name('store');
                    Route::get('/add', 'create')->name('create');
                    Route::post('/data', 'data')->name('data');
                    Route::put('/{patentType}', 'update')->name('update');
                    Route::delete('/{patentType}', 'destroy')->name('destroy');
                    Route::get('/{patentType}/edit', 'edit')->name('edit');
                    Route::delete('restore/{patentType}', 'restore')->withTrashed()->name('restore');
                });

                Route::group(['prefix' => 'ajuan', 'as' => 'ajuan.', 'controller' => AdminAjuanController::class], function (){
                    Route::get('/', 'index')->name('index');
                    Route::post('/data', 'data')->name('data');
                    Route::post('/{patentDetail:id}', 'store')->name('store');
                    Route::put('/{patentDetail:id}', 'finishAjuan')->name('finishAjuan');
                    Route::get('/check/{patentDetail:id}', 'create')->name('create');
                    Route::get('/detail/{patentDetail:id}', 'show')->name('show');
                });

                // template
                Route::group(['prefix' => 'template', 'as' => 'template.', 'controller' => AdminTemplateController::class], function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'store')->name('store');
                    Route::get('/add', 'create')->name('create');
                    Route::post('/data', 'data')->name('data');
                    Route::put('/{templateDocument:id}', 'update')->name('update');
                    Route::delete('/{templateDocument:id}', 'destroy')->name('destroy');
                    Route::get('/{templateDocument:id}/edit', 'edit')->name('edit');
                });

                // profile
                Route::group(['prefix' => 'profile', 'as' => 'profile.', 'controller' => AdminProfileController::class], function (){
                    Route::get('/', 'index')->name('index');
                    Route::post('/change-password', 'changePassword')->name('change-password');
                    Route::post('/change-detail', 'changeDetail')->name('change-detail');
                });
            });
            Route::group(['middleware' => [UserRole::getMiddlewareSuperAdminRole()]], function (){
                // manage-admin
                Route::group(['prefix' => 'manage-admin', 'as' => 'manage-admin.', 'controller' => AdminController::class], function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'store')->name('store');
                    Route::get('/add', 'create')->name('create');
                    Route::post('/data', 'data')->name('data');
                    Route::delete('/{user:id}', 'destroy')->name('destroy');
                });
            });
        });
    });
});
