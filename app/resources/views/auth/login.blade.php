<x-guest-layout>
    <div class="text-center mb-4">
        <h1 class="h4 mb-1">Panel de administración</h1>
        <p class="text-muted small mb-0">Acceso exclusivo para administradores del inventario</p>
    </div>

    @if (session('status'))
        <div class="alert alert-info">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input
                id="email"
                type="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
            >
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input
                id="password"
                type="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                required
                autocomplete="current-password"
            >
        </div>

        <div class="mb-4 form-check">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label">Recordarme</label>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-box-arrow-in-right me-1"></i> Iniciar sesión
            </button>
        </div>
    </form>
</x-guest-layout>
