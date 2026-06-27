<?php $currentPage = $page ?? ''; ?>
<nav class="bottom-nav d-lg-none" aria-label="Navegación móvil">
    <a href="dashboard.php" class="<?= $currentPage === 'dashboard' ? 'active' : '' ?>">
        <i class="bi bi-house"></i>
        Inicio
    </a>
    <a href="productos.php" class="<?= $currentPage === 'productos' ? 'active' : '' ?>">
        <i class="bi bi-box"></i>
        Productos
    </a>
    <a href="movimientos.php" class="<?= $currentPage === 'movimientos' ? 'active' : '' ?>">
        <i class="bi bi-arrow-left-right"></i>
        Stock
    </a>
    <a href="categorias.php" class="<?= $currentPage === 'categorias' ? 'active' : '' ?>">
        <i class="bi bi-grid"></i>
        Más
    </a>
</nav>
