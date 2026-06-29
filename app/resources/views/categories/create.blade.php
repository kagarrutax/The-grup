@extends('layouts.app')

@section('title', 'Crear categoría')
@section('page-title', 'Nueva categoría')
@section('page-subtitle', 'Agrega una categoría de productos')

@section('content')
    <div class="card-app">
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-medium">Nombre</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-medium">Descripción</label>
                    <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Volver</a>
                </div>
            </form>
        </div>
    </div>
@endsection
