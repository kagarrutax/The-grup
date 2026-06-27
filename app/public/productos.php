<?php
$pageTitle = 'Productos';
$pageSubtitle = 'Gestión del catálogo de inventario';
$page = 'productos';
require __DIR__ . '/components/layout-start.php';
?>

<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div class="search-bar-lg flex-grow-1" style="max-width: 360px;">
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-search text-muted"></i></span>
            <input type="search" class="form-control" placeholder="Nombre o SKU...">
        </div>
    </div>
    <div class="d-flex gap-2">
        <a href="busqueda.php" class="btn btn-outline-secondary">
            <i class="bi bi-search me-1"></i> Búsqueda avanzada
        </a>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal" data-product-new>
            <i class="bi bi-plus-lg me-1"></i> Nuevo producto
        </button>
    </div>
</div>

<div class="card card-static p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover mb-0" data-table>
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code class="text-desc">SKU-001</code></td>
                    <td class="fw-medium">Leche entera 1L</td>
                    <td>Lácteos</td>
                    <td>$1.25</td>
                    <td>48</td>
                    <td><span class="badge-pill badge-active">Activo</span></td>
                    <td>
                        <button type="button" class="btn btn-outline-secondary btn-action-sm me-1"
                            data-edit-product
                            data-name="Leche entera 1L"
                            data-sku="SKU-001"
                            data-category="lacteos"
                            data-price="1.25"
                            data-stock-min="15"
                            data-status="activo"><i class="bi bi-pencil"></i></button>
                        <button type="button" class="btn btn-outline-primary btn-action-sm me-1"
                            data-bs-toggle="modal" data-bs-target="#productDetailModal"
                            data-name="Leche entera 1L"
                            data-sku="SKU-001"
                            data-category="Lácteos"
                            data-price="$1.25"
                            data-stock="48"
                            data-status="Activo"><i class="bi bi-eye"></i></button>
                        <button class="btn btn-outline-danger btn-action-sm" data-confirm-delete><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td><code class="text-desc">SKU-042</code></td>
                    <td class="fw-medium">Arroz premium 500g</td>
                    <td>Despensa</td>
                    <td>$2.80</td>
                    <td>120</td>
                    <td><span class="badge-pill badge-active">Activo</span></td>
                    <td>
                        <button type="button" class="btn btn-outline-secondary btn-action-sm me-1"
                            data-edit-product
                            data-name="Arroz premium 500g"
                            data-sku="SKU-042"
                            data-category="despensa"
                            data-price="2.80"
                            data-stock-min="20"
                            data-status="activo"><i class="bi bi-pencil"></i></button>
                        <button type="button" class="btn btn-outline-primary btn-action-sm me-1"
                            data-bs-toggle="modal" data-bs-target="#productDetailModal"
                            data-name="Arroz premium 500g"
                            data-sku="SKU-042"
                            data-category="Despensa"
                            data-price="$2.80"
                            data-stock="120"
                            data-status="Activo"><i class="bi bi-eye"></i></button>
                        <button class="btn btn-outline-danger btn-action-sm" data-confirm-delete><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td><code class="text-desc">SKU-018</code></td>
                    <td class="fw-medium">Yogurt natural</td>
                    <td>Lácteos</td>
                    <td>$0.95</td>
                    <td>3</td>
                    <td><span class="badge-pill badge-pending">Bajo stock</span></td>
                    <td>
                        <button type="button" class="btn btn-outline-secondary btn-action-sm me-1"
                            data-edit-product
                            data-name="Yogurt natural"
                            data-sku="SKU-018"
                            data-category="lacteos"
                            data-price="0.95"
                            data-stock-min="15"
                            data-status="bajo"><i class="bi bi-pencil"></i></button>
                        <button type="button" class="btn btn-outline-primary btn-action-sm me-1"
                            data-bs-toggle="modal" data-bs-target="#productDetailModal"
                            data-name="Yogurt natural"
                            data-sku="SKU-018"
                            data-category="Lácteos"
                            data-price="$0.95"
                            data-stock="3"
                            data-status="Bajo stock"><i class="bi bi-eye"></i></button>
                        <button class="btn btn-outline-danger btn-action-sm" data-confirm-delete><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td><code class="text-desc">SKU-099</code></td>
                    <td class="fw-medium">Refresco cola 2L</td>
                    <td>Bebidas</td>
                    <td>$1.50</td>
                    <td>0</td>
                    <td><span class="badge-pill badge-inactive">Inactivo</span></td>
                    <td>
                        <button type="button" class="btn btn-outline-secondary btn-action-sm me-1"
                            data-edit-product
                            data-name="Refresco cola 2L"
                            data-sku="SKU-099"
                            data-category="bebidas"
                            data-price="1.50"
                            data-stock-min="10"
                            data-status="inactivo"><i class="bi bi-pencil"></i></button>
                        <button type="button" class="btn btn-outline-primary btn-action-sm me-1"
                            data-bs-toggle="modal" data-bs-target="#productDetailModal"
                            data-name="Refresco cola 2L"
                            data-sku="SKU-099"
                            data-category="Bebidas"
                            data-price="$1.50"
                            data-stock="0"
                            data-status="Inactivo"><i class="bi bi-eye"></i></button>
                        <button class="btn btn-outline-danger btn-action-sm" data-confirm-delete><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Crear / editar producto -->
<div class="modal fade modal-app" id="productModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-icon primary"><i class="bi bi-box"></i></div>
                <div>
                    <h5 class="modal-title" id="productModalTitle">Nuevo producto</h5>
                    <p class="modal-subtitle" id="productModalSubtitle">Completa los datos del producto</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="productName">Nombre</label>
                        <input type="text" class="form-control" id="productName" placeholder="Ej. Leche entera 1L">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="productSku">SKU</label>
                        <input type="text" class="form-control" id="productSku" placeholder="SKU-000">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="productCategory">Categoría</label>
                        <select class="form-select" id="productCategory">
                            <option value="lacteos">Lácteos</option>
                            <option value="bebidas">Bebidas</option>
                            <option value="despensa">Despensa</option>
                            <option value="limpieza">Limpieza</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="productPrice">Precio</label>
                        <input type="number" step="0.01" class="form-control" id="productPrice" placeholder="0.00">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="productStockMin">Stock mínimo</label>
                        <input type="number" class="form-control" id="productStockMin" value="15">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="productStatus">Estado</label>
                        <select class="form-select" id="productStatus">
                            <option value="activo">Activo</option>
                            <option value="bajo">Bajo stock</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="saveModal('productModal','Producto guardado (demo)')">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Detalle producto -->
<div class="modal fade modal-app" id="productDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-icon success"><i class="bi bi-info-circle"></i></div>
                <div>
                    <h5 class="modal-title" id="detailProductName">Producto</h5>
                    <p class="modal-subtitle mb-0" id="detailProductSku">SKU-000</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <dl class="row mb-0">
                    <dt class="col-5 text-desc">Categoría</dt>
                    <dd class="col-7 fw-medium" id="detailProductCategory">—</dd>
                    <dt class="col-5 text-desc">Precio</dt>
                    <dd class="col-7 fw-medium text-success" id="detailProductPrice">—</dd>
                    <dt class="col-5 text-desc">Stock</dt>
                    <dd class="col-7 fw-medium" id="detailProductStock">—</dd>
                    <dt class="col-5 text-desc">Estado</dt>
                    <dd class="col-7" id="detailProductStatus">—</dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a href="producto-editar.php" class="btn btn-primary">Editar completo</a>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/components/layout-end.php'; ?>
