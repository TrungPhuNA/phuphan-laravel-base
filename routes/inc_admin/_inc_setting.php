<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/22/25
 */

Route::group(['prefix' => 'setting','namespace' => 'Setting','as' => 'setting.'], function (){
    Route::get('',[\App\Http\Controllers\Admin\Setting\AdminSettingInfoController::class,'index'])
        ->name('info')->defaults('description', 'Show toàn bộ menu cấu hình');

    Route::get('general',[\App\Http\Controllers\Admin\Setting\AdminSettingInfoController::class,'showUpdateInfo'])
        ->name('update.info')->defaults('description', 'Cập nhật cấu hình website');
    Route::post('general',[\App\Http\Controllers\Admin\Setting\AdminSettingInfoController::class,'updateSetting'])
        ->defaults('description', 'Lưu Cấu hình, cập nhật thông tin');

    Route::group(['prefix' => 'ads','as' => 'ads.'], function (){
        Route::get("",[\App\Http\Controllers\Admin\Setting\AdminSettingAdsController::class,'index'])->name("index")
            ->defaults('description', 'Cấu hình ads');
        Route::post("",[\App\Http\Controllers\Admin\Setting\AdminSettingAdsController::class,'store'])
            ->defaults('description', 'Lưu cấu hình ads');
    });

    Route::group(['prefix' => 'email','as' => 'email.'], function (){
        Route::get("",[\App\Http\Controllers\Admin\Setting\AdminSettingEmailController::class,'index'])->name("index")
            ->defaults('description', 'Cấu hình email');
        Route::post("",[\App\Http\Controllers\Admin\Setting\AdminSettingEmailController::class,'sendEmailTest'])
            ->defaults('description', 'Cấu hình email');
    });
});

//AdminSettingAdsController