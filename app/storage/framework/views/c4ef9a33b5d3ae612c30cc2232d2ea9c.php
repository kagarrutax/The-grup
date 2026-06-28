

<?php $__env->startSection('title', 'Productos'); ?>
<?php $__env->startSection('page-title', 'Productos'); ?>
<?php $__env->startSection('page-subtitle', 'Catálogo de productos del inventario'); ?>

<?php $__env->startSection('content'); ?>
    <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-3">
        <form method="GET" class="d-flex flex-wrap gap-2 align-items-end">
            <div>
                <label class="form-label small mb-1">Buscar</label>
                <input type="search" name="search" value="<?php echo e($search); ?>" class="form-control form-control-sm" placeholder="Nombre o SKU">
            </div>
            <div>
                <label class="form-label small mb-1">Categoría</label>
                <select name="category_id" class="form-select form-select-sm">
                    <option value="">Todas</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat->id); ?>" <?php if($categoryId == $cat->id): echo 'selected'; endif; ?>><?php echo e($cat->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <button type="submit" class="btn btn-outline-secondary btn-sm">Filtrar</button>
        </form>
        <a href="<?php echo e(route('products.create')); ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Nuevo producto
        </a>
    </div>

    <div class="card-app">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-app mb-0">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><code><?php echo e($product->sku); ?></code></td>
                                <td class="fw-medium"><?php echo e($product->name); ?></td>
                                <td><?php echo e($product->category->name ?? '—'); ?></td>
                                <td>
                                    <span class="<?php echo e($product->stock_quantity <= $product->stock_minimum ? 'text-danger fw-semibold' : ''); ?>">
                                        <?php echo e($product->stock_quantity); ?>

                                    </span>
                                </td>
                                <td>$<?php echo e(number_format($product->price, 2)); ?></td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-info" onclick="viewProduct(<?php echo e($product->id); ?>)">
                                        <i class="bi bi-eye me-1"></i> Ver
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="editProduct(<?php echo e($product->id); ?>)">
                                        <i class="bi bi-pencil me-1"></i> Editar
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="showDeleteConfirmation('<?php echo e($product->name); ?>', '<?php echo e(route('products.destroy', $product)); ?>', 'producto')">
                                        <i class="bi bi-trash me-1"></i> Eliminar
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="6" class="text-center text-muted py-4">No hay productos.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if($products->hasPages()): ?>
            <div class="card-footer"><?php echo e($products->links()); ?></div>
        <?php endif; ?>
    </div>

    <!-- Modales -->
    <?php echo $__env->make('components.modal-view-product', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('components.modal-edit-product', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('components.modal-delete-confirmation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\The-grup\app\resources\views/products/index.blade.php ENDPATH**/ ?>