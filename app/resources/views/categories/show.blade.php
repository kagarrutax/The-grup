<div class="simple-detail-grid">
    <div>
        <small class="text-muted d-block">ID</small>
        <strong>#{{ $category->id }}</strong>
    </div>
    <div>
        <small class="text-muted d-block">Nombre</small>
        <strong>{{ $category->name }}</strong>
    </div>
    <div class="w-100">
        <small class="text-muted d-block">Descripción</small>
        <p class="mb-0">{{ $category->description ?: 'Sin descripción registrada.' }}</p>
    </div>
    <div>
        <small class="text-muted d-block">Productos asociados</small>
        <strong>{{ $category->products_count }}</strong>
    </div>
    <div>
        <small class="text-muted d-block">Creación</small>
        <strong>{{ $category->created_at->format('d/m/Y H:i') }}</strong>
    </div>
</div>
