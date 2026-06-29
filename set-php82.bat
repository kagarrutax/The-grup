@echo off
REM Configurar PHP 8.2 para el proyecto The-grup
setx PATH "C:\laragon\bin\php\php-8.2.28-nts-Win32-vs16-x64;%PATH%"
echo PHP 8.2.28 ha sido configurado como la version por defecto
php -v
pause
