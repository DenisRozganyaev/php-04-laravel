<?php
use Illuminate\Support\Facades\Route;

Route::resource('products', \App\Http\Controllers\Api\V1\ProductsController::class);
