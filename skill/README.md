# skill/ — Capa de ejecución para IA

Instrucciones que el agente sigue para ejecutar los planes de `spec/`. No contiene lógica de aplicación.

## Skills disponibles

| Skill | Cuándo usar |
|-------|-------------|
| [spec-as-source/SKILL.md](spec-as-source/SKILL.md) | **Siempre** — orquestación base de todo el proyecto |
| [catalogo-productos/SKILL.md](catalogo-productos/SKILL.md) | Catálogo MVC, auth, dashboard, productos, WhatsApp |

## Crear una skill para una nueva solicitud

1. Leer la spec asociada en `spec/`
2. Crear carpeta `skill/<nombre-tarea>/`
3. Escribir `SKILL.md` con tareas atómicas por etapa
4. Referenciar checklists de `spec-as-source/` para testing y seguridad

## Restricción

Las skills de esta carpeta **no deben** importar, requerir ni acoplarse al framework o tecnología de `app/`.
