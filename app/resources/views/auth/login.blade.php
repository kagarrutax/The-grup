@extends('layouts.guest')

@section('title', 'Iniciar sesión')

@section('content')

    {{-- Vista login — Fase 1 (Breeze). Integrar con route('login') --}}
    <div class="login-page">
        <div class="card login-card border-0">

            {{-- Marca --}}
            <div class="text-center mb-4">
                <div class="login-brand mx-auto mb-3">
                    <i class="bi bi-shop-window"></i>
                </div>
                <h1 class="h4 fw-bold mb-1">SuperMercado</h1>
                <p class="login-footer-text mb-0">Sistema de inventario — ingresa tus credenciales</p>
            </div>

            {{-- Errores de validación (Breeze / Laravel) --}}
            @if ($errors->any())
                <div class="alert alert-danger rounded-3 py-2 mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span>
                    @endforeach
                </div>
            @endif

            {{-- Mensaje de sesión --}}
            @if (session('status'))
                <div class="alert alert-success rounded-3 py-2 mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Formulario — action="{{ route('login') }}" method="POST" --}}
            <form action="{{ url('/login') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label fw-medium">Correo electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-envelope text-muted"></i></span>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email', 'admin@supermercado.com') }}"
                               placeholder="tu@correo.com"
                               required
                               autofocus
                               autocomplete="username">
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div class="mb-3">
                    <label for="password" class="form-label fw-medium">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-lock text-muted"></i></span>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password"
                               name="password"
                               placeholder="••••••••"
                               required
                               autocomplete="current-password">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword" title="Mostrar contraseña">
                            <i class="bi bi-eye" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Recordarme + olvidé contraseña --}}
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label small" for="remember">Recordarme</label>
                    </div>
                    {{-- Integrar con: route('password.request') --}}
                    <a href="{{ url('/forgot-password') }}" class="small text-decoration-none">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-semibold">
                    <i class="bi bi-box-arrow-in-right me-1"></i>Iniciar sesión
                </button>
            </form>

            <p class="login-footer-text text-center mt-4 mb-0">
                Versión 1.0 — Credenciales demo: admin@supermercado.com / password
            </p>

        </div>
    </div>

@endsection

@section('scripts')
<script>
    (function () {
        'use strict';

        // Validación Bootstrap
        var form = document.querySelector('.needs-validation');
        if (form) {
            form.addEventListener('submit', function (e) {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                form.classList.add('was-validated');
            });
        }

        // Mostrar / ocultar contraseña
        var toggle = document.getElementById('togglePassword');
        var input = document.getElementById('password');
        var icon = document.getElementById('togglePasswordIcon');
        if (toggle && input && icon) {
            toggle.addEventListener('click', function () {
                var isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';
                icon.classList.toggle('bi-eye', !isPassword);
                icon.classList.toggle('bi-eye-slash', isPassword);
            });
        }
    })();
</script>
@endsection
