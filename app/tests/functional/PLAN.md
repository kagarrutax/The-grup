# PLAN — tests/functional/

## Rol

Pruebas **funcionales** con el test client de Flask: simulan peticiones HTTP reales a rutas y validan respuestas.

## Archivos previstos

| Archivo | Etapa | Flujos |
|---------|-------|--------|
| `test_auth.py` | 3 | register → login → logout |
| `test_dashboard.py` | 4 | acceso admin vs user |
| `test_products.py` | 5 | CRUD completo como admin |
| `test_catalog.py` | 6 | GET / muestra activos; botón wa.me en HTML |
| `test_security.py` | 7 | CSRF, rutas protegidas sin sesión |

## Flujo E2E principal (etapa 7)

```
1. Admin login
2. Crear producto activo
3. GET / como anónimo → producto visible
4. HTML contiene enlace wa.me con nombre del producto
5. Desactivar producto → ya no aparece en /
```

## Fixtures requeridas

- `admin_client`: sesión autenticada como admin
- `user_client`: sesión autenticada como user normal
- `anonymous_client`: sin sesión
