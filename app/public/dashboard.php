<?php
$pageTitle = 'Dashboard';
$pageSubtitle = 'Resumen del inventario en tiempo real';
$page = 'dashboard';
$loadDashboardJs = true;
require __DIR__ . '/components/layout-start.php';
?>

<div class="row g-3 g-xl-4 mb-4">
    <div class="col-lg-3 col-md-6">
        <button type="button" class="card stat-card stat-card--primary stat-card-btn p-4"
            data-bs-toggle="modal" data-bs-target="#statModalSales">
            <div class="stat-top">
                <div>
                    <div class="stat-label">Ventas totales</div>
                    <div class="stat-value">$1,240</div>
                    <span class="stat-change up"><i class="bi bi-arrow-up-short"></i> +5.6%</span>
                </div>
                <div class="stat-icon primary"><i class="bi bi-wallet2"></i></div>
            </div>
            <div class="sparkline-wrap">
                <canvas data-sparkline="820,900,880,950,1100,1240" data-color="#2563EB" height="48"></canvas>
            </div>
            <span class="stat-hint"><i class="bi bi-arrows-fullscreen me-1"></i> Ver detalle</span>
        </button>
    </div>
    <div class="col-lg-3 col-md-6">
        <button type="button" class="card stat-card stat-card--warning stat-card-btn p-4"
            data-bs-toggle="modal" data-bs-target="#statModalStock">
            <div class="stat-top">
                <div>
                    <div class="stat-label">Stock bajo</div>
                    <div class="stat-value">7</div>
                    <span class="stat-change down"><i class="bi bi-arrow-down-short"></i> -2.1%</span>
                </div>
                <div class="stat-icon warning"><i class="bi bi-exclamation-triangle"></i></div>
            </div>
            <div class="sparkline-wrap">
                <canvas data-sparkline="12,10,9,11,8,7" data-color="#D97706" height="48"></canvas>
            </div>
            <span class="stat-hint"><i class="bi bi-arrows-fullscreen me-1"></i> Ver detalle</span>
        </button>
    </div>
    <div class="col-lg-3 col-md-6">
        <button type="button" class="card stat-card stat-card--info stat-card-btn p-4"
            data-bs-toggle="modal" data-bs-target="#statModalMovements">
            <div class="stat-top">
                <div>
                    <div class="stat-label">Movimientos hoy</div>
                    <div class="stat-value">34</div>
                    <span class="stat-change up"><i class="bi bi-arrow-up-short"></i> +12%</span>
                </div>
                <div class="stat-icon info"><i class="bi bi-arrow-left-right"></i></div>
            </div>
            <div class="sparkline-wrap">
                <canvas data-sparkline="20,24,28,22,30,34" data-color="#4F46E5" height="48"></canvas>
            </div>
            <span class="stat-hint"><i class="bi bi-arrows-fullscreen me-1"></i> Ver detalle</span>
        </button>
    </div>
    <div class="col-lg-3 col-md-6">
        <button type="button" class="card stat-card stat-card--success stat-card-btn p-4"
            data-bs-toggle="modal" data-bs-target="#statModalInventory">
            <div class="stat-top">
                <div>
                    <div class="stat-label">Valor inventario</div>
                    <div class="stat-value">$48.2k</div>
                    <span class="stat-change up"><i class="bi bi-arrow-up-short"></i> +3.2%</span>
                </div>
                <div class="stat-icon success"><i class="bi bi-box-seam"></i></div>
            </div>
            <div class="sparkline-wrap">
                <canvas data-sparkline="42,44,43,45,47,48" data-color="#059669" height="48"></canvas>
            </div>
            <span class="stat-hint"><i class="bi bi-arrows-fullscreen me-1"></i> Ver detalle</span>
        </button>
    </div>
</div>

