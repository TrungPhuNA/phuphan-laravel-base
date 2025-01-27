<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/22/25
 */

Route::get('setting',[\App\Http\Controllers\Admin\Setting\AdminSettingInfoController::class,'index'])
    ->name('setting')->defaults('description', 'Cấu hình, cập nhật thông tin');
Route::post('setting',[\App\Http\Controllers\Admin\Setting\AdminSettingInfoController::class,'updateSetting'])
    ->defaults('description', 'Lưu Cấu hình, cập nhật thông tin');

Route::group(['prefix' => 'setting','namespace' => 'Setting','as' => 'setting.'], function (){
    Route::group(['prefix' => 'ads','as' => 'ads.'], function (){
        Route::get("",[\App\Http\Controllers\Admin\Setting\AdminSettingAdsController::class,'index'])->name("index")
            ->defaults('description', 'Cấu hình ads');
        Route::post("",[\App\Http\Controllers\Admin\Setting\AdminSettingAdsController::class,'store'])
            ->defaults('description', 'Lưu cấu hình ads');
    });
});

//AdminSettingAdsController