<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController; 
use App\Http\Controllers\CategoryController;





// Define a route to show the products list
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);

