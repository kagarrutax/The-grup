<!-- Modal para Editar Producto -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modal-content-modern">
            <div class="modal-header modal-header-gradient">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square icon-header"></i>
                    <div>
                        <h5 class="modal-title mb-0" id="editProductModalLabel">Editar Producto</h5>
                        <small class="text-muted">Actualiza la información</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-modern">
                <form id="editProductForm">
                    @csrf
                    @method('PATCH')
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-medium">
                                <i class="bi bi-type text-primary me-2"></i>Nombre
                            </label>
                            <input type="text" id="editName" name="name" class="form-control form-control-modern" placeholder="Nombre del producto" required>
                            <div class="invalid-feedback" id="nameError"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">
                                <i class="bi bi-qr-code text-primary me-2"></i>SKU
                            </label>
                            <input type="text" id="editSku" name="sku" class="form-control form-control-modern" placeholder="Código SKU" required>
                            <div class="invalid-feedback" id="skuError"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">
                                <i class="bi bi-tag text-primary me-2"></i>Categoría
                            </label>
                            <select id="editCategory" name="category_id" class="form-select form-select-modern" required>
                                <option value="">Seleccionar categoría</option>
                            </select>
                            <div class="invalid-feedback" id="categoryError"></div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium">
                                <i class="bi bi-currency-dollar text-primary me-2"></i>Precio
                            </label>
                            <input type="number" id="editPrice" name="price" step="0.01" class="form-control form-control-modern" placeholder="0.00" required>
                            <div class="invalid-feedback" id="priceError"></div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium">
                                <i class="bi bi-exclamation-circle text-primary me-2"></i>Stock mín.
                            </label>
                            <input type="number" id="editStockMinimum" name="stock_minimum" class="form-control form-control-modern" required>
                            <div class="invalid-feedback" id="stockMinError"></div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium">
                                <i class="bi bi-rulers text-primary me-2"></i>Unidad
                            </label>
                            <input type="text" id="editUnit" name="unit" class="form-control form-control-modern" placeholder="ej: kg, lt, un" required>
                            <div class="invalid-feedback" id="unitError"></div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium">
                                <i class="bi bi-toggle-on text-primary me-2"></i>Estado
                            </label>
                            <select id="editStatus" name="status" class="form-select form-select-modern">
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                            <div class="invalid-feedback" id="statusError"></div>
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
            name: 'nameError',
            sku: 'skuError',
            category_id: 'categoryError',
            price: 'priceError',
            stock_minimum: 'stockMinError',
            unit: 'unitError',
            status: 'statusError',
        };

        Object.entries(fieldErrorMap).forEach(([field, errorId]) => {
            const input = document.getElementById(`edit${field.charAt(0).toUpperCase()}${field.slice(1)}`) ?? document.querySelector(`[name="${field}"]`);
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
            category_id: ['editCategory', 'categoryError'],
            price: ['editPrice', 'priceError'],
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

            document.getElementById('editName').value = data.name;
            document.getElementById('editSku').value = data.sku;
            document.getElementById('editPrice').value = data.price;
            document.getElementById('editStockMinimum').value = data.stock_minimum;
            document.getElementById('editUnit').value = data.unit;
            document.getElementById('editStatus').value = data.status;

            await loadCategoriesForEdit(data.category_id);

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
        .then(data => {
            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('editProductModal')).hide();
                location.reload();
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
