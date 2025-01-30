<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/27/25
 */

Route::group(['prefix' => 'news','namespace' => 'Fe/Blog','as' => 'news.'], function (){
    Route::get("a/{slug}.html",[\App\Http\Controllers\Fe\Blog\BlogArticleController::class,'index'])->name("article.detail")
        ->defaults('description', 'Chi tiết bài viết');
    Route::get("m/{slug}.html",[\App\Http\Controllers\Fe\Blog\BlogMenuController::class,'index'])->name("menu.index")
        ->defaults('description', 'trang chủ menu');
    Route::get("",[\App\Http\Controllers\Fe\Blog\BlogHomeController::class,'index'])->name("index")
        ->defaults('description', 'trang chủ bài viết');
});