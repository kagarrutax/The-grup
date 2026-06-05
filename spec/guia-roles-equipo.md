# Guía de roles — Equipo The-grup

> **Proyecto:** Catálogo de productos con contacto WhatsApp (Python MVC)  
> **Uso:** Repartir responsabilidades, evitar solapamientos y definir entregables por persona  
> **Última actualización:** 2026-06-05

---

## Resumen del equipo

| Integrante | Rol | Enfoque principal |
|------------|-----|-------------------|
| **Verenice** | Líder y desarrolladora principal | Backend MVC, lógica de negocio, coordinación |
| **Jessica** | Frontend y responsive | Diseño visual, UI/UX, adaptación móvil |
| **Yadira** | Documentación y presentación · Coordinación de entregables académicos | Manuales, capturas, diapositivas, checklist de entrega |
| **Elda** | Validaciones | Pruebas funcionales, revisión de formularios |
| **Adrian** | GitHub y organización · Revisión e integración de código | Repositorio, estructura, revisión de PRs y merges |

> **PDF para el equipo:** [`docs/guia-roles-equipo.pdf`](../docs/guia-roles-equipo.pdf)

### Encargados en `app/PLAN.md`

Cada carpeta de `app/` incluye en su `PLAN.md`:
- **Encargado** — integrante principal del módulo
- **Participación GitHub y documentación** — tareas concretas de **Adrian** (PRs, merges) y **Yadira** (capturas, manuales)

| Integrante | Carpetas donde es encargado principal |
|------------|--------------------------------------|
| **Verenice** | Raíz, `config/`, `controllers/`, `models/`, `utils/` |
| **Jessica** | `views/`, `static/` |
| **Elda** | `tests/` |

**Yadira** y **Adrian** no tienen carpeta propia en `app/`; su trabajo está en `docs/` y en la organización del repositorio (ver secciones de cada uno más abajo).

---

## Matriz completa — participación por carpeta

Resumen de quién lidera y quién apoya en cada módulo:

| Carpeta | Verenice | Jessica | Yadira | Elda | Adrian |
|---------|-----|---------|--------|------|--------|
| `app/` (raíz) | Principal | Apoyo | Apoyo | Apoyo | Apoyo |
| `config/` | Principal | Supervisión | Apoyo | Apoyo | Apoyo |
| `controllers/` | Principal | Apoyo | Apoyo | Apoyo | Apoyo |
| `controllers/auth/` | Principal | Apoyo | Apoyo | Apoyo | Apoyo |
| `controllers/catalog/` | Principal | Apoyo | Apoyo | Apoyo | Apoyo |
| `controllers/dashboard/` | Principal | Apoyo | Apoyo | Apoyo | Apoyo |
| `controllers/products/` | Principal | Apoyo | Apoyo | Apoyo | Apoyo |
| `models/` | Principal | Supervisión | Apoyo | Apoyo | Apoyo |
| `views/` | Principal | Principal | Apoyo | Apoyo | Apoyo |
| `views/layouts/` | Principal | Principal | Apoyo | Apoyo | Supervisión |
| `views/auth/` | Apoyo | Principal | Apoyo | Apoyo | Supervisión |
| `views/catalog/` | Apoyo | Principal | Apoyo | Apoyo | Supervisión |
| `views/dashboard/` | Apoyo | Principal | Apoyo | Apoyo | Supervisión |
| `views/products/` | Apoyo | Principal | Apoyo | Apoyo | Supervisión |
| `static/` | Apoyo | Principal | Apoyo | Apoyo | Apoyo |
| `static/css/` | Supervisión | Principal | Apoyo | Apoyo | Supervisión |
| `static/js/` | Apoyo | Principal | Supervisión | Apoyo | Supervisión |
| `static/img/` | Supervisión | Principal | Apoyo | Apoyo | Apoyo |
| `utils/` | Principal | Supervisión | Apoyo | Apoyo | Apoyo |
| `tests/` | Apoyo | Apoyo | Apoyo | Principal | Apoyo |
| `tests/unit/` | Apoyo | Supervisión | Apoyo | Principal | Apoyo |
| `tests/functional/` | Apoyo | Apoyo | Apoyo | Principal | Apoyo |

---

## Verenice — Líder y desarrolladora principal

### Responsabilidad

Desarrollo del núcleo del sistema bajo arquitectura **Monolítica MVC** en Python. Coordina el avance técnico y resuelve bloqueos de integración.

### Ámbito de trabajo (`app/`)

