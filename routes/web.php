<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Fe\Ecommerce\ProductDetailController;
use App\Http\Controllers\Fe\Ecommerce\ShoppingCart\ShoppingCartController;
require_once "inc_web_blog/inc_blog.php";


Route::group(["prefix" => "cart","as" => "cart."], function (){
    Route::get("",[ShoppingCartController::class,'index'])->name("index");
    Route::post('add', [ShoppingCartController::class, 'addToCart'])->name('add');
    Route::post('update', [ShoppingCartController::class, 'updateCart'])->name('update');
    Route::post('remove', [ShoppingCartController::class, 'removeFromCart'])->name('remove');
    Route::post('checkout', [ShoppingCartController::class, 'checkout'])->name('checkout');
});
Route::get("test.html",[\App\Http\Controllers\TestController::class,'index'])->name("get.test")
    ->defaults('description', 'Test');
Route::get("api/countries",[\App\Http\Controllers\TestController::class,'getCountriesGeoJSON'])
    ->defaults('description', 'Test');

Route::get("p/{slug}.html",[ProductDetailController::class,'index'])->name("get.product.detail")
    ->defaults('description', 'Home');
Route::get("",[\App\Http\Controllers\Fe\HomeController::class,'index'])->name("get.home")
    ->defaults('description', 'Home');

