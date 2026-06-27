<?php
/**
 * Configuración base del frontend (preview XAMPP).
 */
if (!isset($pageTitle)) {
    $pageTitle = 'Inventario';
}
if (!isset($page)) {
    $page = '';
}
$assetBase = 'assets';
$userName = 'Administrador';
$userInitials = 'AD';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> — Supermercado</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" rel="stylesheet">
    <link href="<?= $assetBase ?>/css/variables.css" rel="stylesheet">
    <link href="<?= $assetBase ?>/css/style.css" rel="stylesheet">
    <link href="<?= $assetBase ?>/css/dashboard.css" rel="stylesheet">
    <link href="<?= $assetBase ?>/css/responsive.css" rel="stylesheet">
</head>
<body>
<div class="sidebar-overlay" id="sidebarOverlay"></div>
<div class="app-wrapper">
