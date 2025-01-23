<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/22/25
 */

Route::group(['prefix' => 'acl','namespace' => 'Acl','as' => 'acl.'], function (){
    Route::group(['prefix' => 'account','as' => 'account.'], function (){
        Route::get("",[\App\Http\Controllers\Admin\Acl\AclAccountController::class,'index'])->name("index")
            ->defaults('description', 'Danh sách tài khoản');
        Route::get("create",[\App\Http\Controllers\Admin\Acl\AclAccountController::class,'create'])->name("create")
            ->defaults('description', 'Thêm mới tài khoản');
        Route::post("create",[\App\Http\Controllers\Admin\Acl\AclAccountController::class,'store'])
            ->defaults('description', 'Thêm mới tài khoản');

        Route::get("update/{id}",[\App\Http\Controllers\Admin\Acl\AclAccountController::class,'edit'])->name("update")
            ->defaults('description', 'Cập nhật tài khoản');
        Route::post("update/{id}",[\App\Http\Controllers\Admin\Acl\AclAccountController::class,'update'])
            ->defaults('description', 'Cập nhật tài khoản');
    });
    Route::group(['prefix' => 'permission','as' => 'permission.'], function (){
        Route::get("",[\App\Http\Controllers\Admin\Acl\AclPermissionController::class,'index'])->name("index")
            ->defaults('description', 'Danh sách permission');

        Route::get("create",[\App\Http\Controllers\Admin\Acl\AclPermissionController::class,'create'])->name("create")
            ->defaults('description', 'Thêm mới permission');
        Route::post("create",[\App\Http\Controllers\Admin\Acl\AclPermissionController::class,'store'])
            ->defaults('description', 'Thêm mới permission');

        Route::get("update/{id}",[\App\Http\Controllers\Admin\Acl\AclPermissionController::class,'edit'])->name("update")
            ->defaults('description', 'Cập nhật permission');
        Route::post("update/{id}",[\App\Http\Controllers\Admin\Acl\AclPermissionController::class,'update'])
            ->defaults('description', 'Cập nhật permission');
    });
    Route::group(['prefix' => 'role','as' => 'role.'], function (){
        Route::get("",[\App\Http\Controllers\Admin\Acl\AclRoleController::class,'index'])->name("index")
            ->defaults('description', 'Danh sách nhóm quyền');
        Route::get("create",[\App\Http\Controllers\Admin\Acl\AclRoleController::class,'create'])->name("create")
            ->defaults('description', 'Thêm mới nhóm quyền');
        Route::post("create",[\App\Http\Controllers\Admin\Acl\AclRoleController::class,'store'])
            ->defaults('description', 'Thêm mới nhóm quyền');

        Route::get("update/{id}",[\App\Http\Controllers\Admin\Acl\AclRoleController::class,'edit'])->name("update")
            ->defaults('description', 'Cập nhật nhóm quyền');
        Route::post("update/{id}",[\App\Http\Controllers\Admin\Acl\AclRoleController::class,'update'])
            ->defaults('description', 'Cập nhật nhóm quyền');
    });
});