<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/23/25
 */

Route::group(['prefix' => 'blog','namespace' => 'Blog','as' => 'blog.'], function (){
    Route::group(['prefix' => 'tag','as' => 'tag.'], function (){
        Route::get("",[\App\Http\Controllers\Admin\Blog\AdmBlogTagController::class,'index'])->name("index")
            ->defaults('description', 'Danh sách tags');
        Route::get("create",[\App\Http\Controllers\Admin\Blog\AdmBlogTagController::class,'create'])->name("create")
            ->defaults('description', 'Thêm mới tags');
        Route::post("create",[\App\Http\Controllers\Admin\Blog\AdmBlogTagController::class,'store'])
            ->defaults('description', 'Thêm mới tags');

        Route::get("update/{id}",[\App\Http\Controllers\Admin\Blog\AdmBlogTagController::class,'edit'])->name("update")
            ->defaults('description', 'Cập nhật tags');
        Route::post("update/{id}",[\App\Http\Controllers\Admin\Blog\AdmBlogTagController::class,'update'])
            ->defaults('description', 'Cập nhật tags');

        Route::get("delete/{id}",[\App\Http\Controllers\Admin\Blog\AdmBlogTagController::class,'delete'])
            ->name("delete")
            ->defaults('description', 'Xoá tags');
    });
    Route::group(['prefix' => 'menu','as' => 'menu.'], function (){
        Route::get("",[\App\Http\Controllers\Admin\Blog\AdmBlogMenuController::class,'index'])->name("index")
            ->defaults('description', 'Danh sách menu');

        Route::get("create",[\App\Http\Controllers\Admin\Blog\AdmBlogMenuController::class,'create'])->name("create")
            ->defaults('description', 'Thêm mới menu');
        Route::post("create",[\App\Http\Controllers\Admin\Blog\AdmBlogMenuController::class,'store'])
            ->defaults('description', 'Thêm mới menu');

        Route::get("update/{id}",[\App\Http\Controllers\Admin\Blog\AdmBlogMenuController::class,'edit'])->name("update")
            ->defaults('description', 'Cập nhật menu');
        Route::post("update/{id}",[\App\Http\Controllers\Admin\Blog\AdmBlogMenuController::class,'update'])
            ->defaults('description', 'Cập nhật menu');

        Route::get("delete/{id}",[\App\Http\Controllers\Admin\Blog\AdmBlogMenuController::class,'delete'])
            ->name("delete")
            ->defaults('description', 'Xoá menu');
    });
    Route::group(['prefix' => 'article','as' => 'article.'], function (){
        Route::get("",[\App\Http\Controllers\Admin\Blog\AdmBlogArticleController::class,'index'])->name("index")
            ->defaults('description', 'Danh sách bài viết');
        Route::get("create",[\App\Http\Controllers\Admin\Blog\AdmBlogArticleController::class,'create'])->name("create")
            ->defaults('description', 'Thêm mới bài viết');
        Route::post("create",[\App\Http\Controllers\Admin\Blog\AdmBlogArticleController::class,'store'])
            ->defaults('description', 'Thêm mới bài viết');

        Route::get("update/{id}",[\App\Http\Controllers\Admin\Blog\AdmBlogArticleController::class,'edit'])->name("update")
            ->defaults('description', 'Cập nhật bài viết');
        Route::post("update/{id}",[\App\Http\Controllers\Admin\Blog\AdmBlogArticleController::class,'update'])
            ->defaults('description', 'Cập nhật bài viết');

        Route::get("delete/{id}",[\App\Http\Controllers\Admin\Blog\AdmBlogArticleController::class,'delete'])
            ->name("delete")
            ->defaults('description', 'Xoá bài viết');
    });
});