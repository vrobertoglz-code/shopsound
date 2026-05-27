<?php

namespace App\Http\Controllers;

use App\Models\Orden;

class OrdenController extends Controller
{
    public function index()
    {
        $ordenes = Orden::latest()
            ->paginate(10);

        return view(
            'ordenes.index',
            compact('ordenes')
        );
    }

    public function show($id)
    {
        $orden = Orden::with(
            'detalles.producto'
        )->findOrFail($id);

        return view(
            'ordenes.show',
            compact('orden')
        );
    }
}