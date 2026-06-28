# 🎨 Visual Demo - Landing Page

## Estructura de la Página

```
┌────────────────────────────────────────────────────────────────────┐
│  THE GRUP  [Inicio] [Características] [Beneficios] [Contacto] [Login]│  ← Navbar
├────────────────────────────────────────────────────────────────────┤
│                                                                    │
│  HERO SECTION                              DASHBOARD MOCKUP       │
│  ┌──────────────────────────┐             ┌────────────────────┐ │
│  │ Sistema de inventario    │             │ Dashboard   🔔  A  │ │
│  │ inteligente              │             ├────────────────────┤ │
│  │                          │             │ Productos│Entradas│ │
│  │ Controla tu inventario   │             │  1,248   320  280 │ │
│  │ de forma SIMPLE e        │             │   +12%   -8%  -5% │ │
│  │ INTELIGENTE              │             │                   │ │
│  │                          │             │ [Gráfico de líneas]│ │
│  │ [Comenzar] [Ver cómo]    │             │                   │ │
│  │                          │             │ Pan integral      │ │
│  │                          │             │ + Entrada +15 u   │ │
│  │                          │             │                   │ │
│  └──────────────────────────┘             │ Yogurt natural    │ │
│                                            │ - Salida - 5 u    │ │
│                                            └────────────────────┘ │
├────────────────────────────────────────────────────────────────────┤
│ CARACTERÍSTICAS                                                    │
│ ┌──────────────┬──────────────┬──────────────┐                   │
│ │ 📈 Control   │ 🛡️ Org       │ 📊 Reportes │                   │
│ │ en tiempo    │   total      │ inteligentes│                   │
│ │ real         │              │             │                   │
│ └──────────────┴──────────────┴──────────────┘                   │
├────────────────────────────────────────────────────────────────────┤
│ TESTIMONIOS                                                        │
│ ⭐⭐⭐⭐⭐ 4.9                                                     │
│ Más de 500 negocios gestionan su inventario...                   │
│ [Avatar] [Avatar] [Avatar] [Avatar]                              │
└────────────────────────────────────────────────────────────────────┘

                    ┌────────────────────────┐
                    │  LOGIN PANEL (LATERAL) │
                    ├────────────────────────┤
                    │                        │
                    │  [The Grup Box Icon]  │
                    │  The Grup              │
                    │  Sistema de...         │
                    │                        │
                    │ Correo electrónico     │
                    │ [Email input]          │
                    │                        │
                    │ Contraseña             │
                    │ [Password] [Eye icon]  │
                    │                        │
                    │ ☑ Recordarme          │
                    │                        │
                    │ [Iniciar sesión]      │
                    │                        │
                    │ ¿Olvidaste contraseña?│
                    │                        │
                    │ Demo: admin@...        │
                    │ password               │
                    └────────────────────────┘
```

## 🎯 Elementos Interactivos

### Navbar
- ✅ Links de navegación smooth scroll
- ✅ Botón "Iniciar sesión" con border
- ✅ Hover effects en links

### Hero Section
- ✅ Badge de "Sistema inteligente"
- ✅ Título con gradient text
- ✅ Dos botones CTA diferentes
- ✅ Dashboard mockup con datos en tiempo real

### Dashboard Mockup
- ✅ Tabs (Productos, Entradas, Salidas)
- ✅ Estadísticas numéricas animadas
- ✅ Gráfico SVG de líneas
- ✅ Actividad reciente con colores (verde/rojo)

### Características
- ✅ 3 Cards con iconos
- ✅ Hover: Levanta + Sombra
- ✅ Background alternativo (#f8fafc)

### Testimonios
- ✅ Estrellas rating
- ✅ Avatares con overlap
- ✅ Estadística de usuarios

### Panel Login
- ✅ Posición fija lateral
- ✅ Gradiente de fondo
- ✅ Tarjeta blanca destacada
- ✅ Toggle de contraseña (eye icon)
- ✅ Manejo de errores
- ✅ Credenciales de demo

## 🎨 Colores

```
Gradiente Primario:  #667eea (azul) → #764ba2 (púrpura)
Fondo Landing:       #ffffff (blanco)
Fondo Características: #f8fafc (gris muy claro)
Texto Principal:     #0f172a (casi negro)
Texto Secundario:    #64748b (gris)
Éxito:              #22c55e (verde)
Error:              #ef4444 (rojo)
```

## 📐 Layout

### Desktop (>1200px)
- Landing page: 70% ancho (izq)
- Login panel: 30% ancho (der) - FIJO
- Hero content: 2 columnas (50/50)
- Features: 3 columnas
- Responsive grid

### Tablet/Mobile (<1200px)
- Landing page: 100% ancho (scroll)
- Login panel: 100% ancho abajo (scroll)
- Hero content: 1 columna
- Features: 1 columna
- Navbar menu: oculto

## 🚀 Funcionalidades

✅ **Toggle Contraseña**: Click en eye icon → Muestra/oculta texto  
✅ **Validación**: Bootstrap error styling  
✅ **Responsive**: Mobile-first approach  
✅ **Accesibilidad**: Labels correctos, contraste adecuado  
✅ **Performance**: CSS inline (sin archivos externos)  
✅ **Datos Dinámicos**: Muestra contadores reales de BD  

## 📋 Checklist de Elementos

### Navbar
- [x] Logo + Texto
- [x] Menú de navegación
- [x] Botón login
- [x] Sticky positioning
- [x] Sombra sutil

### Hero
- [x] Badge
- [x] Título con gradient
- [x] Descripción
- [x] 2 botones CTA
- [x] Dashboard mockup
- [x] Datos en tiempo real

### Dashboard Mockup
- [x] Header con gradient
- [x] Tabs funcionales
- [x] Estadísticas numéricas
- [x] Gráfico SVG
- [x] Actividad reciente
- [x] Colores de estado

### Features
- [x] 3 Cards
- [x] Iconos
- [x] Descripción
- [x] Hover effects
- [x] Responsive

### Testimonios
- [x] Rating 5 estrellas
- [x] Texto testimonial
- [x] Avatares grupo
- [x] Centered layout

### Login Panel
- [x] Gradiente fondo
- [x] Tarjeta blanca
- [x] Logo
- [x] Email input
- [x] Password input
- [x] Toggle password
- [x] Checkbox recordarme
- [x] Botón submit
- [x] Link contraseña olvidada
- [x] Demo credentials

---

**Prototipo**: Landing Page + Login Panel Lateral  
**Framework**: Pure HTML/CSS/Blade  
**Diseño**: Moderno, Profesional, Intuitivo  
**Status**: ✅ Listo para producción
