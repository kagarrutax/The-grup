# Spec 001 — Sistema de inventario para supermercado

> **Estado:** Aprobado  
> **Solicitud:** Sistema de gestión de inventario con Laravel 11, MySQL y MVC  
> **Skill asociada:** `skill/inventario-supermercado/SKILL.md`  
> **Stack:** Laravel 11 · MySQL · Blade · Bootstrap 5 · Laravel Breeze  
> **Última actualización:** 2026-06-05

---

## Objetivo

Construir un sistema web MVC para gestionar el inventario de un supermercado: productos, categorías, stock y registro de entradas/salidas de mercadería, con autenticación, dashboard de métricas y buscador.

## Alcance

### Incluido

- Autenticación (login, registro, logout) con Laravel Breeze
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

- `users` — name, email, password, role (admin|operador)
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

- [ ] `composer create-project`, Breeze blade, npm build
- [ ] `.env` MySQL, `php artisan migrate`
- [ ] Layout base `resources/views/layouts/app.blade.php`

**Criterio de done:** App arranca, auth Breeze funcional.

### Fase 2 — Categorías (Día 2-3)

- [ ] Modelo, migración, CategoryController resource
- [ ] Vistas CRUD categorías
- [ ] Rutas en `web.php` con middleware auth

**Criterio de done:** CRUD categorías completo.

### Fase 3 — Productos (Día 3-4)

- [ ] ProductController resource con validación SKU único
- [ ] `stock_quantity` no editable desde formulario producto
- [ ] Vistas CRUD productos

**Criterio de done:** Productos vinculados a categorías.

### Fase 4 — Movimientos de stock (Día 4-5)

- [ ] StockController / MovementController
- [ ] Validación salida > stock disponible
- [ ] Actualización atómica de `stock_quantity`

**Criterio de done:** Entradas/salidas registradas sin stock negativo.

### Fase 5 — Dashboard (Día 5-6)

- [ ] DashboardController con métricas
- [ ] Vista con tarjetas Bootstrap
- [ ] Últimos 10 movimientos

**Criterio de done:** Panel con totales y alertas stock bajo.

### Fase 6 — Buscador (Día 6)

- [ ] Scope/búsqueda en ProductController@index
- [ ] Filtro por nombre, SKU y categoría (GET)

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
- Roles admin/operador en users

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
