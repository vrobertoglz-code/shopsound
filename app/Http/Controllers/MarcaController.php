<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::paginate(10);

        return view('marcas.index', compact('marcas'));
    }

    public function create()
    {
        return view('marcas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:marcas|max:255',
            'descripcion' => 'nullable'
        ]);

        Marca::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'activo' => true
        ]);

        return redirect()
            ->route('marcas.index')
            ->with('success', 'Marca creada correctamente');
    }

    public function edit(string $id)
    {
        $marca = Marca::findOrFail($id);

        return view('marcas.edit', compact('marca'));
    }

    public function update(Request $request, string $id)
    {
        $marca = Marca::findOrFail($id);

        $request->validate([
            'nombre' => 'required|max:255|unique:marcas,nombre,' . $marca->id,
            'descripcion' => 'nullable'
        ]);

        $marca->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);

        return redirect()
            ->route('marcas.index')
            ->with('success', 'Marca actualizada correctamente');
    }

    public function destroy(string $id)
    {
        $marca = Marca::findOrFail($id);

        $marca->update([
            'activo' => false
        ]);

        return redirect()
            ->route('marcas.index')
            ->with('success', 'Marca desactivada correctamente');
    }
}