<div class="row g-3 g-xl-4 mb-4">
    <div class="col-lg-8">
        <div class="card card-static p-4 chart-card">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                <h3 class="h3 mb-0">Rendimiento de ventas y entradas</h3>
                <div class="chart-legend">
                    <span><span class="dot blue"></span> Ventas</span>
                    <span><span class="dot green"></span> Entradas</span>
                </div>
            </div>
            <div class="chart-inner" style="height: 280px;">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-panel card-static h-100">
            <div class="card-panel__head">
                <div class="head-icon primary"><i class="bi bi-clock-history"></i></div>
                <h3 class="h3 mb-0">Últimos movimientos</h3>
            </div>
            <div class="card-panel__body">
            <div class="activity-item">
                <div class="activity-icon in"><i class="bi bi-arrow-down-left"></i></div>
                <div class="flex-grow-1">
                    <div class="fw-medium small">Leche entera 1L</div>
                    <div class="text-desc">Entrada · +48 uds · hace 5 min</div>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-icon out"><i class="bi bi-arrow-up-right"></i></div>
                <div class="flex-grow-1">
                    <div class="fw-medium small">Arroz premium 500g</div>
                    <div class="text-desc">Salida · -12 uds · hace 18 min</div>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-icon in"><i class="bi bi-arrow-down-left"></i></div>
                <div class="flex-grow-1">
                    <div class="fw-medium small">Detergente 2L</div>
                    <div class="text-desc">Entrada · +24 uds · hace 1 h</div>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-icon out"><i class="bi bi-arrow-up-right"></i></div>
                <div class="flex-grow-1">
                    <div class="fw-medium small">Pan integral</div>
                    <div class="text-desc">Salida · -6 uds · hace 2 h</div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 g-xl-4">
    <div class="col-lg-4">
        <div class="card card-panel card-static">
            <div class="card-panel__head">
                <div class="head-icon warning"><i class="bi bi-exclamation-circle"></i></div>
                <h3 class="h3 mb-0">Productos con poco stock</h3>
            </div>
            <div class="card-panel__body">
            <div class="mb-3">
                <div class="d-flex justify-content-between mb-1">
                    <span class="small fw-medium">Yogurt natural</span>
                    <span class="text-desc">3 / 15</span>
                </div>
                <div class="stock-bar"><div class="stock-bar-fill critical" style="width: 20%"></div></div>
            </div>
            <div class="mb-3">
                <div class="d-flex justify-content-between mb-1">
                    <span class="small fw-medium">Aceite girasol</span>
                    <span class="text-desc">8 / 20</span>
                </div>
                <div class="stock-bar"><div class="stock-bar-fill low" style="width: 40%"></div></div>
            </div>
            <div>
                <div class="d-flex justify-content-between mb-1">
                    <span class="small fw-medium">Papel higiénico</span>
                    <span class="text-desc">5 / 25</span>
                </div>
                <div class="stock-bar"><div class="stock-bar-fill low" style="width: 20%"></div></div>
            </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-panel card-static">
            <div class="card-panel__head">
                <div class="head-icon primary"><i class="bi bi-bar-chart"></i></div>
                <h3 class="h3 mb-0">Top categorías</h3>
            </div>
            <div class="card-panel__body">
            <ul class="list-unstyled mb-0">
                <li class="rank-item"><span>Lácteos</span><span class="badge-pill badge-active">62</span></li>
                <li class="rank-item"><span>Bebidas</span><span class="badge-pill badge-active">48</span></li>
                <li class="rank-item"><span>Limpieza</span><span class="badge-pill badge-active">41</span></li>
                <li class="rank-item"><span>Panadería</span><span class="badge-pill badge-active">35</span></li>
            </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-panel card-static">
            <div class="card-panel__head">
                <div class="head-icon success"><i class="bi bi-activity"></i></div>
                <h3 class="h3 mb-0">Actividad reciente</h3>
            </div>
            <div class="card-panel__body p-0">
            <table class="table table-sm mb-0">
                <tbody>
                    <tr><td class="text-desc">SKU-001</td><td><span class="badge-pill badge-entrada">Entrada</span></td><td class="qty-positive">+20</td></tr>
                    <tr><td class="text-desc">SKU-042</td><td><span class="badge-pill badge-salida">Salida</span></td><td class="qty-negative">-5</td></tr>
                    <tr><td class="text-desc">SKU-018</td><td><span class="badge-pill badge-entrada">Entrada</span></td><td class="qty-positive">+100</td></tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<!-- Modales métricas dashboard -->
