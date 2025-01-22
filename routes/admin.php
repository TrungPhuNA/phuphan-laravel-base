<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/22/25
 */

use Illuminate\Support\Facades\Route;

Route::get('',[\App\Http\Controllers\Admin\AdminDashboardController::class,'index']);