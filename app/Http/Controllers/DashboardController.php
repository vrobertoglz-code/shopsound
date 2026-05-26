<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Venta;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProductos = Producto::count();

        $totalClientes = Cliente::count();

        $totalVentas = Venta::count();

        $ingresos = Venta::sum('total');

        $productosBajos = Producto::where('stock', '<=', 5)
            ->get();

        $ventasRecientes = Venta::with('cliente')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalProductos',
            'totalClientes',
            'totalVentas',
            'ingresos',
            'productosBajos',
            'ventasRecientes'
        ));
    }
}