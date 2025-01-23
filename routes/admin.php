<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/22/25
 */

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin','namespace' => 'Admin','as' => 'admin.','middleware' => ['check.login.admin']], function (){
    Route::get('',[\App\Http\Controllers\Admin\AdminDashboardController::class,'index'])
        ->name('dashboard')->middleware('permission:full|admin.dashboard')->defaults('description', 'Thống kê');
    require_once "inc_admin/_inc_setting.php";
    require_once "inc_admin/_inc_acl.php";
})->middleware("permission");