# Guía de Uso: Componentes Modal

## Cómo Usar los Modales en Otras Vistas

### 1. Modal de Visualización

Para mostrar un modal que visualice detalles de un elemento:

```blade
<!-- En tu vista -->
<button onclick="viewProduct({{ $item->id }})">Ver</button>

<!-- Incluye el componente modal -->
@include('components.modal-view-product')
```

**Requisitos:**
- El controlador debe tener un método `show()` que devuelva la vista parcial
- La ruta debe ser `/items/{id}/show`

---

### 2. Modal de Edición

Para editar un elemento en un modal:

```blade
<!-- En tu vista -->
<button onclick="editProduct({{ $item->id }})">Editar</button>

<!-- Incluye el componente modal -->
@include('components.modal-edit-product')
```

**Requisitos:**
- El controlador debe tener un método `edit()` que devuelva JSON si se solicita por AJAX
- El método `update()` debe devolver JSON con estructura: `{ success: true, message: '...' }`
- Asegúrate de que los campos del formulario coincidan con los nombres de los atributos del modelo

---

### 3. Modal de Confirmación de Eliminación

Para confirmar antes de eliminar:

```blade
<!-- En tu vista -->
<button onclick="showDeleteConfirmation('Nombre del item', '{{ route('items.destroy', $item) }}', 'item')">
    <i class="bi bi-trash"></i> Eliminar
</button>

<!-- Incluye el componente modal -->
@include('components.modal-delete-confirmation')
```

**Parámetros:**
- `itemName`: Nombre del elemento (se muestra en el modal)
- `deleteRoute`: URL de eliminación
- `itemType`: Tipo de elemento (producto, categoría, etc.)

**Requisitos:**
- La ruta debe aceptar DELETE y devolver JSON: `{ success: true }`

---

### 4. Modal de Perfil

Para editar el perfil del usuario:

```blade
<button onclick="openProfileModal()">Editar Perfil</button>

@include('components.modal-profile-admin')
```

---

### 5. Modal Base Personalizado

Para crear un modal personalizado:

```blade
@include('components.modal', [
    'id' => 'miModal',
    'title' => 'Título del Modal',
    'size' => 'modal-lg',  // modal-sm, modal-lg, o sin especificar
    'centered' => true,
    'scrollable' => false,
    'header' => true,
    'footer' => true,
])
    <!-- Contenido del modal -->
    <p>Contenido aquí</p>
    
    @slot('footer')
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button class="btn btn-primary">Guardar</button>
    @endslot
@endinclude
```

---

## Adaptación a Otros Modelos

### Ejemplo: Crear modales para Categorías

**1. Actualizar CategoryController:**

```php
public function edit(Category $category)
{
    if (request()->wantsJson()) {
        return response()->json($category);
    }
    return view('categories.edit', compact('category'));
}

public function show(Category $category)
{
    return view('categories.show', compact('category'));
}

public function update(Request $request, Category $category)
{
    $validated = $request->validate([...]);
    $category->update($validated);
    
    if ($request->wantsJson()) {
        return response()->json(['success' => true, 'message' => '...']);
    }
    return redirect()->route('categories.index');
}

public function destroy(Category $category)
{
    $category->delete();
    
    if (request()->wantsJson()) {
        return response()->json(['success' => true]);
    }
    return redirect()->route('categories.index');
}
```

**2. Crear vistas parciales:**

```blade
<!-- categories/show.blade.php -->
<div class="row g-3">
    <div class="col-12">
        <label class="text-muted small">Nombre</label>
        <p class="fw-medium">{{ $category->name }}</p>
    </div>
    <div class="col-12">
        <label class="text-muted small">Descripción</label>
        <p>{{ $category->description ?? '—' }}</p>
    </div>
</div>
```

**3. Agregar rutas:**

```php
Route::get('/categories/{category}/show', [CategoryController::class, 'show'])->name('categories.show');
```

**4. Actualizar vista de índice:**

```blade
<button onclick="viewCategory({{ $category->id }})">Ver</button>
<button onclick="editCategory({{ $category->id }})">Editar</button>
<button onclick="showDeleteConfirmation('{{ $category->name }}', '{{ route('categories.destroy', $category) }}')">Eliminar</button>

@include('components.modal-view-product')  <!-- Reutiliza con ID diferente -->
@include('components.modal-edit-product')
@include('components.modal-delete-confirmation')
```

**5. Crear funciones JavaScript adaptadas:**

En el modal de visualización (`modal-view-product.blade.php`), cambiar:
```javascript
function viewProduct(productId) {
    fetch(`/products/${productId}/show`)  // Cambiar a `/categories/${productId}/show`
```

---

## Validación de Errores

Los modales incluyen manejo de errores. Para personalizar:

```javascript
.catch(error => {
    console.error('Error:', error);
    // Mostrar mensaje de error personalizado
    alert('Error: ' + error.message);
});
```

---

## Seguridad

✅ **CSRF Protection**: Todos los formularios incluyen token CSRF
✅ **Validación Backend**: Todos los datos se validan en el servidor
✅ **Autorización**: Protegidos por middleware `auth` y `admin`

---

## Estilos Personalizables

El archivo `resources/css/modals.css` contiene todos los estilos. Puedes modificar:

- Colores de botones
- Tamaños de fuente
- Espaciado
- Bordes y sombras
- Animaciones

Todos los estilos son responsivos y se adaptan a dispositivos móviles.
