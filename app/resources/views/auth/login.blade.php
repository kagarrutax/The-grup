@extends('layouts.guest')

@section('title', 'Iniciar sesión')

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="text-center mb-4">
            <div class="auth-brand mx-auto mb-3">
                <i class="bi bi-box"></i>
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
                <label for="email" class="auth-label">Correo electrónico</label>
                <input type="email" class="auth-input" id="email" name="email"
                       value="{{ old('email') }}" placeholder="tu@correo.com" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="auth-label">Contraseña</label>
                <div class="position-relative">
                    <input type="password" class="auth-input pe-5" id="password" name="password"
                           placeholder="••••••••" required>
                    <button class="btn-password-toggle" type="button" id="togglePassword">
                        <i class="bi bi-eye" id="togglePasswordIcon"></i>
                    </button>
                </div>
            </div>

            <div class="d-flex align-items-center mb-4">
                <input class="auth-checkbox me-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label text-muted small mb-0" for="remember" style="cursor: pointer; user-select: none;">
                    Recordarme
                </label>
            </div>

            <button type="submit" class="btn btn-auth-gradient w-100 py-2">
                <i class="bi bi-box-arrow-in-right me-1"></i> Iniciar sesión
            </button>
        </form>

        <div class="auth-demo-card mt-4">
            <span class="text-muted small">Demo: <strong>admin@supermercado.com</strong> / <strong>password</strong></span>
        </div>
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
