# PLAN — views/dashboard/

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Jessica** | Frontend y responsive | Diseño del panel admin, cards de métricas y navegación |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Revisar PR de vista del panel administrativo |
| **Yadira** | Documentación y presentación | Captura del dashboard en slides de exposición |

## Rol

Vista del **dashboard administrativo básico**. Punto central para el admin tras autenticarse.

## Archivos previstos

| Archivo | Descripción |
|---------|-------------|
| `index.html` | Panel con métricas y accesos rápidos |

## Plan de trabajo

| Orden | Tarea | Etapa |
|-------|-------|-------|
| 1 | Extender `layouts/admin.html` | 4 |
| 2 | Card: total de productos | 4 |
| 3 | Card: productos activos / inactivos | 4 |
| 4 | Botón principal: "Gestionar productos" → `/admin/products` | 4 |
| 5 | Link secundario: "Ver tienda" → `/` | 4 |
| 6 | Bienvenida personalizada con nombre del admin | 4 |

## Contenido mínimo

- Resumen numérico del inventario
- Navegación clara hacia módulo de productos
- Sin gráficos complejos (v1 básica)
