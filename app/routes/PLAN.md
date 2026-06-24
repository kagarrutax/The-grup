# PLAN — routes/

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Verenice** | Líder y desarrolladora principal | `web.php`: resources, dashboard, middleware auth |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Adrian** | Revisión e integración de código | Revisar rutas protegidas y convención de nombres |
| **Yadira** | Documentación y presentación | Tabla de rutas en manual técnico |

## Rol

Definición de endpoints HTTP en `routes/web.php`.

## Rutas previstas

```php
Route::middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('stock', StockController::class);
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
```

## Spec

[`spec/001-inventario-supermercado.md`](../../../spec/001-inventario-supermercado.md)
