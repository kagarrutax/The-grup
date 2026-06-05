# PLAN — static/

## Rol

Recursos **estáticos del frontend**: hojas de estilo, scripts JavaScript e imágenes. Sirve la capa visual responsive del catálogo y paneles admin.

## Subcarpetas

| Carpeta | Contenido |
|---------|-----------|
| `css/` | Estilos globales, grid catálogo, componentes |
| `js/` | Interacciones UX (navbar, preview imagen) |
| `img/` | Logo, placeholders, assets locales |

## Plan de trabajo

| Orden | Tarea | Etapa |
|-------|-------|-------|
| 1 | `css/main.css` — variables, tipografía, reset | 1 |
| 2 | `css/catalog.css` — grid tarjetas responsive | 6 |
| 3 | `css/admin.css` — tablas y formularios admin | 5 |
| 4 | `js/main.js` — navbar móvil toggle | 1 |
| 5 | `img/placeholder-product.png` — imagen por defecto | 6 |

## Framework CSS previsto

Bootstrap 5 **o** Tailwind CSS (decisión del grupo en etapa 1). Debe garantizar responsive sin CSS custom excesivo.

## Responsive obligatorio

- Breakpoints para catálogo (ver `views/catalog/PLAN.md`)
- Formularios legibles en pantallas 320px+
- Botón Comprar con área táctil mínima (~44px)
