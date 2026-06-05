# PLAN — static/img/

## Rol

Imágenes locales de la aplicación: logo, iconos y **placeholder** cuando un producto no tiene imagen válida.

## Archivos previstos

| Archivo | Propósito |
|---------|-----------|
| `logo.png` o `logo.svg` | Marca en navbar |
| `placeholder-product.png` | Imagen por defecto en tarjetas catálogo |
| `favicon.ico` | Icono del sitio |

## Plan de trabajo

1. Añadir placeholder genérico de producto (etapa 6)
2. Logo del grupo (opcional etapa 7)
3. Referenciar desde vistas con `url_for('static', filename='img/...')`

## Nota

Las imágenes de productos reales vendrán por `imagen_url` externa; esta carpeta solo tiene assets fijos de la app.
