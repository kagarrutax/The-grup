@extends('layouts.app')

@section('title', 'Editar categoría')
@section('page-title', 'Editar categoría')
@section('page-subtitle', $category->name)

@section('content')
    <div class="card-app">
        <div class="card-body">
            <form action="{{ route('categories.update', $category) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label class="form-label fw-medium">Nombre</label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-medium">Descripción</label>
                    <textarea name="description" rows="3" class="form-control">{{ old('description', $category->description) }}</textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Volver</a>
                </div>
            </form>
        </div>
    </div>
@endsection
