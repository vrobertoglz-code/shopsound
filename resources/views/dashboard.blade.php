<x-app-layout>

    <div class="p-6">

        <h1 class="text-3xl font-bold mb-6">

            Dashboard ShopSound

        </h1>

        <!-- CARDS -->

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

            <div class="bg-white shadow rounded p-6">

                <h2 class="text-gray-500 text-sm">
                    Productos
                </h2>

                <p class="text-3xl font-bold mt-2">
                    {{ $totalProductos }}
                </p>

            </div>

            <div class="bg-white shadow rounded p-6">

                <h2 class="text-gray-500 text-sm">
                    Clientes
                </h2>

                <p class="text-3xl font-bold mt-2">
                    {{ $totalClientes }}
                </p>

            </div>

            <div class="bg-white shadow rounded p-6">

                <h2 class="text-gray-500 text-sm">
                    Ventas
                </h2>

                <p class="text-3xl font-bold mt-2">
                    {{ $totalVentas }}
                </p>

            </div>

            <div class="bg-white shadow rounded p-6">

                <h2 class="text-gray-500 text-sm">
                    Ingresos
                </h2>

                <p class="text-3xl font-bold mt-2">
                    ${{ number_format($ingresos, 2) }}
                </p>

            </div>

        </div>

        <!-- PRODUCTOS BAJO STOCK -->

        <div class="bg-white shadow rounded p-6 mb-8">

            <h2 class="text-2xl font-bold mb-4">

                Productos con Bajo Stock

            </h2>

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-4 py-2 text-left">
                            Producto
                        </th>

                        <th class="px-4 py-2 text-left">
                            Stock
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($productosBajos as $producto)

                        <tr class="border-t">

                            <td class="px-4 py-2">

                                {{ $producto->nombre }}

                            </td>

                            <td class="px-4 py-2 text-red-600 font-bold">

                                {{ $producto->stock }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="2"
                                class="text-center py-4 text-gray-500">

                                No hay productos bajos de stock

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- VENTAS RECIENTES -->

        <div class="bg-white shadow rounded p-6">

            <h2 class="text-2xl font-bold mb-4">

                Ventas Recientes

            </h2>

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-4 py-2 text-left">
                            Folio
                        </th>

                        <th class="px-4 py-2 text-left">
                            Cliente
                        </th>

                        <th class="px-4 py-2 text-left">
                            Total
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($ventasRecientes as $venta)

                        <tr class="border-t">

                            <td class="px-4 py-2">

                                #{{ $venta->id }}

                            </td>

                            <td class="px-4 py-2">

                                {{ $venta->cliente->nombre }}

                            </td>

                            <td class="px-4 py-2">

                                ${{ number_format($venta->total, 2) }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3"
                                class="text-center py-4 text-gray-500">

                                No hay ventas registradas

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>