<?php
$pageTitle = 'Editar producto';
$pageSubtitle = 'SKU-001 · Leche entera 1L';
$page = 'productos';
require __DIR__ . '/components/layout-start.php';
?>

<div class="mb-3">
    <a href="productos.php" class="text-decoration-none text-desc small">
        <i class="bi bi-arrow-left me-1"></i> Volver a productos
    </a>
</div>

<div class="card card-static p-4">
    <ul class="nav nav-tabs-custom mb-4" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-info">Información</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-stock">Stock</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-media">Media</button></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="tab-info">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" value="Leche entera 1L">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Categoría</label>
                            <select class="form-select">
                                <option selected>Lácteos</option>
                                <option>Bebidas</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">SKU</label>
                            <input type="text" class="form-control" value="SKU-001">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Precio</label>
                            <input type="number" step="0.01" class="form-control" value="1.25">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Stock mínimo</label>
                            <input type="number" class="form-control" value="15">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Estado</label>
                            <select class="form-select">
                                <option selected>Activo</option>
                                <option>Inactivo</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control" rows="4">Leche entera pasteurizada 1 litro.</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label class="form-label">Imagen del producto</label>
                    <div class="upload-card">
                        <div class="upload-preview"><i class="bi bi-image"></i></div>
                        <button type="button" class="btn btn-outline-secondary btn-sm">Cambiar</button>
                        <p class="text-desc mt-2 mb-0">PNG, JPG · máx. 2MB</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab-stock">
            <p class="text-desc">El stock se modifica desde <a href="movimientos.php">Movimientos</a>.</p>
            <div class="row g-3 mt-2">
                <div class="col-md-4">
                    <div class="card card-static p-3 text-center">
                        <div class="text-desc small">Stock actual</div>
                        <div class="stat-value">48</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-static p-3 text-center">
                        <div class="text-desc small">Stock mínimo</div>
                        <div class="stat-value">15</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab-media">
            <div class="upload-card" style="max-width: 320px;">
                <div class="upload-preview"><i class="bi bi-cloud-arrow-up"></i></div>
                <button type="button" class="btn btn-outline-primary btn-sm">Subir imagen</button>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
        <a href="productos.php" class="btn btn-outline-secondary">Cancelar</a>
        <button type="button" class="btn btn-primary" onclick="showToast('Cambios guardados (demo)','success')">Guardar cambios</button>
    </div>
</div>

<?php require __DIR__ . '/components/layout-end.php'; ?>
