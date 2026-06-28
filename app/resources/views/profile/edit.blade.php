@extends('layouts.app')

@section('title', 'Perfil')
@section('page-title', 'Perfil')
@section('page-subtitle', 'Información de tu cuenta')

@section('content')
    <div class="card-app">
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Nombre</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Correo electrónico</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Rol</label>
                        <input type="text" class="form-control" value="{{ $user->role }}" disabled>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Actualizar</button>
            </form>
        </div>
    </div>
@endsection
