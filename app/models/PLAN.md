# PLAN — models/

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Verenice** | Líder y desarrolladora principal | Modelos User y Product, hash de contraseñas y consultas a BD |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Verificar que archivos de BD local no se commiteen |
| **Yadira** | Documentación y presentación | Diagrama de entidades User y Product en manual técnico |

## Rol

Capa **Model** del MVC. Define entidades de datos, relaciones y acceso a la base de datos (SQLAlchemy).

## Entidades previstas

### User

| Campo | Tipo | Notas |
|-------|------|-------|
| id | Integer PK | Autoincrement |
| email | String unique | Login |
| password_hash | String | Nunca texto plano |
| nombre | String | Display name |
| rol | Enum/string | `admin` \| `user` |
| created_at | DateTime | Auditoría |

### Product

| Campo | Tipo | Notas |
|-------|------|-------|
| id | Integer PK | Autoincrement |
| nombre | String | Obligatorio |
| descripcion | Text | Para catálogo |
| precio | Decimal/Float | > 0 |
| imagen_url | String | URL imagen externa |
| activo | Boolean | Visible en catálogo público |
| created_at | DateTime | Orden en catálogo |

## Plan de trabajo

| Orden | Tarea | Etapa |
|-------|-------|-------|
| 1 | Configurar SQLAlchemy y base declarativa | 2 |
| 2 | Implementar modelo `User` con `set_password()` / `check_password()` | 2 |
| 3 | Implementar modelo `Product` | 2 |
| 4 | Métodos de consulta: `Product.get_active()`, `User.find_by_email()` | 2 |
| 5 | Seed admin: `admin@thegrup.local` (cambiar en producción) | 2 |

## Archivos previstos

| Archivo | Descripción |
|---------|-------------|
| `__init__.py` | Instancia `db` y imports |
| `user.py` | Modelo User |
| `product.py` | Modelo Product |

## Seguridad

- Password siempre hasheado (werkzeug.security o bcrypt)
- No serializar `password_hash` en respuestas JSON/HTML
