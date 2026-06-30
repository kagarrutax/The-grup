@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Resumen del inventario en tiempo real')

@section('content')
<div class="row g-3 g-xl-4 mb-4">
    {{-- Tarjeta 1: Total Productos --}}
    <div class="col-lg-3 col-md-6">
        <a href="{{ route('products.index') }}" class="card stat-card stat-card--primary stat-card-btn p-4 text-decoration-none">
            <div class="stat-top">
                <div>
                    <div class="stat-label">Total Productos</div>
                    <div class="stat-value">{{ $summaryCards[0]['value'] ?? 0 }}</div>
                    <span class="stat-change {{ ($summaryCards[0]['trendDirection'] ?? '') == 'up' ? 'up' : 'neutral' }}">
                        {{ $summaryCards[0]['trend'] ?? '' }}
                    </span>
                </div>
                <div class="stat-icon primary"><i class="bi bi-box"></i></div>
            </div>
            <div class="sparkline-wrap">
                <canvas data-sparkline="40,50,45,60,55,70" data-color="#2563EB" height="48"></canvas>
            </div>
            <span class="stat-hint"><i class="bi bi-arrows-fullscreen me-1"></i> Ver catálogo</span>
        </a>
    </div>

    {{-- Tarjeta 2: Stock Bajo --}}
    <div class="col-lg-3 col-md-6">
        <a href="{{ route('products.index', ['search' => '']) }}" class="card stat-card stat-card--warning stat-card-btn p-4 text-decoration-none">
            <div class="stat-top">
                <div>
                    <div class="stat-label">Stock bajo</div>
                    <div class="stat-value">{{ $summaryCards[1]['value'] ?? 0 }}</div>
                    <span class="stat-change {{ ($summaryCards[1]['trendDirection'] ?? '') == 'down' ? 'down' : 'neutral' }}">
                        {{ $summaryCards[1]['trend'] ?? '' }}
                    </span>
                </div>
                <div class="stat-icon warning"><i class="bi bi-exclamation-triangle"></i></div>
            </div>
            <div class="sparkline-wrap">
                <canvas data-sparkline="12,10,9,11,8,7" data-color="#D97706" height="48"></canvas>
            </div>
            <span class="stat-hint"><i class="bi bi-arrows-fullscreen me-1"></i> Ver alertas</span>
        </a>
    </div>

    {{-- Tarjeta 3: Entradas Hoy --}}
    <div class="col-lg-3 col-md-6">
        <a href="{{ route('stock.index') }}" class="card stat-card stat-card--info stat-card-btn p-4 text-decoration-none">
            <div class="stat-top">
                <div>
                    <div class="stat-label">Entradas del día</div>
                    <div class="stat-value">{{ $summaryCards[2]['value'] ?? 0 }}</div>
                    <span class="stat-change {{ ($summaryCards[2]['trendDirection'] ?? '') == 'up' ? 'up' : 'neutral' }}">
                        {{ $summaryCards[2]['trend'] ?? '' }}
                    </span>
                </div>
                <div class="stat-icon info"><i class="bi bi-arrow-down-left"></i></div>
            </div>
            <div class="sparkline-wrap">
                <canvas data-sparkline="5,12,8,15,10,22" data-color="#4F46E5" height="48"></canvas>
            </div>
            <span class="stat-hint"><i class="bi bi-arrows-fullscreen me-1"></i> Ver movimientos</span>
        </a>
    </div>

    {{-- Tarjeta 4: Valor Inventario --}}
    <div class="col-lg-3 col-md-6">
        <a href="{{ route('reports.index') }}" class="card stat-card stat-card--success stat-card-btn p-4 text-decoration-none">
            <div class="stat-top">
                <div>
                    <div class="stat-label">Valor inventario</div>
                    <div class="stat-value">{{ $summaryCards[4]['value'] ?? '$0' }}</div>
                    <span class="stat-change {{ ($summaryCards[4]['trendDirection'] ?? '') == 'up' ? 'up' : 'neutral' }}">
                        {{ $summaryCards[4]['trend'] ?? '' }}
                    </span>
                </div>
                <div class="stat-icon success"><i class="bi bi-wallet2"></i></div>
            </div>
            <div class="sparkline-wrap">
                <canvas data-sparkline="42,44,43,45,47,48" data-color="#059669" height="48"></canvas>
            </div>
            <span class="stat-hint"><i class="bi bi-arrows-fullscreen me-1"></i> Ver reportes</span>
        </a>
    </div>
</div>

