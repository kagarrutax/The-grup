# PLAN — Inventario Supermercado (raíz Laravel)

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Verenice** | Líder y desarrolladora principal | Instalación Laravel 11, Breeze, `.env`, coordinación de fases |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Estructura repo, `composer.json`, README instalación, despliegue Railway |
| **Yadira** | Documentación y presentación | README final, capturas generales, slides de arquitectura |

## Rol de esta carpeta

Raíz del proyecto **Laravel 11** — aquí se ejecuta `composer install`, `artisan migrate` y `php artisan serve`.

## Stack

| Tecnología | Uso |
|------------|-----|
| Laravel 11 | Framework MVC |
| MySQL | Base de datos |
| Laravel Breeze | Auth (Blade) |
| Bootstrap 5 | UI responsive |

## Estructura Laravel

```
app/                          ← raíz del proyecto Laravel
├── app/Http/Controllers/
├── app/Models/
├── database/migrations/
├── database/seeders/
├── resources/views/
├── routes/web.php
└── tests/
```

## Fases (6 días)

| Fase | Días | Módulo |
|------|------|--------|
| 1 | 1-2 | Instalación, Breeze, layout |
| 2 | 2-3 | Categorías |
| 3 | 3-4 | Productos |
| 4 | 4-5 | Movimientos stock |
| 5 | 5-6 | Dashboard |
| 6 | 6 | Buscador |

## Comandos iniciales (Fase 1)

```bash
composer create-project laravel/laravel .
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run build
php artisan migrate
```

## Spec

[`spec/001-inventario-supermercado.md`](../spec/001-inventario-supermercado.md)
