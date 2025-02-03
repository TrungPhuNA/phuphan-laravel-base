<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 2/3/25
 */

Route::group(['prefix' => 'system', 'namespace' => 'System', 'as' => 'system.'], function () {
    Route::get('', [\App\Http\Controllers\Admin\System\AdminSystemController::class, 'index'])
        ->name('general')->defaults('description', 'System hệ thống');

    Route::group(['prefix' => 'log-request','as' => 'log.request.'], function (){
        Route::get("",[\App\Http\Controllers\Admin\System\AdminSystemLogRequestController::class,'index'])->name("index")
            ->defaults('description', 'Danh sách log request');

        Route::get('download', [\App\Http\Controllers\Admin\System\AdminSystemLogRequestController::class, 'download'])->name('download');
        Route::get('delete', [\App\Http\Controllers\Admin\System\AdminSystemLogRequestController::class, 'destroy'])->name('delete');
    });
});

//AdminSettingAdsController