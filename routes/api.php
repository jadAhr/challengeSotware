<?php

use Illuminate\Support\Facades\Route;   
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/categories', [CategoryController::class, 'apiIndex']);
Route::post('/products', [ProductController::class, 'store']);
