<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\OrdenController;
use App\Http\Controllers\Api\ProductoApiController;

Route::get('/productos', [
    ProductoApiController::class,
    'index'
]);

Route::post('/ordenes', [
    OrdenController::class,
    'store'
]);