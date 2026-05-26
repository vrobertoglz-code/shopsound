<x-app-layout>

    <div class="p-6">

        <div class="flex justify-between items-center mb-6">

            <h1 class="text-2xl font-bold">
                Productos
            </h1>

            <a href="{{ route('productos.create') }}"
               class="bg-green-500 text-white px-4 py-2 rounded">

                Nuevo Producto

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

                            <td class="px-6 py-4 flex gap-2">

                                <a href="{{ route('productos.edit', $producto->id) }}"
                                   class="bg-blue-500 text-white px-3 py-1 rounded">

                                    Editar

                                </a>

                                <form action="{{ route('productos.destroy', $producto->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            onclick="return confirm('¿Eliminar producto?')"
                                            class="bg-red-500 text-white px-3 py-1 rounded">

                                        Eliminar

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
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