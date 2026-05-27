<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Venta;
use App\Models\Orden;

class DashboardController extends Controller
{
    public function index()
    {
        // PRODUCTOS

        $totalProductos =
            Producto::count();

        // CATEGORIAS

        $totalCategorias =
            Categoria::count();

        // VENTAS FISICAS

        $ventasFisicas =
            Venta::sum('total');

        // ORDENES WEB

        $ventasWeb =
            Orden::sum('total');

        // TOTAL INGRESOS

        $ingresosTotales =
            $ventasFisicas + $ventasWeb;

        // VENTAS RECIENTES

        $ventasRecientes =
            Venta::latest()
                ->take(5)
                ->get();

        // ORDENES RECIENTES

        $ordenesRecientes =
            Orden::latest()
                ->take(5)
                ->get();

        return view('dashboard', compact(

            'totalProductos',
            'totalCategorias',
            'ventasFisicas',
            'ventasWeb',
            'ingresosTotales',
            'ventasRecientes',
            'ordenesRecientes'

        ));
    }
}