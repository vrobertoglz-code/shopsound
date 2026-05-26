<x-app-layout>

    <div class="p-6 max-w-3xl mx-auto">

        <h1 class="text-2xl font-bold mb-6">
            Editar Cliente
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

        <form action="{{ route('clientes.update', $cliente->id) }}"
              method="POST"
              class="bg-white p-6 rounded shadow">

            @csrf
            @method('PUT')

            <div class="mb-4">

                <label class="block mb-2">
                    Nombre
                </label>

                <input type="text"
                       name="nombre"
                       value="{{ old('nombre', $cliente->nombre) }}"
                       class="w-full border rounded px-4 py-2"
                       required>

            </div>

            <div class="mb-4">

                <label class="block mb-2">
                    Teléfono
                </label>

                <input type="text"
                       name="telefono"
                       value="{{ old('telefono', $cliente->telefono) }}"
                       class="w-full border rounded px-4 py-2">

            </div>

            <div class="mb-4">

                <label class="block mb-2">
                    Email
                </label>

                <input type="email"
                       name="email"
                       value="{{ old('email', $cliente->email) }}"
                       class="w-full border rounded px-4 py-2">

            </div>

            <div class="mb-4">

                <label class="block mb-2">
                    Dirección
                </label>

                <textarea name="direccion"
                          rows="4"
                          class="w-full border rounded px-4 py-2">{{ old('direccion', $cliente->direccion) }}</textarea>

            </div>

            <div class="flex gap-4">

                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">

                    Actualizar Cliente

                </button>

                <a href="{{ route('clientes.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">

                    Cancelar

                </a>

            </div>

        </form>

    </div>

</x-app-layout>