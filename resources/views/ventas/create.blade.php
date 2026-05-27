<x-app-layout>

    <div class="p-6 max-w-7xl mx-auto">

        <h1 class="text-3xl font-bold mb-6">

            Punto de Venta

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
              method="POST">

            @csrf

            <!-- CLIENTE -->

            <div class="bg-white shadow rounded p-6 mb-6">

                <label class="block mb-2 font-bold">

                    Cliente

                </label>

                <select name="cliente_id"
                        class="w-full border rounded px-4 py-2"
                        required>

                    <option value="">
                        Seleccione cliente
                    </option>

                    @foreach($clientes as $cliente)

                        <option value="{{ $cliente->id }}">

                            {{ $cliente->nombre }}

                        </option>

                    @endforeach

                </select>

            </div>

            <!-- TABLA PRODUCTOS -->

            <div class="bg-white shadow rounded overflow-hidden">

                <table class="min-w-full" id="tabla-productos">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="px-4 py-3 text-left">
                                Producto
                            </th>

                            <th class="px-4 py-3 text-left">
                                Precio
                            </th>

                            <th class="px-4 py-3 text-left">
                                Stock
                            </th>

                            <th class="px-4 py-3 text-left">
                                Cantidad
                            </th>

                            <th class="px-4 py-3 text-left">
                                Subtotal
                            </th>

                            <th class="px-4 py-3 text-left">
                                Acción
                            </th>

                        </tr>

                    </thead>

                    <tbody id="productos-container">

                    </tbody>

                </table>

            </div>

            <!-- BOTONES -->

            <div class="flex justify-between items-center mt-6">

                <button type="button"
                        id="agregar-producto"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">

                    Agregar Producto

                </button>

                <div class="text-right">

                    <h2 class="text-3xl font-bold">

                        Total:
                        $<span id="total-general">0.00</span>

                    </h2>

                </div>

            </div>

            <!-- GUARDAR -->

            <div class="mt-6">

                <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded text-lg">

                    Finalizar Venta

                </button>

            </div>

        </form>

    </div>

    <script>

        let index = 0;

        const productos = @json($productos);

        function actualizarTotal() {

            let total = 0;

            document.querySelectorAll('.subtotal')
                .forEach(subtotal => {

                    total += parseFloat(subtotal.innerText) || 0;

                });

            document.getElementById('total-general')
                .innerText = total.toFixed(2);
        }

        function agregarFila() {

            let fila = document.createElement('tr');

            fila.classList.add('border-t');

            fila.innerHTML = `

                <td class="px-4 py-4">

                    <select name="productos[${index}][producto_id]"
                            class="producto-select w-full border rounded px-2 py-2"
                            required>

                        <option value="">
                            Seleccione
                        </option>

                        ${productos.map(producto => `
                            <option
                                value="${producto.id}"
                                data-precio="${producto.precio}"
                                data-stock="${producto.stock}">

                                ${producto.nombre}

                            </option>
                        `).join('')}

                    </select>

                </td>

                <td class="px-4 py-4 precio">

                    $0.00

                </td>

                <td class="px-4 py-4 stock">

                    0

                </td>

                <td class="px-4 py-4">

                    <input type="number"
                           name="productos[${index}][cantidad]"
                           min="1"
                           value="1"
                           class="cantidad w-24 border rounded px-2 py-2"
                           required>

                </td>

                <td class="px-4 py-4">

                    $<span class="subtotal">0.00</span>

                </td>

                <td class="px-4 py-4">

                    <button type="button"
                            class="eliminar bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">

                        Eliminar

                    </button>

                </td>

            `;

            document.getElementById('productos-container')
                .appendChild(fila);

            configurarEventos(fila);

            index++;
        }

        function configurarEventos(fila) {

            const select = fila.querySelector('.producto-select');

            const cantidad = fila.querySelector('.cantidad');

            const precioTd = fila.querySelector('.precio');

            const stockTd = fila.querySelector('.stock');

            const subtotalSpan = fila.querySelector('.subtotal');

            function recalcular() {

                const option =
                    select.options[select.selectedIndex];

                const precio =
                    parseFloat(option.dataset.precio || 0);

                const stock =
                    parseInt(option.dataset.stock || 0);

                let cantidadValor =
                    parseInt(cantidad.value || 0);

                if (cantidadValor > stock) {

                    alert('Stock insuficiente');

                    cantidad.value = stock;

                    cantidadValor = stock;
                }

                precioTd.innerText =
                    '$' + precio.toFixed(2);

                stockTd.innerText = stock;

                subtotalSpan.innerText =
                    (precio * cantidadValor).toFixed(2);

                actualizarTotal();
            }

            select.addEventListener('change', recalcular);

            cantidad.addEventListener('input', recalcular);

            fila.querySelector('.eliminar')
                .addEventListener('click', () => {

                    fila.remove();

                    actualizarTotal();
                });
        }

        document.getElementById('agregar-producto')
            .addEventListener('click', agregarFila);

        agregarFila();

    </script>

</x-app-layout>