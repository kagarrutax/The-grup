@extends('layouts.guest')

@section('title', 'Iniciar sesión')

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="text-center mb-4">
            <div class="auth-brand mx-auto mb-3">
                <i class="bi bi-shop-window"></i>
            </div>
            <h1 class="h4 fw-bold mb-1">The Grup</h1>
            <p class="text-muted small mb-0">Sistema de inventario — ingresa tus credenciales</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger rounded-3 py-2 mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-medium">Correo electrónico</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-envelope text-muted"></i></span>
                    <input type="email" class="form-control" id="email" name="email"
                           value="{{ old('email') }}" placeholder="tu@correo.com" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label fw-medium">Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-lock text-muted"></i></span>
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="••••••••" required>
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="bi bi-eye" id="togglePasswordIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-semibold">
                <i class="bi bi-box-arrow-in-right me-1"></i> Iniciar sesión
            </button>
        </form>

        <p class="text-muted small text-center mt-4 mb-0">
            Demo: <strong>admin@supermercado.com</strong> / <strong>password</strong>
        </p>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('togglePassword')?.addEventListener('click', function () {
        var input = document.getElementById('password');
        var icon = document.getElementById('togglePasswordIcon');
        var show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        icon.classList.toggle('bi-eye', !show);
        icon.classList.toggle('bi-eye-slash', show);
    });
</script>
@endsection
