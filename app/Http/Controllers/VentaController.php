<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('cliente')
            ->latest()
            ->paginate(10);

        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $clientes = Cliente::where('activo', true)->get();

        $productos = Producto::where('activo', true)
            ->where('stock', '>', 0)
            ->get();

        return view(
            'ventas.create',
            compact(
                'clientes',
                'productos'
            )
        );
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $venta = Venta::create([
                'cliente_id' => $request->cliente_id,
                'total' => 0
            ]);

            $total = 0;

            foreach ($request->productos as $item) {

                $producto = Producto::findOrFail($item['producto_id']);

                if ($item['cantidad'] > $producto->stock) {

                    throw new \Exception(
                        'Stock insuficiente para el producto: ' .
                        $producto->nombre
                    );
                }

                $subtotal = $item['cantidad'] * $producto->precio;

                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $item['cantidad'],
                    'precio' => $producto->precio,
                    'subtotal' => $subtotal
                ]);

                $producto->update([
                    'stock' => $producto->stock - $item['cantidad']
                ]);

                $total += $subtotal;
            }

            $venta->update([
                'total' => $total
            ]);

            DB::commit();

            return redirect()
                ->route('ventas.index')
                ->with('success', 'Venta registrada correctamente');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->withErrors([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function show(Venta $venta)
    {
        $venta->load([
            'cliente',
            'detalles.producto'
        ]);

        return view('ventas.show', compact('venta'));
    }
}