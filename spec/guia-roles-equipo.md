# Guía de roles — Equipo The-grup

> **Proyecto:** Sistema de inventario para supermercado (Laravel 11 + MySQL)  
> **Uso:** Repartir responsabilidades entre integrantes  
> **Última actualización:** 2026-06-05

---

## Resumen del equipo

| Integrante | Rol | Enfoque principal |
|------------|-----|-------------------|
| **Verenice** | Líder y desarrolladora principal | Laravel MVC, modelos, controladores, migraciones, stock |
| **Jessica** | Frontend y responsive | Blade, Bootstrap 5, vistas responsive |
| **Yadira** | Documentación y presentación · Coordinación de entregables académicos | Manuales, capturas, slides, checklist entrega |
| **Elda** | Validaciones | Tests Feature/Unit, casos stock límite |
| **Adrian** | GitHub y organización · Revisión e integración de código | Repo, PRs, merges, despliegue Railway |

> **PDF:** [`docs/guia-roles-equipo.pdf`](../docs/guia-roles-equipo.pdf)

---

## Encargados por carpeta Laravel

| Integrante | Carpetas principales |
|------------|---------------------|
| **Verenice** | `app/Http/Controllers/`, `app/Models/`, `database/`, `routes/` |
| **Jessica** | `resources/views/` |
| **Elda** | `tests/` |
| **Yadira** | `docs/` |
| **Adrian** | Repo, GitHub, `spec/PLAN.md` |

Cada `PLAN.md` incluye **Encargado** + **Participación GitHub y documentación** (Adrian y Yadira).

---

## Verenice — Líder y desarrolladora principal

| Módulo | Entregables | Fase |
|--------|-------------|------|
| Instalación | Laravel 11, Breeze, `.env` MySQL | 1 |
| Categorías | CategoryController resource | 2 |
| Productos | ProductController, validación SKU | 3 |
| Stock | StockController, lógica entrada/salida | 4 |
| Dashboard | DashboardController métricas | 5 |
| Buscador | Scope búsqueda en ProductController | 6 |

**Crítico:** validar stock no negativo antes de salidas.

---

## Jessica — Frontend y responsive

| Módulo | Vistas | Fase |
|--------|--------|------|
| Layout | `layouts/app.blade.php` | 1 |
| Categorías | CRUD Blade | 2 |
| Productos | CRUD + formulario búsqueda | 3, 6 |
| Stock | Formulario movimientos | 4 |
| Dashboard | Tarjetas Bootstrap | 5 |

Bootstrap 5 vía CDN — mobile-first, tablas responsive.

---

## Yadira — Documentación y presentación · Coordinación entregables

- Manual usuario y manual técnico (`docs/`)
- Capturas: dashboard, categorías, productos, stock, buscador, móvil
- README con instalación y credenciales demo
- Slides: objetivo, arquitectura MVC, demo, equipo
- Checklist entrega y paquete `docs/entrega/`

**Credenciales demo:** admin@supermercado.com / password

---

## Elda — Validaciones

| Prioridad | Caso |
|-----------|------|
| Alta | Salida con stock insuficiente → rechazada |
| Alta | Entrada incrementa stock correctamente |
| Media | SKU duplicado rechazado |
| Media | Buscador filtra por nombre/SKU/categoría |
| Media | Auth login/logout |

```bash
php artisan test
```

---

## Adrian — GitHub y organización · Revisión e integración

- Estructura Laravel en repo
- PRs por módulo (`feat/categories`, `feat/stock`, etc.)
- Tests en verde antes de merge
- `.gitignore` (`.env`, `vendor/`, `node_modules/`)
- Tag `v1.0.0` y despliegue Railway documentado

---

## Cronograma (6 fases)

| Fase | Días | Verenice | Jessica | Elda |
|------|------|----------|---------|------|
| 1 Instalación | 1-2 | Laravel, Breeze | Layout | Auth |
| 2 Categorías | 2-3 | Controller | Vistas | CRUD test |
| 3 Productos | 3-4 | Controller | Vistas | SKU test |
| 4 Stock | 4-5 | Lógica stock | Vistas | **Casos límite** |
| 5 Dashboard | 5-6 | Controller | Vistas | Métricas |
| 6 Buscador | 6 | Scope | Form GET | Filtros |

Yadira: capturas al cerrar cada fase. Adrian: review PRs.

---

## Integrantes del README

- Verenice
- Jessica
- Yadira
- Elda
- Adrian

---

*Alineado con [`001-inventario-supermercado.md`](001-inventario-supermercado.md)*
