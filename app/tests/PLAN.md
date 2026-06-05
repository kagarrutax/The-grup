# PLAN — tests/

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Elda** | Validaciones | Definir casos, ejecutar pruebas y reportar PASS/FAIL |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Exigir suite de tests en verde antes de merge a `main` |
| **Yadira** | Documentación y presentación | Incluir matriz de pruebas y resultados en paquete de entrega |

## Rol

Capa de **testing** de la aplicación. Valida modelos, utilidades y flujos funcionales antes de cerrar cada etapa de la spec 001.

## Subcarpetas

| Carpeta | Tipo | Alcance |
|---------|------|---------|
| `unit/` | Unitario | Modelos, utils, validadores |
| `functional/` | Funcional | Rutas HTTP, flujos E2E con test client |

## Plan de trabajo por etapa

| Etapa | Tests a crear |
|-------|---------------|
| 1 | App factory crea instancia sin error |
| 2 | User password hash; Product CRUD en memoria/SQLite test |
| 3 | Register, login, logout vía test client |
| 4 | Dashboard 403 para user, 200 para admin |
| 5 | CRUD productos solo como admin |
| 6 | Catálogo público; URL WhatsApp correcta |
| 7 | Suite completa + responsive smoke tests |

## Archivos previstos en raíz

| Archivo | Descripción |
|---------|-------------|
| `conftest.py` | Fixtures: app, client, db, admin_user |
| `__init__.py` | Paquete tests |

## Comando de ejecución previsto

```bash
pytest app/tests/ -v
```

## Criterio de bloqueo

No avanzar de etapa si los tests definidos para esa etapa fallan.
