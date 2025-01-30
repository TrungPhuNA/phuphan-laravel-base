<?php

use Illuminate\Support\Facades\Route;

require_once "inc_web_blog/inc_blog.php";

Route::get('/', function () {
    return view('welcome');
});
