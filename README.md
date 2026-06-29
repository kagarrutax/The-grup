# The-grup ✅

Sistema de **inventario para supermercado** — Laravel 12, MySQL, MVC, Bootstrap 5.3.3 + Icons 1.11.3

Enfoque **spec-as-source**: planificar → aprobar → implementar por fases.

## 🟢 Estado Actual

✅ **Aplicación Operacional** — Laravel 12.62.0 con PHP 8.2.28  
✅ **Landing Page Profesional** — Diseño moderno con navbar, hero, características, testimonios  
✅ **Panel de Login Lateral** — Diseño elegante con gradiente y animaciones  
✅ **Modals Implementados** — Ver/Editar/Eliminar productos y perfil admin  
✅ **Diseño Moderno** — Gradientes, animaciones y responsivo  
✅ **BD Sincronizada** — 7/7 migraciones ejecutadas  

**[👉 Detalles del Diseño en LANDING_PAGE.md](LANDING_PAGE.md)**

## ⚙️ Setup Rápido

### 1. Configurar PHP 8.2 (REQUERIDO)
```powershell
# Como administrador
.\set-php82.ps1
```

### 2. Iniciar Aplicación
```bash
cd app
php artisan serve
```

### 3. Acceder
```
http://the-grup.test  (Laragon)
http://localhost:8000 (artisan serve)
```

## 🎨 Diseño Visual

### Landing Page
- Navbar profesional con navegación
- Sección Hero con CTA (Comenzar ahora)
- Dashboard mockup interactivo
- Características principales (3 cards)
- Testimonios y ratings

### Login Panel
- Panel lateral fijo (450px)
- Gradiente azul/púrpura
- Tarjeta blanca con formulario
- Toggle de contraseña
- Credenciales de demo

## Stack

Laravel 12 · MySQL · Blade · Bootstrap 5.3.3 · Icons 1.11.3 · AJAX/Fetch · CSS Moderno

## Estructura

| Carpeta | Rol |
|---------|-----|
| [`spec/`](spec/) | Planes detallados |
| [`skill/`](skill/) | Guías de ejecución IA |
| [`app/`](app/) | Proyecto Laravel |
| [`docs/`](docs/) | Documentación y entrega |

## Equipo

Verenice · Jessica · Yadira · Elda · Adrian

Guía de roles: [`spec/guia-roles-equipo.md`](spec/guia-roles-equipo.md)

Spec activa: [`spec/001-inventario-supermercado.md`](spec/001-inventario-supermercado.md)

## Preview frontend (Jessica)

Interfaz mock lista en `app/public/` — **sin backend**, datos de demo.

```bash
git pull origin Adrian
```

Abrir en XAMPP:

```
http://localhost/The-grup/app/public/login.php
http://localhost/The-grup/app/public/dashboard.php
```

**Instalar dependencias** (una vez, requiere Node.js):

```bash
cd app/public
npm install
```

Páginas: productos, categorías, movimientos, búsqueda, ventas, compras, usuarios, reportes.

Guía completa: [`app/public/README.md`](app/public/README.md) · Spec UI: [`spec/002-frontend-ui-ux.md`](spec/002-frontend-ui-ux.md)
