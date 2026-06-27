<?php
$pageTitle = 'Búsqueda avanzada';
$pageSubtitle = 'Filtra y explora el catálogo';
$page = 'busqueda';
$loadBusquedaJs = true;

$products = [
    ['name' => 'Leche entera 1L', 'sku' => 'SKU-001', 'category' => 'Lácteos', 'stock' => 48, 'price' => 1.25, 'status' => 'activo', 'badge' => 'badge-active', 'label' => 'Activo'],
    ['name' => 'Arroz premium 500g', 'sku' => 'SKU-042', 'category' => 'Despensa', 'stock' => 120, 'price' => 2.80, 'status' => 'activo', 'badge' => 'badge-active', 'label' => 'Activo'],
    ['name' => 'Yogurt natural', 'sku' => 'SKU-018', 'category' => 'Lácteos', 'stock' => 3, 'price' => 0.95, 'status' => 'bajo', 'badge' => 'badge-pending', 'label' => 'Bajo stock'],
    ['name' => 'Refresco cola 2L', 'sku' => 'SKU-099', 'category' => 'Bebidas', 'stock' => 0, 'price' => 1.50, 'status' => 'inactivo', 'badge' => 'badge-inactive', 'label' => 'Inactivo'],
    ['name' => 'Detergente 2L', 'sku' => 'SKU-055', 'category' => 'Limpieza', 'stock' => 24, 'price' => 3.40, 'status' => 'activo', 'badge' => 'badge-active', 'label' => 'Activo'],
    ['name' => 'Pan integral', 'sku' => 'SKU-012', 'category' => 'Panadería', 'stock' => 18, 'price' => 1.10, 'status' => 'activo', 'badge' => 'badge-active', 'label' => 'Activo'],
    ['name' => 'Aceite girasol', 'sku' => 'SKU-033', 'category' => 'Despensa', 'stock' => 8, 'price' => 2.20, 'status' => 'bajo', 'badge' => 'badge-pending', 'label' => 'Bajo stock'],
    ['name' => 'Papel higiénico', 'sku' => 'SKU-077', 'category' => 'Limpieza', 'stock' => 5, 'price' => 4.50, 'status' => 'bajo', 'badge' => 'badge-pending', 'label' => 'Bajo stock'],
];

require __DIR__ . '/components/layout-start.php';
?>

<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div class="search-bar-lg flex-grow-1" style="max-width: 520px;">
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-search text-muted"></i></span>
            <input type="search" class="form-control" id="searchInput" placeholder="Buscar por nombre, SKU o categoría...">
        </div>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <button type="button" class="btn btn-outline-secondary d-lg-none" data-bs-toggle="modal" data-bs-target="#searchFilterModal">
            <i class="bi bi-funnel me-1"></i> Filtros
        </button>
        <select class="form-select form-select-sm" id="searchSort" style="width: auto;">
            <option value="name">Orden: Nombre</option>
            <option value="price-asc">Precio: menor a mayor</option>
            <option value="price-desc">Precio: mayor a menor</option>
            <option value="stock">Stock: menor primero</option>
        </select>
        <a href="productos.php" class="btn btn-outline-secondary">
            <i class="bi bi-list-ul me-1"></i> Vista tabla
        </a>
    </div>
</div>

<div class="filter-chips mb-3" id="filterChips">
    <span class="filter-chip active" data-filter="activo">Activo</span>
    <span class="filter-chip" data-filter="bajo">Bajo stock</span>
    <span class="filter-chip" data-filter="inactivo">Inactivo</span>
    <button type="button" class="filter-chip-clear d-none" id="clearFilters">Limpiar filtros</button>
</div>

<p class="text-desc mb-4" id="searchResultsCount">Mostrando <?= count($products) ?> productos</p>

