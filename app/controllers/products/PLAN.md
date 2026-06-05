# PLAN — controllers/products/

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Verenice** | Líder y desarrolladora principal | CRUD completo, validación servidor y toggle activo/inactivo |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Revisar PRs del CRUD en `/admin/products` |
| **Yadira** | Documentación y presentación | Capturas de gestión de productos para manual administrador |

## Rol

Controlador del **módulo de productos**. CRUD completo restringido a administradores.

## Rutas previstas

| Método | Ruta | Acción |
|--------|------|--------|
| GET | `/admin/products` | Listar todos los productos |
| GET/POST | `/admin/products/new` | Crear producto |
| GET/POST | `/admin/products/<id>/edit` | Editar producto |
| POST | `/admin/products/<id>/delete` | Eliminar producto |
| POST | `/admin/products/<id>/toggle` | Activar/desactivar en catálogo |

## Plan de trabajo

| Orden | Tarea | Etapa |
|-------|-------|-------|
| 1 | Crear blueprint `products_bp` con prefijo `/admin/products` | 5 |
| 2 | Listado con acciones editar/eliminar/toggle | 5 |
| 3 | Formulario crear: nombre, descripción, precio, imagen_url, activo | 5 |
| 4 | Formulario editar con datos precargados | 5 |
| 5 | Validación servidor: precio > 0, nombre obligatorio | 5 |
| 6 | Confirmación antes de eliminar | 5 |
| 7 | Flash messages éxito/error | 5 |

## Dependencias

- `models/Product`
- `views/products/` (list, form, delete_confirm)
- `@admin_required`

## Regla de negocio

Solo productos con `activo=True` aparecen en `controllers/catalog/` (página principal).
