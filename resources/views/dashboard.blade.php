<x-app-layout>

    <div class="p-6">

        <h1 class="text-3xl font-bold mb-6">
            Dashboard ShopSound
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- PRODUCTOS -->
            <div class="bg-white shadow rounded p-6">

                <h2 class="text-gray-500 text-sm">
                    Productos
                </h2>

                <p class="text-3xl font-bold mt-2 text-blue-600">
                    {{ \App\Models\Producto::count() }}
                </p>

            </div>

            <!-- VENTAS -->
            <div class="bg-white shadow rounded p-6">

                <h2 class="text-gray-500 text-sm">
                    Ventas
                </h2>

                <p class="text-3xl font-bold mt-2 text-green-600">
                    $0
                </p>

            </div>

            <!-- CLIENTES -->
            <div class="bg-white shadow rounded p-6">

                <h2 class="text-gray-500 text-sm">
                    Clientes
                </h2>

                <p class="text-3xl font-bold mt-2 text-purple-600">
                    0
                </p>

            </div>

            <!-- CATEGORÍAS -->
            <div class="bg-white shadow rounded p-6">

                <h2 class="text-gray-500 text-sm">
                    Categorías
                </h2>

                <p class="text-3xl font-bold mt-2 text-red-600">
                    {{ \App\Models\Categoria::count() }}
                </p>

            </div>

        </div>

        <!-- SEGUNDA FILA -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

            <!-- MARCAS -->
            <div class="bg-white shadow rounded p-6">

                <h2 class="text-gray-500 text-sm mb-2">
                    Marcas Registradas
                </h2>

                <p class="text-4xl font-bold text-yellow-600">
                    {{ \App\Models\Marca::count() }}
                </p>

            </div>

            <!-- PRODUCTOS ACTIVOS -->
            <div class="bg-white shadow rounded p-6">

                <h2 class="text-gray-500 text-sm mb-2">
                    Productos Activos
                </h2>

                <p class="text-4xl font-bold text-green-600">
                    {{ \App\Models\Producto::where('activo', true)->count() }}
                </p>

            </div>

        </div>

    </div>

</x-app-layout>