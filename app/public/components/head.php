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
$vendorBase = 'node_modules';
$userName = 'Administrador';
$userInitials = 'AD';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> — Supermercado</title>
    <link href="<?= $vendorBase ?>/@fontsource/inter/400.css" rel="stylesheet">
    <link href="<?= $vendorBase ?>/@fontsource/inter/500.css" rel="stylesheet">
    <link href="<?= $vendorBase ?>/@fontsource/inter/600.css" rel="stylesheet">
    <link href="<?= $vendorBase ?>/@fontsource/inter/700.css" rel="stylesheet">
    <link href="<?= $vendorBase ?>/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $vendorBase ?>/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?= $vendorBase ?>/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="<?= $vendorBase ?>/toastify-js/src/toastify.min.css" rel="stylesheet">
    <link href="<?= $assetBase ?>/css/variables.css" rel="stylesheet">
    <link href="<?= $assetBase ?>/css/style.css" rel="stylesheet">
    <link href="<?= $assetBase ?>/css/dashboard.css" rel="stylesheet">
    <link href="<?= $assetBase ?>/css/responsive.css" rel="stylesheet">
</head>
<body>
<div class="sidebar-overlay" id="sidebarOverlay"></div>
<div class="app-wrapper">