| Módulo | Carpetas | Entregables |
|--------|----------|-------------|
| Arquitectura MVC | `controllers/`, `models/`, `config/` | Factory de app, blueprints, modelos User y Product |
| Login y registro | `controllers/auth/`, `models/` | Rutas `/login`, `/register`, `/logout`, sesiones |
| Dashboard admin | `controllers/dashboard/` | Ruta `/dashboard` protegida (solo admin) |
| Módulo productos | `controllers/products/`, `models/` | CRUD completo en `/admin/products` |
| WhatsApp | `utils/` | Generación de enlace `wa.me` al comprar |
| Coordinación | Todas | Integrar cambios del equipo sin romper MVC |

### Qué NO hace (delegado)

- Diseño visual detallado → Jessica
- Documentación para presentación → Yadira
- Ejecución formal de pruebas → Elda
- Gestión del repositorio y PRs → Adrian

### Criterios de entrega

- [ ] App arranca sin errores en local
- [ ] Login, registro y roles funcionan
- [ ] CRUD de productos operativo para admin
- [ ] Catálogo público muestra productos activos
- [ ] Botón Comprar redirige a WhatsApp del vendedor

### Comunicación con el equipo

- Informar a Jessica cuando las vistas base estén listas para estilizar
- Entregar a Elda builds estables por etapa para validar
- Coordinar con Adrian antes de merges importantes a `main`

---

## Jessica — Frontend y responsive

### Responsabilidad

Diseño visual moderno, organización de la interfaz y **adaptación responsive** a móvil, tablet y escritorio.

### Ámbito de trabajo (`app/`)

| Área | Carpetas | Entregables |
|------|----------|-------------|
| Estilos globales | `static/css/` | `main.css`, variables, tipografía, colores |
| Catálogo visual | `static/css/`, `views/catalog/` | Grid de tarjetas, botón Comprar destacado |
| Auth UI | `views/auth/`, `static/css/` | Formularios login/registro centrados y legibles |
| Panel admin | `views/dashboard/`, `views/products/`, `static/css/` | Tablas, formularios y dashboard ordenados |
| Layout base | `views/layouts/` | Navbar colapsable, footer, estructura responsive |
| Assets | `static/img/` | Logo, placeholder de producto, favicon |
| Interacciones | `static/js/` | Menú móvil, mejoras UX (sin lógica de negocio) |

### Qué NO hace (delegado)

- Lógica de rutas, modelos ni base de datos → Verenice
- Redacción de documentación académica → Yadira
- Casos de prueba y reporte de bugs → Elda
- Commits, branches y estructura de repo → Adrian

### Criterios de entrega

- [ ] Interfaz coherente en todas las pantallas
- [ ] Catálogo usable en pantallas desde 320px
- [ ] Navbar funcional en móvil (menú colapsable)
- [ ] Formularios legibles y accesibles en touch
- [ ] Botón Comprar visible en cada tarjeta de producto

### Breakpoints sugeridos

| Dispositivo | Ancho | Comportamiento catálogo |
|-------------|-------|-------------------------|
| Móvil | < 576px | 1 columna |
| Tablet | 576–992px | 2 columnas |
| Desktop | > 992px | 3–4 columnas |

### Dependencias

- Esperar layouts base de Verenice (`views/layouts/base.html`) antes de estilizar
- Usar clases/IDs acordados con Verenice para no romper plantillas Jinja

---

## Yadira — Documentación y presentación · Coordinación de entregables académicos

### Responsabilidad

**Rol 1 — Documentación y presentación:** manuales, capturas de pantalla y material de presentación (diapositivas).

**Rol 2 — Coordinación de entregables académicos:** seguimiento del checklist de entrega del equipo, índice de documentos y armado del paquete final para la exposición de clase.

### Ámbito de trabajo

| Área | Ubicación sugerida | Entregables |
|------|-------------------|-------------|
| Manual de usuario | `docs/` o anexo del repo | Cómo registrarse, navegar catálogo, comprar vía WhatsApp |
| Manual técnico resumido | `docs/` | Arquitectura MVC, módulos, tecnologías usadas |
| Capturas de pantalla | Carpeta `docs/screenshots/` | Home, login, registro, dashboard, CRUD, móvil |
| Presentación | `.pptx` o Google Slides | Objetivo, arquitectura, demo, roles del equipo |
| Glosario | `docs/` | Términos: MVC, blueprint, catálogo, WhatsApp API link |
| Checklist de entrega | `docs/` | Estado de entregables por integrante y fecha límite |
| Paquete final | `docs/entrega/` | Documentos reunidos listos para presentar |

### Qué NO hace (delegado)

- Escribir código Python o CSS → Verenice / Jessica
- Ejecutar pruebas formales → Elda
- Configurar GitHub ni permisos → Adrian
- Revisar ni mergear código → Adrian

