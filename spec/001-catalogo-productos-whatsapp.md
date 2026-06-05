# Spec 001 — Catálogo de productos con contacto WhatsApp

> **Estado:** Aprobado  
> **Solicitud:** Aplicación Python MVC para gestión de productos, catálogo visual, auth y compra vía WhatsApp  
> **Skill asociada:** `skill/catalogo-productos/SKILL.md`  
> **Arquitectura seleccionada:** Monolítica MVC  
> **Stack:** Python (Flask recomendado) + frontend moderno responsive  
> **Última actualización:** 2026-06-05

---

## Objetivo

Construir una aplicación web monolítica MVC en Python que permita al administrador gestionar productos, muestre un catálogo visual responsive en la página principal y redirija al comprador al WhatsApp del vendedor al pulsar "Comprar".

## Alcance

### Incluido

- Página principal dinámica con catálogo visual de productos
- Sistema de registro de usuarios
- Sistema de login (sesión)
- Dashboard administrativo básico (solo usuarios admin)
- Módulo CRUD de productos (crear, listar, editar, eliminar)
- Botón de compra con enlace `wa.me` hacia WhatsApp del vendedor
- Frontend moderno, organizado y responsive (móvil/tablet/desktop)
- Estructura MVC: controladores, modelos, vistas, rutas
- Carpetas con planes de trabajo (`PLAN.md`) por módulo

### Excluido

- Pasarela de pago integrada
- Carrito de compras / checkout interno
- API REST pública separada del monolito
- Chat interno con el vendedor
- Multi-vendedor (un solo número WhatsApp configurable)
- Despliegue en producción (se planifica, no se ejecuta en esta fase)

## Contexto y dependencias

- Spec previa: [`000-framework-spec-as-source.md`](000-framework-spec-as-source.md)
- Estado actual de `app/`: estructura de carpetas creada, sin código
- Dependencias previstas (instalación en etapa de implementación):
  - Flask + Flask-Login + Flask-WTF (o equivalente MVC Python)
  - SQLAlchemy + SQLite (desarrollo)
  - bcrypt o werkzeug para hash de contraseñas
  - Bootstrap 5 o Tailwind CSS (frontend responsive)

## Mapa de módulos y carpetas

```
app/
├── PLAN.md                 → Visión general de la aplicación
├── config/                 → Configuración y variables de entorno
├── controllers/            → Rutas y lógica de petición HTTP
│   ├── auth/               → Login y registro
│   ├── catalog/            → Página principal / catálogo público
│   ├── dashboard/          → Panel administrativo
│   └── products/           → CRUD productos (admin)
├── models/                 → Entidades: User, Product
├── views/                  → Plantillas HTML (Jinja2)
│   ├── layouts/            → Base responsive compartida
│   ├── auth/               → Vistas login/registro
│   ├── catalog/            → Vista catálogo principal
│   ├── dashboard/          → Vista panel admin
│   └── products/           → Vistas gestión productos
├── static/                 → CSS, JS, imágenes
│   ├── css/
│   ├── js/
│   └── img/
├── utils/                  → Helpers (enlace WhatsApp, validadores)
└── tests/
    ├── unit/
    └── functional/
```

## Pasos de implementación

### Etapa 1 — Esqueleto MVC y configuración

**Entregables:**
- [ ] Punto de entrada de la aplicación (`run.py` o `app.py`)
- [ ] Configuración por entorno en `config/`
- [ ] Registro de blueprints/controladores
- [ ] Layout base responsive en `views/layouts/`
- [ ] Estilos base en `static/css/`

**Pruebas requeridas:**
- Unitarias: carga de configuración sin errores
- Funcionales: la app arranca y responde en `/` con layout base

**Criterio de done:** Servidor local levanta, layout responsive visible, sin rutas de negocio aún.

---

### Etapa 2 — Modelos y persistencia

**Entregables:**
- [ ] Modelo `User` (id, email, password_hash, nombre, rol admin/user, created_at)
- [ ] Modelo `Product` (id, nombre, descripción, precio, imagen_url, activo, created_at)
- [ ] Inicialización de base de datos
- [ ] Seed opcional: usuario admin por defecto

**Pruebas requeridas:**
- Unitarias: creación de User y Product; hash de contraseña
- Funcionales: migración/creación de tablas al iniciar

**Criterio de done:** CRUD a nivel modelo funciona en tests unitarios.

---

### Etapa 3 — Autenticación (registro + login)

**Entregables:**
- [ ] Controlador auth: rutas `/register`, `/login`, `/logout`
- [ ] Vistas auth con formularios validados
- [ ] Sesión con Flask-Login (o equivalente)
- [ ] Protección de rutas admin

**Pruebas requeridas:**
- Unitarias: validación de email duplicado, contraseña débil rechazada
- Funcionales: flujo registro → login → logout; acceso denegado sin sesión

**Criterio de done:** Usuario puede registrarse, iniciar sesión y cerrar sesión.

---

### Etapa 4 — Dashboard administrativo

