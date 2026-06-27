<?php
$pageTitle = 'Reportes';
$pageSubtitle = 'Análisis e informes del inventario';
$page = 'reportes';
$loadReportesJs = true;
require __DIR__ . '/components/layout-start.php';
?>

<div class="filter-bar mb-4">
    <div>
        <label class="form-label">Periodo</label>
        <select class="form-select" id="reportPeriod">
            <option value="7">Últimos 7 días</option>
            <option value="30" selected>Últimos 30 días</option>
            <option value="90">Últimos 3 meses</option>
            <option value="365">Último año</option>
        </select>
    </div>
    <div>
        <label class="form-label">Tipo de reporte</label>
        <select class="form-select" id="reportType">
            <option value="inventory">Inventario general</option>
            <option value="movements">Movimientos de stock</option>
            <option value="lowstock">Stock bajo</option>
            <option value="categories">Por categoría</option>
        </select>
    </div>
    <div>
        <label class="form-label">Categoría</label>
        <select class="form-select">
            <option value="">Todas</option>
            <option>Lácteos</option>
            <option>Bebidas</option>
            <option>Despensa</option>
            <option>Limpieza</option>
        </select>
    </div>
    <div class="ms-auto d-flex gap-2 align-items-end flex-wrap">
        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exportModal">
            <i class="bi bi-download me-1"></i> Exportar
        </button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#generateReportModal">
            <i class="bi bi-file-earmark-bar-graph me-1"></i> Generar reporte
        </button>
    </div>
</div>

<div class="row g-3 g-xl-4 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card card-static p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="user-stat-icon primary"><i class="bi bi-box-seam"></i></div>
                <div>
                    <div class="text-desc small">Productos activos</div>
                    <div class="stat-value" style="font-size: 22px;">186</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card card-static p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="user-stat-icon success"><i class="bi bi-arrow-down-left"></i></div>
                <div>
                    <div class="text-desc small">Entradas (30 días)</div>
                    <div class="stat-value" style="font-size: 22px;">248</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card card-static p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="user-stat-icon warning"><i class="bi bi-arrow-up-right"></i></div>
                <div>
                    <div class="text-desc small">Salidas (30 días)</div>
                    <div class="stat-value" style="font-size: 22px;">192</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card card-static p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="user-stat-icon info"><i class="bi bi-currency-dollar"></i></div>
                <div>
                    <div class="text-desc small">Valor inventario</div>
                    <div class="stat-value" style="font-size: 22px;">$48.2k</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 g-xl-4 mb-4">
    <div class="col-lg-8">
        <div class="card card-static p-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                <h3 class="h3 mb-0">Entradas vs. salidas</h3>
                <div class="chart-legend">
                    <span><span class="dot green"></span> Entradas</span>
                    <span><span class="dot red"></span> Salidas</span>
                </div>
            </div>
            <div class="chart-inner" style="height: 280px;">
                <canvas id="reportMovementsChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-static p-4 h-100">
            <h3 class="h3 mb-3">Valor por categoría</h3>
            <div style="height: 220px;">
                <canvas id="reportCategoryChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="card card-panel card-static">
    <div class="card-panel__head">
        <div class="head-icon primary"><i class="bi bi-clock-history"></i></div>
        <h3 class="h3 mb-0">Reportes generados</h3>
        <button type="button" class="btn btn-sm btn-outline-secondary ms-auto" onclick="showToast('Lista actualizada (demo)','info')">
            <i class="bi bi-arrow-clockwise"></i>
        </button>
    </div>
    <div class="card-panel__body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Reporte</th>
                        <th>Periodo</th>
                        <th>Generado</th>
                        <th>Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-medium">Inventario general — Jun 2026</td>
                        <td class="text-desc">01/06 — 26/06</td>
                        <td class="text-desc">26/06/2026 09:15</td>
                        <td>Administrador</td>
                        <td>
                            <button type="button" class="btn btn-outline-primary btn-action-sm me-1"
                                data-bs-toggle="modal" data-bs-target="#reportDetailModal"
                                data-title="Inventario general — Jun 2026"
                                data-period="01/06/2026 — 26/06/2026"
                                data-type="Inventario general"
                                data-user="Administrador"
                                data-date="26/06/2026 09:15"
                                data-summary="186 productos · valor $48,200 · 7 alertas stock bajo"><i class="bi bi-eye"></i></button>
                            <button type="button" class="btn btn-outline-secondary btn-action-sm" data-export-report><i class="bi bi-download"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-medium">Movimientos de stock — Semana 25</td>
                        <td class="text-desc">19/06 — 25/06</td>
                        <td class="text-desc">25/06/2026 17:40</td>
                        <td>Verenice Ruiz</td>
                        <td>
                            <button type="button" class="btn btn-outline-primary btn-action-sm me-1"
                                data-bs-toggle="modal" data-bs-target="#reportDetailModal"
                                data-title="Movimientos de stock — Semana 25"
                                data-period="19/06/2026 — 25/06/2026"
                                data-type="Movimientos"
                                data-user="Verenice Ruiz"
                                data-date="25/06/2026 17:40"
                                data-summary="58 entradas · 42 salidas · 100 movimientos totales"><i class="bi bi-eye"></i></button>
                            <button type="button" class="btn btn-outline-secondary btn-action-sm" data-export-report><i class="bi bi-download"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-medium">Alertas stock bajo</td>
                        <td class="text-desc">26/06/2026</td>
                        <td class="text-desc">26/06/2026 08:00</td>
                        <td>Jessica Soto</td>
                        <td>
                            <button type="button" class="btn btn-outline-primary btn-action-sm me-1"
                                data-bs-toggle="modal" data-bs-target="#reportDetailModal"
                                data-title="Alertas stock bajo"
                                data-period="26/06/2026"
                                data-type="Stock bajo"
                                data-user="Jessica Soto"
                                data-date="26/06/2026 08:00"
                                data-summary="7 productos bajo mínimo · 1 agotado"><i class="bi bi-eye"></i></button>
                            <button type="button" class="btn btn-outline-secondary btn-action-sm" data-export-report><i class="bi bi-download"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Generar reporte -->
