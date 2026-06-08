<x-app-layout>

    <div class="p-6">

        <div class="flex justify-between items-center mb-6">

            <h1 class="text-2xl font-bold">
                Marcas
            </h1>

            <a
                href="{{ route('marcas.create') }}"
                class="inline-flex items-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow transition"
            >
                + Nueva marca
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

                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">Nombre</th>
                        <th class="px-6 py-3 text-left">Descripción</th>
                        <th class="px-6 py-3 text-left">Estado</th>
                        <th class="px-6 py-3 text-left">Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($marcas as $marca)

                        <tr class="border-t">

                            <td class="px-6 py-4">
                                {{ $marca->id }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $marca->nombre }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $marca->descripcion }}
                            </td>

                            <td class="px-6 py-4">

                                @if($marca->activo)

                                    <span class="text-green-600">
                                        Activo
                                    </span>

                                @else

                                    <span class="text-red-600">
                                        Inactivo
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">

                                    <a
                                        href="{{ route('marcas.edit', $marca->id) }}"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-lg shadow transition"
                                    >
                                        Editar
                                    </a>

                                    <form
                                        action="{{ route('marcas.destroy', $marca->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar esta marca?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-bold rounded-lg shadow transition"
                                        >
                                            Eliminar
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <div class="mt-4">

            {{ $marcas->links() }}

        </div>

    </div>

</x-app-layout>