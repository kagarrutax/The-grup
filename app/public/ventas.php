<?php
$pageTitle = 'Ventas';
$pageSubtitle = 'Registro de ventas al mostrador';
$page = 'ventas';
require __DIR__ . '/components/layout-start.php';
?>

<div class="row g-3 g-xl-4 mb-4">
    <div class="col-md-4">
        <div class="card card-static p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="user-stat-icon success"><i class="bi bi-cart-check"></i></div>
                <div>
                    <div class="text-desc small">Ventas hoy</div>
                    <div class="stat-value" style="font-size: 22px;">$1,240</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-static p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="user-stat-icon primary"><i class="bi bi-receipt"></i></div>
                <div>
                    <div class="text-desc small">Tickets</div>
                    <div class="stat-value" style="font-size: 22px;">34</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-static p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="user-stat-icon info"><i class="bi bi-graph-up"></i></div>
                <div>
                    <div class="text-desc small">Ticket promedio</div>
                    <div class="stat-value" style="font-size: 22px;">$36.50</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="filter-bar mb-4">
    <div class="search-bar-lg flex-grow-1" style="max-width: 280px;">
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-search text-muted"></i></span>
            <input type="search" class="form-control" placeholder="Nº ticket...">
        </div>
    </div>
    <div>
        <label class="form-label">Estado</label>
        <select class="form-select">
            <option value="">Todos</option>
            <option>Completada</option>
            <option>Pendiente</option>
            <option>Cancelada</option>
        </select>
    </div>
    <div>
        <label class="form-label">Cajero</label>
        <select class="form-select">
            <option value="">Todos</option>
            <option>Administrador</option>
            <option>Jessica Soto</option>
        </select>
    </div>
    <div class="ms-auto d-flex gap-2 align-items-end">
        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#saleFilterModal">
            <i class="bi bi-funnel me-1"></i> Filtros
        </button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#saleModal" data-sale-new>
            <i class="bi bi-plus-lg me-1"></i> Nueva venta
        </button>
    </div>
</div>

<div class="card card-static p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover mb-0" data-table>
            <thead>
                <tr>
                    <th>Ticket</th>
                    <th>Fecha</th>
                    <th>Productos</th>
                    <th>Total</th>
                    <th>Cajero</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="fw-medium">#VT-1042</td>
                    <td class="text-desc">26/06/2026 11:20</td>
                    <td>5 ítems</td>
                    <td class="fw-medium qty-positive">$48.75</td>
                    <td>Jessica Soto</td>
                    <td><span class="badge-pill badge-active">Completada</span></td>
                    <td>
                        <button type="button" class="btn btn-outline-primary btn-action-sm me-1"
                            data-sale-detail
                            data-bs-toggle="modal" data-bs-target="#saleDetailModal"
                            data-id="#VT-1042"
                            data-date="26/06/2026 11:20"
                            data-total="$48.75"
                            data-items="Leche entera 1L ×2, Pan integral ×3, Yogurt natural ×1"
                            data-cashier="Jessica Soto"
                            data-status="Completada"
                            data-badge="badge-active"><i class="bi bi-eye"></i></button>
                        <button type="button" class="btn btn-outline-secondary btn-action-sm me-1"
                            data-edit-sale
                            data-id="#VT-1042"
                            data-total="48.75"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-outline-danger btn-action-sm" data-confirm-delete><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td class="fw-medium">#VT-1041</td>
                    <td class="text-desc">26/06/2026 10:45</td>
                    <td>3 ítems</td>
                    <td class="fw-medium qty-positive">$22.30</td>
                    <td>Administrador</td>
                    <td><span class="badge-pill badge-active">Completada</span></td>
                    <td>
                        <button type="button" class="btn btn-outline-primary btn-action-sm me-1"
                            data-sale-detail
                            data-bs-toggle="modal" data-bs-target="#saleDetailModal"
                            data-id="#VT-1041"
                            data-date="26/06/2026 10:45"
                            data-total="$22.30"
                            data-items="Arroz premium 500g ×1, Aceite girasol ×1, Refresco cola 2L ×1"
                            data-cashier="Administrador"
                            data-status="Completada"
                            data-badge="badge-active"><i class="bi bi-eye"></i></button>
                        <button type="button" class="btn btn-outline-secondary btn-action-sm me-1"
                            data-edit-sale data-id="#VT-1041" data-total="22.30"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-outline-danger btn-action-sm" data-confirm-delete><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td class="fw-medium">#VT-1040</td>
                    <td class="text-desc">26/06/2026 09:30</td>
                    <td>2 ítems</td>
                    <td class="fw-medium">$15.00</td>
                    <td>Elda López</td>
                    <td><span class="badge-pill badge-pending">Pendiente</span></td>
                    <td>
                        <button type="button" class="btn btn-outline-primary btn-action-sm me-1"
                            data-sale-detail
                            data-bs-toggle="modal" data-bs-target="#saleDetailModal"
                            data-id="#VT-1040"
                            data-date="26/06/2026 09:30"
                            data-total="$15.00"
                            data-items="Detergente 2L ×1, Papel higiénico ×1"
                            data-cashier="Elda López"
                            data-status="Pendiente"
                            data-badge="badge-pending"><i class="bi bi-eye"></i></button>
                        <button type="button" class="btn btn-outline-secondary btn-action-sm me-1"
                            data-edit-sale data-id="#VT-1040" data-total="15.00"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-outline-danger btn-action-sm" data-confirm-delete><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td class="fw-medium">#VT-1039</td>
                    <td class="text-desc">25/06/2026 17:10</td>
                    <td>1 ítem</td>
                    <td class="fw-medium text-desc text-decoration-line-through">$1.50</td>
                    <td>Jessica Soto</td>
                    <td><span class="badge-pill badge-inactive">Cancelada</span></td>
                    <td>
                        <button type="button" class="btn btn-outline-primary btn-action-sm me-1"
                            data-sale-detail
                            data-bs-toggle="modal" data-bs-target="#saleDetailModal"
                            data-id="#VT-1039"
                            data-date="25/06/2026 17:10"
                            data-total="$1.50"
                            data-items="Refresco cola 2L ×1 (devuelto)"
                            data-cashier="Jessica Soto"
                            data-status="Cancelada"
                            data-badge="badge-inactive"><i class="bi bi-eye"></i></button>
                        <button type="button" class="btn btn-outline-secondary btn-action-sm me-1" disabled><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-outline-danger btn-action-sm" data-confirm-delete><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Nueva / editar venta -->
