<x-app-layout>

    <div class="p-6">

        <div class="mb-8">

            <h1 class="text-3xl font-bold">

                Orden #{{ $orden->id }}

            </h1>

        </div>

        <!-- CLIENTE -->

        <div class="bg-white shadow rounded p-6 mb-8">

            <h2 class="text-xl font-bold mb-4">

                Información Cliente

            </h2>

            <p>
                <strong>Cliente:</strong>
                {{ $orden->cliente }}
            </p>

            <p>
                <strong>Correo:</strong>
                {{ $orden->correo }}
            </p>

            <p>
                <strong>Teléfono:</strong>
                {{ $orden->telefono }}
            </p>

            <p>
                <strong>Dirección:</strong>
                {{ $orden->direccion }}
            </p>

        </div>

        <!-- PRODUCTOS -->

        <div class="bg-white shadow rounded p-6">

            <h2 class="text-xl font-bold mb-4">

                Productos

            </h2>

            <table class="w-full">

                <thead>

                    <tr class="border-b">

                        <th class="text-left p-3">
                            Producto
                        </th>

                        <th class="text-left p-3">
                            Cantidad
                        </th>

                        <th class="text-left p-3">
                            Precio
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($orden->detalles as $detalle)

                        <tr class="border-b">

                            <td class="p-3">

                                {{ $detalle->producto->nombre }}

                            </td>

                            <td class="p-3">

                                {{ $detalle->cantidad }}

                            </td>

                            <td class="p-3">

                                ${{ $detalle->precio }}

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

            <div class="mt-8 text-right">

                <h2 class="text-3xl font-bold text-green-600">

                    Total:
                    ${{ $orden->total }}

                </h2>

            </div>

        </div>

    </div>

</x-app-layout>