<div class="modal fade modal-app" id="statModalSales" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-icon primary"><i class="bi bi-wallet2"></i></div>
                <div>
                    <h5 class="modal-title">Ventas totales</h5>
                    <p class="modal-subtitle mb-0">Desglose del periodo · Oct 2023 — Jun 2026</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="stat-detail-kpi">
                    <div class="kpi-box"><div class="label">Total</div><div class="value text-primary">$1,240</div></div>
                    <div class="kpi-box"><div class="label">vs. mes anterior</div><div class="value qty-positive">+5.6%</div></div>
                    <div class="kpi-box"><div class="label">Ticket promedio</div><div class="value">$36.50</div></div>
                    <div class="kpi-box"><div class="label">Transacciones</div><div class="value">34</div></div>
                </div>
                <h6 class="fw-semibold mb-2">Top productos vendidos</h6>
                <ul class="stat-detail-list">
                    <li><span>Leche entera 1L</span><span class="fw-medium">$312</span></li>
                    <li><span>Arroz premium 500g</span><span class="fw-medium">$280</span></li>
                    <li><span>Refresco cola 2L</span><span class="fw-medium">$225</span></li>
                    <li><span>Pan integral</span><span class="fw-medium">$198</span></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a href="productos.php" class="btn btn-primary">Ver productos</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-app" id="statModalStock" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-icon warning"><i class="bi bi-exclamation-triangle"></i></div>
                <div>
                    <h5 class="modal-title">Stock bajo</h5>
                    <p class="modal-subtitle mb-0">7 productos por debajo del mínimo</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <ul class="stat-detail-list mb-0">
                    <li>
                        <span>Yogurt natural <span class="text-desc">· 3/15 uds</span></span>
                        <span class="badge-pill badge-pending">Crítico</span>
                    </li>
                    <li>
                        <span>Papel higiénico <span class="text-desc">· 5/25 uds</span></span>
                        <span class="badge-pill badge-pending">Bajo</span>
                    </li>
                    <li>
                        <span>Aceite girasol <span class="text-desc">· 8/20 uds</span></span>
                        <span class="badge-pill badge-pending">Bajo</span>
                    </li>
                    <li>
                        <span>Refresco cola 2L <span class="text-desc">· 0/10 uds</span></span>
                        <span class="badge-pill badge-inactive">Agotado</span>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a href="movimientos.php" class="btn btn-primary">Registrar entrada</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-app" id="statModalMovements" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-icon primary"><i class="bi bi-arrow-left-right"></i></div>
                <div>
                    <h5 class="modal-title">Movimientos hoy</h5>
                    <p class="modal-subtitle mb-0">34 operaciones registradas · +12% vs. ayer</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0">
                <table class="table table-sm mb-0">
                    <thead>
                        <tr><th>Hora</th><th>Producto</th><th>Tipo</th><th>Cant.</th></tr>
                    </thead>
                    <tbody>
                        <tr><td class="text-desc">10:32</td><td>Leche entera 1L</td><td><span class="badge-pill badge-entrada">Entrada</span></td><td class="qty-positive">+48</td></tr>
                        <tr><td class="text-desc">09:15</td><td>Arroz premium 500g</td><td><span class="badge-pill badge-salida">Salida</span></td><td class="qty-negative">-12</td></tr>
                        <tr><td class="text-desc">08:40</td><td>Detergente 2L</td><td><span class="badge-pill badge-entrada">Entrada</span></td><td class="qty-positive">+24</td></tr>
                        <tr><td class="text-desc">07:22</td><td>Pan integral</td><td><span class="badge-pill badge-salida">Salida</span></td><td class="qty-negative">-6</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a href="movimientos.php" class="btn btn-primary">Ver todos</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-app" id="statModalInventory" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-icon success"><i class="bi bi-box-seam"></i></div>
                <div>
                    <h5 class="modal-title">Valor inventario</h5>
                    <p class="modal-subtitle mb-0">Valoración total del stock · +3.2% este mes</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="stat-detail-kpi mb-3">
                    <div class="kpi-box"><div class="label">Valor total</div><div class="value qty-positive">$48.2k</div></div>
                    <div class="kpi-box"><div class="label">Productos</div><div class="value">186</div></div>
                </div>
                <h6 class="fw-semibold mb-2">Por categoría</h6>
                <ul class="stat-detail-list">
                    <li><span>Lácteos</span><span class="fw-medium">$14,200</span></li>
                    <li><span>Bebidas</span><span class="fw-medium">$11,800</span></li>
                    <li><span>Despensa</span><span class="fw-medium">$9,600</span></li>
                    <li><span>Limpieza</span><span class="fw-medium">$7,400</span></li>
                    <li><span>Panadería</span><span class="fw-medium">$5,200</span></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a href="categorias.php" class="btn btn-primary">Ver categorías</a>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/components/layout-end.php'; ?>
