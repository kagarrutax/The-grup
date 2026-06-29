<div class="simple-detail-grid">
    <div>
        <small class="text-muted d-block">Empresa</small>
        <strong>{{ $supplier->company_name }}</strong>
    </div>
    <div>
        <small class="text-muted d-block">Responsable</small>
        <strong>{{ $supplier->contact_name }}</strong>
    </div>
    <div>
        <small class="text-muted d-block">Teléfono</small>
        <strong>{{ $supplier->phone ?: '—' }}</strong>
    </div>
    <div>
        <small class="text-muted d-block">Correo</small>
        <strong>{{ $supplier->email ?: '—' }}</strong>
    </div>
    <div class="w-100">
        <small class="text-muted d-block">Dirección</small>
        <p class="mb-0">{{ $supplier->address ?: 'Sin dirección registrada.' }}</p>
    </div>
    <div>
        <small class="text-muted d-block">Estado</small>
        <strong>{{ ucfirst($supplier->status) }}</strong>
    </div>
    <div>
        <small class="text-muted d-block">Productos asociados</small>
        <strong>{{ $supplier->products_count }}</strong>
    </div>
</div>
