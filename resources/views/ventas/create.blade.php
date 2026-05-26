<x-app-layout>

    <div class="p-6 max-w-5xl mx-auto">

        <h1 class="text-2xl font-bold mb-6">
            Nueva Venta
        </h1>

        @if ($errors->any())

            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">

                <ul class="list-disc list-inside">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('ventas.store') }}"
              method="POST"
              class="bg-white p-6 rounded shadow">

            @csrf

            <!-- CLIENTE -->
            <div class="mb-6">

                <label class="block mb-2 font-bold">
                    Cliente
                </label>

                <select name="cliente_id"
                        class="w-full border rounded px-4 py-2"
                        required>

                    <option value="">
                        Seleccione un cliente
                    </option>

                    @foreach($clientes as $cliente)

                        <option value="{{ $cliente->id }}">

                            {{ $cliente->nombre }}

                        </option>

                    @endforeach

                </select>

            </div>

            <!-- PRODUCTOS -->
            <h2 class="text-xl font-bold mb-4">
                Productos
            </h2>

            <div id="productos-container">

                <div class="grid grid-cols-2 gap-4 mb-4 producto-item">

                    <div>

                        <label class="block mb-2">
                            Producto
                        </label>

                        <select name="productos[0][producto_id]"
                                class="w-full border rounded px-4 py-2"
                                required>

                            <option value="">
                                Seleccione producto
                            </option>

                            @foreach($productos as $producto)

                                <option value="{{ $producto->id }}"
                                        data-stock="{{ $producto->stock }}">

                                    {{ $producto->nombre }}
                                    | Stock: {{ $producto->stock }}
                                    | ${{ $producto->precio }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        <label class="block mb-2">
                            Cantidad
                        </label>

                           <input type="number"
                               name="productos[0][cantidad]"
                               min="1"
                               class="w-full border rounded px-4 py-2 cantidad-input"
                               required>

                    </div>

                </div>

            </div>

            <!-- BOTON AGREGAR -->
            <button type="button"
                    id="agregar-producto"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mb-6">

                Agregar Otro Producto

            </button>

            <!-- BOTON GUARDAR -->
            <div>

                <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded">

                    Guardar Venta

                </button>

            </div>

        </form>

    </div>

    <!-- SCRIPT -->
    <script>

        let index = 1;

        document.getElementById('agregar-producto')
            .addEventListener('click', function () {

                const container = document.getElementById('productos-container');

                const nuevo = document.querySelector('.producto-item')
                    .cloneNode(true);

                nuevo.querySelectorAll('select, input').forEach(element => {

                    if (element.name.includes('producto_id')) {

                        element.name = `productos[${index}][producto_id]`;

                        element.value = '';

                    }

                    if (element.name.includes('cantidad')) {

                        element.name = `productos[${index}][cantidad]`;

                        element.value = '';

                    }

                });

                container.appendChild(nuevo);

                index++;
            });

    </script>

    <script>

        function configurarStock() {

            document.querySelectorAll('.producto-item')
                .forEach(item => {

                    const select = item.querySelector('select');

                    const cantidadInput = item.querySelector('.cantidad-input');

                    select.addEventListener('change', function () {

                        const option =
                            select.options[select.selectedIndex];

                        const stock =
                            option.getAttribute('data-stock');

                        cantidadInput.max = stock;

                        cantidadInput.placeholder =
                            'Máximo disponible: ' + stock;
                    });

                });
        }

        configurarStock();

    </script>

</x-app-layout>