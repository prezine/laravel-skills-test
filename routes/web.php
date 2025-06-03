<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/form', function () {
    return view('form');
});

Route::get('/edit', function () {
    return view('edit');
});

Route::post('/submit', [ProductController::class, 'store']);
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products/update/{index}', [ProductController::class, 'update']);
