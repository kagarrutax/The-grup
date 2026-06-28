@extends('layouts.app')

@section('title', 'Movimientos de stock')
@section('page-title', 'Movimientos de stock')
@section('page-subtitle', 'Registro de entradas y salidas')

@section('content')
<div class="card-app">
    <form method="GET" action="{{ route('stock.index') }}" class="filters-bar">
        <div class="filter-group">
            <label>Tipo</label>
            <select name="type" class="form-select form-select-sm">
                <option value="">Todos</option>
                <option value="entrada" @selected(request('type') === 'entrada')>Entrada</option>
                <option value="salida" @selected(request('type') === 'salida')>Salida</option>
            </select>
        </div>
        <div class="filter-group">
            <label>Usuario</label>
            <select name="user_id" class="form-select form-select-sm">
                <option value="">Todos</option>
                @foreach($users as $id => $name)
                    <option value="{{ $id }}" @selected(request('user_id') == $id)>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label>Producto</label>
            <select name="product_id" class="form-select form-select-sm">
                <option value="">Todos</option>
                @foreach($products as $id => $name)
                    <option value="{{ $id }}" @selected(request('product_id') == $id)>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="ms-auto d-flex gap-2">
            <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="bi bi-funnel me-1"></i> Filtrar</button>
            <a href="{{ route('stock.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> Nuevo</a>
        </div>
    </form>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-app mb-0">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Producto</th>
                        <th>Tipo</th>
                        <th>Cantidad</th>
                        <th>Usuario</th>
                        <th>Motivo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($movements as $movement)
                        <tr>
                            <td class="text-nowrap">{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $movement->product->name }}</td>
                            <td>
                                @if($movement->type === 'entrada')
                                    <span class="badge-entrada">ENTRADA</span>
                                @else
                                    <span class="badge-salida">SALIDA</span>
                                @endif
                            </td>
                            <td class="{{ $movement->type === 'entrada' ? 'qty-positive' : 'qty-negative' }}">
                                {{ $movement->type === 'entrada' ? '+' : '-' }}{{ $movement->quantity }}
                            </td>
                            <td>{{ $movement->user->name }}</td>
                            <td class="text-muted">{{ $movement->reason ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No hay movimientos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($movements->hasPages())
        <div class="card-footer d-flex justify-content-between align-items-center">
            <small class="text-muted">Mostrando {{ $movements->firstItem() }}–{{ $movements->lastItem() }} de {{ $movements->total() }}</small>
            {{ $movements->links() }}
        </div>
    @endif
</div>
@endsection
