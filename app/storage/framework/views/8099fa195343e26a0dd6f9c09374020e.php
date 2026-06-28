<aside class="app-sidebar" id="appSidebar">
    <a href="<?php echo e(route('dashboard')); ?>" class="sidebar-brand">
        <span class="sidebar-brand-icon"><i class="bi bi-box-seam"></i></span>
        <span>Inventario</span>
    </a>

    <div class="sidebar-section">Inventario</div>
    <ul class="sidebar-nav">
        <li>
            <a href="<?php echo e(route('dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('products.index')); ?>" class="nav-link <?php echo e(request()->routeIs('products.*') ? 'active' : ''); ?>">
                <i class="bi bi-basket"></i> Productos
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('categories.index')); ?>" class="nav-link <?php echo e(request()->routeIs('categories.*') ? 'active' : ''); ?>">
                <i class="bi bi-tags"></i> Categorías
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('stock.index')); ?>" class="nav-link <?php echo e(request()->routeIs('stock.*') ? 'active' : ''); ?>">
                <i class="bi bi-arrow-left-right"></i> Movimientos
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <ul class="sidebar-nav mb-0">
            <li>
                <a href="<?php echo e(route('profile.edit')); ?>" class="nav-link <?php echo e(request()->routeIs('profile.*') ? 'active' : ''); ?>">
                    <i class="bi bi-person"></i> Perfil
                </a>
            </li>
            <li>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="nav-link w-100 border-0 bg-transparent text-start">
                        <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
<?php /**PATH C:\laragon\www\The-grup\app\resources\views/partials/sidebar.blade.php ENDPATH**/ ?>