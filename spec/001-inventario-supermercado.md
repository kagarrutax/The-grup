# Spec 001 — Sistema de inventario para supermercado

> **Estado:** Completado (integración frontend ↔ backend pendiente de merge)  
> **Solicitud:** Sistema de gestión de inventario con Laravel 11, MySQL y MVC  
> **Skill asociada:** `skill/inventario-supermercado/SKILL.md`  
> **Stack:** Laravel 11 · MySQL · Blade · Bootstrap 5 · Laravel Breeze  
> **Última actualización:** 2026-06-27

---

## Objetivo

Construir un sistema web MVC para gestionar el inventario de un supermercado: productos, categorías, stock y registro de entradas/salidas de mercadería, con autenticación, dashboard de métricas y buscador.

## Alcance

### Incluido

- Autenticación (login, logout) con Laravel Breeze — **solo administradores**
- CRUD de categorías
- CRUD de productos (SKU único, categoría, precio, stock mínimo)
- Movimientos de stock (entrada/salida) con validación de stock no negativo
- Dashboard: totales, stock bajo, movimientos recientes
- Buscador y filtro por categoría en listado de productos
- Layout responsive con Bootstrap 5
- Migraciones MySQL y seeder de prueba
- Despliegue documentado (Railway)

### Excluido

- API REST pública separada
- Pasarela de pago o ventas al público
- App móvil nativa
- Multi-sucursal

## Stack y justificación

| Tecnología | Uso |
|------------|-----|
| Laravel 11 | MVC, auth, ORM, migraciones, vistas |
| MySQL | Persistencia |
| Laravel Breeze | Login, registro, recuperación de contraseña |
| Blade + Bootstrap 5 | Frontend responsive sin bundler obligatorio |

## Base de datos

### Tablas

- `users` — name, email, password, role (`admin` únicamente)
- `categories` — name, description
- `products` — category_id, name, sku (unique), price, stock_quantity, stock_minimum, unit, status
- `stock_movements` — product_id, user_id, type (entrada|salida), quantity, reason

### Relaciones

```
users (1) ──< stock_movements (N) >── (1) products
categories (1) ──< products (N)
```

## Fases de implementación

### Fase 1 — Instalación y base (Día 1-2)

- [x] `composer create-project`, Breeze blade, npm build
- [x] `.env` MySQL, `php artisan migrate`
- [x] Layout base `resources/views/layouts/app.blade.php`

**Criterio de done:** App arranca, auth Breeze funcional.

### Fase 2 — Categorías (Día 2-3)

- [x] Modelo, migración, CategoryController resource
- [x] Vistas CRUD categorías *(Jessica — `categorias/` en `main`)*
- [x] Rutas en `web.php` con middleware auth

**Criterio de done:** CRUD categorías completo.

### Fase 3 — Productos (Día 3-4)

- [x] ProductController resource con validación SKU único
- [x] `stock_quantity` no editable desde formulario producto
- [x] Vistas CRUD productos *(Jessica — `productos/` en `main`)*

**Criterio de done:** Productos vinculados a categorías.

### Fase 4 — Movimientos de stock (Día 4-5)

- [x] StockController / MovementController
- [x] Validación salida > stock disponible
- [x] Actualización atómica de `stock_quantity`
- [x] Vistas stock *(Jessica — `inventario/index` en `main`)*

**Criterio de done:** Entradas/salidas registradas sin stock negativo.

### Fase 5 — Dashboard (Día 5-6)

- [x] DashboardController con métricas
- [x] Vista con tarjetas Bootstrap *(Jessica — `dashboard/index`)*
- [x] Últimos 10 movimientos

**Criterio de done:** Panel con totales y alertas stock bajo.

### Fase 6 — Buscador (Día 6)

- [x] Scope/búsqueda en ProductController@index
- [x] Filtro por nombre, SKU y categoría (GET)
- [x] Formulario buscador en vista *(Jessica — `productos/index` + `products/index`)*

**Criterio de done:** Listado filtrable sin JS obligatorio.

## Capa de testing

| Componente | Caso | Esperado |
|------------|------|----------|
| Stock salida | quantity > stock | Error, stock sin cambio |
| Stock entrada | quantity válida | stock_quantity incrementa |
| Producto | SKU duplicado | Validación falla |
| Auth | login válido | redirect dashboard |
| Buscador | filtro nombre | solo coincidencias |

## Capa de seguridad

- CSRF en formularios (Laravel default)
- Middleware `auth` en rutas administrativas
- Validación servidor en todos los store/update
- `.env` fuera del repo
- Roles admin/operador en users → **solo cuentas admin; registro público deshabilitado**

## Riesgos

| Riesgo | Mitigación |
|--------|------------|
| Stock negativo en demo | Validar antes de salida; Elda prueba casos límite |
| README incompleto | Yadira capturas cuando sistema funcione |
| Merge sin tests | Adrian exige tests verdes |

## Registro de progreso

| Fecha | Fase | Acción | Resultado |
|-------|------|--------|-----------|
| 2026-06-05 | — | Spec y estructura Laravel creadas | Plan listo |
| 2026-06-27 | 1 | Laravel 12 + Breeze, MySQL `the_grup`, layout Bootstrap | PASS — auth tests 4/4 |
| 2026-06-27 | 2 | Backend categorías: model, migration, controller, routes | PASS — CategoryTest 6/6 |
| 2026-06-27 | 3 | Backend productos: model, migration, controller, SKU único | PASS — ProductTest 2/2 |
| 2026-06-27 | 4 | Backend stock: StockMovement, StockController, transacción | PASS — StockMovementTest 5/5 |
| 2026-06-27 | 5 | Backend dashboard: DashboardController, métricas, scope lowStock | PASS — DashboardTest 4/4 |
| 2026-06-27 | 6 | Backend buscador: scopeSearch, filtros GET en ProductController | PASS — ProductTest 6/6 |
| 2026-06-27 | 2–6 | Frontend Jessica: categorías, productos, inventario, dashboard | PASS — vistas en `origin/main` |
| 2026-06-27 | — | Auth admin-only: sin registro, home→login, middleware admin | PASS — AdminAccessTest |
