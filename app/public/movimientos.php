<?php
$pageTitle = 'Movimientos de stock';
$pageSubtitle = 'Registro de entradas y salidas';
$page = 'movimientos';
require __DIR__ . '/components/layout-start.php';
?>

<div class="filter-bar">
    <div>
        <label class="form-label">Tipo</label>
        <select class="form-select">
            <option value="">Todos</option>
            <option>Entrada</option>
            <option>Salida</option>
        </select>
    </div>
    <div>
        <label class="form-label">Usuario</label>
        <select class="form-select">
            <option value="">Todos</option>
            <option>Administrador</option>
            <option>Operador</option>
        </select>
    </div>
    <div>
        <label class="form-label">Producto</label>
        <select class="form-select">
            <option value="">Todos</option>
            <option>Leche entera 1L</option>
            <option>Arroz premium 500g</option>
        </select>
    </div>
    <div class="ms-auto d-flex gap-2 align-items-end">
        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#filterModal">
            <i class="bi bi-funnel me-1"></i> Filtros
        </button>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#movementModal">
            <i class="bi bi-plus-lg me-1"></i> Nuevo
        </button>
    </div>
</div>

<div class="card card-static p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover mb-0" data-table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Tipo</th>
                    <th>Cantidad</th>
                    <th>Usuario</th>
                    <th>Motivo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-desc">24/06/2026 10:32</td>
                    <td class="fw-medium">Leche entera 1L</td>
                    <td><span class="badge-pill badge-entrada">Entrada</span></td>
                    <td class="qty-positive">+48</td>
                    <td>Administrador</td>
                    <td class="text-desc">Compra proveedor</td>
                </tr>
                <tr>
                    <td class="text-desc">24/06/2026 09:15</td>
                    <td class="fw-medium">Arroz premium 500g</td>
                    <td><span class="badge-pill badge-salida">Salida</span></td>
                    <td class="qty-negative">-12</td>
                    <td>Operador</td>
                    <td class="text-desc">Reposición tienda</td>
                </tr>
                <tr>
                    <td class="text-desc">23/06/2026 16:40</td>
                    <td class="fw-medium">Detergente 2L</td>
                    <td><span class="badge-pill badge-entrada">Entrada</span></td>
                    <td class="qty-positive">+24</td>
                    <td>Administrador</td>
                    <td class="text-desc">Inventario inicial</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<p class="text-desc mt-3 mb-0">Mostrando 1 a 3 de 3 resultados</p>

<div class="modal fade modal-app" id="filterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-icon warning"><i class="bi bi-funnel"></i></div>
                <div>
                    <h5 class="modal-title">Filtros avanzados</h5>
                    <p class="modal-subtitle mb-0">Refina la búsqueda de movimientos</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Rango de fechas</label>
                    <input type="date" class="form-control mb-2">
                    <input type="date" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Cantidad mínima</label>
                    <input type="number" class="form-control" min="0" placeholder="0">
                </div>
                <div>
                    <label class="form-label">Motivo</label>
                    <input type="text" class="form-control" placeholder="Buscar por motivo...">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Limpiar</button>
                <button type="button" class="btn btn-primary" onclick="saveModal('filterModal','Filtros aplicados (demo)')">Aplicar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-app" id="movementModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-icon success"><i class="bi bi-arrow-left-right"></i></div>
                <div>
                    <h5 class="modal-title">Registrar movimiento</h5>
                    <p class="modal-subtitle mb-0">Entrada o salida de stock</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Producto</label>
                        <select class="form-select">
                            <option>Leche entera 1L (48 uds)</option>
                            <option>Arroz premium 500g (120 uds)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tipo</label>
                        <select class="form-select">
                            <option>Entrada</option>
                            <option>Salida</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Cantidad</label>
                        <input type="number" min="1" class="form-control" value="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Motivo</label>
                        <input type="text" class="form-control" placeholder="Opcional">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="saveModal('movementModal','Movimiento registrado (demo)')">Registrar</button>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/components/layout-end.php'; ?>
