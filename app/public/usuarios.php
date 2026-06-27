<?php
$pageTitle = 'Usuarios';
$pageSubtitle = 'Gestión de accesos y roles del sistema';
$page = 'usuarios';
require __DIR__ . '/components/layout-start.php';
?>

<div class="row g-3 g-xl-4 mb-4">
    <div class="col-md-4">
        <div class="card card-static p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="user-stat-icon primary"><i class="bi bi-people"></i></div>
                <div>
                    <div class="text-desc small">Total usuarios</div>
                    <div class="stat-value" style="font-size: 22px;">5</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-static p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="user-stat-icon info"><i class="bi bi-shield-check"></i></div>
                <div>
                    <div class="text-desc small">Administradores</div>
                    <div class="stat-value" style="font-size: 22px;">2</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-static p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="user-stat-icon success"><i class="bi bi-person-check"></i></div>
                <div>
                    <div class="text-desc small">Activos</div>
                    <div class="stat-value" style="font-size: 22px;">4</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="filter-bar mb-4">
    <div class="search-bar-lg flex-grow-1" style="max-width: 360px;">
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-search text-muted"></i></span>
            <input type="search" class="form-control" placeholder="Nombre o correo...">
        </div>
    </div>
    <div>
        <label class="form-label">Rol</label>
        <select class="form-select">
            <option value="">Todos</option>
            <option>Administrador</option>
            <option>Operador</option>
        </select>
    </div>
    <div>
        <label class="form-label">Estado</label>
        <select class="form-select">
            <option value="">Todos</option>
            <option>Activo</option>
            <option>Inactivo</option>
        </select>
    </div>
    <div class="ms-auto d-flex align-items-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal" data-user-new>
            <i class="bi bi-person-plus me-1"></i> Nuevo usuario
        </button>
    </div>
</div>

<div class="card card-static p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover mb-0" data-table>
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Último acceso</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar-sm admin">AD</div>
                            <span class="fw-medium">Administrador</span>
                        </div>
                    </td>
                    <td class="text-desc">admin@supermercado.com</td>
                    <td><span class="badge-pill badge-admin">Admin</span></td>
                    <td class="text-desc">Hoy, 10:15</td>
                    <td><span class="badge-pill badge-active">Activo</span></td>
                    <td>
                        <button type="button" class="btn btn-outline-primary btn-action-sm me-1"
                            data-bs-toggle="modal" data-bs-target="#userDetailModal"
                            data-name="Administrador"
                            data-email="admin@supermercado.com"
                            data-role="Administrador"
                            data-role-badge="badge-admin"
                            data-status="Activo"
                            data-status-badge="badge-active"
                            data-last="Hoy, 10:15"
                            data-initials="AD"><i class="bi bi-eye"></i></button>
                        <button type="button" class="btn btn-outline-secondary btn-action-sm me-1"
                            data-edit-user
                            data-name="Administrador"
                            data-email="admin@supermercado.com"
                            data-role="admin"
                            data-status="activo"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-outline-danger btn-action-sm" data-confirm-delete disabled title="No puedes eliminar tu propia cuenta"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar-sm admin">VR</div>
                            <span class="fw-medium">Verenice Ruiz</span>
                        </div>
                    </td>
                    <td class="text-desc">verenice@supermercado.com</td>
                    <td><span class="badge-pill badge-admin">Admin</span></td>
                    <td class="text-desc">Ayer, 18:40</td>
                    <td><span class="badge-pill badge-active">Activo</span></td>
                    <td>
                        <button type="button" class="btn btn-outline-primary btn-action-sm me-1"
                            data-bs-toggle="modal" data-bs-target="#userDetailModal"
                            data-name="Verenice Ruiz"
                            data-email="verenice@supermercado.com"
                            data-role="Administrador"
                            data-role-badge="badge-admin"
                            data-status="Activo"
                            data-status-badge="badge-active"
                            data-last="Ayer, 18:40"
                            data-initials="VR"><i class="bi bi-eye"></i></button>
                        <button type="button" class="btn btn-outline-secondary btn-action-sm me-1"
                            data-edit-user
                            data-name="Verenice Ruiz"
                            data-email="verenice@supermercado.com"
                            data-role="admin"
                            data-status="activo"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-outline-danger btn-action-sm" data-confirm-delete><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar-sm operator">JS</div>
                            <span class="fw-medium">Jessica Soto</span>
                        </div>
                    </td>
                    <td class="text-desc">jessica@supermercado.com</td>
                    <td><span class="badge-pill badge-operator">Operador</span></td>
                    <td class="text-desc">24/06/2026, 09:02</td>
                    <td><span class="badge-pill badge-active">Activo</span></td>
                    <td>
                        <button type="button" class="btn btn-outline-primary btn-action-sm me-1"
                            data-bs-toggle="modal" data-bs-target="#userDetailModal"
                            data-name="Jessica Soto"
                            data-email="jessica@supermercado.com"
                            data-role="Operador"
                            data-role-badge="badge-operator"
                            data-status="Activo"
                            data-status-badge="badge-active"
                            data-last="24/06/2026, 09:02"
                            data-initials="JS"><i class="bi bi-eye"></i></button>
                        <button type="button" class="btn btn-outline-secondary btn-action-sm me-1"
                            data-edit-user
                            data-name="Jessica Soto"
                            data-email="jessica@supermercado.com"
                            data-role="operador"
                            data-status="activo"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-outline-danger btn-action-sm" data-confirm-delete><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar-sm operator">EL</div>
                            <span class="fw-medium">Elda López</span>
                        </div>
                    </td>
                    <td class="text-desc">elda@supermercado.com</td>
                    <td><span class="badge-pill badge-operator">Operador</span></td>
                    <td class="text-desc">23/06/2026, 16:20</td>
                    <td><span class="badge-pill badge-active">Activo</span></td>
                    <td>
                        <button type="button" class="btn btn-outline-primary btn-action-sm me-1"
                            data-bs-toggle="modal" data-bs-target="#userDetailModal"
                            data-name="Elda López"
                            data-email="elda@supermercado.com"
                            data-role="Operador"
                            data-role-badge="badge-operator"
                            data-status="Activo"
                            data-status-badge="badge-active"
                            data-last="23/06/2026, 16:20"
                            data-initials="EL"><i class="bi bi-eye"></i></button>
                        <button type="button" class="btn btn-outline-secondary btn-action-sm me-1"
                            data-edit-user
                            data-name="Elda López"
                            data-email="elda@supermercado.com"
                            data-role="operador"
                            data-status="activo"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-outline-danger btn-action-sm" data-confirm-delete><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar-sm operator muted">CR</div>
                            <span class="fw-medium">Carlos Ramírez</span>
                        </div>
                    </td>
                    <td class="text-desc">carlos@supermercado.com</td>
                    <td><span class="badge-pill badge-operator">Operador</span></td>
                    <td class="text-desc">15/06/2026, 11:00</td>
                    <td><span class="badge-pill badge-inactive">Inactivo</span></td>
                    <td>
                        <button type="button" class="btn btn-outline-primary btn-action-sm me-1"
                            data-bs-toggle="modal" data-bs-target="#userDetailModal"
                            data-name="Carlos Ramírez"
                            data-email="carlos@supermercado.com"
                            data-role="Operador"
                            data-role-badge="badge-operator"
                            data-status="Inactivo"
                            data-status-badge="badge-inactive"
                            data-last="15/06/2026, 11:00"
                            data-initials="CR"><i class="bi bi-eye"></i></button>
                        <button type="button" class="btn btn-outline-secondary btn-action-sm me-1"
                            data-edit-user
                            data-name="Carlos Ramírez"
                            data-email="carlos@supermercado.com"
                            data-role="operador"
                            data-status="inactivo"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-outline-danger btn-action-sm" data-confirm-delete><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Crear / editar usuario -->
