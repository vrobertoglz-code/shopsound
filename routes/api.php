<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\OrdenController;
use App\Http\Controllers\Api\ProductoApiController;
use App\Http\Controllers\Api\CategoriaApiController;
use App\Http\Controllers\Api\MarcaApiController;

Route::get('/productos', [
    ProductoApiController::class,
    'index'
]);

Route::get(
    '/categorias',
    [CategoriaApiController::class, 'index']
);

Route::get(
    '/marcas',
    [MarcaApiController::class, 'index']
);

Route::post('/ordenes', [
    OrdenController::class,
    'store'
]);