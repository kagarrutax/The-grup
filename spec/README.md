# spec/ — Capa de planificación

Fuente de verdad para el agente de IA. Cada solicitud del usuario genera o actualiza un documento aquí **antes** de escribir código en `app/`.

## Convenciones

- Numeración: `NNN-nombre-kebab-case.md` (ej. `001-gestion-usuarios.md`)
- Plantilla: [`_template.md`](_template.md)
- Framework base: [`000-framework-spec-as-source.md`](000-framework-spec-as-source.md)

## Estados de una spec

| Estado | Significado |
|--------|-------------|
| Borrador | En redacción, no ejecutar |
| En revisión | Lista para validación del usuario |
| Aprobado | Puede ejecutarse por etapas |
| En progreso | Implementación activa |
| Completado | Todas las etapas cerradas y validadas |
| Cancelado | Descartada con motivo documentado |

## Regla de oro

> Ningún cambio en `app/` sin spec en estado **Aprobado** o **En progreso**.
