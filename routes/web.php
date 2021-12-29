<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
	ProductController,
	TagController,
};

Route::get('/', function () {
    return redirect('tags');
});

Route::resource('tags', TagController::class);

Route::resource('products', ProductController::class);

Route::get('products/filto/{id}', [App\Http\Controllers\ProductController::class, 'filtroTag'])->name('filtroTag');

Auth::routes();


