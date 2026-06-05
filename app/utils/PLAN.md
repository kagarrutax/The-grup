# PLAN — utils/

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Verenice** | Líder y desarrolladora principal | Enlace WhatsApp, decoradores admin y validadores |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Revisar PR de `whatsapp.py` y validadores; sin secretos hardcodeados |
| **Yadira** | Documentación y presentación | Documentar enlace `wa.me` con ejemplo real en manual de usuario |

## Rol

Utilidades transversales: helpers que no pertenecen a un solo controlador. Incluye generación del enlace WhatsApp y decoradores de autorización.

## Archivos previstos

| Archivo | Etapa | Propósito |
|---------|-------|-----------|
| `whatsapp.py` | 6 | `build_whatsapp_url(phone, product)` |
| `decorators.py` | 4 | `@admin_required`, `@login_required` |
| `validators.py` | 3 | Validación email, fortaleza password |

## Plan de trabajo — WhatsApp (crítico)

| Paso | Descripción |
|------|-------------|
| 1 | Leer `WHATSAPP_PHONE` de config (solo dígitos, ej. `573001234567`) |
| 2 | Construir mensaje: `"Hola, quiero comprar: {nombre} - ${precio}"` |
| 3 | Codificar con `urllib.parse.quote` |
| 4 | Retornar `https://wa.me/{phone}?text={mensaje}` |

## Ejemplo de URL resultante

```
https://wa.me/573001234567?text=Hola%2C%20quiero%20comprar%3A%20Camiseta%20-%20%2425.00
```

## Plan de trabajo — Decoradores

1. `login_required`: redirect a `/login` si no hay sesión
2. `admin_required`: abort 403 o redirect si `current_user.rol != 'admin'`

## Tests

Tests unitarios obligatorios en `tests/unit/test_whatsapp.py` (etapa 6).
