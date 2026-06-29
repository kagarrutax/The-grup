@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Visión operativa del inventario con métricas, alertas y actividad reciente')

@section('content')
<div class="dashboard-page">
    <section class="dashboard-hero card-app">
        <div>
            <span class="dashboard-pill">SaaS Inventory Hub</span>
            <h2>Controla compras, stock y movimientos desde una sola vista.</h2>
            <p>Supervisa productos, alertas y valor del inventario con un diseño más limpio y orientado a operación diaria.</p>
        </div>
        <div class="dashboard-hero-metrics">
            <div>
                <strong>{{ $summaryCards[0]['value'] }}</strong>
                <span>Productos activos</span>
            </div>
            <div>
                <strong>{{ $summaryCards[4]['value'] }}</strong>
                <span>Inventario valorizado</span>
            </div>
        </div>
    </section>

    <div class="dashboard-summary-grid">
        @foreach($summaryCards as $card)
            <article class="summary-card summary-card-{{ $card['tone'] }}">
                <div class="summary-icon">
                    <i class="bi {{ $card['icon'] }}"></i>
                </div>
                <div class="summary-body">
                    <div class="summary-topline">
                        <span class="summary-title">{{ $card['title'] }}</span>
                        <span class="summary-trend trend-{{ $card['trendDirection'] }}">{{ $card['trend'] }}</span>
                    </div>
                    <div class="summary-value">{{ $card['value'] }}</div>
                    <div class="summary-caption">{{ $card['description'] }}</div>
                </div>
            </article>
        @endforeach
    </div>

    <div class="dashboard-main-grid">
        <section class="card-app dashboard-card dashboard-chart-card">
            <div class="card-header dashboard-card-header">
                <div>
                    <h2 class="dashboard-card-title">Entradas y salidas</h2>
                    <p class="dashboard-card-text">Comportamiento de los últimos 7 días</p>
                </div>
                <span class="dashboard-filter-badge">Actualización diaria</span>
            </div>
            <div class="card-body chart-card-body">
                <canvas id="movementsChart" height="120"></canvas>
            </div>
        </section>

        <aside class="card-app dashboard-card activity-card">
            <div class="card-header dashboard-card-header">
                <h2 class="dashboard-card-title">Actividad reciente</h2>
                <a href="{{ route('stock.index') }}" class="dashboard-card-link">Ver todas</a>
            </div>
            <div class="card-body activity-card-body">
                @forelse($recentActivity as $item)
                    <div class="activity-item">
                        <div class="activity-icon activity-icon-{{ $item['type'] }}">
                            <i class="bi {{ $item['icon'] }}"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title-row">
                                <strong>{{ $item['product'] }}</strong>
                                <span class="activity-meta">{{ $item['sku'] }}</span>
                            </div>
                            <div class="activity-meta">{{ $item['detail'] }} · {{ $item['time'] }}</div>
                        </div>
                        <div class="activity-badge-wrap">
                            <span class="activity-badge {{ $item['type'] === 'entrada' ? 'badge-entrada' : 'badge-salida' }}">
                                {{ strtoupper($item['type']) }} {{ $item['qty'] }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="empty-state-card">No hay actividad reciente registrada.</div>
                @endforelse
            </div>
        </aside>
    </div>

    <div class="dashboard-bottom-grid">
        <section class="card-app dashboard-card">
            <div class="card-header dashboard-card-header">
                <h2 class="dashboard-card-title">Productos con poco stock</h2>
                <a href="{{ route('products.index', ['search' => '']) }}" class="dashboard-card-link">Ver productos</a>
            </div>
            <div class="card-body stock-card-body">
                @forelse($lowStock as $item)
                    <div class="stock-row">
                        <div class="stock-row-icon stock-row-icon-{{ $item['level'] }}">
                            <i class="bi {{ $item['icon'] }}"></i>
                        </div>
                        <div class="stock-row-content">
                            <div class="stock-bar-label">
                                <span>#{{ $item['id'] }} · {{ $item['name'] }}</span>
                                <span class="text-muted">{{ $item['current'] }} / {{ $item['max'] }} uds</span>
                            </div>
                            <div class="activity-meta mb-2">Código {{ $item['code'] }}</div>
                            <div class="stock-bar">
                                <div class="stock-bar-fill {{ $item['level'] }}" style="width: {{ $item['percent'] }}%"></div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state-card">No hay productos con stock comprometido.</div>
                @endforelse
            </div>
        </section>

        <section class="card-app dashboard-card">
            <div class="card-header dashboard-card-header">
                <h2 class="dashboard-card-title">Top categorías</h2>
                <a href="{{ route('categories.index') }}" class="dashboard-card-link">Ver categorías</a>
            </div>
            <div class="card-body category-card-body">
                @forelse($topCategories as $cat)
                    <div class="category-row">
                        <div class="category-info">
                            <div class="category-icon">
                                <i class="bi {{ $cat['icon'] }}"></i>
                            </div>
                            <div>
                                <strong>{{ $cat['name'] }}</strong>
                                <div class="activity-meta">{{ $cat['count'] }} productos</div>
                            </div>
                        </div>
                        <span class="category-count">{{ number_format($cat['stock_total']) }} uds</span>
                    </div>
                @empty
                    <div class="empty-state-card">Aún no hay categorías con datos suficientes.</div>
                @endforelse
            </div>
        </section>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    new Chart(document.getElementById('movementsChart'), {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [
                {
                    label: 'Entradas',
                    data: @json($chartEntradas),
                    borderColor: '#6a5cff',
                    backgroundColor: 'rgba(106, 92, 255, 0.10)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#6a5cff',
                    pointBorderWidth: 0,
                    pointRadius: 4,
                },
                {
                    label: 'Salidas',
                    data: @json($chartSalidas),
                    borderColor: '#9ca3af',
                    backgroundColor: 'transparent',
                    tension: 0.4,
                    pointBackgroundColor: '#9ca3af',
                    pointBorderWidth: 0,
                    pointRadius: 4,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: false,
                        boxWidth: 28,
                        color: '#667085',
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#edf0f7' },
                    border: { display: false },
                    ticks: { color: '#98a2b3' }
                },
                x: {
                    grid: { display: false },
                    border: { display: false },
                    ticks: { color: '#98a2b3' }
                }
            }
        }
    });
</script>
@endpush
