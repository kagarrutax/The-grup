# PLAN — app/Http/Controllers/

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Verenice** | Líder y desarrolladora principal | Controladores resource, validaciones, lógica de negocio |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Revisar PRs de controladores antes de merge a `main` |
| **Yadira** | Documentación y presentación | Describir flujo MVC controlador→modelo→vista en manual técnico |

## Rol

Capa **Controller** del MVC Laravel. Recibe requests HTTP, valida, invoca modelos y retorna vistas.

## Controladores previstos

| Archivo | Módulo | Fase |
|---------|--------|------|
| `DashboardController.php` | Métricas panel | 5 |
| `CategoryController.php` | CRUD categorías | 2 |
| `ProductController.php` | CRUD productos + buscador | 3, 6 |
| `StockController.php` | Entradas/salidas stock | 4 |

> Auth lo provee **Laravel Breeze** (no controlador custom salvo extensión de roles).

## Validaciones críticas

- Producto: SKU único, `category_id` exists, precio ≥ 0
- Stock salida: `quantity` ≤ `stock_quantity` disponible
- Stock: `type` in (`entrada`, `salida`)

## Spec

[`spec/001-inventario-supermercado.md`](../../../spec/001-inventario-supermercado.md)
