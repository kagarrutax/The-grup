@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Resumen del inventario en tiempo real')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card-app h-100">
            <div class="card-header d-flex justify-content-between align-items-center bg-transparent">
                <span>Movimientos mensuales</span>
                <small class="text-muted fw-normal">Entradas vs salidas</small>
            </div>
            <div class="card-body">
                <canvas id="movementsChart" height="120"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-app h-100">
            <div class="card-header bg-transparent">Actividad reciente</div>
            <div class="card-body pt-0">
                @foreach($recentActivity as $item)
                    <div class="activity-item">
                        <div>
                            <div class="fw-medium">{{ $item['product'] }}</div>
                            <div class="activity-meta">{{ $item['detail'] }} · {{ $item['time'] }}</div>
                        </div>
                        <div class="text-end">
                            <div class="activity-meta mb-1">{{ $item['sku'] }}</div>
                            <span class="activity-badge {{ $item['type'] === 'entrada' ? 'badge-entrada' : 'badge-salida' }}">
                                {{ strtoupper($item['type']) }} {{ $item['qty'] }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card-app h-100">
            <div class="card-header bg-transparent">Productos con poco stock</div>
            <div class="card-body">
                @foreach($lowStock as $item)
                    <div class="stock-bar-wrap">
                        <div class="stock-bar-label">
                            <span>{{ $item['name'] }}</span>
                            <span class="text-muted">{{ $item['current'] }} / {{ $item['max'] }}</span>
                        </div>
                        <div class="stock-bar">
                            <div class="stock-bar-fill {{ $item['level'] }}" style="width: {{ $item['percent'] }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-app h-100">
            <div class="card-header bg-transparent">Top categorías</div>
            <div class="card-body pt-2">
                @foreach($topCategories as $cat)
                    <div class="category-row">
                        <span>{{ $cat['name'] }}</span>
                        <span class="category-count">{{ $cat['count'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
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
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.08)',
                    fill: true,
                    tension: 0.4,
                },
                {
                    label: 'Salidas',
                    data: @json($chartSalidas),
                    borderColor: '#94a3b8',
                    backgroundColor: 'transparent',
                    tension: 0.4,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endpush