<div class="search-layout">
    <aside class="filter-sidebar d-none d-lg-block">
        <h4>Estado</h4>
        <div class="form-check">
            <input class="form-check-input sidebar-filter" type="checkbox" id="sf1" data-filter="activo" checked>
            <label class="form-check-label" for="sf1">Activo</label>
        </div>
        <div class="form-check">
            <input class="form-check-input sidebar-filter" type="checkbox" id="sf2" data-filter="bajo">
            <label class="form-check-label" for="sf2">Bajo stock</label>
        </div>
        <div class="form-check mb-4">
            <input class="form-check-input sidebar-filter" type="checkbox" id="sf3" data-filter="inactivo">
            <label class="form-check-label" for="sf3">Inactivo</label>
        </div>

        <h4>Categoría</h4>
        <select class="form-select form-select-sm mb-4" id="categoryFilter">
            <option value="">Todas</option>
            <option>Lácteos</option>
            <option>Bebidas</option>
            <option>Despensa</option>
            <option>Limpieza</option>
            <option>Panadería</option>
        </select>

        <h4>Precio máximo</h4>
        <div class="d-flex justify-content-between small text-desc mb-1">
            <span>$0</span>
            <span id="priceRangeLabel">$5.00</span>
        </div>
        <input type="range" class="form-range mb-4" id="priceRange" min="0" max="10" step="0.5" value="5">

        <button type="button" class="btn btn-primary w-100 btn-sm" id="applySidebarFilters">Aplicar filtros</button>
    </aside>

    <div>
        <div class="row g-3 g-xl-4" id="productGrid">
            <?php foreach ($products as $p): ?>
            <div class="col-md-6 col-xl-4 product-grid-item"
                data-name="<?= htmlspecialchars(strtolower($p['name'])) ?>"
                data-sku="<?= htmlspecialchars(strtolower($p['sku'])) ?>"
                data-category="<?= htmlspecialchars(strtolower($p['category'])) ?>"
                data-status="<?= htmlspecialchars($p['status']) ?>"
                data-price="<?= $p['price'] ?>"
                data-stock="<?= $p['stock'] ?>">
                <div class="product-grid-card h-100 product-grid-card--clickable"
                    role="button" tabindex="0"
                    data-bs-toggle="modal" data-bs-target="#searchProductModal"
                    data-name="<?= htmlspecialchars($p['name']) ?>"
                    data-sku="<?= htmlspecialchars($p['sku']) ?>"
                    data-category="<?= htmlspecialchars($p['category']) ?>"
                    data-price="$<?= number_format($p['price'], 2) ?>"
                    data-stock="<?= $p['stock'] ?> uds"
                    data-status="<?= htmlspecialchars($p['label']) ?>"
                    data-badge="<?= htmlspecialchars($p['badge']) ?>">
                    <div class="pg-img"><i class="bi bi-box"></i></div>
                    <div class="pg-body">
                        <div class="d-flex justify-content-between align-items-start gap-2 mb-1">
                            <h3 class="h3 mb-0"><?= htmlspecialchars($p['name']) ?></h3>
                            <span class="badge-pill <?= htmlspecialchars($p['badge']) ?>"><?= htmlspecialchars($p['label']) ?></span>
                        </div>
                        <p class="text-desc mb-2"><?= htmlspecialchars($p['sku']) ?> · <?= htmlspecialchars($p['category']) ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="pg-price">$<?= number_format($p['price'], 2) ?></div>
                            <span class="text-desc small">Stock: <?= $p['stock'] ?></span>
                        </div>
                        <span class="pg-link small fw-medium">Ver detalles <i class="bi bi-arrow-right"></i></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center py-5 d-none" id="searchEmpty">
            <i class="bi bi-search fs-1 text-desc d-block mb-2"></i>
            <p class="fw-medium mb-1">Sin resultados</p>
            <p class="text-desc mb-3">Prueba con otros filtros o términos de búsqueda</p>
            <button type="button" class="btn btn-outline-secondary btn-sm" id="resetSearch">Restablecer búsqueda</button>
        </div>
    </div>
</div>

<!-- Filtros móvil -->
<div class="modal fade modal-app" id="searchFilterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-icon warning"><i class="bi bi-funnel"></i></div>
                <div>
                    <h5 class="modal-title">Filtros de búsqueda</h5>
                    <p class="modal-subtitle mb-0">Refina el catálogo de productos</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <h6 class="fw-semibold mb-2">Estado</h6>
                <div class="form-check"><input class="form-check-input mobile-filter" type="checkbox" id="mf1" data-filter="activo" checked><label class="form-check-label" for="mf1">Activo</label></div>
                <div class="form-check"><input class="form-check-input mobile-filter" type="checkbox" id="mf2" data-filter="bajo"><label class="form-check-label" for="mf2">Bajo stock</label></div>
                <div class="form-check mb-3"><input class="form-check-input mobile-filter" type="checkbox" id="mf3" data-filter="inactivo"><label class="form-check-label" for="mf3">Inactivo</label></div>
                <h6 class="fw-semibold mb-2">Categoría</h6>
                <select class="form-select form-select-sm mb-3" id="mobileCategoryFilter">
                    <option value="">Todas</option>
                    <option>Lácteos</option>
                    <option>Bebidas</option>
                    <option>Despensa</option>
                    <option>Limpieza</option>
                    <option>Panadería</option>
                </select>
                <h6 class="fw-semibold mb-2">Precio máximo</h6>
                <input type="range" class="form-range" id="mobilePriceRange" min="0" max="10" step="0.5" value="5">
                <p class="text-desc small mb-0">Hasta $<span id="mobilePriceLabel">5.00</span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="applyMobileFilters">Aplicar</button>
            </div>
        </div>
    </div>
</div>

<!-- Detalle producto -->
<div class="modal fade modal-app" id="searchProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-icon success"><i class="bi bi-box"></i></div>
                <div>
                    <h5 class="modal-title" id="searchDetailName">Producto</h5>
                    <p class="modal-subtitle mb-0" id="searchDetailSku">SKU-000</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="upload-card mb-3" style="padding: 16px;">
                    <div class="upload-preview" style="height: 100px; max-width: 100%; font-size: 36px;"><i class="bi bi-image"></i></div>
                </div>
                <dl class="row mb-0">
                    <dt class="col-5 text-desc">Categoría</dt>
                    <dd class="col-7 fw-medium" id="searchDetailCategory">—</dd>
                    <dt class="col-5 text-desc">Precio</dt>
                    <dd class="col-7 fw-medium qty-positive" id="searchDetailPrice">—</dd>
                    <dt class="col-5 text-desc">Stock</dt>
                    <dd class="col-7 fw-medium" id="searchDetailStock">—</dd>
                    <dt class="col-5 text-desc">Estado</dt>
                    <dd class="col-7" id="searchDetailStatus">—</dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a href="producto-editar.php" class="btn btn-primary">Editar producto</a>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/components/layout-end.php'; ?>
