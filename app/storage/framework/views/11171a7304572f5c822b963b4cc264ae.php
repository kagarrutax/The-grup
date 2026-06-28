<div class="row g-3">
    <div class="col-md-6">
        <label class="text-muted small">SKU</label>
        <p class="fw-medium"><code><?php echo e($product->sku); ?></code></p>
    </div>
    
    <div class="col-md-6">
        <label class="text-muted small">Nombre</label>
        <p class="fw-medium"><?php echo e($product->name); ?></p>
    </div>
    
    <div class="col-md-6">
        <label class="text-muted small">Categoría</label>
        <p class="fw-medium"><?php echo e($product->category->name ?? '—'); ?></p>
    </div>
    
    <div class="col-md-6">
        <label class="text-muted small">Estado</label>
        <p>
            <span class="badge <?php echo e($product->status === 'activo' ? 'bg-success' : 'bg-danger'); ?>">
                <?php echo e(ucfirst($product->status)); ?>

            </span>
        </p>
    </div>
    
    <div class="col-md-6">
        <label class="text-muted small">Precio</label>
        <p class="fw-medium">$<?php echo e(number_format($product->price, 2)); ?></p>
    </div>
    
    <div class="col-md-6">
        <label class="text-muted small">Stock Actual</label>
        <p class="fw-medium <?php echo e($product->stock_quantity <= $product->stock_minimum ? 'text-danger' : 'text-success'); ?>">
            <?php echo e($product->stock_quantity); ?> <?php echo e($product->unit); ?>

        </p>
    </div>
    
    <div class="col-md-6">
        <label class="text-muted small">Stock Mínimo</label>
        <p class="fw-medium"><?php echo e($product->stock_minimum); ?> <?php echo e($product->unit); ?></p>
    </div>
    
    <div class="col-md-6">
        <label class="text-muted small">Unidad</label>
        <p class="fw-medium"><?php echo e($product->unit); ?></p>
    </div>
    
    <div class="col-12">
        <hr>
    </div>
    
    <div class="col-12">
        <label class="text-muted small">Información de la Auditoría</label>
        <small class="text-muted d-block">Creado: <?php echo e($product->created_at->format('d/m/Y H:i')); ?></small>
        <small class="text-muted d-block">Actualizado: <?php echo e($product->updated_at->format('d/m/Y H:i')); ?></small>
    </div>
</div>
<?php /**PATH C:\laragon\www\The-grup\app\resources\views/products/show.blade.php ENDPATH**/ ?>