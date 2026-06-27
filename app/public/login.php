<?php
$pageTitle = 'Iniciar sesión';
$assetBase = 'assets';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> — Inventario</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/css/variables.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<div class="login-page">
    <div class="card login-card">
        <div class="text-center mb-4">
            <div class="login-brand mx-auto"><i class="bi bi-box-seam"></i></div>
            <h1 class="h3 mb-1">Inventario Supermercado</h1>
            <p class="text-desc">Ingresa tus credenciales para continuar</p>
        </div>
        <form action="dashboard.php" method="get">
            <div class="mb-3">
                <label class="form-label" for="email">Correo electrónico</label>
                <input type="email" class="form-control" id="email" value="admin@supermercado.com" required>
            </div>
            <div class="mb-4">
                <label class="form-label" for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" value="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2">Iniciar sesión</button>
        </form>
        <p class="text-desc text-center mt-4 mb-0">Demo frontend — sin backend</p>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
