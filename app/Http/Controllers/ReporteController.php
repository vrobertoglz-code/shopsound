<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function index()
    {
        $productosSinStock = Producto::where('stock', '<=', 0)
            ->get();

        $productosMasVendidos = DB::table('detalle_ventas')
            ->join('productos', 'detalle_ventas.producto_id', '=', 'productos.id')
            ->select(
                'productos.nombre',
                DB::raw('SUM(detalle_ventas.cantidad) as total_vendidos')
            )
            ->groupBy('productos.nombre')
            ->orderByDesc('total_vendidos')
            ->take(5)
            ->get();

        return view('reportes.index', compact(
            'productosSinStock',
            'productosMasVendidos'
        ));
    }

    public function ventasPorFecha(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date'
        ]);

        $ventas = Venta::with('cliente')
            ->whereBetween('created_at', [
                $request->fecha_inicio,
                $request->fecha_fin
            ])
            ->get();

        $total = $ventas->sum('total');

        $productosSinStock = Producto::where('stock', '<=', 0)
            ->get();

        $productosMasVendidos = DB::table('detalle_ventas')
            ->join('productos', 'detalle_ventas.producto_id', '=', 'productos.id')
            ->select(
                'productos.nombre',
                DB::raw('SUM(detalle_ventas.cantidad) as total_vendidos')
            )
            ->groupBy('productos.nombre')
            ->orderByDesc('total_vendidos')
            ->take(5)
            ->get();

        return view('reportes.index', compact(
            'ventas',
            'total',
            'productosSinStock',
            'productosMasVendidos'
        ));
    }
}