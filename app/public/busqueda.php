<?php
$pageTitle = 'Búsqueda avanzada';
$pageSubtitle = 'Filtra y explora el catálogo';
$page = 'productos';
require __DIR__ . '/components/layout-start.php';
?>

<div class="search-layout">
    <aside class="filter-sidebar">
        <h4>Estado</h4>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="f1" checked>
            <label class="form-check-label" for="f1">Activo</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="f2">
            <label class="form-check-label" for="f2">Bajo stock</label>
        </div>
        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="f3">
            <label class="form-check-label" for="f3">Inactivo</label>
        </div>

        <h4>Categoría</h4>
        <select class="form-select form-select-sm mb-4">
            <option>Todas</option>
            <option>Lácteos</option>
            <option>Bebidas</option>
        </select>

        <h4>Precio</h4>
        <input type="range" class="form-range mb-4" min="0" max="10" value="5">

        <button class="btn btn-primary w-100 btn-sm">Aplicar filtros</button>
    </aside>

    <div>
        <div class="search-bar-lg mb-4">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search text-muted"></i></span>
                <input type="search" class="form-control" placeholder="Buscar por nombre, SKU o categoría...">
            </div>
        </div>

        <div class="row g-3 g-xl-4">
            <?php
            $items = [
                ['name' => 'Leche entera 1L', 'sku' => 'SKU-001', 'stock' => 48, 'price' => '$1.25'],
                ['name' => 'Arroz premium 500g', 'sku' => 'SKU-042', 'stock' => 120, 'price' => '$2.80'],
                ['name' => 'Yogurt natural', 'sku' => 'SKU-018', 'stock' => 3, 'price' => '$0.95'],
                ['name' => 'Refresco cola 2L', 'sku' => 'SKU-099', 'stock' => 0, 'price' => '$1.50'],
                ['name' => 'Detergente 2L', 'sku' => 'SKU-055', 'stock' => 24, 'price' => '$3.40'],
                ['name' => 'Pan integral', 'sku' => 'SKU-012', 'stock' => 18, 'price' => '$1.10'],
            ];
            foreach ($items as $item):
            ?>
            <div class="col-md-6 col-xl-4">
                <div class="product-grid-card h-100">
                    <div class="pg-img"><i class="bi bi-box"></i></div>
                    <div class="pg-body">
                        <h3 class="h3 mb-1"><?= htmlspecialchars($item['name']) ?></h3>
                        <p class="text-desc mb-2"><?= htmlspecialchars($item['sku']) ?> · Stock: <?= $item['stock'] ?></p>
                        <div class="pg-price mb-3"><?= htmlspecialchars($item['price']) ?></div>
                        <a href="producto-editar.php" class="small fw-medium text-decoration-none">Ver detalles <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require __DIR__ . '/components/layout-end.php'; ?>
