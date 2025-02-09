<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 2/9/25
 */

Route::group(['namespace' => 'Appearance','as' => 'appearance.'], function (){
    Route::group(['prefix' => 'menu','as' => 'menu.'], function (){
        Route::get("",[\App\Http\Controllers\Admin\Appearance\AdminMenuController::class,'index'])->name("index")
            ->defaults('description', 'Danh sách config menu');

        Route::get("create",[\App\Http\Controllers\Admin\Appearance\AdminMenuController::class,'create'])->name("create")
            ->defaults('description', 'Thêm mới config menu');
        Route::post("create",[\App\Http\Controllers\Admin\Appearance\AdminMenuController::class,'store'])
            ->defaults('description', 'Thêm mới config menu');

        Route::get("update/{id}",[\App\Http\Controllers\Admin\Appearance\AdminMenuController::class,'edit'])->name("update")
            ->defaults('description', 'Cập nhật config menu');
        Route::post("update/{id}",[\App\Http\Controllers\Admin\Appearance\AdminMenuController::class,'update'])
            ->defaults('description', 'Cập nhật config menu');

        Route::get("delete/{id}",[\App\Http\Controllers\Admin\Appearance\AdminMenuController::class,'delete'])
            ->name("delete")
            ->defaults('description', 'Xoá menu');
    });
    Route::group(['prefix' => 'menu/api','as' => 'menu.api.'], function (){
        Route::get("",[\App\Http\Controllers\Admin\Appearance\AdminMenuController::class,'getListsMenus'])->name("index")
            ->defaults('description', 'Danh sách config menu');
        Route::post("save",[\App\Http\Controllers\Admin\Appearance\AdminMenuController::class,'storeApi'])->name("save")
            ->defaults('description', 'Lưu config menu');
    });
    Route::group(['prefix' => 'pages','as' => 'pages.'], function (){
        Route::get("",[\App\Http\Controllers\Admin\Appearance\AdminPageController::class,'index'])->name("index")
            ->defaults('description', 'Danh sách page');

        Route::get("create",[\App\Http\Controllers\Admin\Appearance\AdminPageController::class,'create'])->name("create")
            ->defaults('description', 'Thêm mới page');
        Route::post("create",[\App\Http\Controllers\Admin\Appearance\AdminPageController::class,'store'])
            ->defaults('description', 'Thêm mới page');

        Route::get("update/{id}",[\App\Http\Controllers\Admin\Appearance\AdminPageController::class,'edit'])->name("update")
            ->defaults('description', 'Cập nhật page');
        Route::post("update/{id}",[\App\Http\Controllers\Admin\Appearance\AdminPageController::class,'update'])
            ->defaults('description', 'Cập nhật page');

        Route::get("delete/{id}",[\App\Http\Controllers\Admin\Appearance\AdminPageController::class,'delete'])
            ->name("delete")
            ->defaults('description', 'Xoá page');
    });
});