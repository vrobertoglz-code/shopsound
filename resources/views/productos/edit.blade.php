<x-app-layout>

    <div class="p-6 max-w-3xl mx-auto">

        <h1 class="text-2xl font-bold mb-6">
            Editar Producto
        </h1>

        @if ($errors->any())

            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">

                <ul class="list-disc list-inside">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('productos.update', $producto->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="bg-white p-6 rounded shadow">

            @csrf
            @method('PUT')

            <div class="mb-4">

                <label class="block mb-2">
                    Nombre
                </label>

                <input type="text"
                       name="nombre"
                       value="{{ old('nombre', $producto->nombre) }}"
                       class="w-full border rounded px-4 py-2"
                       required>

            </div>

            <div class="mb-4">

                <label class="block mb-2">
                    Descripción
                </label>

                <textarea name="descripcion"
                          class="w-full border rounded px-4 py-2"
                          rows="4">{{ old('descripcion', $producto->descripcion) }}</textarea>

            </div>

            <div class="grid grid-cols-2 gap-4">

                <div class="mb-4">

                    <label class="block mb-2">
                        Precio
                    </label>

                    <input type="number"
                           step="0.01"
                           name="precio"
                           value="{{ old('precio', $producto->precio) }}"
                           class="w-full border rounded px-4 py-2"
                           required>

                </div>

                <div class="mb-4">

                    <label class="block mb-2">
                        Stock
                    </label>

                    <input type="number"
                           name="stock"
                           value="{{ old('stock', $producto->stock) }}"
                           class="w-full border rounded px-4 py-2"
                           required>

                </div>

            </div>

            <div class="mb-4">

                <label class="block mb-2">
                    Imagen del Producto
                </label>

                <input type="file"
                       name="imagen"
                       class="w-full border rounded px-4 py-2">

            </div>

            @if($producto->imagen)

                <div class="mb-4">

                    <p class="mb-2 text-sm text-gray-600">
                        Imagen actual
                    </p>

                    <img src="{{ asset('storage/' . $producto->imagen) }}"
                         class="w-32 h-32 object-cover rounded shadow">

                </div>

            @endif

            <div class="grid grid-cols-2 gap-4">

                <div class="mb-4">

                    <label class="block mb-2">
                        Categoría
                    </label>

                    <select name="categoria_id"
                            class="w-full border rounded px-4 py-2"
                            required>

                        @foreach($categorias as $categoria)

                            <option value="{{ $categoria->id }}"
                                {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>

                                {{ $categoria->nombre }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-4">

                    <label class="block mb-2">
                        Marca
                    </label>

                    <select name="marca_id"
                            class="w-full border rounded px-4 py-2"
                            required>

                        @foreach($marcas as $marca)

                            <option value="{{ $marca->id }}"
                                {{ $producto->marca_id == $marca->id ? 'selected' : '' }}>

                                {{ $marca->nombre }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

            <div class="flex gap-4 mt-6">

                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">

                    Actualizar Producto

                </button>

                <a href="{{ route('productos.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">

                    Cancelar

                </a>

            </div>

        </form>

    </div>

</x-app-layout>