### Criterios de entrega

- [ ] Documento con índice y capturas etiquetadas
- [ ] Slides: portada, problema, solución, arquitectura, demo, equipo, conclusiones
- [ ] Capturas en desktop y móvil (mínimo 6 pantallas clave)
- [ ] Sección "Cómo comprar por WhatsApp" con ejemplo real
- [ ] Checklist de entregables del equipo completado
- [ ] Paquete final en `docs/entrega/` organizado y revisado

### Pantallas obligatorias para capturas

1. Página principal (catálogo)
2. Detalle visual de tarjeta con botón Comprar
3. Login
4. Registro
5. Dashboard administrativo
6. Listado / formulario de productos
7. Vista móvil del catálogo

### Dependencias

- Solicitar a Jessica builds visuales finales para capturas
- Solicitar a Verenice descripción técnica breve de módulos
- Coordinar con Adrian la ubicación final de `docs/` en el repo

---

## Elda — Validaciones

### Responsabilidad

Probar el sistema de punta a punta: formularios, flujos de usuario, permisos y comportamiento del catálogo y WhatsApp.

### Ámbito de trabajo

| Área | Referencia | Entregables |
|------|------------|-------------|
| Pruebas funcionales | `app/tests/functional/` | Casos documentados (puede ejecutarlos o probar manualmente) |
| Pruebas unitarias | `app/tests/unit/` | Revisar cobertura de utils y modelos |
| Formularios | `views/auth/`, `views/products/` | Matriz de validación (campos vacíos, datos inválidos) |
| Seguridad básica | `skill/spec-as-source/security-checklist.md` | Checklist completado por etapa |
| Reporte de bugs | Issue o documento | Descripción, pasos, resultado esperado vs actual |

### Qué NO hace (delegado)

- Corregir bugs en código → Verenice (Jessica si es solo CSS)
- Escribir documentación de presentación → Yadira
- Gestionar ramas ni merges → Adrian

### Matriz de pruebas obligatorias

| # | Caso | Resultado esperado |
|---|------|-------------------|
| 1 | Registro con email válido | Usuario creado, redirect o mensaje éxito |
| 2 | Registro con email duplicado | Error, no se duplica en BD |
| 3 | Login credenciales correctas | Sesión iniciada |
| 4 | Login credenciales incorrectas | Error genérico, sin sesión |
| 5 | Usuario normal accede `/dashboard` | Acceso denegado |
| 6 | Admin accede `/dashboard` | Panel visible |
| 7 | Admin crea producto | Aparece en listado admin |
| 8 | Producto inactivo | No aparece en página principal |
| 9 | Producto activo en `/` | Visible en catálogo |
| 10 | Clic en Comprar | Abre WhatsApp con mensaje y producto correctos |
| 11 | Formulario producto precio ≤ 0 | Rechazado con error |
| 12 | Vista móvil catálogo | Grid usable, botón Comprar accesible |

### Criterios de entrega

- [ ] Matriz de pruebas completada (PASS/FAIL por caso)
- [ ] Lista de bugs con prioridad (Alta/Media/Baja)
- [ ] Checklist de seguridad revisado
- [ ] Validación final firmada antes de presentación

### Dependencias

- Recibir de Verenice URL local y credenciales de prueba (admin y user)
- Reportar bugs con captura cuando sea posible (coordinar con Yadira)

---

## Adrian — GitHub y organización · Revisión e integración de código

### Responsabilidad

**Rol 1 — GitHub y organización:** estructura de carpetas, buenas prácticas Git, README y documentación final en el repositorio.

**Rol 2 — Revisión e integración de código:** revisar pull requests del equipo, coordinar merges a `main` y verificar que los cambios integrados respeten MVC y no rompan funcionalidades.

### Ámbito de trabajo

| Área | Ubicación | Entregables |
|------|-----------|-------------|
| Estructura del repo | Raíz: `spec/`, `skill/`, `app/` | Verificar que cada carpeta tenga su propósito claro |
| README principal | `README.md` | Instalación, requisitos, cómo ejecutar, equipo |
| `.gitignore` | Raíz | Excluir `.env`, `__pycache__`, BD local, venv |
| Flujo Git | Ramas | `main` estable, `develop` o ramas por feature |
| Pull Requests | GitHub | Descripción clara, revisión antes de merge |
| Releases / tags | GitHub | Tag de versión para entrega (ej. `v1.0.0`) |
| Organización `app/` | `app/README.md`, `PLAN.md` | Confirmar que MVC se respeta |
| Revisión de PRs | GitHub | Comentarios, aprobación y merge coordinado |
| Integración | Ramas `feat/*` | Resolver conflictos menores o escalar a Verenice |

