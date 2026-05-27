<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\OrdenController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('categorias', CategoriaController::class);
    Route::resource('marcas', MarcaController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('clientes', ClienteController::class);
    Route::get('ventas', [VentaController::class, 'index'])
        ->name('ventas.index');

    Route::get('ventas/create', [VentaController::class, 'create'])
        ->name('ventas.create');

    Route::post('ventas', [VentaController::class, 'store'])
        ->name('ventas.store');
    Route::get('ventas/{venta}', [VentaController::class, 'show'])
    ->name('ventas.show');
    Route::get('ventas/{venta}/pdf', [VentaController::class, 'pdf'])
        ->name('ventas.pdf');

    Route::get(
        '/ordenes',
        [OrdenController::class, 'index']
    )->name('ordenes.index');

    Route::get(
        '/ordenes/{id}',
        [OrdenController::class, 'show']
    )->name('ordenes.show');

    Route::middleware(['role:admin'])->group(function () {

        Route::get('reportes',
            [ReporteController::class, 'index'])
            ->name('reportes.index');

        Route::post('reportes/ventas',
            [ReporteController::class, 'ventasPorFecha'])
            ->name('reportes.ventas');

    });
});

require __DIR__.'/auth.php';
