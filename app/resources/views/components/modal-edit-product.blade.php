<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modal-content-modern">
            <div class="modal-header modal-header-gradient">
                <div>
                    <h5 class="modal-title mb-0" id="editProductModalLabel">Editar producto</h5>
                    <small class="text-muted">Edición con ID automático y datos completos</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-modern">
                <form id="editProductForm">
                    @csrf
                    @method('PATCH')
                    <div class="row g-4">
                        <div class="col-md-2">
                            <label class="form-label fw-medium">ID</label>
                            <input type="text" id="editId" class="form-control form-control-modern" disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium">Código</label>
                            <input type="text" id="editSku" name="sku" class="form-control form-control-modern" placeholder="Código interno" required>
                            <div class="invalid-feedback" id="skuError"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Nombre</label>
                            <input type="text" id="editName" name="name" class="form-control form-control-modern" placeholder="Nombre del producto" required>
                            <div class="invalid-feedback" id="nameError"></div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Imagen URL</label>
                            <input type="url" id="editImageUrl" name="image_url" class="form-control form-control-modern" placeholder="https://...">
                            <div class="invalid-feedback" id="imageUrlError"></div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium">Categoría</label>
                            <select id="editCategory" name="category_id" class="form-select form-select-modern" required></select>
                            <div class="invalid-feedback" id="categoryError"></div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium">Proveedor</label>
                            <select id="editSupplier" name="supplier_id" class="form-select form-select-modern"></select>
                            <div class="invalid-feedback" id="supplierError"></div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium">Unidad</label>
                            <input type="text" id="editUnit" name="unit" class="form-control form-control-modern" placeholder="unidad, litro, caja" required>
                            <div class="invalid-feedback" id="unitError"></div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Precio compra</label>
                            <input type="number" id="editPurchasePrice" name="purchase_price" step="0.01" class="form-control form-control-modern" placeholder="0.00" required>
                            <div class="invalid-feedback" id="purchasePriceError"></div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Precio venta</label>
                            <input type="number" id="editSalePrice" name="sale_price" step="0.01" class="form-control form-control-modern" placeholder="0.00" required>
                            <div class="invalid-feedback" id="salePriceError"></div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Stock mín.</label>
                            <input type="number" id="editStockMinimum" name="stock_minimum" class="form-control form-control-modern" required>
                            <div class="invalid-feedback" id="stockMinError"></div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Estado</label>
                            <select id="editStatus" name="status" class="form-select form-select-modern">
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                            <div class="invalid-feedback" id="statusError"></div>
                        </div>
                        <div class="col-12">
                            <div class="alert alert-light border mb-0">
                                El stock actual se ajusta desde <strong>Movimientos</strong>; aquí solo editas la ficha del producto.
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer modal-footer-modern">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary btn-modern" id="saveProductBtn">
                    <i class="bi bi-check-circle me-2"></i>Guardar cambios
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentProductId = null;
    const jsonHeaders = {
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
    };

    function parseJsonResponse(response) {
        return response.json()
            .catch(() => ({}))
            .then(data => {
                if (!response.ok) {
                    throw data;
                }

                return data;
            });
    }

    function clearValidationErrors() {
        const fieldErrorMap = {
            name: ['editName', 'nameError'],
            sku: ['editSku', 'skuError'],
            image_url: ['editImageUrl', 'imageUrlError'],
            category_id: ['editCategory', 'categoryError'],
            supplier_id: ['editSupplier', 'supplierError'],
            purchase_price: ['editPurchasePrice', 'purchasePriceError'],
            sale_price: ['editSalePrice', 'salePriceError'],
            stock_minimum: ['editStockMinimum', 'stockMinError'],
            unit: ['editUnit', 'unitError'],
            status: ['editStatus', 'statusError'],
        };

        Object.values(fieldErrorMap).forEach(([inputId, errorId]) => {
            const input = document.getElementById(inputId);
            const errorElement = document.getElementById(errorId);

            if (input) {
                input.classList.remove('is-invalid');
            }

            if (errorElement) {
                errorElement.textContent = '';
            }
        });
    }

    function applyValidationErrors(errors = {}) {
        const fieldMap = {
            name: ['editName', 'nameError'],
            sku: ['editSku', 'skuError'],
            image_url: ['editImageUrl', 'imageUrlError'],
            category_id: ['editCategory', 'categoryError'],
            supplier_id: ['editSupplier', 'supplierError'],
            purchase_price: ['editPurchasePrice', 'purchasePriceError'],
            sale_price: ['editSalePrice', 'salePriceError'],
            stock_minimum: ['editStockMinimum', 'stockMinError'],
            unit: ['editUnit', 'unitError'],
            status: ['editStatus', 'statusError'],
        };

        Object.entries(errors).forEach(([field, messages]) => {
            const [inputId, errorId] = fieldMap[field] ?? [];
            const input = inputId ? document.getElementById(inputId) : null;
            const errorElement = errorId ? document.getElementById(errorId) : null;

            if (input) {
                input.classList.add('is-invalid');
            }

            if (errorElement) {
                errorElement.textContent = Array.isArray(messages) ? messages[0] : messages;
            }
        });
    }

    async function editProduct(productId) {
        currentProductId = productId;
        clearValidationErrors();

        try {
            const data = await fetch(`/products/${productId}/edit`, {
                headers: jsonHeaders,
            }).then(parseJsonResponse);

            document.getElementById('editId').value = `#${data.id}`;
            document.getElementById('editName').value = data.name;
            document.getElementById('editSku').value = data.sku;
            document.getElementById('editImageUrl').value = data.image_url ?? '';
            document.getElementById('editPurchasePrice').value = data.purchase_price;
            document.getElementById('editSalePrice').value = data.sale_price;
            document.getElementById('editStockMinimum').value = data.stock_minimum;
            document.getElementById('editUnit').value = data.unit;
            document.getElementById('editStatus').value = data.status;

            await Promise.all([
                loadCategoriesForEdit(data.category_id),
                loadSuppliersForEdit(data.supplier_id),
            ]);

            new bootstrap.Modal(document.getElementById('editProductModal')).show();
        } catch (error) {
            console.error('Error:', error);
            alert(error.message || 'Error al cargar los datos del producto');
        }
    }

    function loadCategoriesForEdit(selectedCategoryId = null) {
        return fetch('/categories/list', {
            headers: jsonHeaders,
        })
            .then(parseJsonResponse)
            .then(data => {
                const select = document.getElementById('editCategory');
                select.innerHTML = '<option value="">Seleccionar categoría</option>';

                data.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.name;
                    select.appendChild(option);
                });

                select.value = selectedCategoryId ? String(selectedCategoryId) : '';
            });
    }

    function loadSuppliersForEdit(selectedSupplierId = null) {
        return fetch('/suppliers/list', {
            headers: jsonHeaders,
        })
            .then(parseJsonResponse)
            .then(data => {
                const select = document.getElementById('editSupplier');
                select.innerHTML = '<option value="">Sin proveedor</option>';

                data.forEach(supplier => {
                    const option = document.createElement('option');
                    option.value = supplier.id;
                    option.textContent = supplier.name;
                    select.appendChild(option);
                });

                select.value = selectedSupplierId ? String(selectedSupplierId) : '';
            });
    }

    document.getElementById('saveProductBtn').addEventListener('click', function() {
        const form = document.getElementById('editProductForm');
        const formData = new FormData(form);

        clearValidationErrors();

        fetch(`/products/${currentProductId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                ...jsonHeaders,
            },
            body: formData
        })
        .then(parseJsonResponse)
        .then(async data => {
            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('editProductModal')).hide();
                if (typeof window.refreshProductsTable === 'function') {
                    await window.refreshProductsTable();
                } else {
                    location.reload();
                }
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);

            if (error.errors) {
                applyValidationErrors(error.errors);
                return;
            }

            alert(error.message || 'Error al guardar los cambios');
        });
    });
</script>
