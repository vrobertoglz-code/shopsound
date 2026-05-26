<x-app-layout>

    <div class="p-6 max-w-3xl mx-auto">

        <h1 class="text-2xl font-bold mb-6">
            Nuevo Producto
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

          <form action="{{ route('productos.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="bg-white p-6 rounded shadow">

            @csrf

            <div class="mb-4">

                <label class="block mb-2">
                    Nombre
                </label>

                <input type="text"
                       name="nombre"
                       class="w-full border rounded px-4 py-2"
                       required>

            </div>

            <div class="mb-4">

                <label class="block mb-2">
                    Descripción
                </label>

                <textarea name="descripcion"
                          class="w-full border rounded px-4 py-2"></textarea>

            </div>

            <div class="mb-4">

                <label class="block mb-2">
                    Imagen
                </label>

                <input type="file"
                       name="imagen"
                       class="w-full border rounded px-4 py-2">

            </div>

            <div class="grid grid-cols-2 gap-4">

                <div class="mb-4">

                    <label class="block mb-2">
                        Precio
                    </label>

                    <input type="number"
                           step="0.01"
                           name="precio"
                           class="w-full border rounded px-4 py-2"
                           required>

                </div>

                <div class="mb-4">

                    <label class="block mb-2">
                        Stock
                    </label>

                    <input type="number"
                           name="stock"
                           class="w-full border rounded px-4 py-2"
                           required>

                </div>

            </div>

            <div class="grid grid-cols-2 gap-4">

                <div class="mb-4">

                    <label class="block mb-2">
                        Categoría
                    </label>

                    <select name="categoria_id"
                            class="w-full border rounded px-4 py-2"
                            required>

                        <option value="">
                            Seleccione
                        </option>

                        @foreach($categorias as $categoria)

                            <option value="{{ $categoria->id }}">

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

                        <option value="">
                            Seleccione
                        </option>

                        @foreach($marcas as $marca)

                            <option value="{{ $marca->id }}">

                                {{ $marca->nombre }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

            <button type="submit"
                    class="bg-green-500 text-white px-4 py-2 rounded">

                Guardar Producto

            </button>

        </form>

    </div>

</x-app-layout>