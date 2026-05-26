<x-app-layout>

    <div class="p-6 max-w-5xl mx-auto">

        <div class="flex justify-between items-center mb-6">

            <h1 class="text-2xl font-bold">

                Venta #{{ $venta->id }}

            </h1>

            <a href="{{ route('ventas.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">

                Volver

            </a>

        </div>

        <!-- DATOS CLIENTE -->

        <div class="bg-white shadow rounded p-6 mb-6">

            <h2 class="text-xl font-bold mb-4">
                Información Cliente
            </h2>

            <p>
                <strong>Cliente:</strong>
                {{ $venta->cliente->nombre }}
            </p>

            <p>
                <strong>Fecha:</strong>
                {{ $venta->created_at->format('d/m/Y H:i') }}
            </p>

        </div>

        <!-- PRODUCTOS -->

        <div class="bg-white shadow rounded overflow-hidden">

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-3 text-left">
                            Producto
                        </th>

                        <th class="px-6 py-3 text-left">
                            Cantidad
                        </th>

                        <th class="px-6 py-3 text-left">
                            Precio
                        </th>

                        <th class="px-6 py-3 text-left">
                            Subtotal
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($venta->detalles as $detalle)

                        <tr class="border-t">

                            <td class="px-6 py-4">

                                {{ $detalle->producto->nombre }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $detalle->cantidad }}

                            </td>

                            <td class="px-6 py-4">

                                ${{ number_format($detalle->precio, 2) }}

                            </td>

                            <td class="px-6 py-4">

                                ${{ number_format($detalle->subtotal, 2) }}

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <!-- TOTAL -->

        <div class="bg-white shadow rounded p-6 mt-6 text-right">

            <h2 class="text-2xl font-bold">

                Total:
                ${{ number_format($venta->total, 2) }}

            </h2>

        </div>

    </div>

</x-app-layout>