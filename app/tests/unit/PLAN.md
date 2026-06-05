# PLAN — tests/unit/

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Elda** | Validaciones | Definir y revisar casos unitarios (modelos, WhatsApp, validadores) |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Verificar que PRs incluyan o no rompan tests unitarios |
| **Yadira** | Documentación y presentación | Resumen de cobertura unitaria en manual técnico |

## Rol

Pruebas **unitarias** aisladas: sin peticiones HTTP completas cuando sea posible.

## Archivos previstos

| Archivo | Etapa | Casos |
|---------|-------|-------|
| `test_user_model.py` | 2 | set_password, check_password, email unique |
| `test_product_model.py` | 2 | campos obligatorios, get_active |
| `test_whatsapp.py` | 6 | URL válida, mensaje codificado, phone sin símbolos |
| `test_validators.py` | 3 | email inválido, password corta |

## Casos críticos — WhatsApp

```text
test_build_url_includes_product_name
test_build_url_encodes_special_characters
test_build_url_uses_config_phone
```

## Casos críticos — User

```text
test_password_not_stored_plain
test_check_password_correct_and_wrong
```
