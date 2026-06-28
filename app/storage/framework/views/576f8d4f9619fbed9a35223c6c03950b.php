

<?php $__env->startSection('title', 'Movimientos de stock'); ?>
<?php $__env->startSection('page-title', 'Movimientos de stock'); ?>
<?php $__env->startSection('page-subtitle', 'Registro de entradas y salidas'); ?>

<?php $__env->startSection('content'); ?>
<div class="card-app">
    <form method="GET" action="<?php echo e(route('stock.index')); ?>" class="filters-bar">
        <div class="filter-group">
            <label>Tipo</label>
            <select name="type" class="form-select form-select-sm">
                <option value="">Todos</option>
                <option value="entrada" <?php if(request('type') === 'entrada'): echo 'selected'; endif; ?>>Entrada</option>
                <option value="salida" <?php if(request('type') === 'salida'): echo 'selected'; endif; ?>>Salida</option>
            </select>
        </div>
        <div class="filter-group">
            <label>Usuario</label>
            <select name="user_id" class="form-select form-select-sm">
                <option value="">Todos</option>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($id); ?>" <?php if(request('user_id') == $id): echo 'selected'; endif; ?>><?php echo e($name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="filter-group">
            <label>Producto</label>
            <select name="product_id" class="form-select form-select-sm">
                <option value="">Todos</option>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($id); ?>" <?php if(request('product_id') == $id): echo 'selected'; endif; ?>><?php echo e($name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="ms-auto d-flex gap-2">
            <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="bi bi-funnel me-1"></i> Filtrar</button>
            <a href="<?php echo e(route('stock.create')); ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> Nuevo</a>
        </div>
    </form>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-app mb-0">
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
                    <?php $__empty_1 = true; $__currentLoopData = $movements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="text-nowrap"><?php echo e($movement->created_at->format('d/m/Y H:i')); ?></td>
                            <td><?php echo e($movement->product->name); ?></td>
                            <td>
                                <?php if($movement->type === 'entrada'): ?>
                                    <span class="badge-entrada">ENTRADA</span>
                                <?php else: ?>
                                    <span class="badge-salida">SALIDA</span>
                                <?php endif; ?>
                            </td>
                            <td class="<?php echo e($movement->type === 'entrada' ? 'qty-positive' : 'qty-negative'); ?>">
                                <?php echo e($movement->type === 'entrada' ? '+' : '-'); ?><?php echo e($movement->quantity); ?>

                            </td>
                            <td><?php echo e($movement->user->name); ?></td>
                            <td class="text-muted"><?php echo e($movement->reason ?? '—'); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No hay movimientos registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if($movements->hasPages()): ?>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <small class="text-muted">Mostrando <?php echo e($movements->firstItem()); ?>–<?php echo e($movements->lastItem()); ?> de <?php echo e($movements->total()); ?></small>
            <?php echo e($movements->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\The-grup\app\resources\views/stock/index.blade.php ENDPATH**/ ?>