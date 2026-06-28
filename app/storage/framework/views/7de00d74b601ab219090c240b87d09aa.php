

<?php $__env->startSection('title', 'Editar producto'); ?>
<?php $__env->startSection('page-title', 'Editar producto'); ?>
<?php $__env->startSection('page-subtitle', $product->name); ?>

<?php $__env->startSection('content'); ?>
    <div class="card-app">
        <div class="card-body">
            <form action="<?php echo e(route('products.update', $product)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Nombre</label>
                        <input type="text" name="name" value="<?php echo e(old('name', $product->name)); ?>" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">SKU</label>
                        <input type="text" name="sku" value="<?php echo e(old('sku', $product->sku)); ?>" class="form-control <?php $__errorArgs = ['sku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <?php $__errorArgs = ['sku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Categoría</label>
                        <select name="category_id" class="form-select" required>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat->id); ?>" <?php if(old('category_id', $product->category_id) == $cat->id): echo 'selected'; endif; ?>><?php echo e($cat->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium">Precio</label>
                        <input type="number" step="0.01" name="price" value="<?php echo e(old('price', $product->price)); ?>" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium">Stock mínimo</label>
                        <input type="number" name="stock_minimum" value="<?php echo e(old('stock_minimum', $product->stock_minimum)); ?>" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-medium">Unidad</label>
                        <input type="text" name="unit" value="<?php echo e(old('unit', $product->unit)); ?>" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-medium">Estado</label>
                        <select name="status" class="form-select">
                            <option value="activo" <?php if(old('status', $product->status) === 'activo'): echo 'selected'; endif; ?>>Activo</option>
                            <option value="inactivo" <?php if(old('status', $product->status) === 'inactivo'): echo 'selected'; endif; ?>>Inactivo</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-medium">Stock actual</label>
                        <input type="text" class="form-control" value="<?php echo e($product->stock_quantity); ?>" disabled>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="<?php echo e(route('products.index')); ?>" class="btn btn-outline-secondary">Volver</a>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\The-grup\app\resources\views/products/edit.blade.php ENDPATH**/ ?>