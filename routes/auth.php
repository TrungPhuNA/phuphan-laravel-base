<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/22/25
 */

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth','namespace' => 'Auth','as' => 'auth.'], function (){
    Route::get('login',[\App\Http\Controllers\Auth\LoginController::class,'index'])->name("login")
        ->defaults('description', 'Đăng nhập');
    Route::post('login',[\App\Http\Controllers\Auth\LoginController::class,'login'])
        ->defaults('description', 'Đăng nhập');

    Route::get('register',[\App\Http\Controllers\Auth\RegisterController::class,'index'])->name("register")
        ->defaults('description', 'Đăng ký');
    Route::post('register',[\App\Http\Controllers\Auth\RegisterController::class,'register'])
        ->defaults('description', 'Đăng ký');

    Route::get('active-account',[\App\Http\Controllers\Auth\RegisterController::class,'viewActiveAccount'])->name('active.account')
        ->defaults('description', 'Kích hoạt tài khoản');
    Route::post('active-account',[\App\Http\Controllers\Auth\RegisterController::class,'activeAccount'])
        ->name("verify.account")
        ->defaults('description', 'Kích hoạt tài khoản');

    Route::get('alert',[\App\Http\Controllers\Auth\RegisterController::class,'alertRegister'])->name("alert.register")
        ->defaults('description', 'Thông báo đăng ký');

    Route::get('reset-password',[\App\Http\Controllers\Auth\ChangePasswordController::class,'resetPassword'])->name("reset.password")
        ->defaults('description', 'Quên mật khẩu');
    Route::post('reset-password',[\App\Http\Controllers\Auth\ChangePasswordController::class,'processResetPassword'])
        ->defaults('description', 'Quên mật khẩu');

    Route::get('change-password/{token}',[\App\Http\Controllers\Auth\ChangePasswordController::class,'changePassword'])->name("change.password")
        ->defaults('description', 'Thay đổi mật khẩu');
    Route::post('change-password/{token}',[\App\Http\Controllers\Auth\ChangePasswordController::class,'updatePassword'])
        ->defaults('description', 'Thay đổi mật khẩu');

    Route::get('logout',[\App\Http\Controllers\Auth\RegisterController::class,'logout'])->name("logout")
        ->defaults('description', 'Đăng xuất');
});