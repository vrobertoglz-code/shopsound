<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Marca;

class MarcaApiController extends Controller
{
    public function index()
    {
        return response()->json(
            Marca::all()
        );
    }
}