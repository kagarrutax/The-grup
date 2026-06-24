# PLAN — resources/views/stock/

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Jessica** | Frontend y responsive | Formulario entrada/salida, listado movimientos |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Revisar PR módulo stock (lógica crítica) |
| **Yadira** | Documentación y presentación | Captura flujo entrada/salida para demo |

## Rol

Vistas del **módulo central** — registro de movimientos de inventario.

## Vistas previstas

- `index.blade.php` — historial movimientos
- `create.blade.php` — producto, tipo (entrada/salida), cantidad, motivo

## Validación UI

Mostrar errores si stock insuficiente en salida (mensaje del controlador).

## Fase

**Fase 4** (Día 4-5) — probar casos límite antes de presentación.

## Spec

[`spec/001-inventario-supermercado.md`](../../../../spec/001-inventario-supermercado.md)
