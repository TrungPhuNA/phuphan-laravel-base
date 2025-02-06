<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Fe\HomeController;
use App\Http\Controllers\Fe\Ecommerce\ProductDetailController;
require_once "inc_web_blog/inc_blog.php";



Route::get("p/{slug}.html",[ProductDetailController::class,'index'])->name("get.product.detail")
    ->defaults('description', 'Home');
Route::get("",[\App\Http\Controllers\Fe\HomeController::class,'index'])->name("get.home")
    ->defaults('description', 'Home');

