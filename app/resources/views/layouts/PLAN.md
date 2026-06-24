# PLAN — resources/views/layouts/

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Jessica** | Frontend y responsive | `app.blade.php`: navbar, flash messages, Bootstrap CDN, `@yield` |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Revisar PR del layout base (Fase 1) |
| **Yadira** | Documentación y presentación | Captura del layout común en manual |

## Rol

Layout maestro compartido por todas las vistas.

## Elementos obligatorios

- Meta viewport responsive
- Bootstrap 5.3 CSS + JS CDN
- Bootstrap Icons CDN
- Navbar: marca, nombre usuario, logout
- Alert `@if(session('success'))`
- `@yield('content')` y `@yield('scripts')`

## Fase

**Fase 1** — debe existir antes de módulos CRUD.

## Spec

[`spec/001-inventario-supermercado.md`](../../../../spec/001-inventario-supermercado.md)
