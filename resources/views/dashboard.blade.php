<x-app-layout>

    <div class="p-6">

        <h1 class="text-3xl font-bold mb-6">
            Dashboard ShopSound
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white shadow rounded p-6">

                <h2 class="text-gray-500 text-sm">
                    Productos
                </h2>

                <p class="text-3xl font-bold mt-2">
                    0
                </p>

            </div>

            <div class="bg-white shadow rounded p-6">

                <h2 class="text-gray-500 text-sm">
                    Ventas
                </h2>

                <p class="text-3xl font-bold mt-2">
                    $0
                </p>

            </div>

            <div class="bg-white shadow rounded p-6">

                <h2 class="text-gray-500 text-sm">
                    Clientes
                </h2>

                <p class="text-3xl font-bold mt-2">
                    0
                </p>

            </div>

            <div class="bg-white shadow rounded p-6">

                <h2 class="text-gray-500 text-sm">
                    Categorías
                </h2>

                <p class="text-3xl font-bold mt-2">
                    {{ \App\Models\Categoria::count() }}
                </p>

            </div>

        </div>

    </div>

</x-app-layout>