<div class="row g-3 g-xl-4 mb-4">
    <div class="col-lg-8">
        <div class="card card-static p-4 chart-card h-100">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                <h3 class="h3 mb-0">Rendimiento de entradas y salidas</h3>
                <div class="chart-legend">
                    <span><span class="dot blue"></span> Entradas</span>
                    <span><span class="dot" style="background: #9ca3af"></span> Salidas</span>
                </div>
            </div>
            <div class="chart-inner" style="height: 280px;">
                <canvas id="movementsChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-panel card-static h-100 activity-card">
            <div class="card-panel__head">
                <div class="head-icon primary"><i class="bi bi-clock-history"></i></div>
                <h3 class="h3 mb-0">Últimos movimientos</h3>
            </div>
            <div class="card-panel__body p-3">
                @forelse($recentActivity as $item)
                    <div class="activity-item">
                        <div class="activity-icon {{ $item['type'] === 'entrada' ? 'in' : 'out' }}">
                            <i class="bi {{ $item['icon'] }}"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-medium small">{{ $item['product'] }}</div>
                            <div class="text-desc">{{ ucfirst($item['type']) }} · {{ $item['type'] === 'entrada' ? '+' : '-' }}{{ $item['qty'] }} uds · {{ $item['time'] }}</div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state-card">No hay actividad reciente registrada.</div>
                @endforelse
                
                @if(count($recentActivity) > 0)
                    <div class="text-center mt-3">
                        <a href="{{ route('stock.index') }}" class="btn btn-sm btn-outline-secondary">Ver todos los movimientos</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row g-3 g-xl-4">
    <div class="col-lg-6">
        <div class="card card-panel card-static h-100">
            <div class="card-panel__head">
                <div class="head-icon warning"><i class="bi bi-exclamation-circle"></i></div>
                <h3 class="h3 mb-0">Productos con poco stock</h3>
            </div>
            <div class="card-panel__body">
                @forelse($lowStock as $item)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small fw-medium">{{ $item['name'] }} <span class="text-muted ms-1">#{{ $item['code'] }}</span></span>
                            <span class="text-desc">{{ $item['current'] }} / {{ $item['max'] }}</span>
                        </div>
                        <div class="stock-bar">
                            <div class="stock-bar-fill {{ $item['level'] }}" style="width: {{ $item['percent'] }}%"></div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state-card">No hay productos con stock comprometido.</div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card card-panel card-static h-100">
            <div class="card-panel__head">
                <div class="head-icon primary"><i class="bi bi-bar-chart"></i></div>
                <h3 class="h3 mb-0">Top categorías</h3>
            </div>
            <div class="card-panel__body">
                <ul class="list-unstyled mb-0">
                    @forelse($topCategories as $cat)
                        <li class="rank-item">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi {{ $cat['icon'] }} text-primary"></i>
                                <span>{{ $cat['name'] }}</span>
                            </div>
                            <div>
                                <span class="text-desc me-2">{{ $cat['count'] }} prod.</span>
                                <span class="badge-pill badge-active">{{ number_format($cat['stock_total']) }} uds</span>
                            </div>
                        </li>
                    @empty
                        <div class="empty-state-card">Aún no hay categorías con datos suficientes.</div>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    // Draw Sparklines
    function drawSparklines() {
        document.querySelectorAll('canvas[data-sparkline]').forEach(canvas => {
            const ctx = canvas.getContext('2d');
            const data = canvas.dataset.sparkline.split(',').map(Number);
            const color = canvas.dataset.color || '#2563EB';
            
            // Adjust canvas for high DPI
            const dpr = window.devicePixelRatio || 1;
            const rect = canvas.parentNode.getBoundingClientRect();
            canvas.width = rect.width * dpr;
            canvas.height = rect.height * dpr;
            canvas.style.width = `${rect.width}px`;
            canvas.style.height = `${rect.height}px`;
            ctx.scale(dpr, dpr);

            const w = rect.width;
            const h = rect.height;
            const max = Math.max(...data);
            const min = Math.min(...data);
            const range = max - min || 1;
            
            const points = data.map((val, i) => ({
                x: i * (w / (data.length - 1)),
                y: h - ((val - min) / range) * (h - 10) - 5
            }));

            // Draw line
            ctx.beginPath();
            ctx.moveTo(points[0].x, points[0].y);
            
            for (let i = 1; i < points.length - 2; i++) {
                const xc = (points[i].x + points[i + 1].x) / 2;
                const yc = (points[i].y + points[i + 1].y) / 2;
                ctx.quadraticCurveTo(points[i].x, points[i].y, xc, yc);
            }
            if(points.length > 2) {
                ctx.quadraticCurveTo(points[points.length - 2].x, points[points.length - 2].y, points[points.length - 1].x, points[points.length - 1].y);
            } else if(points.length === 2) {
                ctx.lineTo(points[1].x, points[1].y);
            }

            ctx.strokeStyle = color;
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';
            ctx.stroke();

            // Draw gradient fill
            const gradient = ctx.createLinearGradient(0, 0, 0, h);
            gradient.addColorStop(0, `${color}40`);
            gradient.addColorStop(1, `${color}00`);
            
            ctx.lineTo(w, h);
            ctx.lineTo(0, h);
            ctx.fillStyle = gradient;
            ctx.fill();
        });
    }

    drawSparklines();
    window.addEventListener('resize', drawSparklines);

    // Main Chart
    const ctx = document.getElementById('movementsChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [
                    {
                        label: 'Entradas',
                        data: @json($chartEntradas),
                        borderColor: '#2563EB',
                        backgroundColor: 'rgba(37, 99, 235, 0.10)',
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#2563EB',
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
                    legend: { display: false } // Custom legend is in HTML
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
    }
</script>
@endpush
