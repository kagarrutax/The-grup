@php
    $user = auth()->user();
    $initials = collect(explode(' ', $user?->name ?? 'AD'))
        ->filter()
        ->take(2)
        ->map(fn ($w) => strtoupper(substr($w, 0, 1)))
        ->implode('');
@endphp

<header class="app-topbar">
    <div class="d-flex align-items-center gap-3">
        <button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Menú">
            <i class="bi bi-list fs-5"></i>
        </button>
        <div>
            <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
            @hasSection('page-subtitle')
                <p class="page-subtitle">@yield('page-subtitle')</p>
            @endif
        </div>
    </div>

    <div class="topbar-actions">
        <button class="topbar-date topbar-date-button" type="button">
            <i class="bi bi-calendar3"></i>
            <span>Oct 2023 – {{ now()->format('M Y') }}</span>
            <i class="bi bi-chevron-down small"></i>
        </button>
        <button class="topbar-btn topbar-btn-notification" type="button" aria-label="Notificaciones">
            <i class="bi bi-bell"></i>
            <span class="topbar-dot">3</span>
        </button>
        
        <div class="dropdown">
            <button class="user-avatar dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="{{ $user?->name ?? 'Usuario' }}">
                {{ $initials ?: 'AD' }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><span class="dropdown-header">{{ $user?->name ?? 'Usuario' }}</span></li>
                <li><span class="dropdown-item-text small text-muted">{{ $user?->email ?? 'user@example.com' }}</span></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person-circle me-2"></i>Mi Perfil
                    </a>
                </li>
                <li>
                    <button type="button" class="dropdown-item text-danger" onclick="performLogout()">
                        <i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión
                    </button>
                </li>
            </ul>
        </div>
    </div>
</header>

<form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script>
function performLogout() {
    if (confirm('¿Deseas cerrar sesión?')) {
        document.getElementById('logoutForm').submit();
    }
}
</script>