<div class="modal fade modal-app" id="generateReportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-icon primary"><i class="bi bi-file-earmark-bar-graph"></i></div>
                <div>
                    <h5 class="modal-title">Generar reporte</h5>
                    <p class="modal-subtitle mb-0">Configura y crea un nuevo informe</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nombre del reporte</label>
                    <input type="text" class="form-control" placeholder="Ej. Inventario mensual Jun 2026">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tipo</label>
                    <select class="form-select">
                        <option>Inventario general</option>
                        <option>Movimientos de stock</option>
                        <option>Stock bajo</option>
                        <option>Valor por categoría</option>
                    </select>
                </div>
                <div class="row g-3">
                    <div class="col-6">
                        <label class="form-label">Desde</label>
                        <input type="date" class="form-control" value="2026-06-01">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Hasta</label>
                        <input type="date" class="form-control" value="2026-06-26">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="saveModal('generateReportModal','Reporte generado (demo)')">Generar</button>
            </div>
        </div>
    </div>
</div>

<!-- Exportar -->
<div class="modal fade modal-app" id="exportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-icon success"><i class="bi bi-download"></i></div>
                <div>
                    <h5 class="modal-title">Exportar reporte</h5>
                    <p class="modal-subtitle mb-0">Elige el formato de descarga</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-outline-secondary text-start" onclick="saveModal('exportModal','Exportando PDF (demo)')">
                        <i class="bi bi-file-pdf me-2 text-danger"></i> PDF
                    </button>
                    <button type="button" class="btn btn-outline-secondary text-start" onclick="saveModal('exportModal','Exportando Excel (demo)')">
                        <i class="bi bi-file-earmark-spreadsheet me-2 text-success"></i> Excel (.xlsx)
                    </button>
                    <button type="button" class="btn btn-outline-secondary text-start" onclick="saveModal('exportModal','Exportando CSV (demo)')">
                        <i class="bi bi-filetype-csv me-2 text-primary"></i> CSV
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detalle reporte -->
<div class="modal fade modal-app" id="reportDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-icon info"><i class="bi bi-file-text"></i></div>
                <div>
                    <h5 class="modal-title" id="reportDetailTitle">Reporte</h5>
                    <p class="modal-subtitle mb-0" id="reportDetailPeriod">—</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="stat-detail-kpi mb-3">
                    <div class="kpi-box"><div class="label">Tipo</div><div class="value" style="font-size: 14px;" id="reportDetailType">—</div></div>
                    <div class="kpi-box"><div class="label">Generado por</div><div class="value" style="font-size: 14px;" id="reportDetailUser">—</div></div>
                </div>
                <p class="text-desc mb-2">Resumen</p>
                <p class="fw-medium mb-3" id="reportDetailSummary">—</p>
                <p class="text-desc small mb-0" id="reportDetailDate">—</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exportModal">
                    <i class="bi bi-download me-1"></i> Descargar
                </button>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/components/layout-end.php'; ?>
