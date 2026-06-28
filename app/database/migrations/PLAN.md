# PLAN — database/migrations/

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Verenice** | Líder y desarrolladora principal | Migraciones MySQL: users, categories, products, stock_movements |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Verificar migraciones en PR; no commitear `.sql` locales |
| **Yadira** | Documentación y presentación | Incluir esquema de tablas en manual técnico |

## Rol

Definición del esquema MySQL mediante migraciones Laravel.

## Tablas

```sql
users          → role ENUM('admin','operador')
categories     → name, description
products       → category_id FK, ID UNIQUE, stock_quantity, stock_minimum
stock_movements → product_id FK, user_id FK, type ENUM('entrada','salida')
```

## Comandos

```bash
php artisan make:model Category -m
php artisan migrate
php artisan migrate:fresh --seed   # solo desarrollo
```

## Spec

[`spec/001-inventario-supermercado.md`](../../../spec/001-inventario-supermercado.md)