<div class="modal fade modal-app" id="saleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-icon success"><i class="bi bi-cart-plus"></i></div>
                <div>
                    <h5 class="modal-title" id="saleModalTitle">Nueva venta</h5>
                    <p class="modal-subtitle" id="saleModalSubtitle">Registra una venta al mostrador</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Producto</label>
                        <select class="form-select" id="saleProduct">
                            <option>Leche entera 1L — $1.25</option>
                            <option>Arroz premium 500g — $2.80</option>
                            <option>Pan integral — $1.10</option>
                            <option>Yogurt natural — $0.95</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="saleQty" min="1" value="1">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Estado</label>
                        <select class="form-select" id="saleStatus">
                            <option value="completada">Completada</option>
                            <option value="pendiente">Pendiente</option>
                        </select>
                    </div>
                </div>
                <div class="card card-static p-3 mb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-desc">Total estimado</span>
                        <span class="stat-value" style="font-size: 20px;" id="saleTotalPreview">$1.25</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="saveModal('saleModal','Venta registrada (demo)')">Registrar venta</button>
            </div>
        </div>
    </div>
</div>

<!-- Detalle venta -->
<div class="modal fade modal-app" id="saleDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-icon success"><i class="bi bi-receipt"></i></div>
                <div>
                    <h5 class="modal-title" id="saleDetailId">#VT-0000</h5>
                    <p class="modal-subtitle mb-0" id="saleDetailDate">—</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <dl class="row mb-3">
                    <dt class="col-5 text-desc">Cajero</dt>
                    <dd class="col-7 fw-medium" id="saleDetailCashier">—</dd>
                    <dt class="col-5 text-desc">Estado</dt>
                    <dd class="col-7" id="saleDetailStatus">—</dd>
                    <dt class="col-5 text-desc">Total</dt>
                    <dd class="col-7 fw-medium qty-positive" id="saleDetailTotal">—</dd>
                </dl>
                <p class="text-desc mb-1">Productos</p>
                <p class="fw-medium mb-0" id="saleDetailItems">—</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-outline-primary" onclick="showToast('Ticket impreso (demo)','info')">
                    <i class="bi bi-printer me-1"></i> Imprimir
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Filtros -->
<div class="modal fade modal-app" id="saleFilterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-icon warning"><i class="bi bi-funnel"></i></div>
                <div>
                    <h5 class="modal-title">Filtros de ventas</h5>
                    <p class="modal-subtitle mb-0">Refina el listado de tickets</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Rango de fechas</label>
                    <input type="date" class="form-control mb-2" value="2026-06-01">
                    <input type="date" class="form-control" value="2026-06-26">
                </div>
                <div>
                    <label class="form-label">Monto mínimo</label>
                    <input type="number" class="form-control" min="0" step="0.01" placeholder="0.00">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Limpiar</button>
                <button type="button" class="btn btn-primary" onclick="saveModal('saleFilterModal','Filtros aplicados (demo)')">Aplicar</button>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/components/layout-end.php'; ?>
