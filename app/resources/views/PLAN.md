# PLAN — resources/views/

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Jessica** | Frontend y responsive | Blade (`resources/views/`) + **vista cliente** (`app/public/`, spec 002) |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Revisar PRs de vistas Blade |
| **Yadira** | Documentación y presentación | Capturas de cada módulo para manual y slides |

## Rol

Capa **View** — plantillas Blade para Laravel (spec 001). La **UI preview XAMPP** vive en [`app/public/`](../public/PLAN.md) (spec 002).

## Subcarpetas

| Carpeta | Contenido | Fase |
|---------|-----------|------|
| `layouts/` | `app.blade.php` base | 1 |
| `dashboard/` | Panel métricas | 5 |
| `categories/` | CRUD categorías | 2 |
| `products/` | CRUD + buscador | 3, 6 |
| `stock/` | Formulario movimientos | 4 |

## Bootstrap 5

CDN en layout — sin bundler obligatorio. Navbar dark, alerts flash, tablas responsive.

## Spec

[`spec/001-inventario-supermercado.md`](../../../spec/001-inventario-supermercado.md)
