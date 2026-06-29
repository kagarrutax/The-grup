<div class="card-app module-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Vista previa</span>
        <small class="text-muted">{{ $rows->count() }} registros</small>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-app table-modern mb-0">
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
                        <tr><td colspan="10" class="text-center text-muted py-5">No hay registros para los filtros seleccionados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
