# PLAN — controllers/catalog/

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Verenice** | Líder y desarrolladora principal | Ruta `/`, consulta de productos activos e inyección de URL WhatsApp |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Revisar PRs de la ruta `/` y catálogo público |
| **Yadira** | Documentación y presentación | Capturas de página principal y flujo de compra por WhatsApp |

## Rol

Controlador de la **página principal dinámica**. Expone el catálogo visual público de productos activos al visitante anónimo o autenticado.

## Rutas previstas

| Método | Ruta | Acción |
|--------|------|--------|
| GET | `/` | Listar productos activos y renderizar catálogo |

## Plan de trabajo

| Orden | Tarea | Etapa |
|-------|-------|-------|
| 1 | Crear blueprint `catalog_bp` | 6 |
| 2 | Consultar `Product` donde `activo=True`, ordenados por fecha | 6 |
| 3 | Pasar lista a vista con datos para botón WhatsApp | 6 |
| 4 | Inyectar `whatsapp_url` por producto vía `utils/whatsapp.py` | 6 |
| 5 | Manejar catálogo vacío con mensaje amigable | 6 |

## Dependencias

- `models/Product`
- `views/catalog/index.html`
- `utils/whatsapp.py`
- `config/` → WHATSAPP_PHONE

## Criterio visual

- Grid responsive de tarjetas (imagen, nombre, precio, botón Comprar)
- Mobile-first: 1 columna móvil, 2 tablet, 3+ desktop
