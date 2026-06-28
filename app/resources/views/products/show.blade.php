<div class="row g-4">
    <!-- Sección Principal -->
    <div class="col-md-6">
        <div class="info-section mb-4">
            <h6 class="section-title">
                <i class="bi bi-box-seam text-primary me-2"></i>Información Básica
            </h6>
            
            <div class="info-row">
                <label class="info-label"><i class="bi bi-qr-code me-2"></i>SKU</label>
                <p class="info-value"><code>{{ $product->sku }}</code></p>
            </div>
            
            <div class="info-row">
                <label class="info-label"><i class="bi bi-type me-2"></i>Nombre</label>
                <p class="info-value fw-bold">{{ $product->name }}</p>
            </div>
            
            <div class="info-row">
                <label class="info-label"><i class="bi bi-tag me-2"></i>Categoría</label>
                <p class="info-value">
                    <span class="badge bg-light text-dark">{{ $product->category->name ?? '—' }}</span>
                </p>
            </div>
        </div>

        <div class="info-section">
            <h6 class="section-title">
                <i class="bi bi-currency-dollar text-success me-2"></i>Precios
            </h6>
            
            <div class="info-row">
                <label class="info-label"><i class="bi bi-currency-dollar me-2"></i>Precio</label>
                <p class="info-value fw-bold text-success" style="font-size: 1.25rem;">${{ number_format($product->price, 2) }}</p>
            </div>
        </div>
    </div>

    <!-- Sección Stock -->
    <div class="col-md-6">
        <div class="info-section mb-4">
            <h6 class="section-title">
                <i class="bi bi-box text-info me-2"></i>Stock
            </h6>
            
            <div class="info-row">
                <label class="info-label"><i class="bi bi-collection me-2"></i>Stock Actual</label>
                <p class="info-value">
                    <span class="badge {{ $product->stock_quantity <= $product->stock_minimum ? 'bg-danger' : 'bg-success' }}">
                        {{ $product->stock_quantity }} {{ $product->unit }}
                    </span>
                </p>
            </div>
            
            <div class="info-row">
                <label class="info-label"><i class="bi bi-exclamation-circle me-2"></i>Stock Mínimo</label>
                <p class="info-value">{{ $product->stock_minimum }} {{ $product->unit }}</p>
            </div>
            
            <div class="info-row">
                <label class="info-label"><i class="bi bi-rulers me-2"></i>Unidad</label>
                <p class="info-value">{{ $product->unit }}</p>
            </div>
        </div>

        <div class="info-section">
            <h6 class="section-title">
                <i class="bi bi-toggle-on text-warning me-2"></i>Estado
            </h6>
            
            <div class="info-row">
                <label class="info-label"><i class="bi bi-circle-fill me-2"></i>Estado</label>
                <p class="info-value">
                    <span class="badge {{ $product->status === 'activo' ? 'bg-success' : 'bg-danger' }}">
                        {{ ucfirst($product->status) }}
                    </span>
                </p>
            </div>
        </div>
    </div>
    
    <!-- Sección de Auditoría -->
    <div class="col-12">
        <div class="audit-section">
            <h6 class="section-title">
                <i class="bi bi-clock-history text-muted me-2"></i>Información de Auditoría
            </h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <small class="text-muted d-block">Creado</small>
                    <p class="info-value small">{{ $product->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Actualizado</small>
                    <p class="info-value small">{{ $product->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .info-section {
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 0.75rem;
        border-left: 4px solid #667eea;
    }

    .section-title {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1rem;
        font-size: 0.95rem;
    }

    .info-row {
        margin-bottom: 1rem;
    }

    .info-row:last-child {
        margin-bottom: 0;
    }

    .info-label {
        display: block;
        color: #6c757d;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 0.35rem;
    }

    .info-value {
        color: #2c3e50;
        font-size: 0.95rem;
        margin-bottom: 0;
    }

    code {
        background-color: #e9ecef;
        padding: 0.25rem 0.5rem;
        border-radius: 0.35rem;
        color: #e83e8c;
        font-size: 0.875rem;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.4rem 0.75rem;
        font-weight: 500;
    }

    .audit-section {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        padding: 1.25rem;
        border-radius: 0.75rem;
        border: 1px solid rgba(102, 126, 234, 0.2);
    }
</style>
