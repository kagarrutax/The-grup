<header class="app-navbar">
    <button class="btn-icon d-lg-none" type="button" id="sidebarToggle" aria-label="Menú">
        <i class="bi bi-list fs-5"></i>
    </button>

    <div class="navbar-page-title">
        <h1><?= htmlspecialchars($pageTitle ?? 'Inventario') ?></h1>
        <?php if (!empty($pageSubtitle)): ?>
        <p><?= htmlspecialchars($pageSubtitle) ?></p>
        <?php endif; ?>
    </div>

    <div class="navbar-tools">
        <div class="date-range-picker d-none d-md-flex">
            <i class="bi bi-calendar3"></i>
            <span>Oct 2023 — Jun 2026</span>
            <i class="bi bi-chevron-down small"></i>
        </div>
        <button class="btn-icon" type="button" title="Notificaciones">
            <i class="bi bi-bell"></i>
        </button>
        <div class="avatar"><?= htmlspecialchars($userInitials ?? 'AD') ?></div>
    </div>
</header>
