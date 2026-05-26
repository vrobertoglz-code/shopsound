<x-app-layout>

    <div class="p-6 max-w-2xl mx-auto">

        <h1 class="text-2xl font-bold mb-6">
            Nueva Marca
        </h1>

        <form action="{{ route('marcas.store') }}"
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
                    Descripción
                </label>

                <textarea name="descripcion"
                          class="w-full border rounded px-4 py-2"></textarea>

            </div>

            <button type="submit"
                    class="bg-green-500 text-white px-4 py-2 rounded">

                Guardar

            </button>

        </form>

    </div>

</x-app-layout>