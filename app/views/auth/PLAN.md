# PLAN — views/auth/

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Jessica** | Frontend y responsive | Diseño de formularios login/registro, responsive y UX |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Revisar PR de formularios login y registro |
| **Yadira** | Documentación y presentación | Capturas desktop y móvil de pantallas de auth |

## Rol

Vistas del **sistema de registro y login**. Formularios accesibles y responsive para autenticación de usuarios.

## Archivos previstos

| Archivo | Descripción |
|---------|-------------|
| `login.html` | Formulario email + contraseña |
| `register.html` | Formulario nombre + email + contraseña + confirmación |

## Plan de trabajo

| Orden | Tarea | Etapa |
|-------|-------|-------|
| 1 | `login.html` extendiendo `layouts/base.html` | 3 |
| 2 | `register.html` con validación visual de campos | 3 |
| 3 | Mostrar errores de formulario por campo | 3 |
| 4 | Link cruzado: "¿No tienes cuenta? Regístrate" | 3 |
| 5 | Diseño centrado, usable en móvil (inputs full-width) | 3 |

## Campos del formulario

**Registro:** nombre, email, password, password_confirm  
**Login:** email, password

## Seguridad en vista

- Token CSRF en cada formulario
- No mostrar contraseñas en value attributes tras error
