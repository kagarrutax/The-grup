<div class="card-app module-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-app table-modern mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Proveedor</th>
                        <th>Precio compra</th>
                        <th>Precio venta</th>
                        <th>Stock</th>
                        <th>Stock mínimo</th>
                        <th>Estado</th>
                        <th>Creación</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td><span class="table-id">#{{ $product->id }}</span></td>
                            <td>
                                <div class="product-thumb">
                                    @if($product->image_url)
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                                    @else
                                        <span><i class="bi bi-image"></i></span>
                                    @endif
                                </div>
                            </td>
                            <td><span class="table-code">{{ $product->sku }}</span></td>
                            <td>
                                <div class="fw-semibold">{{ $product->name }}</div>
                                <small class="text-muted">{{ $product->unit }}</small>
                            </td>
                            <td>{{ $product->category->name ?? '—' }}</td>
                            <td>{{ $product->supplier->company_name ?? 'Sin proveedor' }}</td>
                            <td>${{ number_format($product->purchase_price, 2) }}</td>
                            <td>${{ number_format($product->sale_price, 2) }}</td>
                            <td>
                                <span class="{{ $product->stock_quantity <= $product->stock_minimum ? 'text-danger fw-semibold' : 'fw-semibold' }}">
                                    {{ $product->stock_quantity }}
                                </span>
                            </td>
                            <td>{{ $product->stock_minimum }}</td>
                            <td>
                                <span class="status-pill {{ $product->status === 'activo' ? 'status-pill-success' : 'status-pill-muted' }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </td>
                            <td>{{ $product->created_at->format('d/m/Y') }}</td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    <button class="btn btn-outline-info" onclick="viewProduct({{ $product->id }})" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-outline-warning" onclick="editProduct({{ $product->id }})" title="Editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-outline-danger" onclick="showDeleteConfirmation('{{ $product->name }}', '{{ route('products.destroy', $product) }}', 'producto')" title="Eliminar">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13" class="text-center text-muted py-5">No hay productos que coincidan con la búsqueda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($products->hasPages())
        <div class="card-footer">{{ $products->links() }}</div>
    @endif
</div>
