@extends('layouts.app')

@section('title', 'Notificaciones')
@section('page-title', 'Notificaciones')
@section('page-subtitle', 'Centro de alertas del sistema con estado, fecha y acciones rápidas')

@section('content')
    <section class="notifications-page">
        <div class="card-app module-card">
            <div class="card-header notifications-page-header">
                <div>
                    <h2 class="dashboard-card-title mb-1">Todas las notificaciones</h2>
                    <p class="text-muted mb-0">{{ $notifications->total() }} registros disponibles</p>
                </div>
                <form action="{{ route('notifications.markAllRead') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Marcar todas como leídas</button>
                </form>
            </div>
        </div>

        <div class="notifications-feed">
            @forelse($notifications as $notification)
                <article class="notification-card {{ $notification->read_at ? 'is-read' : '' }}">
                    <div class="notification-icon">
                        <i class="bi {{ $notification->icon }}"></i>
                    </div>
                    <div class="notification-card-body">
                        <div class="notification-head">
                            <strong>{{ $notification->title }}</strong>
                            <span class="notification-status">{{ $notification->read_at ? 'Leído' : 'No leído' }}</span>
                        </div>
                        <p>{{ $notification->description }}</p>
                        <div class="notification-card-meta">
                            <span>{{ $notification->created_at->format('d/m/Y H:i') }}</span>
                            <span>{{ $notification->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="notification-card-actions">
                        @if(!$notification->read_at)
                            <form action="{{ route('notifications.read', $notification) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-primary">Marcar leída</button>
                            </form>
                        @endif
                        <form action="{{ route('notifications.destroy', $notification) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </div>
                </article>
            @empty
                <div class="card-app empty-state-card">No hay notificaciones registradas por el momento.</div>
            @endforelse
        </div>

        @if($notifications->hasPages())
            <div class="card-app module-card">
                <div class="card-body">
                    {{ $notifications->links() }}
                </div>
            </div>
        @endif
    </section>
@endsection
