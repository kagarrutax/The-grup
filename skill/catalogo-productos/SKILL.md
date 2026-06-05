---
name: catalogo-productos
description: >-
  Ejecuta la spec 001 del catálogo de productos con WhatsApp en The-grup.
  Arquitectura MVC Python. Usar al implementar auth, dashboard, productos o catálogo público.
---

# Skill — Catálogo de productos + WhatsApp

**Spec de referencia:** [`spec/001-catalogo-productos-whatsapp.md`](../../spec/001-catalogo-productos-whatsapp.md)  
**Orquestación base:** [`../spec-as-source/SKILL.md`](../spec-as-source/SKILL.md)

## Precondición

- Spec 001 en estado **Aprobado** o **En progreso**
- Leer `PLAN.md` de la carpeta objetivo antes de escribir código
- Ejecutar **una etapa** por iteración

## Orden de ejecución (obligatorio)

```
Etapa 1 → Esqueleto MVC
Etapa 2 → Modelos
Etapa 3 → Auth (registro + login)
Etapa 4 → Dashboard admin
Etapa 5 → CRUD productos
Etapa 6 → Catálogo + WhatsApp
Etapa 7 → Pulido + tests + seguridad
```

## Tareas por etapa

### Etapa 1 — Esqueleto MVC

| Tarea | Carpeta | Acción |
|-------|---------|--------|
| 1.1 | `app/config/` | Configuración base y carga de entorno |
| 1.2 | `app/controllers/` | Factory app + registro blueprints |
| 1.3 | `app/views/layouts/` | Layout HTML responsive base |
| 1.4 | `app/static/css/` | Estilos globales mobile-first |

**Prueba:** App arranca sin error.  
**Checklists:** testing + seguridad de spec-as-source.

---

### Etapa 2 — Modelos

| Tarea | Carpeta | Acción |
|-------|---------|--------|
| 2.1 | `app/models/` | Modelo User con hash de contraseña |
| 2.2 | `app/models/` | Modelo Product con campos requeridos |
| 2.3 | `app/config/` | Inicialización BD |

**Prueba:** Tests unitarios de modelos pasan.

---

### Etapa 3 — Auth

| Tarea | Carpeta | Acción |
|-------|---------|--------|
| 3.1 | `app/controllers/auth/` | Rutas register, login, logout |
| 3.2 | `app/views/auth/` | Formularios registro y login |
| 3.3 | `app/utils/` | Validadores de email y contraseña |

**Prueba:** Flujo registro → login funcional.

---

### Etapa 4 — Dashboard

| Tarea | Carpeta | Acción |
|-------|---------|--------|
| 4.1 | `app/controllers/dashboard/` | Ruta protegida `/dashboard` |
| 4.2 | `app/views/dashboard/` | Vista resumen admin |
| 4.3 | `app/utils/` | Decorador `admin_required` |

**Prueba:** User normal no accede; admin sí.

---

### Etapa 5 — Productos CRUD

| Tarea | Carpeta | Acción |
|-------|---------|--------|
| 5.1 | `app/controllers/products/` | Rutas CRUD |
| 5.2 | `app/views/products/` | Vistas listado, formulario, confirmación |
| 5.3 | `app/models/` | Campo `activo` para filtrar catálogo |

**Prueba:** Admin gestiona productos; inactivos ocultos del público.

---

### Etapa 6 — Catálogo + WhatsApp

| Tarea | Carpeta | Acción |
|-------|---------|--------|
| 6.1 | `app/controllers/catalog/` | Ruta `/` con productos activos |
| 6.2 | `app/views/catalog/` | Grid visual de tarjetas producto |
| 6.3 | `app/utils/` | `build_whatsapp_url(phone, product)` |
| 6.4 | `app/static/js/` | Mejoras UX opcionales (sin bloquear compra) |

**Prueba:** Botón Comprar genera enlace wa.me correcto.

---

### Etapa 7 — Cierre

| Tarea | Carpeta | Acción |
|-------|---------|--------|
| 7.1 | `app/tests/unit/` | Tests unitarios completos |
| 7.2 | `app/tests/functional/` | Tests E2E de flujos críticos |
| 7.3 | Todas | Responsive + páginas error + flash messages |

**Prueba:** Suite completa en verde. Actualizar spec 001 a **Completado**.

## Reglas

- Código solo en `app/`; nunca en `spec/` ni `skill/`
- Cada archivo nuevo debe respetar el rol de su carpeta (ver `PLAN.md` local)
- WhatsApp: usar `https://wa.me/{numero}?text={mensaje}` con número sin `+` ni espacios
- No saltar etapas
