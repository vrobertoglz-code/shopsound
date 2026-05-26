<x-app-layout>

    <div class="p-6 max-w-2xl mx-auto">

        <h1 class="text-2xl font-bold mb-6">
            Editar Categoría
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

        <form action="{{ route('categorias.update', $categoria->id) }}"
              method="POST"
              class="bg-white p-6 rounded shadow">

            @csrf
            @method('PUT')

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Nombre
                </label>

                <input type="text"
                       name="nombre"
                       value="{{ old('nombre', $categoria->nombre) }}"
                       class="w-full border rounded px-4 py-2"
                       required>

            </div>

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Descripción
                </label>

                <textarea name="descripcion"
                          class="w-full border rounded px-4 py-2"
                          rows="4">{{ old('descripcion', $categoria->descripcion) }}</textarea>

            </div>

            <div class="flex gap-4">

                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">

                    Actualizar

                </button>

                <a href="{{ route('categorias.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">

                    Cancelar

                </a>

            </div>

        </form>

    </div>

</x-app-layout>