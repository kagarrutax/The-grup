# PLAN — controllers/dashboard/

## Rol

Controlador del **dashboard administrativo básico**. Panel de entrada para el administrador tras iniciar sesión.

## Rutas previstas

| Método | Ruta | Acción |
|--------|------|--------|
| GET | `/dashboard` | Mostrar resumen y enlaces de gestión |

## Plan de trabajo

| Orden | Tarea | Etapa |
|-------|-------|-------|
| 1 | Crear blueprint `dashboard_bp` | 4 |
| 2 | Decorador `@admin_required` en todas las rutas | 4 |
| 3 | Calcular métricas: total productos, activos, inactivos | 4 |
| 4 | Enlaces rápidos: "Gestionar productos", "Ver catálogo" | 4 |
| 5 | Redirect a login si no autenticado; 403 si no admin | 4 |

## Dependencias

- `models/User`, `models/Product`
- `views/dashboard/index.html`
- `utils/decorators.py`

## Contenido mínimo del dashboard

- Saludo con nombre del admin
- Contadores de productos
- Botón/link hacia CRUD de productos
- Link para ver tienda pública (`/`)