### Qué NO hace (delegado)

- Desarrollo de lógica backend → Verenice
- Diseño CSS → Jessica
- Redacción de slides → Yadira
- Ejecución de pruebas → Elda

### Criterios de entrega (revisión e integración)

- [ ] Todos los PRs revisados antes de merge a `main`
- [ ] Sin conflictos sin resolver en rama principal
- [ ] Código integrado pasa tests (coordinar con Elda)
- [ ] Estructura MVC respetada tras cada merge

### Convenciones Git sugeridas

| Elemento | Convención |
|----------|------------|
| Commits | `feat:`, `fix:`, `docs:`, `style:`, `test:` |
| Ramas | `feat/login`, `feat/catalogo`, `fix/whatsapp-url` |
| PR | Una funcionalidad por PR, descripción + captura si hay UI |
| Protección | No push directo a `main` sin revisión |

### Criterios de entrega

- [ ] Repo clonable y ejecutable siguiendo README
- [ ] Sin archivos sensibles commiteados (`.env`, contraseñas)
- [ ] Historial de commits legible por módulo
- [ ] README con tabla de roles del equipo
- [ ] Tag de entrega final en GitHub

### Checklist de estructura esperada

```
The-grup/
├── spec/          ← Planes (no código de app)
├── skill/         ← Guías para IA (no código de app)
├── app/           ← Aplicación MVC Python
├── docs/          ← Documentación Yadira (cuando exista)
├── README.md
├── .gitignore
└── requirements.txt   (cuando Verenice lo genere)
```

---

## Flujo de trabajo entre roles

```
┌─────────────┐     layouts + lógica      ┌─────────────┐
│     Verenice      │ ────────────────────────► │   Jessica   │
│  (Backend)  │ ◄── estilos integrados ── │ (Frontend)  │
└──────┬──────┘                           └─────────────┘
       │ build estable
       ▼
┌─────────────┐     bugs reportados       ┌─────────────┐
│    Elda     │ ────────────────────────► │     Verenice      │
│ (Validación)│                           │  (corrección)│
└──────┬──────┘                           └─────────────┘
       │ sistema validado
       ▼
┌─────────────┐     capturas + texto        ┌─────────────┐
│   Yadira    │ ◄────────────────────────── │ Jessica/Elda│
│   (Docs)    │                             └─────────────┘
└──────┬──────┘
       │ docs listos
       ▼
┌─────────────┐
│   Adrian    │  merge final, tag, README
│  (GitHub)   │
└─────────────┘
```

---

## Cronograma sugerido por etapas

| Etapa | Responsable principal | Apoyos |
|-------|----------------------|--------|
| 1 — Esqueleto MVC | Verenice | Jessica (estilos base), Adrian (estructura) |
| 2 — Modelos | Verenice | Elda (revisar datos de prueba) |
| 3 — Auth | Verenice | Jessica (UI forms), Elda (matriz login/registro) |
| 4 — Dashboard | Verenice | Jessica (UI admin) |
| 5 — CRUD productos | Verenice | Jessica (tablas/forms), Elda (validar CRUD) |
| 6 — Catálogo + WhatsApp | Verenice | Jessica (grid responsive), Elda (probar wa.me) |
| 7 — Cierre | Todos | Elda (validación final), Yadira (docs), Adrian (release) |

---

## Reglas de convivencia en el equipo

1. **Una persona, un dominio principal** — evitar que dos personas editen el mismo archivo sin avisar.
2. **Comunicar antes de integrar** — avisar en el grupo antes de mergear a rama compartida.
3. **No commitear secretos** — `.env` siempre fuera del repo (Adrian verifica).
4. **Bugs con contexto** — Elda reporta con pasos; Verenice o Jessica corrigen según el área.
5. **Presentación con datos reales** — Yadira usa el sistema funcionando, no mockups falsos.
6. **Respetar MVC** — Jessica no pone lógica de negocio en JS; Verenice no redefine diseño sin coordinar.

---

## Contacto y escalación

| Situación | Contactar primero |
|-----------|-------------------|
| Error en ruta, BD o login | Verenice |
| Se ve mal en móvil o colores | Jessica |
| Falta texto en manual o slides | Yadira |
| Algo no funciona al probar | Elda → reporta → Verenice |
| Conflicto en Git o estructura | Adrian |
| Bloqueo general del proyecto | Verenice (líder) |

---

*Documento para distribución interna del equipo. Alineado con [`001-catalogo-productos-whatsapp.md`](001-catalogo-productos-whatsapp.md).*
