# Frontend — Preview UI/UX

Interfaz del inventario (Bootstrap 5.3, estilo SaaS). **Solo frontend** — datos mock.

## Ver en XAMPP

```
http://localhost/The-grup/app/public/login.php
http://localhost/The-grup/app/public/dashboard.php
```

## Páginas

| Archivo | Módulo |
|---------|--------|
| `login.php` | Inicio de sesión |
| `dashboard.php` | Panel métricas + gráfico |
| `productos.php` | Listado, buscador, modal CRUD |
| `categorias.php` | CRUD categorías |
| `movimientos.php` | Entradas/salidas stock |

## Estructura

```
public/
├── assets/css/     variables, style, dashboard, responsive
├── assets/js/      app.js, dashboard.js
├── components/     navbar, sidebar, layout
└── *.php           páginas
```

## Encargado

**Jessica** — ver [`spec/002-frontend-ui-ux.md`](../../spec/002-frontend-ui-ux.md)

## Librerías (CDN)

Bootstrap 5.3 · Bootstrap Icons · Inter · Chart.js · DataTables · SweetAlert2 · Toastify
