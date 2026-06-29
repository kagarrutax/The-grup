<?php
$pageTitle = 'Compras';
$pageSubtitle = 'Órdenes de compra a proveedores';
$page = 'compras';
require __DIR__ . '/components/layout-start.php';
?>

<div class="row g-3 g-xl-4 mb-4">
    <div class="col-md-4">
        <div class="card card-static p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="user-stat-icon primary"><i class="bi bi-truck"></i></div>
                <div>
                    <div class="text-desc small">Compras del mes</div>
                    <div class="stat-value" style="font-size: 22px;">$8,420</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-static p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="user-stat-icon warning"><i class="bi bi-hourglass-split"></i></div>
                <div>
                    <div class="text-desc small">Pendientes</div>
                    <div class="stat-value" style="font-size: 22px;">3</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-static p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="user-stat-icon success"><i class="bi bi-check2-circle"></i></div>
                <div>
                    <div class="text-desc small">Recibidas</div>
                    <div class="stat-value" style="font-size: 22px;">12</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="filter-bar mb-4">
    <div class="search-bar-lg flex-grow-1" style="max-width: 280px;">
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-search text-muted"></i></span>
            <input type="search" class="form-control" placeholder="Nº orden o proveedor...">
        </div>
    </div>
    <div>
        <label class="form-label">Estado</label>
        <select class="form-select">
            <option value="">Todos</option>
            <option>Recibida</option>
            <option>Pendiente</option>
            <option>Parcial</option>
            <option>Cancelada</option>
        </select>
    </div>
    <div>
        <label class="form-label">Proveedor</label>
        <select class="form-select">
            <option value="">Todos</option>
            <option>Lácteos del Norte SA</option>
            <option>Distribuidora Central</option>
            <option>Alimentos Express</option>
        </select>
    </div>
    <div class="ms-auto d-flex gap-2 align-items-end">
        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#purchaseFilterModal">
            <i class="bi bi-funnel me-1"></i> Filtros
        </button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#purchaseModal" data-purchase-new>
            <i class="bi bi-plus-lg me-1"></i> Nueva compra
        </button>
    </div>
</div>

<div class="card card-static p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover mb-0" data-table>
            <thead>
                <tr>
                    <th>Orden</th>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Productos</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="fw-medium">#OC-0288</td>
                    <td class="text-desc">26/06/2026 08:00</td>
                    <td>Lácteos del Norte SA</td>
                    <td>4 ítems</td>
                    <td class="fw-medium">$1,850.00</td>
                    <td><span class="badge-pill badge-pending">Pendiente</span></td>
                    <td>
                        <button type="button" class="btn btn-outline-primary btn-action-sm me-1"
                            data-bs-toggle="modal" data-bs-target="#purchaseDetailModal"
                            data-id="#OC-0288"
                            data-date="26/06/2026 08:00"
                            data-supplier="Lácteos del Norte SA"
                            data-total="$1,850.00"
                            data-items="Leche entera 1L ×100, Yogurt natural ×80, Queso fresco ×40, Mantequilla ×30"
                            data-status="Pendiente"
                            data-badge="badge-pending"
                            data-delivery="28/06/2026"><i class="bi bi-eye"></i></button>
                        <button type="button" class="btn btn-outline-secondary btn-action-sm me-1"
                            data-edit-purchase
                            data-id="#OC-0288"
                            data-supplier="lacteos"
                            data-total="1850"><i class="bi bi-pencil"></i></button>
                        <button type="button" class="btn btn-outline-success btn-action-sm me-1" title="Marcar recibida"
                            onclick="showToast('Compra marcada como recibida (demo)','success')"><i class="bi bi-check-lg"></i></button>
                        <button class="btn btn-outline-danger btn-action-sm" data-confirm-delete><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td class="fw-medium">#OC-0287</td>
                    <td class="text-desc">24/06/2026 14:30</td>
                    <td>Distribuidora Central</td>
                    <td>6 ítems</td>
                    <td class="fw-medium">$2,340.00</td>
                    <td><span class="badge-pill badge-active">Recibida</span></td>
                    <td>
                        <button type="button" class="btn btn-outline-primary btn-action-sm me-1"
                            data-bs-toggle="modal" data-bs-target="#purchaseDetailModal"
                            data-id="#OC-0287"
                            data-date="24/06/2026 14:30"
                            data-supplier="Distribuidora Central"
                            data-total="$2,340.00"
                            data-items="Arroz premium 500g ×200, Aceite girasol ×60, Frijoles ×80..."
                            data-status="Recibida"
                            data-badge="badge-active"
                            data-delivery="25/06/2026"><i class="bi bi-eye"></i></button>
                        <button type="button" class="btn btn-outline-secondary btn-action-sm me-1" disabled><i class="bi bi-pencil"></i></button>
                        <button type="button" class="btn btn-outline-success btn-action-sm me-1" disabled><i class="bi bi-check-lg"></i></button>
                        <button class="btn btn-outline-danger btn-action-sm" data-confirm-delete><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td class="fw-medium">#OC-0286</td>
                    <td class="text-desc">22/06/2026 10:15</td>
                    <td>Alimentos Express</td>
                    <td>3 ítems</td>
                    <td class="fw-medium">$980.00</td>
                    <td><span class="badge-pill badge-partial">Parcial</span></td>
                    <td>
                        <button type="button" class="btn btn-outline-primary btn-action-sm me-1"
                            data-bs-toggle="modal" data-bs-target="#purchaseDetailModal"
                            data-id="#OC-0286"
                            data-date="22/06/2026 10:15"
                            data-supplier="Alimentos Express"
                            data-total="$980.00"
                            data-items="Refresco cola 2L ×50 (30 recibidos), Pan integral ×40 (40 recibidos)"
                            data-status="Parcial"
                            data-badge="badge-partial"
                            data-delivery="23/06/2026"><i class="bi bi-eye"></i></button>
                        <button type="button" class="btn btn-outline-secondary btn-action-sm me-1"
                            data-edit-purchase data-id="#OC-0286" data-supplier="express" data-total="980"><i class="bi bi-pencil"></i></button>
                        <button type="button" class="btn btn-outline-success btn-action-sm me-1"
                            onclick="showToast('Recepción parcial registrada (demo)','success')"><i class="bi bi-check-lg"></i></button>
                        <button class="btn btn-outline-danger btn-action-sm" data-confirm-delete><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td class="fw-medium">#OC-0285</td>
                    <td class="text-desc">20/06/2026 09:00</td>
                    <td>Limpieza Total SA</td>
                    <td>2 ítems</td>
                    <td class="fw-medium text-desc text-decoration-line-through">$620.00</td>
                    <td><span class="badge-pill badge-inactive">Cancelada</span></td>
                    <td>
                        <button type="button" class="btn btn-outline-primary btn-action-sm me-1"
                            data-bs-toggle="modal" data-bs-target="#purchaseDetailModal"
                            data-id="#OC-0285"
                            data-date="20/06/2026 09:00"
                            data-supplier="Limpieza Total SA"
                            data-total="$620.00"
                            data-items="Detergente 2L ×40, Papel higiénico ×25"
                            data-status="Cancelada"
                            data-badge="badge-inactive"
                            data-delivery="—"><i class="bi bi-eye"></i></button>
                        <button type="button" class="btn btn-outline-secondary btn-action-sm me-1" disabled><i class="bi bi-pencil"></i></button>
                        <button type="button" class="btn btn-outline-success btn-action-sm me-1" disabled><i class="bi bi-check-lg"></i></button>
                        <button class="btn btn-outline-danger btn-action-sm" data-confirm-delete><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Nueva / editar compra -->
