<x-app-layout>

    <div class="p-6">

        <div class="flex justify-between items-center mb-6">

            <h1 class="text-2xl font-bold">
                Productos
            </h1>

            <a
                href="{{ route('productos.create') }}"
                class="inline-flex items-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow transition"
            >
                + Nuevo producto
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
                            Categoría
                        </th>

                        <th class="px-6 py-3 text-left">
                            Marca
                        </th>

                        <th class="px-6 py-3 text-left">
                            Precio
                        </th>

                        <th class="px-6 py-3 text-left">
                            Stock
                        </th>

                        <th class="px-6 py-3 text-left">
                            Imagen
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

                    @forelse($productos as $producto)

                        <tr class="border-t">

                            <td class="px-6 py-4">
                                {{ $producto->nombre }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $producto->marca->nombre ?? 'Sin marca' }}
                            </td>

                            <td class="px-6 py-4">
                                ${{ number_format($producto->precio, 2) }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $producto->stock }}
                            </td>

                            <td class="px-6 py-4">

                                @if($producto->imagen)

                                    <img src="{{ asset('storage/' . $producto->imagen) }}"
                                         class="w-16 h-16 object-cover rounded">

                                @else

                                    Sin imagen

                                @endif

                            </td>

                            <td class="px-6 py-4">

                                @if($producto->activo)

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
                                        href="{{ route('productos.edit', $producto->id) }}"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-lg shadow transition"
                                    >
                                        Editar
                                    </a>

                                    <form
                                        action="{{ route('productos.destroy', $producto->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')"
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

                    @empty

                        <tr>

                            <td colspan="8"
                                class="text-center py-6 text-gray-500">

                                No hay productos registrados

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-4">

            {{ $productos->links() }}

        </div>

    </div>

</x-app-layout>