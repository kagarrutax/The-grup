# app/ — Sistema de inventario supermercado (Laravel 11)

Aplicación MVC Laravel para gestión de inventario: categorías, productos, movimientos de stock y dashboard.

## Stack

**Laravel 11** · **MySQL** · **Blade** · **Bootstrap 5** · **Laravel Breeze**

## Mapa de carpetas

```
app/                              ← raíz proyecto Laravel
├── PLAN.md
├── app/Http/Controllers/         → Verenice
├── app/Models/                   → Verenice
├── database/migrations/          → Verenice
├── database/seeders/             → Verenice
├── routes/                       → Verenice
├── resources/views/              → Jessica
│   ├── layouts/
│   ├── dashboard/
│   ├── categories/
│   ├── products/
│   └── stock/
└── tests/                        → Elda
    ├── Feature/
    └── Unit/
```

Cada carpeta tiene **`PLAN.md`** con encargado y participación de Adrian/Yadira.

## Módulos

| Módulo | Fase |
|--------|------|
| Auth (Breeze) | 1 |
| Categorías | 2 |
| Productos | 3 |
| Movimientos stock | 4 |
| Dashboard | 5 |
| Buscador | 6 |

## Equipo

| Integrante | Rol principal |
|------------|---------------|
| Verenice | Backend Laravel, modelos, controladores |
| Jessica | Vistas Blade + Bootstrap |
| Elda | Tests y validaciones |
| Yadira | [`docs/PLAN.md`](../docs/PLAN.md) |
| Adrian | [`spec/PLAN.md`](../spec/PLAN.md) |

## Referencias

- Spec: [`spec/001-inventario-supermercado.md`](../spec/001-inventario-supermercado.md)
- Skill: [`skill/inventario-supermercado/SKILL.md`](../skill/inventario-supermercado/SKILL.md)
- Guía roles: [`spec/guia-roles-equipo.md`](../spec/guia-roles-equipo.md)
