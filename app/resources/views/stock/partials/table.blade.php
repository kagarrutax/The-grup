<div class="card-app module-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-app table-modern mb-0">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Producto</th>
                        <th>Código</th>
                        <th>Tipo</th>
                        <th>Cantidad</th>
                        <th>Usuario</th>
                        <th>Motivo</th>
                        <th>Observaciones</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($movements as $movement)
                        <tr>
                            <td>{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                            <td><span class="fw-semibold">#{{ $movement->product->id }} · {{ $movement->product->name }}</span></td>
                            <td>{{ $movement->product->sku }}</td>
                            <td>
                                <span class="{{ $movement->type === 'entrada' ? 'badge-entrada' : 'badge-salida' }}">
                                    {{ strtoupper($movement->type) }}
                                </span>
                            </td>
                            <td class="{{ $movement->type === 'entrada' ? 'qty-positive' : 'qty-negative' }}">
                                {{ $movement->type === 'entrada' ? '+' : '-' }}{{ $movement->quantity }}
                            </td>
                            <td>{{ $movement->user->name ?? 'Sin usuario' }}</td>
                            <td>{{ $movement->reason ?: '—' }}</td>
                            <td class="text-muted">{{ \Illuminate\Support\Str::limit($movement->observations, 50) ?: '—' }}</td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-info" onclick="viewMovement({{ $movement->id }})" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-outline-warning" onclick="editMovement({{ $movement->id }})" title="Editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-outline-danger" onclick="showDeleteConfirmation('#{{ $movement->id }} · {{ addslashes($movement->product->name) }}', '{{ route('stock.destroy', $movement) }}', 'movimiento')" title="Eliminar">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="text-center text-muted py-5">No hay movimientos que coincidan con los filtros.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($movements->hasPages())
        <div class="card-footer">{{ $movements->links() }}</div>
    @endif
</div>
