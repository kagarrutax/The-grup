<?php
    $user = auth()->user();
    $initials = collect(explode(' ', $user?->name ?? 'AD'))
        ->filter()
        ->take(2)
        ->map(fn ($w) => strtoupper(substr($w, 0, 1)))
        ->implode('');
?>

<header class="app-topbar">
    <div class="d-flex align-items-center gap-3">
        <button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Menú">
            <i class="bi bi-list fs-5"></i>
        </button>
        <div>
            <h1 class="page-title"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h1>
            <?php if (! empty(trim($__env->yieldContent('page-subtitle')))): ?>
                <p class="page-subtitle"><?php echo $__env->yieldContent('page-subtitle'); ?></p>
            <?php endif; ?>
        </div>
    </div>

    <div class="topbar-actions">
        <div class="topbar-date">
            <i class="bi bi-calendar3"></i>
            <span>Oct 2023 – <?php echo e(now()->format('M Y')); ?></span>
        </div>
        <button class="topbar-btn" type="button" aria-label="Notificaciones">
            <i class="bi bi-bell"></i>
        </button>
        <div class="user-avatar" title="<?php echo e($user?->name ?? 'Usuario'); ?>"><?php echo e($initials ?: 'AD'); ?></div>
    </div>
</header>
<?php /**PATH C:\laragon\www\The-grup\app\resources\views/partials/topbar.blade.php ENDPATH**/ ?>