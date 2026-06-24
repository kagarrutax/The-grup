---
name: inventario-supermercado
description: >-
  Ejecuta la spec 001 del inventario de supermercado en The-grup.
  Laravel 11, MySQL, Breeze, Blade, Bootstrap. Usar al implementar categorías,
  productos, stock, dashboard o buscador.
---

# Skill — Inventario supermercado (Laravel)

**Spec:** [`spec/001-inventario-supermercado.md`](../../spec/001-inventario-supermercado.md)  
**Orquestación:** [`../spec-as-source/SKILL.md`](../spec-as-source/SKILL.md)

## Regla

No programar sin leer spec 001 y el `PLAN.md` de la carpeta objetivo.

## Orden de fases

```
Fase 1 → Instalación, Breeze, layout
Fase 2 → Categorías
Fase 3 → Productos
Fase 4 → Movimientos stock
Fase 5 → Dashboard
Fase 6 → Buscador
```

## Tareas por fase

| Fase | Verenice | Jessica | Elda |
|------|----------|---------|------|
| 1 | Laravel, Breeze, `.env`, migrate | `layouts/app.blade.php` | Auth smoke test |
| 2 | Category model, migration, controller | Vistas categories/ | CRUD categorías |
| 3 | Product model, validation SKU | Vistas products/ | SKU duplicado |
| 4 | Stock logic, increment/decrement | Vistas stock/ | Stock insuficiente |
| 5 | DashboardController metrics | dashboard/index | Métricas correctas |
| 6 | Search scope en ProductController | Formulario búsqueda | Filtros GET |

## Comandos útiles

```bash
php artisan make:model Category -mcr
php artisan migrate --seed
php artisan test
php artisan serve
```

## Cierre

Actualizar spec 001 a **Completado** tras Fase 6 + checklists testing y seguridad.
