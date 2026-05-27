<x-app-layout>

    <div class="p-6">

        <div class="flex justify-between items-center mb-8">

            <h1 class="text-3xl font-bold">

                Órdenes

            </h1>

        </div>

        <div class="bg-white shadow rounded overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-4 text-left">
                            ID
                        </th>

                        <th class="p-4 text-left">
                            Cliente
                        </th>

                        <th class="p-4 text-left">
                            Correo
                        </th>

                        <th class="p-4 text-left">
                            Total
                        </th>

                        <th class="p-4 text-left">
                            Fecha
                        </th>

                        <th class="p-4 text-left">
                            Acción
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($ordenes as $orden)

                        <tr class="border-b">

                            <td class="p-4">
                                #{{ $orden->id }}
                            </td>

                            <td class="p-4">
                                {{ $orden->cliente }}
                            </td>

                            <td class="p-4">
                                {{ $orden->correo }}
                            </td>

                            <td class="p-4 font-bold text-green-600">

                                ${{ $orden->total }}

                            </td>

                            <td class="p-4">

                                {{ $orden->created_at->format('d/m/Y') }}

                            </td>

                            <td class="p-4">

                                <a href="{{ route('ordenes.show', $orden->id) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">

                                    Ver

                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <div class="mt-6">

            {{ $ordenes->links() }}

        </div>

    </div>

</x-app-layout>