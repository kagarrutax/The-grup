# Para el Equipo - Configuración de PHP 8.2

Yadira, Adrian, y todos los miembros del equipo:

El problema que estaban viendo (Laravel no arranca, "artisan falla") fue causado por **incompatibilidad de versión de PHP**.

## 🔴 El Problema
- Laravel necesita: **PHP >= 8.2.0**
- Estaban usando: **PHP 8.0.30**
- Resultado: ❌ Artisan falla

## ✅ La Solución (3 opciones)

### Opción 1: PowerShell (Recomendado)
```powershell
# 1. Abre PowerShell como ADMINISTRADOR
# 2. Navega a The-grup:
cd C:\laragon\www\The-grup

# 3. Ejecuta el script:
.\set-php82.ps1

# 4. Cierra y reabre la terminal
# 5. Verifica:
php -v
```

### Opción 2: Batch
```cmd
# 1. Abre CMD como ADMINISTRADOR
# 2. Navega a The-grup:
cd C:\laragon\www\The-grup

# 3. Ejecuta:
set-php82.bat

# 4. Cierra y reabre la terminal
```

### Opción 3: Manual (sin script)
En PowerShell como ADMINISTRADOR:
```powershell
# Agregar PHP 8.2 al PATH del sistema
$env:PATH = "C:\laragon\bin\php\php-8.2.28-nts-Win32-vs16-x64;$env:PATH"

# Para que sea permanente:
[System.Environment]::SetEnvironmentVariable("PATH", "C:\laragon\bin\php\php-8.2.28-nts-Win32-vs16-x64;$([System.Environment]::GetEnvironmentVariable('PATH', 'Machine'))", "Machine")
```

## ✨ Verificación

Después de cualquier opción, ejecuta:
```bash
php -v
```

Deberías ver:
```
PHP 8.2.28 (cli) (built: Mar 11 2025 18:37:34) (NTS Visual C++ 2019 x64)
```

## 🚀 Siguiente Paso

Una vez configurado PHP 8.2:
```bash
cd app
php artisan serve
```

## 📝 Notas Importantes

- ⚠️ Laragon tiene PHP 8.2.28 **ya instalado**, solo necesitan cambiar el PATH
- 🔄 Si usan IDE, cierren y reabran después de cambiar PHP
- 📦 No necesitan descargar ni instalar nada nuevo
- ✅ Es el mismo PHP que usa la rama principal de desarrollo

---

**Estado**: ✅ Aplicación funcional  
**Fecha**: 2026-06-28  
**Contacto**: [Información de soporte]
