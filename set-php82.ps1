# Script para configurar PHP 8.2 en The-grup (Windows PowerShell)
# Ejecutar como administrador

Write-Host "Configurando PHP 8.2.28 para The-grup..." -ForegroundColor Cyan

# Obtener PATH actual
$currentPath = [System.Environment]::GetEnvironmentVariable("PATH", "Machine")

# Ruta de PHP 8.2
$php82Path = "C:\laragon\bin\php\php-8.2.28-nts-Win32-vs16-x64"

# Verificar si PHP 8.2 ya está en el PATH
if ($currentPath -like "*php-8.2.28*") {
    Write-Host "✓ PHP 8.2.28 ya está configurado en el PATH" -ForegroundColor Green
} else {
    # Agregar PHP 8.2 al inicio del PATH
    $newPath = "$php82Path;$currentPath"
    
    try {
        [System.Environment]::SetEnvironmentVariable("PATH", $newPath, "Machine")
        Write-Host "✓ PHP 8.2.28 agregado al PATH del sistema" -ForegroundColor Green
        Write-Host "Nota: Cierra y reabre la terminal para aplicar los cambios" -ForegroundColor Yellow
    }
    catch {
        Write-Host "✗ Error al establecer PATH. ¿Ejecutaste como administrador?" -ForegroundColor Red
    }
}

# Verificar versión de PHP en la sesión actual
Write-Host "`nVerificando PHP en sesión actual..." -ForegroundColor Cyan
$env:PATH = "$php82Path;$env:PATH"
php -v

Write-Host "`n✓ Configuración completada" -ForegroundColor Green
