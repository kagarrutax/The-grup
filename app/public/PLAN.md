# PLAN — app/public/ (Vista cliente / UI preview)

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Jessica** | Frontend y responsive | Interfaz SaaS Bootstrap 5.3, componentes PHP, assets CSS/JS |

## Participación GitHub y documentación

| Integrante | Rol | Participación |
|------------|-----|---------------|
| **Adrian** | Revisión e integración | PRs de UI, coherencia con spec 002 |
| **Yadira** | Documentación | Capturas desde XAMPP para manual y slides |
| **Verenice** | Backend | Migrar diseño a Blade cuando Laravel esté listo |

## Rol

**Vista del cliente** — preview funcional en XAMPP **sin backend**. Datos mock, listo para demo universitaria y referencia visual al integrar Blade.

> **No confundir con:** `resources/views/` (Blade Laravel, spec 001).

## Spec

[`spec/002-frontend-ui-ux.md`](../../spec/002-frontend-ui-ux.md)  
Skill: [`skill/frontend-ui/SKILL.md`](../../skill/frontend-ui/SKILL.md)

## Preview local

```
http://localhost/The-grup/app/public/login.php
http://localhost/The-grup/app/public/dashboard.php
```

## Estructura

```
public/
├── PLAN.md
├── index.php              → redirige a login.php
├── login.php
├── dashboard.php
├── productos.php, producto-editar.php, categorias.php
├── movimientos.php, busqueda.php
├── ventas.php, compras.php
├── usuarios.php, reportes.php
├── components/            navbar, sidebar, layout, head, footer
└── assets/css|js/         variables, style, dashboard, responsive
```

## Páginas (spec 002)

| Archivo | Módulo |
|---------|--------|
| `login.php` | Auth demo |
| `dashboard.php` | Métricas + gráfico |
| `productos.php` | Listado CRUD |
| `producto-editar.php` | Formulario tabs |
| `categorias.php` | CRUD categorías |
| `movimientos.php` | Stock entrada/salida |
| `busqueda.php` | Buscador avanzado (Fase 6) |
| `ventas.php` | Tickets mostrador |
| `compras.php` | Órdenes proveedor |
| `usuarios.php` | Roles admin/operador |
| `reportes.php` | Informes y exportación |

## Reglas de trabajo

1. Solo frontend — sin consultas DB ni lógica de negocio.
2. Reutilizar `components/layout-start.php` y `layout-end.php`.
3. Estilos en `assets/css/` (variables → style → dashboard → responsive).
4. Paleta: Primary `#2563EB`, fondo `#F8FAFC`, sidebar `#0F172A`.
5. CDN: Bootstrap 5.3, Icons, Inter, Chart.js, DataTables, SweetAlert2, Toastify.

## Relación con Blade (spec 001)

| Preview PHP | Vista Blade futura |
|-------------|-------------------|
| `categorias.php` | `categories/*` |
| `productos.php` | `products/*` |
| `movimientos.php` | `stock/*` |
| `dashboard.php` | `dashboard/index` |
| `busqueda.php` | Filtros en `products/index` |

Verenice integra rutas Laravel; Jessica mantiene paridad visual entre ambas capas.
