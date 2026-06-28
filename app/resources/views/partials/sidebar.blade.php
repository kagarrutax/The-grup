<aside class="app-sidebar" id="appSidebar">
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
        <span class="sidebar-brand-icon"><i class="bi bi-box-seam"></i></span>
        <span>The Grup</span>
    </a>

    <ul class="sidebar-nav sidebar-nav-primary">
        <li>
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door-fill"></i> Inicio
            </a>
        </li>
    </ul>

    <div class="sidebar-section">Inventario</div>
    <ul class="sidebar-nav">
        <li>
            <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                <i class="bi bi-box"></i> Productos
            </a>
        </li>
        <li>
            <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <i class="bi bi-tag"></i> Categorías
            </a>
        </li>
        <li>
            <a href="{{ route('stock.index') }}" class="nav-link {{ request()->routeIs('stock.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-left-right"></i> Movimientos
            </a>
        </li>
        <li>
            <a href="#" class="nav-link nav-link-muted" onclick="return false;">
                <i class="bi bi-truck"></i> Proveedores
            </a>
        </li>
        <li>
            <a href="#" class="nav-link nav-link-muted" onclick="return false;">
                <i class="bi bi-sliders"></i> Ajustes de stock
            </a>
        </li>
    </ul>

    <div class="sidebar-section">Reportes</div>
    <ul class="sidebar-nav">
        <li>
            <a href="#" class="nav-link nav-link-muted" onclick="return false;">
                <i class="bi bi-graph-up-arrow"></i> Reportes
            </a>
        </li>
        <li>
            <a href="#" class="nav-link nav-link-muted" onclick="return false;">
                <i class="bi bi-upload"></i> Exportaciones
            </a>
        </li>
    </ul>

    <div class="sidebar-section">Configuración</div>
    <ul class="sidebar-nav">
        <li>
            <a href="#" class="nav-link nav-link-muted" onclick="return false;">
                <i class="bi bi-people"></i> Usuarios
            </a>
        </li>
        <li>
            <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <i class="bi bi-gear"></i> Configuración
            </a>
        </li>
        <li>
            <a href="#" class="nav-link nav-link-muted" onclick="return false;">
                <i class="bi bi-shield-check"></i> Auditoría
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <div class="sidebar-plan-card">
            <div class="sidebar-plan-icon"><i class="bi bi-stars"></i></div>
            <div class="sidebar-plan-title">Actualiza tu plan</div>
            <div class="sidebar-plan-text">Descubre todas las funcionalidades disponibles.</div>
            <button type="button" class="sidebar-plan-button">Ver planes</button>
        </div>

        <div class="sidebar-user-card">
            <div class="sidebar-user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
            <div class="sidebar-user-meta">
                <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
                <span>{{ auth()->user()->email ?? 'admin@thegrup.com' }}</span>
            </div>
            <button type="button" class="sidebar-user-action" onclick="performLogout()" aria-label="Cerrar sesión">
                <i class="bi bi-chevron-down"></i>
            </button>
        </div>
    </div>
</aside>
