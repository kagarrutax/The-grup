<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h1 class="h3 mb-0">Dashboard</h1>
     <?php $__env->endSlot(); ?>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="bi bi-box-seam text-primary fs-4"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-0">Total productos</p>
                            <p class="h3 mb-0"><?php echo e($totalProducts); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                            <i class="bi bi-tags text-success fs-4"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-0">Total categorías</p>
                            <p class="h3 mb-0"><?php echo e($totalCategories); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 <?php echo e($lowStockCount > 0 ? 'border-warning' : ''); ?>">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                            <i class="bi bi-exclamation-triangle text-warning fs-4"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-0">Stock bajo</p>
                            <p class="h3 mb-0 <?php echo e($lowStockCount > 0 ? 'text-warning' : ''); ?>"><?php echo e($lowStockCount); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if($lowStockProducts->isNotEmpty()): ?>
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white">
                <h2 class="h5 mb-0"><i class="bi bi-exclamation-circle text-warning me-1"></i> Productos con stock bajo</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Producto</th>
                            <th>SKU</th>
                            <th>Categoría</th>
                            <th class="text-end">Stock</th>
                            <th class="text-end">Mínimo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $lowStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($product->name); ?></td>
                                <td><code><?php echo e($product->sku); ?></code></td>
                                <td><?php echo e($product->category->name); ?></td>
                                <td class="text-end text-warning fw-semibold"><?php echo e($product->stock_quantity); ?></td>
                                <td class="text-end"><?php echo e($product->stock_minimum); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0"><i class="bi bi-arrow-left-right me-1"></i> Últimos movimientos</h2>
            <a href="<?php echo e(route('stock.create')); ?>" class="btn btn-sm btn-primary">Registrar movimiento</a>
        </div>
        <?php if($recentMovements->isEmpty()): ?>
            <div class="card-body text-muted">
                No hay movimientos registrados aún.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Fecha</th>
                            <th>Producto</th>
                            <th>Usuario</th>
                            <th>Tipo</th>
                            <th class="text-end">Cantidad</th>
                            <th>Motivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $recentMovements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-nowrap"><?php echo e($movement->created_at->format('d/m/Y H:i')); ?></td>
                                <td><?php echo e($movement->product->name); ?></td>
                                <td><?php echo e($movement->user->name); ?></td>
                                <td>
                                    <?php if($movement->type === \App\Models\StockMovement::TYPE_ENTRADA): ?>
                                        <span class="badge bg-success">Entrada</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Salida</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end"><?php echo e($movement->quantity); ?></td>
                                <td><?php echo e($movement->reason ?? '—'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\The-grup\app\resources\views/dashboard/index.blade.php ENDPATH**/ ?>