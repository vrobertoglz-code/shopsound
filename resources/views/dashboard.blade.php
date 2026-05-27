<x-app-layout>

    <div class="p-6">

        <!-- TITULO -->

        <div class="mb-10">

            <h1 class="text-4xl font-black">

                Dashboard ShopSound

            </h1>

            <p class="text-gray-500 mt-2">

                Panel administrativo general

            </p>

        </div>

        <!-- CARDS -->

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6 mb-10">

            <!-- PRODUCTOS -->

            <div class="bg-white shadow rounded-2xl p-6">

                <p class="text-gray-500 mb-2">

                    Productos

                </p>

                <h2 class="text-4xl font-black">

                    {{ $totalProductos }}

                </h2>

            </div>

            <!-- CATEGORIAS -->

            <div class="bg-white shadow rounded-2xl p-6">

                <p class="text-gray-500 mb-2">

                    Categorías

                </p>

                <h2 class="text-4xl font-black">

                    {{ $totalCategorias }}

                </h2>

            </div>

            <!-- VENTAS FISICAS -->

            <div class="bg-white shadow rounded-2xl p-6">

                <p class="text-gray-500 mb-2">

                    Ventas Tienda

                </p>

                <h2 class="text-4xl font-black text-blue-600">

                    ${{ number_format($ventasFisicas, 2) }}

                </h2>

            </div>

            <!-- VENTAS WEB -->

            <div class="bg-white shadow rounded-2xl p-6">

                <p class="text-gray-500 mb-2">

                    Órdenes Web

                </p>

                <h2 class="text-4xl font-black text-purple-600">

                    ${{ number_format($ventasWeb, 2) }}

                </h2>

            </div>

            <!-- TOTAL -->

            <div class="bg-white shadow rounded-2xl p-6">

                <p class="text-gray-500 mb-2">

                    Ingresos Totales

                </p>

                <h2 class="text-4xl font-black text-green-600">

                    ${{ number_format($ingresosTotales, 2) }}

                </h2>

            </div>

        </div>

        <!-- TABLAS -->

        <div class="grid lg:grid-cols-2 gap-8">

            <!-- VENTAS -->

            <div class="bg-white shadow rounded-2xl p-6">

                <h2 class="text-2xl font-bold mb-6">

                    Ventas Recientes

                </h2>

                <div class="space-y-4">

                    @forelse($ventasRecientes as $venta)

                        <div class="border rounded-xl p-4">

                            <div class="flex justify-between">

                                <div>

                                    <p class="font-bold">

                                        Venta #{{ $venta->id }}

                                    </p>

                                    <p class="text-gray-500 text-sm">

                                        {{ $venta->created_at->format('d/m/Y H:i') }}

                                    </p>

                                </div>

                                <div class="text-green-600 font-black">

                                    ${{ $venta->total }}

                                </div>

                            </div>

                        </div>

                    @empty

                        <p class="text-gray-500">

                            Sin ventas registradas

                        </p>

                    @endforelse

                </div>

            </div>

            <!-- ORDENES -->

            <div class="bg-white shadow rounded-2xl p-6">

                <h2 class="text-2xl font-bold mb-6">

                    Órdenes Web Recientes

                </h2>

                <div class="space-y-4">

                    @forelse($ordenesRecientes as $orden)

                        <div class="border rounded-xl p-4">

                            <div class="flex justify-between">

                                <div>

                                    <p class="font-bold">

                                        Orden #{{ $orden->id }}

                                    </p>

                                    <p class="text-gray-500 text-sm">

                                        {{ $orden->cliente }}

                                    </p>

                                </div>

                                <div class="text-purple-600 font-black">

                                    ${{ $orden->total }}

                                </div>

                            </div>

                        </div>

                    @empty

                        <p class="text-gray-500">

                            Sin órdenes registradas

                        </p>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</x-app-layout>