<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/26/25
 */

Route::group(['prefix' => 'ecommerce','namespace' => 'ecommerce','as' => 'ecommerce.'], function (){
    Route::group(['prefix' => 'brand','as' => 'brand.'], function (){
        Route::get("",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceBrandController::class,'index'])->name("index")
            ->defaults('description', 'Danh sách thương hiệu');
        Route::get("create",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceBrandController::class,'create'])->name("create")
            ->defaults('description', 'Thêm mới thương hiệu');
        Route::post("create",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceBrandController::class,'store'])
            ->defaults('description', 'Thêm mới thương hiệu');

        Route::get("update/{id}",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceBrandController::class,'edit'])->name("update")
            ->defaults('description', 'Cập nhật thương hiệu');
        Route::post("update/{id}",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceBrandController::class,'update'])
            ->defaults('description', 'Cập nhật thương hiệu');

        Route::get("delete/{id}",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceBrandController::class,'delete'])
            ->name("delete")
            ->defaults('description', 'Xoá thương hiệu');
    });
    Route::group(['prefix' => 'label','as' => 'label.'], function (){
        Route::get("",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceLabelController::class,'index'])->name("index")
            ->defaults('description', 'Danh sách nhãn');
        Route::get("create",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceLabelController::class,'create'])->name("create")
            ->defaults('description', 'Thêm mới nhãn');
        Route::post("create",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceLabelController::class,'store'])
            ->defaults('description', 'Thêm mới nhãn');

        Route::get("update/{id}",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceLabelController::class,'edit'])->name("update")
            ->defaults('description', 'Cập nhật nhãn');
        Route::post("update/{id}",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceLabelController::class,'update'])
            ->defaults('description', 'Cập nhật nhãn');

        Route::get("delete/{id}",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceLabelController::class,'delete'])
            ->name("delete")
            ->defaults('description', 'Xoá nhãn');
    });
    Route::group(['prefix' => 'category','as' => 'category.'], function (){
        Route::get("",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceCategoryController::class,'index'])->name("index")
            ->defaults('description', 'Danh sách danh mục');
        Route::get("create",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceCategoryController::class,'create'])->name("create")
            ->defaults('description', 'Thêm mới danh mục');
        Route::post("create",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceCategoryController::class,'store'])
            ->defaults('description', 'Thêm mới danh mục');

        Route::get("update/{id}",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceCategoryController::class,'edit'])->name("update")
            ->defaults('description', 'Cập nhật danh mục');
        Route::post("update/{id}",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceCategoryController::class,'update'])
            ->defaults('description', 'Cập nhật danh mục');

        Route::get("delete/{id}",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceCategoryController::class,'delete'])
            ->name("delete")
            ->defaults('description', 'Xoá danh mục');
    });
    Route::group(['prefix' => 'attribute','as' => 'attribute.'], function (){
        Route::get("",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceAttributeController::class,'index'])->name("index")
            ->defaults('description', 'Danh sách thuộc tính');
        Route::get("create",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceAttributeController::class,'create'])->name("create")
            ->defaults('description', 'Thêm mới thuộc tính');
        Route::post("create",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceAttributeController::class,'store'])
            ->defaults('description', 'Thêm mới thuộc tính');

        Route::get("update/{id}",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceAttributeController::class,'edit'])->name("update")
            ->defaults('description', 'Cập nhật thuộc tính');
        Route::post("update/{id}",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceAttributeController::class,'update'])
            ->defaults('description', 'Cập nhật thuộc tính');

        Route::get("delete/{id}",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceAttributeController::class,'delete'])
            ->name("delete")
            ->defaults('description', 'Xoá thuộc tính');
    });
    Route::group(['prefix' => 'product','as' => 'product.'], function (){
        Route::get("",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceProductController::class,'index'])->name("index")
            ->defaults('description', 'Danh sách sản phẩm');
        Route::get("create",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceProductController::class,'create'])->name("create")
            ->defaults('description', 'Thêm mới sản phẩm');
        Route::post("create",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceProductController::class,'store'])
            ->defaults('description', 'Thêm mới sản phẩm');

        Route::get("update/{id}",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceProductController::class,'edit'])->name("update")
            ->defaults('description', 'Cập nhật sản phẩm');
        Route::post("update/{id}",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceProductController::class,'update'])
            ->defaults('description', 'Cập nhật sản phẩm');

        Route::get("delete/{id}",[\App\Http\Controllers\Admin\Ecommerce\AdmEcommerceProductController::class,'delete'])
            ->name("delete")
            ->defaults('description', 'Xoá sản phẩm');
    });
});