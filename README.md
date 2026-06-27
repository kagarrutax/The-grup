# The-grup

Sistema de **inventario para supermercado** — Laravel 11, MySQL, MVC, Bootstrap 5.

Enfoque **spec-as-source**: planificar → aprobar → implementar por fases.

## Stack

Laravel 11 · MySQL · Blade · Bootstrap 5 · Laravel Breeze

## Estructura

| Carpeta | Rol |
|---------|-----|
| [`spec/`](spec/) | Planes detallados |
| [`skill/`](skill/) | Guías de ejecución IA |
| [`app/`](app/) | Proyecto Laravel |
| [`docs/`](docs/) | Documentación y entrega |

## Equipo

Verenice · Jessica · Yadira · Elda · Adrian

Guía de roles: [`spec/guia-roles-equipo.md`](spec/guia-roles-equipo.md)

Spec activa: [`spec/001-inventario-supermercado.md`](spec/001-inventario-supermercado.md)

## Preview frontend (Jessica)

Interfaz mock lista en `app/public/` — **sin backend**, datos de demo.

```bash
git pull origin Adrian
```

Abrir en XAMPP:

```
http://localhost/The-grup/app/public/login.php
http://localhost/The-grup/app/public/dashboard.php
```

Páginas: productos, categorías, movimientos, búsqueda, ventas, compras, usuarios, reportes.

Guía completa: [`app/public/README.md`](app/public/README.md) · Spec UI: [`spec/002-frontend-ui-ux.md`](spec/002-frontend-ui-ux.md)
