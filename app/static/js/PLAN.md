# PLAN — static/js/

## Rol

JavaScript del frontend. Complementa la UI; **no** reemplaza la lógica del servidor (MVC).

## Archivos previstos

| Archivo | Etapa | Propósito |
|---------|-------|-----------|
| `main.js` | 1 | Toggle navbar móvil, utilidades DOM |
| `catalog.js` | 7 | Mejoras UX catálogo (opcional) |
| `products.js` | 7 | Preview imagen URL en formulario admin |

## Plan de trabajo

1. Navbar hamburger en móvil
2. Cerrar menú al hacer click fuera
3. Preview de `imagen_url` en formulario producto (etapa 7)
4. Sin dependencias pesadas; vanilla JS o mínimo del framework CSS

## Nota

El botón Comprar **no requiere JS** — es un enlace directo a WhatsApp.
