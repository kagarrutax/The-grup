# Tests de la Aplicación - Configuración

## Estado Actual
✅ **PHPUnit configurado correctamente**  
⏳ **Sin tests unitarios aún** (pueden ser añadidos)

## Configuración

El archivo `phpunit.xml.dist` está configurado con:
- **Bootstrap**: `bootstrap/app.php`
- **BD para tests**: SQLite en memoria (`:memory:`)
- **Suites**: Unit y Feature
- **Env de test**: Variables de entorno aisladas

## Ejecutar Tests Existentes
```bash
cd app
php artisan test
```

## Crear un Test Ejemplo

### Test Unitario
```bash
php artisan make:test BasicTest --unit
```

Archivo generado en `tests/Unit/BasicTest.php`:
```php
<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class BasicTest extends TestCase
{
    public function test_example()
    {
        $this->assertTrue(true);
    }
}
```

### Test de Funcionalidad (Feature)
```bash
php artisan make:test ProductTest --feature
```

Archivo generado en `tests/Feature/ProductTest.php`:
```php
<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_products_endpoint()
    {
        $response = $this->get('/products');
        $response->assertStatus(200);
    }
}
```

## Ejecutar Tests Específicos
```bash
# Solo tests unitarios
php artisan test --testsuite=Unit

# Solo tests de funcionalidad
php artisan test --testsuite=Feature

# Con filtro
php artisan test --filter=ProductTest
```

## Próximos Tests a Crear

Basado en la funcionalidad implementada:

1. **Tests de Modals**
   - Verificar respuestas JSON de `ProductController@show`
   - Validar rutas AJAX (`/categories/list`, `/products/{id}/show`)
   - Confirmar protección CSRF

2. **Tests de Productos**
   - Listar productos
   - Crear producto
   - Editar producto
   - Eliminar producto
   - Validaciones de formulario

3. **Tests de Perfil**
   - Ver perfil del usuario
   - Actualizar información
   - Cambiar contraseña
   - Validar `current_password`

4. **Tests de Seguridad**
   - Autenticación requerida
   - Autorización por roles
   - Protección CSRF en operaciones POST/PATCH/DELETE

---

**Documentación**: [PHPUnit](https://phpunit.de/documentation.html)  
**Laravel Testing**: [Laravel Docs](https://laravel.com/docs/12/testing)
