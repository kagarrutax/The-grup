<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte de inventario</title>
    <style>
        body { font-family: Arial, sans-serif; color: #111827; margin: 32px; }
        h1 { margin-bottom: 6px; }
        p { color: #6b7280; margin-top: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 24px; }
        th, td { border: 1px solid #e5e7eb; padding: 8px 10px; font-size: 12px; text-align: left; }
        th { background: #f3f4f6; text-transform: uppercase; font-size: 11px; }
    </style>
</head>
<body onload="window.print()">
    <h1>Reporte de inventario</h1>
    <p>Generado el {{ now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Producto</th>
                <th>ID</th>
                <th>Código</th>
                <th>Categoría</th>
                <th>Proveedor</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Usuario</th>
                <th>Motivo</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rows as $row)
                <tr>
                    <td>{{ $row['date'] }}</td>
                    <td>{{ $row['product'] }}</td>
                    <td>#{{ $row['product_id'] }}</td>
                    <td>{{ $row['code'] }}</td>
                    <td>{{ $row['category'] }}</td>
                    <td>{{ $row['supplier'] }}</td>
                    <td>{{ $row['type'] }}</td>
                    <td>{{ $row['quantity'] }}</td>
                    <td>{{ $row['user'] }}</td>
                    <td>{{ $row['reason'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">No hay registros para este reporte.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
