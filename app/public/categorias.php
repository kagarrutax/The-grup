<?php
$pageTitle = 'Categorías de productos';
$pageSubtitle = 'Organiza el catálogo por categorías';
$page = 'categorias';
require __DIR__ . '/components/layout-start.php';
?>

<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div class="search-bar-lg flex-grow-1" style="max-width: 480px;">
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-search text-muted"></i></span>
            <input type="search" class="form-control" placeholder="Buscar categoría...">
        </div>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal" data-category-new>
        <i class="bi bi-plus-lg me-1"></i> Nueva categoría
    </button>
</div>

<div class="card card-static p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover mb-0" data-table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Categoría</th>
                    <th>Productos</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-desc">01</td>
                    <td class="fw-medium">Lácteos</td>
                    <td>62</td>
                    <td><span class="badge-pill badge-active">Activa</span></td>
                    <td>
                        <button type="button" class="btn btn-outline-secondary btn-action-sm me-1"
                            data-edit-category
                            data-name="Lácteos"
                            data-desc="Productos lácteos y derivados"
                            data-status="activa"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-outline-danger btn-action-sm" data-confirm-delete><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td class="text-desc">02</td>
                    <td class="fw-medium">Bebidas</td>
                    <td>48</td>
                    <td><span class="badge-pill badge-active">Activa</span></td>
                    <td>
                        <button type="button" class="btn btn-outline-secondary btn-action-sm me-1"
                            data-edit-category
                            data-name="Bebidas"
                            data-desc="Refrescos, jugos y agua"
                            data-status="activa"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-outline-danger btn-action-sm" data-confirm-delete><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td class="text-desc">03</td>
                    <td class="fw-medium">Limpieza</td>
                    <td>41</td>
                    <td><span class="badge-pill badge-active">Activa</span></td>
                    <td>
                        <button type="button" class="btn btn-outline-secondary btn-action-sm me-1"
                            data-edit-category
                            data-name="Limpieza"
                            data-desc="Artículos de limpieza del hogar"
                            data-status="activa"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-outline-danger btn-action-sm" data-confirm-delete><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td class="text-desc">04</td>
                    <td class="fw-medium">Panadería</td>
                    <td>35</td>
                    <td><span class="badge-pill badge-inactive">Inactiva</span></td>
                    <td>
                        <button type="button" class="btn btn-outline-secondary btn-action-sm me-1"
                            data-edit-category
                            data-name="Panadería"
                            data-desc="Pan y productos de horno"
                            data-status="inactiva"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-outline-danger btn-action-sm" data-confirm-delete><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade modal-app" id="categoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-icon primary"><i class="bi bi-tags"></i></div>
                <div>
                    <h5 class="modal-title" id="categoryModalTitle">Nueva categoría</h5>
                    <p class="modal-subtitle" id="categoryModalSubtitle">Agrega una categoría al catálogo</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label" for="categoryName">Nombre</label>
                    <input type="text" class="form-control" id="categoryName" placeholder="Ej. Lácteos">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="categoryDesc">Descripción</label>
                    <textarea class="form-control" id="categoryDesc" rows="3" placeholder="Descripción opcional"></textarea>
                </div>
                <div>
                    <label class="form-label" for="categoryStatus">Estado</label>
                    <select class="form-select" id="categoryStatus">
                        <option value="activa">Activa</option>
                        <option value="inactiva">Inactiva</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="saveModal('categoryModal','Categoría guardada (demo)')">Guardar</button>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/components/layout-end.php'; ?>
