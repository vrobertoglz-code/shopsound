<x-app-layout>

    <div class="p-6">

        <div class="flex justify-between items-center mb-6">

            <h1 class="text-2xl font-bold">
                Ventas
            </h1>

            <a href="{{ route('ventas.create') }}"
               class="bg-green-500 text-white px-4 py-2 rounded">

                Nueva Venta

            </a>

        </div>

        @if(session('success'))

            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">

                {{ session('success') }}

            </div>

        @endif

        <div class="bg-white shadow rounded overflow-hidden">

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-3 text-left">
                            Folio
                        </th>

                        <th class="px-6 py-3 text-left">
                            Cliente
                        </th>

                        <th class="px-6 py-3 text-left">
                            Total
                        </th>

                        <th class="px-6 py-3 text-left">
                            Fecha
                        </th>

                        <th class="px-6 py-3 text-left">
                            Acciones
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($ventas as $venta)

                        <tr class="border-t">

                            <td class="px-6 py-4">
                                #{{ $venta->id }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $venta->cliente->nombre }}
                            </td>

                            <td class="px-6 py-4">
                                ${{ number_format($venta->total, 2) }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $venta->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td class="px-6 py-4">

                                <a href="{{ route('ventas.show', $venta->id) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">

                                    Ver

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="text-center py-6 text-gray-500">

                                No hay ventas registradas

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>