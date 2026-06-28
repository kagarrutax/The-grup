<x-guest-layout>

    <div class="text-center mb-4">
        <div class="login-brand mx-auto mb-3">
            <i class="bi bi-shop-window"></i>
        </div>
        <h1 class="h4 fw-bold mb-1">SuperMercado</h1>
        <p class="login-footer-text mb-0">Sistema de inventario — acceso administradores</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success rounded-3 py-2 mb-4">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger rounded-3 py-2 mb-4">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label fw-medium">Correo electrónico</label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-envelope text-muted"></i></span>
                <input id="email" type="email" name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}"
                       placeholder="tu@correo.com"
                       required autofocus autocomplete="username">
            </div>
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-medium">Contraseña</label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-lock text-muted"></i></span>
                <input id="password" type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="••••••••"
                       required autocomplete="current-password">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword" title="Mostrar contraseña">
                    <i class="bi bi-eye" id="togglePasswordIcon"></i>
                </button>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <div class="form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember_me" class="form-check-label small">Recordarme</label>
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="small text-decoration-none">¿Olvidaste tu contraseña?</a>
            @endif
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-semibold">
            <i class="bi bi-box-arrow-in-right me-1"></i>Iniciar sesión
        </button>
    </form>

    <p class="login-footer-text text-center mt-4 mb-0">
        Demo: admin@supermercado.com / password
    </p>

    <script>
        (function () {
            var toggle = document.getElementById('togglePassword');
            var input = document.getElementById('password');
            var icon = document.getElementById('togglePasswordIcon');
            if (toggle && input && icon) {
                toggle.addEventListener('click', function () {
                    var show = input.type === 'password';
                    input.type = show ? 'text' : 'password';
                    icon.classList.toggle('bi-eye', !show);
                    icon.classList.toggle('bi-eye-slash', show);
                });
            }
        })();
    </script>

</x-guest-layout>
