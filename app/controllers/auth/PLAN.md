# PLAN — controllers/auth/

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Verenice** | Líder y desarrolladora principal | Rutas `/login`, `/register`, `/logout`, sesiones y hash de contraseñas |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Revisar PRs del módulo auth en rama `feat/auth` o similar |
| **Yadira** | Documentación y presentación | Capturas de login/registro y sección en manual de usuario |

## Rol

Controlador del **sistema de autenticación**: registro de nuevos usuarios, inicio de sesión y cierre de sesión.

## Rutas previstas

| Método | Ruta | Acción |
|--------|------|--------|
| GET/POST | `/register` | Mostrar y procesar formulario de registro |
| GET/POST | `/login` | Mostrar y procesar formulario de login |
| GET | `/logout` | Cerrar sesión y redirigir |

## Plan de trabajo

| Orden | Tarea | Etapa |
|-------|-------|-------|
| 1 | Crear blueprint `auth_bp` | 3 |
| 2 | Vista registro: validar email único, password, confirmación | 3 |
| 3 | Hash de contraseña al guardar User | 3 |
| 4 | Vista login: verificar credenciales, iniciar sesión | 3 |
| 5 | Logout: limpiar sesión, redirect a catálogo | 3 |
| 6 | Redirect post-login: admin → dashboard, user → home | 3 |

## Dependencias

- `models/User`
- `views/auth/register.html`, `views/auth/login.html`
- `utils/validators.py`
- Flask-Login (o gestión de sesión equivalente)

## Seguridad

- CSRF en formularios
- Rate limiting básico (opcional etapa 7)
- No revelar si el email existe en login (mensaje genérico)