**Entregables:**
- [ ] Ruta `/dashboard` protegida (solo admin)
- [ ] Vista con resumen: total productos, productos activos
- [ ] Navegación hacia módulo de productos
- [ ] Redirección si usuario no admin intenta acceder

**Pruebas requeridas:**
- Unitarias: decorador/middleware de rol admin
- Funcionales: admin accede; user normal recibe 403 o redirect

**Criterio de done:** Panel admin visible solo para rol administrador.

---

### Etapa 5 — Módulo de productos (CRUD admin)

**Entregables:**
- [ ] Rutas: listar, crear, editar, eliminar productos
- [ ] Formularios con validación (nombre, precio > 0, imagen URL o upload)
- [ ] Vistas admin de productos
- [ ] Toggle activo/inactivo para catálogo público

**Pruebas requeridas:**
- Unitarias: validación de campos producto
- Funcionales: admin crea/edita/elimina; producto inactivo no aparece en catálogo

**Criterio de done:** CRUD completo operativo desde dashboard.

---

### Etapa 6 — Catálogo público y WhatsApp

**Entregables:**
- [ ] Página principal `/` dinámica con grid de productos activos
- [ ] Tarjetas visuales: imagen, nombre, precio, descripción corta
- [ ] Botón "Comprar" → enlace `https://wa.me/{telefono}?text={mensaje_codificado}`
- [ ] Mensaje predefinido: "Hola, quiero comprar: {nombre_producto} - ${precio}"
- [ ] Número WhatsApp configurable en `config/`
- [ ] Diseño responsive verificado en móvil

**Pruebas requeridas:**
- Unitarias: generador de URL WhatsApp en `utils/`
- Funcionales: catálogo muestra solo activos; botón abre URL correcta

**Criterio de done:** Usuario anónimo ve catálogo y al comprar llega a WhatsApp del vendedor.

---

### Etapa 7 — Pulido, testing integral y seguridad

**Entregables:**
- [ ] Revisión responsive completa
- [ ] Mensajes flash de éxito/error
- [ ] Página 404/403 básica
- [ ] Suite de tests unitarios + funcionales ejecutada
- [ ] Checklist de seguridad aplicado

**Pruebas requeridas:**
- Unitarias: cobertura de utils, modelos, validadores
- Funcionales: flujos end-to-end (registro, admin CRUD, catálogo, WhatsApp)

**Criterio de done:** Todos los módulos mínimos requeridos operativos y validados.

## Capa de testing

| Componente | Tipo | Caso de prueba | Resultado esperado |
|------------|------|----------------|-------------------|
| User model | Unitario | Crear usuario con password | Hash almacenado, no texto plano |
| Auth login | Funcional | Login credenciales válidas | Redirect a dashboard o home |
| Auth register | Funcional | Email duplicado | Error visible, no duplicado en BD |
| Product CRUD | Funcional | Admin crea producto | Aparece en listado admin |
| Catálogo | Funcional | GET `/` | Solo productos activos en grid |
| WhatsApp utils | Unitario | `build_whatsapp_url(product)` | URL wa.me válida con mensaje |
| Dashboard | Funcional | User sin rol admin | Acceso denegado |
| Responsive | Funcional | Viewport 375px | Grid catálogo usable en móvil |

## Capa de seguridad

| Ítem checklist | Aplica | Notas |
|----------------|--------|-------|
| Validación de entradas | Sí | Formularios auth y productos |
| Autenticación/autorización | Sí | Login + rol admin para dashboard/CRUD |
| Manejo de secretos | Sí | SECRET_KEY y DB en `.env` |
| Protección XSS/CSRF/injection | Sí | WTForms + escape Jinja2; SQL parametrizado |
| Contraseñas | Sí | Hash bcrypt/werkzeug, nunca en logs |
| WhatsApp URL | Sí | Sanitizar texto del mensaje (urllib.parse.quote) |

## Riesgos y supuestos

### Riesgos

| Riesgo | Impacto | Mitigación |
|--------|---------|------------|
| Imágenes rotas en catálogo | Medio | URL por defecto + validación de imagen |
| Número WhatsApp mal configurado | Alto | Variable en config + test unitario de URL |
| Acceso admin sin protección | Alto | Middleware de rol en todas las rutas admin |
| Frontend no responsive | Medio | Mobile-first con framework CSS |

### Supuestos

- Un solo vendedor con un número WhatsApp fijo
- SQLite suficiente para desarrollo y demo de clase
- Imágenes de productos vía URL externa (no upload en v1)
- Rol `admin` se asigna manualmente o vía seed inicial
- Python 3.10+ disponible en el entorno del grupo

## Registro de progreso

| Fecha | Etapa | Acción | Resultado |
|-------|-------|--------|-----------|
| 2026-06-05 | — | Spec y estructura de carpetas creadas | Estructura lista, sin código |
| | 1 | Pendiente | — |
| | 2 | Pendiente | — |
| | 3 | Pendiente | — |
| | 4 | Pendiente | — |
| | 5 | Pendiente | — |
| | 6 | Pendiente | — |
| | 7 | Pendiente | — |
