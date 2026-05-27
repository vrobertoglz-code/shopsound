<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Orden;
use App\Models\DetalleOrden;
use App\Models\Producto;

class OrdenController extends Controller
{
    public function store(Request $request)
    {

        try {

            $orden = Orden::create([

                'cliente' => $request->cliente,

                'correo' => $request->correo,

                'telefono' => $request->telefono,

                'direccion' => $request->direccion,

                'total' => $request->total

            ]);

            foreach ($request->productos as $item) {

                DetalleOrden::create([

                    'orden_id' => $orden->id,

                    'producto_id' => $item['id'],

                    'cantidad' => $item['cantidad'],

                    'precio' => $item['precio']

                ]);

                // STOCK

                $producto = Producto::find(
                    $item['id']
                );

                if ($producto) {

                    // EVITAR NEGATIVOS

                    if (
                        $producto->stock >=
                        $item['cantidad']
                    ) {

                        $producto->stock -=
                            $item['cantidad'];

                        $producto->save();

                    }

                }

            }

            return response()->json([

                'success' => true,
                'message' => 'Orden creada'

            ]);

        } catch (\Exception $e) {

            return response()->json([

                'success' => false,
                'error' => $e->getMessage()

            ], 500);

        }

    }
}