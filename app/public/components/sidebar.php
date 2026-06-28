<?php

$currentPage = $page ?? '';

?>

<aside class="app-sidebar" id="appSidebar">

    <div class="sidebar-brand">

        <div class="brand-icon"><i class="bi bi-box-seam"></i></div>

        <span>Inventario</span>

    </div>

    <nav class="sidebar-nav">

        <a href="dashboard.php" class="sidebar-link <?= $currentPage === 'dashboard' ? 'active' : '' ?>">

            <i class="bi bi-speedometer2"></i>

            Dashboard

        </a>



        <div class="sidebar-label">Inventario</div>

        <a href="productos.php" class="sidebar-link <?= $currentPage === 'productos' ? 'active' : '' ?>">

            <i class="bi bi-box"></i>

            Productos

        </a>

        <a href="categorias.php" class="sidebar-link <?= $currentPage === 'categorias' ? 'active' : '' ?>">

            <i class="bi bi-tags"></i>

            Categorías

        </a>

        <a href="movimientos.php" class="sidebar-link <?= $currentPage === 'movimientos' ? 'active' : '' ?>">

            <i class="bi bi-arrow-left-right"></i>

            Movimientos

        </a>

        <a href="busqueda.php" class="sidebar-link <?= $currentPage === 'busqueda' ? 'active' : '' ?>">

            <i class="bi bi-search"></i>

            Búsqueda

        </a>



        <div class="sidebar-label">Operaciones</div>

        <a href="ventas.php" class="sidebar-link <?= $currentPage === 'ventas' ? 'active' : '' ?>">

            <i class="bi bi-cart3"></i>

            Ventas

        </a>

        <a href="compras.php" class="sidebar-link <?= $currentPage === 'compras' ? 'active' : '' ?>">

            <i class="bi bi-truck"></i>

            Compras

        </a>



        <div class="sidebar-label">Administración</div>

        <a href="usuarios.php" class="sidebar-link <?= $currentPage === 'usuarios' ? 'active' : '' ?>">

            <i class="bi bi-people"></i>

            Usuarios

        </a>

        <a href="reportes.php" class="sidebar-link <?= $currentPage === 'reportes' ? 'active' : '' ?>">

            <i class="bi bi-graph-up-arrow"></i>

            Reportes

        </a>

    </nav>

</aside>

`r`n
