<x-app-layout>

    <div class="p-6">

        <div class="flex justify-between items-center mb-6">

            <h1 class="text-2xl font-bold">
                Clientes
            </h1>

            <a href="{{ route('clientes.create') }}"
               class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">

                Nuevo Cliente

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
                            Nombre
                        </th>

                        <th class="px-6 py-3 text-left">
                            Teléfono
                        </th>

                        <th class="px-6 py-3 text-left">
                            Email
                        </th>

                        <th class="px-6 py-3 text-left">
                            Estado
                        </th>

                        <th class="px-6 py-3 text-left">
                            Acciones
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($clientes as $cliente)

                        <tr class="border-t">

                            <td class="px-6 py-4">
                                {{ $cliente->nombre }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $cliente->telefono }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $cliente->email }}
                            </td>

                            <td class="px-6 py-4">

                                @if($cliente->activo)

                                    <span class="text-green-600">
                                        Activo
                                    </span>

                                @else

                                    <span class="text-red-600">
                                        Inactivo
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4 flex gap-2">

                                <a href="{{ route('clientes.edit', $cliente->id) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">

                                    Editar

                                </a>

                                <form action="{{ route('clientes.destroy', $cliente->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            onclick="return confirm('¿Desactivar cliente?')"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">

                                        Desactivar

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="text-center py-6 text-gray-500">

                                No hay clientes registrados

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-4">

            {{ $clientes->links() }}

        </div>

    </div>

</x-app-layout>