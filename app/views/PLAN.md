# PLAN — views/

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Jessica** | Frontend y responsive | Diseño visual, responsive y coherencia UI en todas las vistas |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Revisar PRs que modifiquen plantillas HTML |
| **Yadira** | Documentación y presentación | Coordinar capturas de todas las vistas para entrega académica |

## Rol

Capa **View** del MVC. Plantillas HTML (Jinja2) que presentan datos al usuario. Sin lógica de negocio; solo renderizado y componentes UI.

## Estructura por módulo

| Subcarpeta | Vistas previstas | Módulo |
|------------|------------------|--------|
| `layouts/` | `base.html`, `admin.html` | Compartido |
| `auth/` | `login.html`, `register.html` | Login + Registro |
| `catalog/` | `index.html` | Página principal |
| `dashboard/` | `index.html` | Panel admin |
| `products/` | `list.html`, `form.html` | CRUD productos |

## Plan de trabajo

| Orden | Tarea | Etapa |
|-------|-------|-------|
| 1 | Layout base responsive con navbar y footer | 1 |
| 2 | Layout admin con sidebar o nav secundaria | 4 |
| 3 | Vistas auth con formularios WTForms | 3 |
| 4 | Vista dashboard con cards de métricas | 4 |
| 5 | Vistas products: tabla + formulario | 5 |
| 6 | Vista catalog: grid de tarjetas + botón WhatsApp | 6 |
| 7 | Páginas `errors/404.html`, `403.html` | 7 |

## Principios UI

- Extender siempre de `layouts/base.html`
- Mobile-first (Bootstrap 5 o Tailwind)
- Botón "Comprar" visible y accesible en cada tarjeta de producto
- Mensajes flash para feedback al usuario

## WhatsApp en vista

El botón Comprar será un enlace `<a href="{{ product.whatsapp_url }}" target="_blank">` generado en el controlador o vía filtro Jinja.