<div class="modal fade modal-app" id="purchaseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-icon primary"><i class="bi bi-truck"></i></div>
                <div>
                    <h5 class="modal-title" id="purchaseModalTitle">Nueva orden de compra</h5>
                    <p class="modal-subtitle" id="purchaseModalSubtitle">Registra un pedido a proveedor</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Proveedor</label>
                        <select class="form-select" id="purchaseSupplier">
                            <option value="lacteos">Lácteos del Norte SA</option>
                            <option value="central">Distribuidora Central</option>
                            <option value="express">Alimentos Express</option>
                            <option value="limpieza">Limpieza Total SA</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fecha entrega esperada</label>
                        <input type="date" class="form-control" id="purchaseDelivery" value="2026-06-28">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Producto</label>
                        <select class="form-select" id="purchaseProduct">
                            <option>Leche entera 1L — costo $0.95</option>
                            <option>Arroz premium 500g — costo $2.10</option>
                            <option>Detergente 2L — costo $2.80</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="purchaseQty" min="1" value="50">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Notas</label>
                        <textarea class="form-control" rows="2" placeholder="Instrucciones de entrega, referencia..."></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="saveModal('purchaseModal','Orden de compra creada (demo)')">Crear orden</button>
            </div>
        </div>
    </div>
</div>

<!-- Detalle compra -->
<div class="modal fade modal-app" id="purchaseDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-icon primary"><i class="bi bi-file-earmark-text"></i></div>
                <div>
                    <h5 class="modal-title" id="purchaseDetailId">#OC-0000</h5>
                    <p class="modal-subtitle mb-0" id="purchaseDetailDate">—</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="stat-detail-kpi mb-3">
                    <div class="kpi-box"><div class="label">Proveedor</div><div class="value" style="font-size: 14px;" id="purchaseDetailSupplier">—</div></div>
                    <div class="kpi-box"><div class="label">Entrega</div><div class="value" style="font-size: 14px;" id="purchaseDetailDelivery">—</div></div>
                </div>
                <dl class="row mb-3">
                    <dt class="col-4 text-desc">Estado</dt>
                    <dd class="col-8" id="purchaseDetailStatus">—</dd>
                    <dt class="col-4 text-desc">Total</dt>
                    <dd class="col-8 fw-medium" id="purchaseDetailTotal">—</dd>
                </dl>
                <p class="text-desc mb-1">Productos</p>
                <p class="fw-medium mb-0" id="purchaseDetailItems">—</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a href="movimientos.php" class="btn btn-outline-primary">Ver movimiento stock</a>
                <button type="button" class="btn btn-primary" onclick="showToast('Orden exportada (demo)','success')">
                    <i class="bi bi-download me-1"></i> Exportar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Filtros -->
<div class="modal fade modal-app" id="purchaseFilterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-icon warning"><i class="bi bi-funnel"></i></div>
                <div>
                    <h5 class="modal-title">Filtros de compras</h5>
                    <p class="modal-subtitle mb-0">Refina órdenes de compra</p>
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
                <button type="button" class="btn btn-primary" onclick="saveModal('purchaseFilterModal','Filtros aplicados (demo)')">Aplicar</button>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/components/layout-end.php'; ?>
