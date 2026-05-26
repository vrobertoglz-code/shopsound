<x-app-layout>

    <div class="p-6 max-w-3xl mx-auto">

        <h1 class="text-2xl font-bold mb-6">
            Nuevo Cliente
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

        <form action="{{ route('clientes.store') }}"
              method="POST"
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
                    Teléfono
                </label>

                <input type="text"
                       name="telefono"
                       class="w-full border rounded px-4 py-2">

            </div>

            <div class="mb-4">

                <label class="block mb-2">
                    Email
                </label>

                <input type="email"
                       name="email"
                       class="w-full border rounded px-4 py-2">

            </div>

            <div class="mb-4">

                <label class="block mb-2">
                    Dirección
                </label>

                <textarea name="direccion"
                          rows="4"
                          class="w-full border rounded px-4 py-2"></textarea>

            </div>

            <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">

                Guardar Cliente

            </button>

        </form>

    </div>

</x-app-layout>