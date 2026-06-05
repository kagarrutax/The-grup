# PLAN — views/catalog/

## Rol

Vista de la **página principal dinámica** — catálogo visual de productos. Es la cara pública de la tienda.

## Archivos previstos

| Archivo | Descripción |
|---------|-------------|
| `index.html` | Grid de productos con botón Comprar |

## Plan de trabajo

| Orden | Tarea | Etapa |
|-------|-------|-------|
| 1 | Hero o título de tienda en parte superior | 6 |
| 2 | Grid CSS responsive de tarjetas producto | 6 |
| 3 | Cada tarjeta: imagen, nombre, precio, descripción corta | 6 |
| 4 | Botón **Comprar** → enlace WhatsApp (`target="_blank"`) | 6 |
| 5 | Estado vacío: "No hay productos disponibles" | 6 |
| 6 | Lazy loading o placeholder si imagen falla | 6 |

## Estructura de tarjeta (wireframe)

```
┌─────────────────┐
│     [imagen]    │
│  Nombre producto│
│    $ 99.00      │
│  Descripción... │
│  [  Comprar  ]  │  → wa.me
└─────────────────┘
```

## Responsive

| Viewport | Columnas |
|----------|----------|
| < 576px | 1 |
| 576–992px | 2 |
| > 992px | 3–4 |
