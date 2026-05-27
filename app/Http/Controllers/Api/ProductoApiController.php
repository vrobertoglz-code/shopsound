<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Producto;

class ProductoApiController extends Controller
{
    public function index()
    {
        $productos = Producto::with(
            'categoria'
        )->get();

        return response()->json(
            $productos
        );
    }
}