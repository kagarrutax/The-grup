# PLAN — database/seeders/

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Verenice** | Líder y desarrolladora principal | DatabaseSeeder: admin, categorías demo, productos factory |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Revisar seeder en PR; credenciales demo no sensibles |
| **Yadira** | Documentación y presentación | Documentar credenciales de prueba en README |

## Rol

Datos de demostración para presentación sin carga manual.

## Contenido del seeder

- Usuario admin: `admin@supermercado.com` / `password`
- Categorías: Lácteos, Carnes, Bebidas, Limpieza, Panadería
- ~30 productos vía factory

## Comando

```bash
php artisan db:seed
```

## Spec

[`spec/001-inventario-supermercado.md`](../../../spec/001-inventario-supermercado.md)
