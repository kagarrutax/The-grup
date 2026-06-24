# PLAN — tests/

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Elda** | Validaciones | Feature/Unit tests, matriz PASS/FAIL, casos stock límite |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Exigir `php artisan test` en verde antes de merge |
| **Yadira** | Documentación y presentación | Resultados de pruebas en paquete de entrega |

## Rol

Pruebas Laravel con PHPUnit — `tests/Feature/` y `tests/Unit/`.

## Casos críticos (obligatorios)

| # | Caso | Esperado |
|---|------|----------|
| 1 | Salida quantity > stock | Error, stock sin cambio |
| 2 | Entrada válida | stock_quantity incrementa |
| 3 | SKU duplicado | Validación falla |
| 4 | Login válido | redirect dashboard |
| 5 | Búsqueda por nombre | solo coincidencias |

## Comando

```bash
php artisan test
```

## Spec

[`spec/001-inventario-supermercado.md`](../../spec/001-inventario-supermercado.md)
