---
name: spec-as-source
description: >-
  Orquesta el desarrollo bajo el framework spec-as-source de The-grup.
  Lee spec/ antes de programar, ejecuta por etapas con testing y seguridad.
  Usar en toda solicitud de desarrollo, feature, bugfix o refactor en este repositorio.
---

# Spec-as-Source — Orquestación The-grup

## Regla fundamental

**NO escribir código en `app/` hasta haber leído la spec aplicable y confirmado el plan.**

Si no existe spec para la solicitud: crear spec + skill primero, presentar plan, esperar aprobación.

## Inicio de cada tarea

Copiar y actualizar este checklist:

```
Progreso de orquestación:
- [ ] Leer spec/000-framework-spec-as-source.md
- [ ] Buscar spec existente para la solicitud
- [ ] Si no existe: crear spec con _template.md
- [ ] Si no existe: crear skill específica en skill/<tarea>/
- [ ] Presentar resumen del plan al usuario
- [ ] Confirmar estado Aprobado antes de codificar
```

## Flujo de ejecución

### Fase 1 — Análisis (solo lectura)

1. Leer `spec/README.md` y listar specs en `spec/`
2. Leer la spec más relevante (o 000 si es nueva solicitud)
3. Explorar `app/` para entender estado actual
4. Identificar etapa pendiente según registro de progreso de la spec

### Fase 2 — Planificación (si aplica)

1. Copiar `spec/_template.md` → `spec/NNN-<nombre>.md`
2. Completar: Objetivo, Alcance, Etapas, Testing, Seguridad, Riesgos
3. Crear `skill/<nombre-tarea>/SKILL.md` con tareas atómicas por etapa
4. Cambiar estado de spec a **En revisión**
5. Resumir plan al usuario en español; **detenerse aquí**

### Fase 3 — Ejecución (una etapa)

1. Verificar spec en estado **Aprobado** o **En progreso**
2. Ejecutar **solo la etapa actual** definida en la spec
3. Implementar cambios únicamente en `app/`
4. Ejecutar pruebas definidas en la etapa
5. Aplicar [testing-checklist.md](testing-checklist.md)
6. Aplicar [security-checklist.md](security-checklist.md)
7. Actualizar registro de progreso en la spec
8. Reportar resultado antes de pasar a la siguiente etapa

### Fase 4 — Cierre

1. Marcar todas las etapas como completadas en la spec
2. Cambiar estado a **Completado**
3. Resumir entregables y pruebas ejecutadas

## Restricciones de desacoplamiento

| Permitido en spec/skill | Prohibido en spec/skill |
|-------------------------|-------------------------|
| Lenguaje de negocio | Imports de `app/` |
| Nombres de módulos conceptuales | Código ejecutable de aplicación |
| Criterios de aceptación | Rutas, configs o .env |
| Referencias a checklists | Dependencias npm/composer/etc. |

## Tareas atómicas (plantilla para skills derivadas)

Cada skill específica debe dividir su etapa así:

```markdown
### Tarea N.M — [Nombre]

**Precondición:** [Etapa anterior completada]
**Acción:** [Una sola acción verificable]
**Archivos:** [Solo en app/]
**Prueba:** [Comando o caso concreto]
**Postcondición:** [Estado verificable]
**Rollback:** [Cómo revertir si falla]
```

## Cuándo detenerse y preguntar

- Alcance ambiguo o contradictorio con specs existentes
- Riesgo de seguridad alto sin mitigación definida
- Etapa requiere decisión arquitectónica no documentada en la spec
- Pruebas de la etapa fallan tras dos intentos de corrección

## Recursos

- Checklist testing: [testing-checklist.md](testing-checklist.md)
- Checklist seguridad: [security-checklist.md](security-checklist.md)
- Plantilla spec: [../../spec/_template.md](../../spec/_template.md)
