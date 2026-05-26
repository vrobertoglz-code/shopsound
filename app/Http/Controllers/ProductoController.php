<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with(['categoria', 'marca'])
            ->paginate(10);

        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::where('activo', true)->get();

        $marcas = Marca::where('activo', true)->get();

        return view('productos.create', compact('categorias', 'marcas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required',
            'marca_id' => 'required'
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {

            $data['imagen'] = $request->file('imagen')
                ->store('productos', 'public');
        }

        Producto::create($data);

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto creado correctamente');
    }
public function edit(string $id)
{
    $producto = Producto::findOrFail($id);

    $categorias = Categoria::where('activo', true)->get();

    $marcas = Marca::where('activo', true)->get();

    return view(
        'productos.edit',
        compact(
            'producto',
            'categorias',
            'marcas'
        )
    );
}

public function update(Request $request, string $id)
{
    $producto = Producto::findOrFail($id);

    $request->validate([
        'nombre' => 'required|max:255',
        'precio' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'categoria_id' => 'required',
        'marca_id' => 'required'
    ]);
    $data = $request->all();

    if ($request->hasFile('imagen')) {

        $data['imagen'] = $request->file('imagen')
            ->store('productos', 'public');
    }

    $producto->update($data);

    return redirect()
        ->route('productos.index')
        ->with('success', 'Producto actualizado correctamente');
}

public function destroy(string $id)
{
    $producto = Producto::findOrFail($id);

    $producto->update([
        'activo' => false
    ]);

    return redirect()
        ->route('productos.index')
        ->with('success', 'Producto desactivado correctamente');
}
}