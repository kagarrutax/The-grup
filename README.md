# The-grup

Proyecto de clase de desarrollo de software con enfoque **spec-as-source**: la IA planifica antes de programar y ejecuta por etapas controladas.

## Estructura

| Carpeta | Rol |
|---------|-----|
| [`spec/`](spec/) | Planes detallados — fuente de verdad |
| [`skill/`](skill/) | Instrucciones de ejecución para el agente IA |
| [`app/`](app/) | Aplicación final |

## Flujo de trabajo

1. Solicitud del usuario → spec en `spec/`
2. Skill específica en `skill/`
3. Aprobación del plan
4. Implementación progresiva en `app/` con testing y seguridad

Documentación del framework: [`spec/000-framework-spec-as-source.md`](spec/000-framework-spec-as-source.md)
