# PLAN — config/

## Rol

Centraliza la **configuración de la aplicación**: variables de entorno, claves secretas, URL de base de datos y parámetros del vendedor (número WhatsApp).

## Responsabilidades

- Cargar variables desde `.env` (SECRET_KEY, DATABASE_URL, WHATSAPP_PHONE)
- Definir perfiles: desarrollo / producción / testing
- Inicializar extensión de base de datos
- Exponer configuración a la factory de la app

## Plan de trabajo

| Orden | Tarea | Etapa |
|-------|-------|-------|
| 1 | Crear clase `Config` base con SECRET_KEY y SQLAlchemy URI | 1 |
| 2 | Crear `DevelopmentConfig` y `TestingConfig` | 1 |
| 3 | Registrar `WHATSAPP_PHONE` del vendedor | 1 |
| 4 | Función `init_db(app)` para crear tablas | 2 |
| 5 | Seed de usuario admin inicial (opcional) | 2 |

## Archivos previstos

| Archivo | Descripción |
|---------|-------------|
| `__init__.py` | Exporta configuraciones |
| `settings.py` | Clases de configuración por entorno |
| `database.py` | Inicialización BD (si se separa de settings) |

## Seguridad

- Nunca commitear `.env` real
- SECRET_KEY única por entorno
- WHATSAPP_PHONE solo dígitos (sin + ni espacios)
