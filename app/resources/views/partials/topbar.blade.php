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
        <div class="topbar-date topbar-date-button" aria-hidden="true">
            <i class="bi bi-calendar3"></i>
            <span>{{ now()->translatedFormat('d \d\e F, Y') }}</span>
        </div>
        <button class="topbar-btn topbar-btn-notification" type="button" aria-label="Notificaciones" id="notificationsToggle">
            <i class="bi bi-bell"></i>
            <span class="topbar-dot" id="notificationCount">0</span>
        </button>
        
        <div class="dropdown">
            <button class="user-avatar dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="{{ $user?->name ?? 'Usuario' }}" aria-label="Cuenta de usuario">
                {{ $initials ?: 'AD' }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><span class="dropdown-header">{{ $user?->name ?? 'Usuario' }}</span></li>
                <li><span class="dropdown-item-text small text-muted">{{ $user?->email ?? 'user@example.com' }}</span></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person-circle me-2"></i>Perfil y configuración
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

<div class="notifications-panel" id="notificationsPanel" hidden>
    <div class="notifications-panel-header">
        <div>
            <strong>Notificaciones</strong>
            <small>Actualización automática del inventario</small>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-sm btn-light" id="markAllNotificationsRead">Marcar todas</button>
            <a href="{{ route('notifications.page') }}" class="btn btn-sm btn-primary">Ver todas</a>
        </div>
    </div>
    <div class="notifications-panel-body" id="notificationsList">
        <div class="notifications-empty">Cargando notificaciones...</div>
    </div>
</div>

<form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script>
    function performLogout() {
        if (confirm('¿Deseas cerrar sesión?')) {
            document.getElementById('logoutForm').submit();
        }
    }

    async function loadNotifications() {
        const list = document.getElementById('notificationsList');
        const count = document.getElementById('notificationCount');

        try {
            const response = await fetch('{{ route('notifications.index') }}', {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            if (!response.ok) {
                throw new Error('No se pudieron cargar las notificaciones.');
            }

            const data = await response.json();
            const items = Array.isArray(data.items) ? data.items : [];
            const unreadCount = Number(data.count || 0);

            count.textContent = unreadCount;
            count.style.display = unreadCount > 0 ? 'inline-flex' : 'none';

            if (!items.length) {
                list.innerHTML = '<div class="notifications-empty">No hay notificaciones nuevas.</div>';
                return;
            }

            list.innerHTML = items.map(item => `
                <article class="notification-item ${item.read ? 'is-read' : ''}">
                    <div class="notification-icon"><i class="bi ${item.icon}"></i></div>
                    <div class="notification-content">
                        <div class="notification-head">
                            <strong>${item.title}</strong>
                            <span class="notification-status">${item.status}</span>
                        </div>
                        <p>${item.description}</p>
                        <small>${item.date}</small>
                    </div>
                    <button type="button" class="notification-delete" data-id="${item.id}" aria-label="Eliminar">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </article>
            `).join('');
        } catch (error) {
            count.textContent = '0';
            count.style.display = 'none';
            list.innerHTML = '<div class="notifications-empty">No fue posible cargar las notificaciones.</div>';
            console.error(error);
        }
    }

    document.getElementById('notificationsToggle')?.addEventListener('click', async function () {
        const panel = document.getElementById('notificationsPanel');
        const isHidden = panel.hasAttribute('hidden');

        if (isHidden) {
            await loadNotifications();
            panel.removeAttribute('hidden');
        } else {
            panel.setAttribute('hidden', 'hidden');
        }
    });

    document.getElementById('markAllNotificationsRead')?.addEventListener('click', async function () {
        await fetch('{{ route('notifications.markAllRead') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
        });

        loadNotifications();
    });

    document.getElementById('notificationsList')?.addEventListener('click', async function (event) {
        const button = event.target.closest('.notification-delete');

        if (!button) {
            return;
        }

        await fetch(`/notifications/${button.dataset.id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
        });

        loadNotifications();
    });

    document.addEventListener('click', function (event) {
        const panel = document.getElementById('notificationsPanel');
        const toggle = document.getElementById('notificationsToggle');

        if (!panel || panel.hasAttribute('hidden')) {
            return;
        }

        if (panel.contains(event.target) || toggle?.contains(event.target)) {
            return;
        }

        panel.setAttribute('hidden', 'hidden');
    });

    loadNotifications();
    setInterval(loadNotifications, 30000);
</script>
