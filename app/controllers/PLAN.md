# PLAN — controllers/

## Rol

Capa **Controller** del MVC. Recibe peticiones HTTP, invoca modelos/servicios, elige la vista y devuelve la respuesta. En Flask se implementa con **Blueprints**.

## Responsabilidades

- Definir rutas (endpoints) de la aplicación
- Validar permisos (login, rol admin) antes de ejecutar lógica
- Orquestar operaciones entre modelos y vistas
- Manejar redirects y mensajes flash

## Submódulos

| Carpeta | Rutas previstas | Acceso |
|---------|-----------------|--------|
| `auth/` | `/register`, `/login`, `/logout` | Público / autenticado |
| `catalog/` | `/` (página principal) | Público |
| `dashboard/` | `/dashboard` | Solo admin |
| `products/` | `/admin/products/*` | Solo admin |

## Plan de trabajo

| Orden | Tarea | Etapa |
|-------|-------|-------|
| 1 | Factory `create_app()` que registra todos los blueprints | 1 |
| 2 | Blueprint `auth` con registro y login | 3 |
| 3 | Blueprint `dashboard` con protección admin | 4 |
| 4 | Blueprint `products` con CRUD completo | 5 |
| 5 | Blueprint `catalog` con listado público | 6 |

## Archivos previstos en raíz

| Archivo | Descripción |
|---------|-------------|
| `__init__.py` | Factory de la aplicación Flask |
| `errors.py` | Handlers 404/403 (etapa 7) |

## Convención de rutas MVC

```
Petición HTTP → Controller (blueprint) → Model → View (template) → Respuesta HTML
```
