# PLAN — Aplicación The-grup (raíz)

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Verenice** | Líder y desarrolladora principal | Coordinación general, punto de entrada e integración de módulos |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Revisar PRs generales, README, `requirements.txt` y tag de release |
| **Yadira** | Documentación y presentación | Documentar arquitectura MVC y mapa de módulos en manual técnico |

## Rol de esta carpeta

Contenedor de la aplicación monolítica **MVC en Python**. Aquí vive todo el código ejecutable. La raíz aloja el punto de entrada y coordina los módulos hijos.

## Arquitectura seleccionada

**Monolítica MVC** — una sola aplicación con separación clara:

| Capa MVC | Carpeta en `app/` |
|----------|-------------------|
| **Model** | `models/` |
| **View** | `views/` + `static/` |
| **Controller** | `controllers/` |

## Módulos mínimos requeridos

| Módulo | Carpetas involucradas | Etapa spec |
|--------|----------------------|------------|
| Página principal dinámica | `controllers/catalog/`, `views/catalog/` | 6 |
| Sistema de login | `controllers/auth/`, `views/auth/` | 3 |
| Registro de usuarios | `controllers/auth/`, `views/auth/` | 3 |
| Dashboard administrativo | `controllers/dashboard/`, `views/dashboard/` | 4 |
| Módulo de productos | `controllers/products/`, `views/products/`, `models/` | 5 |
| Catálogo visual | `views/catalog/`, `static/css/` | 6 |
| Botón compra → WhatsApp | `utils/`, `views/catalog/` | 6 |

## Plan de trabajo (orden de implementación)

1. **Etapa 1** — `config/`, `controllers/` (factory), `views/layouts/`, `static/css/`
2. **Etapa 2** — `models/`
3. **Etapa 3** — `controllers/auth/`, `views/auth/`, `utils/`
4. **Etapa 4** — `controllers/dashboard/`, `views/dashboard/`
5. **Etapa 5** — `controllers/products/`, `views/products/`
6. **Etapa 6** — `controllers/catalog/`, `views/catalog/`, `utils/` (WhatsApp)
7. **Etapa 7** — `tests/`, pulido responsive, seguridad

## Archivos previstos en raíz (sin crear aún)

| Archivo | Rol |
|---------|-----|
| `run.py` o `app.py` | Punto de entrada del servidor |
| `requirements.txt` | Dependencias Python |
| `.env.example` | Plantilla de variables (SECRET_KEY, WHATSAPP_PHONE, DATABASE_URL) |

## Spec de referencia

[`spec/001-catalogo-productos-whatsapp.md`](../spec/001-catalogo-productos-whatsapp.md)
