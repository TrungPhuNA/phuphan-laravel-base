<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/22/25
 */

Route::get('setting',[\App\Http\Controllers\Admin\AdminSettingInfoController::class,'index'])
    ->name('setting')->defaults('description', 'Cấu hình, cập nhật thông tin');
Route::post('setting',[\App\Http\Controllers\Admin\AdminSettingInfoController::class,'updateSetting'])
    ->defaults('description', 'Lưu Cấu hình, cập nhật thông tin');