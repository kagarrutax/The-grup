<div class="card-app module-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-app table-modern mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Productos</th>
                        <th>Creación</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td><span class="table-id">#{{ $category->id }}</span></td>
                            <td class="fw-semibold">{{ $category->name }}</td>
                            <td class="text-muted">{{ \Illuminate\Support\Str::limit($category->description, 80) ?: '—' }}</td>
                            <td>{{ $category->products_count }}</td>
                            <td>{{ $category->created_at->format('d/m/Y') }}</td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-info" onclick="viewCategory({{ $category->id }})"><i class="bi bi-eye"></i></button>
                                    <button class="btn btn-outline-warning" onclick="editCategory({{ $category->id }})"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-outline-danger" onclick="showDeleteConfirmation('{{ $category->name }}', '{{ route('categories.destroy', $category) }}', 'categoría')"><i class="bi bi-trash3"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-5">No hay categorías que coincidan con la búsqueda.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($categories->hasPages())
        <div class="card-footer">{{ $categories->links() }}</div>
    @endif
</div>
