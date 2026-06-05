# PLAN — views/layouts/

## Rol

Plantillas **base compartidas**. Definen estructura HTML común: head, navbar, footer, bloques de contenido y carga de assets estáticos.

## Archivos previstos

| Archivo | Uso |
|---------|-----|
| `base.html` | Layout público (catálogo, auth) |
| `admin.html` | Layout panel admin (extiende base o independiente) |
| `_navbar.html` | Partial: navegación principal |
| `_footer.html` | Partial: pie de página |
| `_flash.html` | Partial: mensajes flash |

## Plan de trabajo

| Orden | Tarea | Etapa |
|-------|-------|-------|
| 1 | `base.html` con meta viewport, CSS responsive | 1 |
| 2 | Navbar: Inicio, Login/Logout, Dashboard (si admin) | 1 |
| 3 | Bloques Jinja: `{% block title %}`, `{% block content %}`, `{% block scripts %}` | 1 |
| 4 | `admin.html` con nav lateral o tabs admin | 4 |
| 5 | Integrar mensajes flash en layout | 3 |

## Responsive

- Viewport meta obligatorio
- Navbar colapsable en móvil (hamburger)
- Contenedor con max-width y padding adaptable
