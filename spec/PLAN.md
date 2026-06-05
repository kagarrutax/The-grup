# PLAN — spec/ y organización del repositorio

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Adrian** | GitHub y organización | Estructura del repo, ramas, README, `.gitignore` y releases |
| **Adrian** | Revisión e integración de código | Revisar PRs, validar merges y que los cambios no rompan la arquitectura MVC |

## Roles

### GitHub y organización

Mantener el repositorio ordenado y listo para entrega: convenciones Git, protección de `main` y tag de versión final.

### Revisión e integración de código

Revisar pull requests del equipo, coordinar integración entre ramas y confirmar que el código mergeado respeta la estructura `spec/`, `skill/` y `app/`.

## Ámbito de trabajo

| Ubicación | Tarea |
|-----------|-------|
| Raíz (`README.md`, `.gitignore`) | Instalación, equipo, cómo ejecutar |
| `spec/` | Verificar que planes estén actualizados |
| `skill/` | Verificar skills de orquestación |
| `app/` | Confirmar estructura MVC y `PLAN.md` por carpeta |
| `docs/` | Coordinar con Yadira ubicación de documentación |
| GitHub | PRs, protección de `main`, tag `v1.0.0` |

## Convenciones Git

| Elemento | Convención |
|----------|------------|
| Commits | `feat:`, `fix:`, `docs:`, `style:`, `test:` |
| Ramas | `feat/login`, `feat/catalogo`, etc. |
| Merge | Solo con revisión; tests en verde |

## Spec de referencia

[`000-framework-spec-as-source.md`](000-framework-spec-as-source.md)
