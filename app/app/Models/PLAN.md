# PLAN — app/Models/

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Verenice** | Líder y desarrolladora principal | Modelos Eloquent, relaciones y fillable |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Revisar PRs de modelos y relaciones |
| **Yadira** | Documentación y presentación | Diagrama ER (users, categories, products, stock_movements) |

## Rol

Capa **Model** — entidades Eloquent y relaciones.

## Modelos previstos

| Modelo | Relaciones |
|--------|------------|
| `User` | hasMany StockMovement |
| `Category` | hasMany Product |
| `Product` | belongsTo Category; hasMany StockMovement |
| `StockMovement` | belongsTo Product, User |

## Campos clave Product

- `ID` — único
- `stock_quantity` — solo vía movimientos, no formulario producto
- `stock_minimum` — alerta dashboard

## Spec

[`spec/001-inventario-supermercado.md`](../../../spec/001-inventario-supermercado.md)
