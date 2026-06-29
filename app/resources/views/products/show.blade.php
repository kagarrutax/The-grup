<div class="product-overview">
    <div class="product-overview-media">
        @if($product->image_url)
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
        @else
            <div class="product-overview-placeholder">
                <i class="bi bi-box-seam"></i>
            </div>
        @endif
    </div>

    <div class="product-overview-content">
        <div class="product-overview-head">
            <div>
                <span class="table-id">#{{ $product->id }}</span>
                <h4 class="mt-2 mb-1">{{ $product->name }}</h4>
                <p class="text-muted mb-0">Código {{ $product->sku }}</p>
            </div>
            <span class="status-pill {{ $product->status === 'activo' ? 'status-pill-success' : 'status-pill-muted' }}">
                {{ ucfirst($product->status) }}
            </span>
        </div>

        <div class="product-overview-grid">
            <div>
                <small class="text-muted d-block">Categoría</small>
                <strong>{{ $product->category->name ?? 'Sin categoría' }}</strong>
            </div>
            <div>
                <small class="text-muted d-block">Proveedor</small>
                <strong>{{ $product->supplier->company_name ?? 'Sin proveedor' }}</strong>
            </div>
            <div>
                <small class="text-muted d-block">Precio compra</small>
                <strong>${{ number_format($product->purchase_price, 2) }}</strong>
            </div>
            <div>
                <small class="text-muted d-block">Precio venta</small>
                <strong>${{ number_format($product->sale_price, 2) }}</strong>
            </div>
            <div>
                <small class="text-muted d-block">Stock actual</small>
                <strong class="{{ $product->stock_quantity <= $product->stock_minimum ? 'text-danger' : 'text-success' }}">
                    {{ $product->stock_quantity }} {{ $product->unit }}
                </strong>
            </div>
            <div>
                <small class="text-muted d-block">Stock mínimo</small>
                <strong>{{ $product->stock_minimum }} {{ $product->unit }}</strong>
            </div>
            <div>
                <small class="text-muted d-block">Creado</small>
                <strong>{{ $product->created_at->format('d/m/Y H:i') }}</strong>
            </div>
            <div>
                <small class="text-muted d-block">Actualizado</small>
                <strong>{{ $product->updated_at->format('d/m/Y H:i') }}</strong>
            </div>
        </div>
    </div>
</div>
