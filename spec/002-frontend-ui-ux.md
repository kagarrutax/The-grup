# Spec 002 — Frontend UI/UX (Bootstrap 5.3)

> **Estado:** En progreso  
> **Encargado:** Jessica  
> **Skill:** `skill/frontend-ui/SKILL.md`  
> **Última actualización:** 2026-06-05

---

## Objetivo

Implementar la interfaz del inventario con apariencia SaaS 2026: Bootstrap 5.3, diseño limpio, responsive y componentes reutilizables. **Solo frontend** — datos mock, sin backend Laravel aún.

## Ubicación

| Área | Ruta |
|------|------|
| Preview XAMPP | `app/public/*.php` |
| Assets | `app/public/assets/css/`, `js/` |
| Componentes PHP | `app/public/components/` |
| Blade (futuro) | `app/resources/views/` |

## Preview local

```
http://localhost/The-grup/app/public/dashboard.php
```

## Paleta

Primary `#2563EB` · Background `#F8FAFC` · Sidebar `#0F172A`

## Páginas

- [x] `login.php`
- [x] `dashboard.php`
- [x] `productos.php`
- [x] `categorias.php`
- [x] `movimientos.php`

## Librerías CDN

Bootstrap 5.3 · Bootstrap Icons · Inter · Chart.js · DataTables · SweetAlert2 · Toastify

## Criterio de done

- [x] Layout sidebar + navbar responsive (offcanvas móvil)
- [x] Variables CSS según guía
- [x] Dashboard con cards y gráfico
- [x] Tablas con DataTables
- [x] Formularios dos columnas
- [x] Badges estado (activo/pendiente/inactivo)
