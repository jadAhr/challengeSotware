<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

// Welcome Page Route
Route::get('/', function () {
    return view('welcome');
});

// Products Page (Blade + Vue) - Display products list
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Show form for creating a product
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// API: Fetch Products in JSON Format
Route::get('/api/products', [ProductController::class, 'apiIndex'])->name('api.products.index');

// API: Fetch Categories in JSON Format
Route::get('/api/categories', [CategoryController::class, 'apiIndex'])->name('api.categories.index');

// Store a new product
Route::post('/products', [ProductController::class, 'store'])->name('products.store');



