@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
        <div>
            <h1 class="h3 fw-bold mb-1">Dashboard</h1>
            <p class="text-muted mb-0">Resumen general del inventario</p>
        </div>
        <div class="text-muted small">
            <i class="bi bi-calendar3 me-1"></i>{{ date('d/m/Y') }}
        </div>
    </div>

    <div class="row g-3 g-md-4 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-3 bg-primary bg-opacity-10 p-3 me-3">
                        <i class="bi bi-box-seam fs-3 text-primary"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-1">Total Productos</p>
                        <h2 class="h4 fw-bold mb-0">{{ $totalProducts ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-3 bg-success bg-opacity-10 p-3 me-3">
                        <i class="bi bi-tags fs-3 text-success"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-1">Total Categorías</p>
                        <h2 class="h4 fw-bold mb-0">{{ $totalCategories ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-3 bg-warning bg-opacity-10 p-3 me-3">
                        <i class="bi bi-exclamation-triangle fs-3 text-warning"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-1">Stock Bajo</p>
                        <h2 class="h4 fw-bold mb-0">{{ $lowStockCount ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-3 bg-danger bg-opacity-10 p-3 me-3">
                        <i class="bi bi-x-circle fs-3 text-danger"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-1">Productos Agotados</p>
                        <h2 class="h4 fw-bold mb-0">{{ $outOfStockCount ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (!empty($lowStockProducts) && $lowStockProducts->isNotEmpty())
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white">
                <h2 class="h5 mb-0"><i class="bi bi-exclamation-circle text-warning me-1"></i> Productos con stock bajo</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Producto</th>
                            <th>SKU</th>
                            <th>Categoría</th>
                            <th class="text-end">Stock</th>
                            <th class="text-end">Mínimo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lowStockProducts as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td><code>{{ $product->sku }}</code></td>
                                <td>{{ $product->category->name ?? '—' }}</td>
                                <td class="text-end text-warning fw-semibold">{{ $product->stock_quantity }}</td>
                                <td class="text-end">{{ $product->stock_minimum }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0"><i class="bi bi-arrow-left-right me-1"></i> Últimos movimientos</h2>
            <a href="{{ route('stock.create') }}" class="btn btn-sm btn-primary">Registrar movimiento</a>
        </div>

        @if (empty($recentMovements) || $recentMovements->isEmpty())
            <div class="card-body text-muted">
                No hay movimientos registrados aún.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Fecha</th>
                            <th>Producto</th>
                            <th>Usuario</th>
                            <th>Tipo</th>
                            <th class="text-end">Cantidad</th>
                            <th>Motivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentMovements as $movement)
                            <tr>
                                <td class="text-nowrap">{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $movement->product->name }}</td>
                                <td>{{ $movement->user->name ?? '—' }}</td>
                                <td>
                                    @if ($movement->type === \App\Models\StockMovement::TYPE_ENTRADA)
                                        <span class="badge bg-success">Entrada</span>
                                    @else
                                        <span class="badge bg-danger">Salida</span>
                                    @endif
                                </td>
                                <td class="text-end">{{ $movement->quantity }}</td>
                                <td>{{ $movement->reason ?? '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection
@endsection
>>>>>>> 867cecf1ab512df8272c1ff76e7bdabc536b0774
