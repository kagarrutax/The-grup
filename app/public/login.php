<?php
/**
 * Login — Vista cliente (spec 002)
 * Preview XAMPP sin backend. Integrar con Laravel Breeze después.
 */
$pageTitle = 'Iniciar sesión';
$assetBase = 'assets';
$loginError = isset($_GET['error']) && $_GET['error'] === '1';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> — SuperMercado</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?= $assetBase ?>/css/variables.css" rel="stylesheet">
    <link href="<?= $assetBase ?>/css/style.css" rel="stylesheet">
</head>
<body>

<div class="login-page">
    <div class="card login-card border-0">

        <div class="text-center mb-4">
            <div class="login-brand mx-auto"><i class="bi bi-shop-window"></i></div>
            <h1 class="h4 fw-bold mb-1">SuperMercado</h1>
            <p class="text-desc mb-0">Sistema de inventario — ingresa tus credenciales</p>
        </div>

        <?php if ($loginError): ?>
        <div class="alert alert-danger rounded-3 py-2 mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            Credenciales incorrectas. Intenta de nuevo.
        </div>
        <?php endif; ?>

        <form action="dashboard.php" method="get" class="needs-validation" novalidate id="loginForm">

            <div class="mb-3">
                <label class="form-label fw-medium" for="email">Correo electrónico</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-envelope text-muted"></i></span>
                    <input type="email" class="form-control" id="email" name="email"
                           value="admin@supermercado.com" placeholder="tu@correo.com" required autofocus>
                </div>
                <div class="invalid-feedback">Ingresa un correo válido.</div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium" for="password">Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-lock text-muted"></i></span>
                    <input type="password" class="form-control" id="password" name="password"
                           value="password" placeholder="••••••••" required>
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword" title="Mostrar contraseña">
                        <i class="bi bi-eye" id="togglePasswordIcon"></i>
                    </button>
                </div>
                <div class="invalid-feedback">La contraseña es obligatoria.</div>
            </div>

            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label small" for="remember">Recordarme</label>
                </div>
                <a href="#" class="small text-decoration-none text-muted" title="Próximamente con Breeze">¿Olvidaste tu contraseña?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-semibold">
                <i class="bi bi-box-arrow-in-right me-1"></i>Iniciar sesión
            </button>
        </form>

        <p class="text-desc text-center mt-4 mb-0">
            Versión 1.0 — Demo frontend · <code>admin@supermercado.com</code> / <code>password</code>
        </p>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function () {
    'use strict';
    var form = document.getElementById('loginForm');
    form.addEventListener('submit', function (e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            form.classList.add('was-validated');
            return;
        }
        form.classList.add('was-validated');
        // Demo: simular error si el email no es el demo
        var email = document.getElementById('email').value.trim();
        if (email !== 'admin@supermercado.com') {
            e.preventDefault();
            window.location.href = 'login.php?error=1';
        }
    });

    var toggle = document.getElementById('togglePassword');
    var input = document.getElementById('password');
    var icon = document.getElementById('togglePasswordIcon');
    toggle.addEventListener('click', function () {
        var show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        icon.classList.toggle('bi-eye', !show);
        icon.classList.toggle('bi-eye-slash', show);
    });
})();
</script>
</body>
</html>
