<x-app-layout>

    <div class="p-6">

        <h1 class="text-3xl font-bold mb-6">
            Reportes
        </h1>

        <!-- FILTRO FECHAS -->

        <div class="bg-white shadow rounded p-6 mb-8">

            <h2 class="text-xl font-bold mb-4">
                Ventas por Fecha
            </h2>

            <form action="{{ route('reportes.ventas') }}"
                  method="POST"
                  class="grid grid-cols-1 md:grid-cols-4 gap-4">

                @csrf

                <div>

                    <label class="block mb-2">
                        Fecha Inicio
                    </label>

                    <input type="date"
                           name="fecha_inicio"
                           class="w-full border rounded px-4 py-2"
                           required>

                </div>

                <div>

                    <label class="block mb-2">
                        Fecha Fin
                    </label>

                    <input type="date"
                           name="fecha_fin"
                           class="w-full border rounded px-4 py-2"
                           required>

                </div>

                <div class="flex items-end">

                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">

                        Consultar

                    </button>

                </div>

            </form>

        </div>

        <!-- RESULTADO VENTAS -->

        @isset($ventas)

            <div class="bg-white shadow rounded p-6 mb-8">

                <h2 class="text-xl font-bold mb-4">

                    Resultado de Ventas

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

                            <th class="px-4 py-2 text-left">
                                Fecha
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($ventas as $venta)

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

                                <td class="px-4 py-2">
                                    {{ $venta->created_at->format('d/m/Y') }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4"
                                    class="text-center py-4 text-gray-500">

                                    No hay ventas

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

                <div class="mt-4 text-right">

                    <h3 class="text-2xl font-bold">

                        Total:
                        ${{ number_format($total, 2) }}

                    </h3>

                </div>

            </div>

        @endisset

        <!-- PRODUCTOS MÁS VENDIDOS -->

        <div class="bg-white shadow rounded p-6 mb-8">

            <h2 class="text-xl font-bold mb-4">
                Productos Más Vendidos
            </h2>

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-4 py-2 text-left">
                            Producto
                        </th>

                        <th class="px-4 py-2 text-left">
                            Total Vendidos
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($productosMasVendidos as $producto)

                        <tr class="border-t">

                            <td class="px-4 py-2">

                                {{ $producto->nombre }}

                            </td>

                            <td class="px-4 py-2">

                                {{ $producto->total_vendidos }}

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <!-- SIN STOCK -->

        <div class="bg-white shadow rounded p-6">

            <h2 class="text-xl font-bold mb-4">
                Productos Sin Stock
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

                    @forelse($productosSinStock as $producto)

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

                                No hay productos agotados

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>