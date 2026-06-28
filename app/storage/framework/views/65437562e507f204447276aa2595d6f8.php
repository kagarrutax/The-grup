

<?php $__env->startSection('title', 'Categorías'); ?>
<?php $__env->startSection('page-title', 'Categorías'); ?>
<?php $__env->startSection('page-subtitle', 'Organización del catálogo de productos'); ?>

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-end mb-3">
        <a href="<?php echo e(route('categories.create')); ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Nueva categoría
        </a>
    </div>

    <div class="card-app">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-app mb-0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Productos</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="fw-medium"><?php echo e($category->name); ?></td>
                                <td class="text-muted"><?php echo e(Str::limit($category->description, 60) ?? '—'); ?></td>
                                <td><?php echo e($category->products_count); ?></td>
                                <td class="text-end">
                                    <a href="<?php echo e(route('categories.edit', $category)); ?>" class="btn btn-sm btn-outline-secondary">Editar</a>
                                    <form action="<?php echo e(route('categories.destroy', $category)); ?>" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar categoría?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="4" class="text-center text-muted py-4">No hay categorías.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if($categories->hasPages()): ?>
            <div class="card-footer"><?php echo e($categories->links()); ?></div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\The-grup\app\resources\views/categories/index.blade.php ENDPATH**/ ?>