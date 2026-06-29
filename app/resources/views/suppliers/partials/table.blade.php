<div class="card-app module-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-app table-modern mb-0">
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Responsable</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Dirección</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $supplier)
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ $supplier->company_name }}</div>
                                <small class="text-muted">#{{ $supplier->id }} · {{ $supplier->products_count }} productos</small>
                            </td>
                            <td>{{ $supplier->contact_name }}</td>
                            <td>{{ $supplier->phone ?: '—' }}</td>
                            <td>{{ $supplier->email ?: '—' }}</td>
                            <td class="text-muted">{{ \Illuminate\Support\Str::limit($supplier->address, 50) ?: '—' }}</td>
                            <td>
                                <span class="status-pill {{ $supplier->status === 'activo' ? 'status-pill-success' : 'status-pill-muted' }}">
                                    {{ ucfirst($supplier->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-info" onclick="viewSupplier({{ $supplier->id }})"><i class="bi bi-eye"></i></button>
                                    <button class="btn btn-outline-warning" onclick="editSupplier({{ $supplier->id }})"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-outline-danger" onclick="showDeleteConfirmation('{{ $supplier->company_name }}', '{{ route('suppliers.destroy', $supplier) }}', 'proveedor')"><i class="bi bi-trash3"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-5">No hay proveedores que coincidan con la búsqueda.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($suppliers->hasPages())
        <div class="card-footer">{{ $suppliers->links() }}</div>
    @endif
</div>
