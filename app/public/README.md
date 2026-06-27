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
| `producto-editar.php` | Formulario producto (tabs) |
| `categorias.php` | CRUD categorías |
| `movimientos.php` | Entradas/salidas stock |
| `busqueda.php` | Búsqueda avanzada + filtros + grid |
| `ventas.php` | Tickets de venta al mostrador |
| `compras.php` | Órdenes de compra a proveedores |
| `usuarios.php` | Usuarios, roles y accesos |
| `reportes.php` | Reportes, gráficos y exportación |

## Estructura

```
public/
├── assets/css/     variables, style, dashboard, responsive
├── assets/js/      app.js, dashboard.js, busqueda.js, reportes.js
├── components/     navbar, sidebar, layout
└── *.php           páginas
```

## Encargado

**Jessica** — ver [`spec/002-frontend-ui-ux.md`](../../spec/002-frontend-ui-ux.md)

## Librerías (CDN)

Bootstrap 5.3 · Bootstrap Icons · Inter · Chart.js · DataTables · SweetAlert2 · Toastify
