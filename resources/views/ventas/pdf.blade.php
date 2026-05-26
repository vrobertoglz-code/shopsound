<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>
        Venta {{ $venta->id }}
    </title>

    <style>

        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        th {
            background: #f2f2f2;
        }

        .total {
            margin-top: 20px;
            text-align: right;
            font-size: 20px;
            font-weight: bold;
        }

    </style>

</head>

<body>

    <h1>
        ShopSound
    </h1>

    <h2>
        Ticket de Venta #{{ $venta->id }}
    </h2>

    <p>

        <strong>Cliente:</strong>
        {{ $venta->cliente->nombre }}

    </p>

    <p>

        <strong>Fecha:</strong>
        {{ $venta->created_at->format('d/m/Y H:i') }}

    </p>

    <table>

        <thead>

            <tr>

                <th>
                    Producto
                </th>

                <th>
                    Cantidad
                </th>

                <th>
                    Precio
                </th>

                <th>
                    Subtotal
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($venta->detalles as $detalle)

                <tr>

                    <td>

                        {{ $detalle->producto->nombre }}

                    </td>

                    <td>

                        {{ $detalle->cantidad }}

                    </td>

                    <td>

                        ${{ number_format($detalle->precio, 2) }}

                    </td>

                    <td>

                        ${{ number_format($detalle->subtotal, 2) }}

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

    <div class="total">

        Total:
        ${{ number_format($venta->total, 2) }}

    </div>

</body>

</html>