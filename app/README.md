# app/ — Catálogo de productos (MVC Python)

Aplicación monolítica MVC para gestión de productos, catálogo visual y compra vía WhatsApp.

## Arquitectura

**Monolítica MVC** | **Lenguaje:** Python | **Estado:** Solo estructura y planes (sin código)

## Mapa de carpetas

```
app/
├── PLAN.md                     → Visión general y orden de etapas
├── config/                     → Configuración y variables de entorno
├── controllers/                → Capa Controller (rutas HTTP)
│   ├── auth/                   → Login y registro
│   ├── catalog/                → Página principal / catálogo
│   ├── dashboard/              → Panel administrativo
│   └── products/               → CRUD productos (admin)
├── models/                     → Capa Model (User, Product)
├── views/                      → Capa View (plantillas HTML)
│   ├── layouts/                → Base responsive
│   ├── auth/                   → Login y registro
│   ├── catalog/                → Catálogo visual
│   ├── dashboard/              → Dashboard admin
│   └── products/               → Gestión productos
├── static/                     → CSS, JS, imágenes
│   ├── css/
│   ├── js/
│   └── img/
├── utils/                      → WhatsApp, decoradores, validadores
└── tests/
    ├── unit/
    └── functional/
```

Cada carpeta contiene un **`PLAN.md`** con su rol y plan de trabajo detallado.

## Módulos vs carpetas

| Requisito del proyecto | Ubicación |
|------------------------|-----------|
| Página principal dinámica | `controllers/catalog/` + `views/catalog/` |
| Login | `controllers/auth/` + `views/auth/` |
| Registro | `controllers/auth/` + `views/auth/` |
| Dashboard admin | `controllers/dashboard/` + `views/dashboard/` |
| Módulo productos | `controllers/products/` + `views/products/` + `models/` |
| Catálogo visual | `views/catalog/` + `static/css/` |
| Botón compra → WhatsApp | `utils/whatsapp.py` + `views/catalog/` |

## Documentación de referencia

- Spec: [`spec/001-catalogo-productos-whatsapp.md`](../spec/001-catalogo-productos-whatsapp.md)
- Skill: [`skill/catalogo-productos/SKILL.md`](../skill/catalogo-productos/SKILL.md)

## Próximo paso

Aprobar inicio de **Etapa 1** (esqueleto MVC) — aún sin código hasta confirmación.
