<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/22/25
 */

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin','namespace' => 'Admin','as' => 'admin.','middleware' => ['check.login.admin','log.requests']], function (){
    Route::get('',[\App\Http\Controllers\Admin\AdminDashboardController::class,'index'])
        ->name('dashboard')->middleware('permission:full|admin.dashboard')->defaults('description', 'Thống kê');
    require_once "inc_admin/_inc_system.php";
    require_once "inc_admin/_inc_setting.php";
    require_once "inc_admin/_inc_acl.php";
    require_once "inc_admin/_inc_blog.php";
    require_once "inc_admin/_inc_ecommerce.php";
    require_once "inc_admin/_inc_appearance.php";

    Route::group(['prefix' => 'laravel-filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
})->middleware("permission");