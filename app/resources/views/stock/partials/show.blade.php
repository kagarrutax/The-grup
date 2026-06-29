<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label text-muted">Movimiento</label>
        <div class="fw-semibold">#{{ $movement->id }}</div>
    </div>
    <div class="col-md-6">
        <label class="form-label text-muted">Fecha</label>
        <div class="fw-semibold">{{ $movement->created_at->format('d/m/Y H:i') }}</div>
    </div>
    <div class="col-md-6">
        <label class="form-label text-muted">Producto</label>
        <div class="fw-semibold">#{{ $movement->product->id }} · {{ $movement->product->name }}</div>
        <small class="text-muted">{{ $movement->product->sku }}</small>
    </div>
    <div class="col-md-6">
        <label class="form-label text-muted">Usuario</label>
        <div class="fw-semibold">{{ $movement->user->name ?? 'Sin usuario' }}</div>
    </div>
    <div class="col-md-4">
        <label class="form-label text-muted">Tipo</label>
        <div>
            <span class="{{ $movement->type === 'entrada' ? 'badge-entrada' : 'badge-salida' }}">
                {{ strtoupper($movement->type) }}
            </span>
        </div>
    </div>
    <div class="col-md-4">
        <label class="form-label text-muted">Cantidad</label>
        <div class="{{ $movement->type === 'entrada' ? 'qty-positive' : 'qty-negative' }}">
            {{ $movement->type === 'entrada' ? '+' : '-' }}{{ $movement->quantity }}
        </div>
    </div>
    <div class="col-md-4">
        <label class="form-label text-muted">Stock actual</label>
        <div class="fw-semibold">{{ $movement->product->stock_quantity }}</div>
    </div>
    <div class="col-12">
        <label class="form-label text-muted">Motivo</label>
        <div class="fw-semibold">{{ $movement->reason ?: '—' }}</div>
    </div>
    <div class="col-12">
        <label class="form-label text-muted">Observaciones</label>
        <div class="text-muted">{{ $movement->observations ?: 'Sin observaciones registradas.' }}</div>
    </div>
</div>
