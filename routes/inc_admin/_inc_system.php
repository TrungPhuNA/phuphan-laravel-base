<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 2/3/25
 */

Route::group(['prefix' => 'system', 'namespace' => 'System', 'as' => 'system.'], function () {
    Route::get('', [\App\Http\Controllers\Admin\System\AdminSystemController::class, 'index'])
        ->name('general')->defaults('description', 'System hệ thống');
});

//AdminSettingAdsController