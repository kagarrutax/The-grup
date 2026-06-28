@extends('layouts.app')

@section('title', 'Categorías')
@section('page-title', 'Categorías')
@section('page-subtitle', 'Organización del catálogo de productos')

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Nueva categoría
        </a>
    </div>

    <div class="card-app">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-app mb-0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Productos</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td class="fw-medium">{{ $category->name }}</td>
                                <td class="text-muted">{{ Str::limit($category->description, 60) ?? '—' }}</td>
                                <td>{{ $category->products_count }}</td>
                                <td class="text-end">
                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar categoría?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">No hay categorías.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($categories->hasPages())
            <div class="card-footer">{{ $categories->links() }}</div>
        @endif
    </div>
@endsection
