<div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modal-content-modern">
            <div class="modal-header modal-header-gradient">
                <div>
                    <h5 class="modal-title mb-0" id="createProductModalLabel">Nuevo producto</h5>
                    <small class="text-muted">El ID se genera automáticamente</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-modern">
                <form id="createProductForm" class="row g-4">
                    @csrf
                    <div class="col-md-3">
                        <label class="form-label">Imagen</label>
                        <input type="file" name="image" class="form-control form-control-modern" accept="image/*">
                        <small class="text-muted">Formatos: JPG, PNG, GIF, WebP</small>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Código</label>
                        <input type="text" name="sku" class="form-control form-control-modern" placeholder="COD-001" required autocomplete="off">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control form-control-modern" placeholder="Nombre del producto" required autocomplete="off">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Categoría</label>
                        <select name="category_id" class="form-select form-select-modern" required>
                            <option value="">Seleccionar</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Proveedor</label>
                        <select name="supplier_id" class="form-select form-select-modern">
                            <option value="">Sin proveedor</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->company_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Unidad</label>
                        <input type="text" name="unit" class="form-control form-control-modern" placeholder="unidad, litro, caja" required autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Precio compra</label>
                        <input type="number" step="0.01" min="0" name="purchase_price" class="form-control form-control-modern" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Precio venta</label>
                        <input type="number" step="0.01" min="0" name="sale_price" class="form-control form-control-modern" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Stock mínimo</label>
                        <input type="number" min="0" name="stock_minimum" class="form-control form-control-modern" value="0" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Estado</label>
                        <select name="status" class="form-select form-select-modern">
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <div class="alert alert-light border mb-0">
                            El ID se genera automáticamente y el stock inicial se administra desde
                            <strong>Movimientos</strong>.
                        </div>
                    </div>
                    <div class="col-12">
                        <div id="createProductErrors" class="alert alert-danger d-none mb-0"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer modal-footer-modern">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btn-modern" id="createProductSubmit">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('createProductSubmit')?.addEventListener('click', async function () {
        const form = document.getElementById('createProductForm');
        const errors = document.getElementById('createProductErrors');
        const submit = this;
        errors.classList.add('d-none');
        errors.innerHTML = '';
        submit.disabled = true;

        try {
            const response = await fetch('{{ route('products.store') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: new FormData(form),
            });

            const data = await response.json();

            if (!response.ok) {
                throw data;
            }

            bootstrap.Modal.getInstance(document.getElementById('createProductModal')).hide();
            form.reset();
            if (typeof window.refreshProductsTable === 'function') {
                await window.refreshProductsTable();
            } else {
                window.location.reload();
            }
        } catch (error) {
            const messages = error.errors ? Object.values(error.errors).flat() : [error.message || 'No se pudo crear el producto.'];
            errors.innerHTML = messages.join('<br>');
            errors.classList.remove('d-none');
        } finally {
            submit.disabled = false;
        }
    });
</script>