<div class="modal fade modal-app" id="userModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-icon primary"><i class="bi bi-person-plus"></i></div>
                <div>
                    <h5 class="modal-title" id="userModalTitle">Nuevo usuario</h5>
                    <p class="modal-subtitle" id="userModalSubtitle">Registra un acceso al inventario</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label" for="userName">Nombre completo</label>
                    <input type="text" class="form-control" id="userName" placeholder="Ej. María García">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="userEmail">Correo electrónico</label>
                    <input type="email" class="form-control" id="userEmail" placeholder="usuario@supermercado.com">
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label" for="userRole">Rol</label>
                        <select class="form-select" id="userRole">
                            <option value="operador">Operador</option>
                            <option value="admin">Administrador</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="userStatus">Estado</label>
                        <select class="form-select" id="userStatus">
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3" id="userPasswordWrap">
                    <label class="form-label" for="userPassword">Contraseña</label>
                    <input type="password" class="form-control" id="userPassword" placeholder="Mínimo 8 caracteres">
                </div>
                <div id="userPasswordConfirmWrap">
                    <label class="form-label" for="userPasswordConfirm">Confirmar contraseña</label>
                    <input type="password" class="form-control" id="userPasswordConfirm" placeholder="Repite la contraseña">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="saveModal('userModal','Usuario guardado (demo)')">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Detalle usuario -->
<div class="modal fade modal-app" id="userDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="user-avatar-lg" id="userDetailAvatar">AD</div>
                <div>
                    <h5 class="modal-title" id="userDetailName">Usuario</h5>
                    <p class="modal-subtitle mb-0" id="userDetailEmail">correo@ejemplo.com</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <dl class="row mb-0">
                    <dt class="col-5 text-desc">Rol</dt>
                    <dd class="col-7" id="userDetailRole">—</dd>
                    <dt class="col-5 text-desc">Estado</dt>
                    <dd class="col-7" id="userDetailStatus">—</dd>
                    <dt class="col-5 text-desc">Último acceso</dt>
                    <dd class="col-7 fw-medium" id="userDetailLast">—</dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-outline-primary" id="userDetailEditBtn">
                    <i class="bi bi-pencil me-1"></i> Editar
                </button>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/components/layout-end.php'; ?>
