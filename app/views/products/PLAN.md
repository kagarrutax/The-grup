# PLAN — views/products/

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Jessica** | Frontend y responsive | Tabla de productos, formularios CRUD y diseño admin |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Revisar PR de tablas y formularios CRUD |
| **Yadira** | Documentación y presentación | Capturas de listado y formulario de productos |

## Rol

Vistas del **módulo de gestión de productos** en el panel administrativo.

## Archivos previstos

| Archivo | Descripción |
|---------|-------------|
| `list.html` | Tabla/listado de productos con acciones |
| `form.html` | Formulario crear/editar (reutilizable) |
| `_product_row.html` | Partial fila de tabla (opcional) |

## Plan de trabajo

| Orden | Tarea | Etapa |
|-------|-------|-------|
| 1 | `list.html` con tabla responsive (scroll horizontal en móvil) | 5 |
| 2 | Columnas: imagen mini, nombre, precio, activo, acciones | 5 |
| 3 | Acciones: Editar, Eliminar, Toggle activo | 5 |
| 4 | `form.html` campos: nombre, descripción, precio, imagen_url, activo | 5 |
| 5 | Preview de imagen al ingresar URL (JS opcional etapa 7) | 5 |
| 6 | Botón "Nuevo producto" en listado | 5 |

## Campos del formulario

| Campo | Validación UI |
|-------|---------------|
| nombre | Requerido, max 100 chars |
| descripcion | Opcional, textarea |
| precio | Número positivo |
| imagen_url | URL válida |
| activo | Checkbox |
