<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/22/25
 */

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth','namespace' => 'Auth','as' => 'auth.'], function (){
    Route::get('login',[\App\Http\Controllers\Auth\LoginController::class,'index'])->name("login");
    Route::post('login',[\App\Http\Controllers\Auth\LoginController::class,'login']);

    Route::get('register',[\App\Http\Controllers\Auth\RegisterController::class,'index'])->name("register");
    Route::post('register',[\App\Http\Controllers\Auth\RegisterController::class,'register']);
    Route::get('alert',[\App\Http\Controllers\Auth\RegisterController::class,'alertRegister'])->name("alert.register");

    Route::get('reset-password',[\App\Http\Controllers\Auth\RegisterController::class,'resetPassword'])->name("reset.password");
});