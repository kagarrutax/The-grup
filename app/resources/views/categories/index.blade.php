@extends('layouts.app')

@section('title', 'Categorías')
@section('page-title', 'Categorías')
@section('page-subtitle', 'Catálogo de categorías con búsqueda rápida y edición en modales')

@section('content')
    <section class="module-toolbar mb-4">
        <form method="GET" id="categoriesFilters" class="search-toolbar">
            <div class="search-input-group">
                <i class="bi bi-search"></i>
                <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-search" placeholder="Buscar categorías por ID, nombre o descripción" autocomplete="off">
                <button type="button" class="search-clear" data-clear-search>&times;</button>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryCreateModal">
                <i class="bi bi-plus-lg me-1"></i> Nueva categoría
            </button>
        </form>
    </section>

    <div id="categoriesTableWrapper">
        @include('categories.partials.table', ['categories' => $categories])
    </div>

    @include('components.modal-delete-confirmation')

    <div class="modal fade" id="categoryCreateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-modern">
                <div class="modal-header modal-header-gradient">
                    <div>
                        <h5 class="modal-title mb-0">Nueva categoría</h5>
                        <small class="text-muted">Registro rápido sin salir del listado</small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body modal-body-modern">
                    <form id="categoryCreateForm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="name" class="form-control form-control-modern" required>
                        </div>
                        <div class="mb-0">
                            <label class="form-label">Descripción</label>
                            <textarea name="description" rows="4" class="form-control form-control-modern"></textarea>
                        </div>
                        <div id="categoryCreateErrors" class="alert alert-danger d-none mt-3 mb-0"></div>
                    </form>
                </div>
                <div class="modal-footer modal-footer-modern">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-modern" id="categoryCreateSubmit">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="categoryViewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-modern">
                <div class="modal-header modal-header-gradient">
                    <h5 class="modal-title mb-0">Detalle de categoría</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body modal-body-modern" id="categoryViewContent"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="categoryEditModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-modern">
                <div class="modal-header modal-header-gradient">
                    <h5 class="modal-title mb-0">Editar categoría</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body modal-body-modern">
                    <form id="categoryEditForm">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="name" id="editCategoryName" class="form-control form-control-modern" required>
                        </div>
                        <div class="mb-0">
                            <label class="form-label">Descripción</label>
                            <textarea name="description" rows="4" id="editCategoryDescription" class="form-control form-control-modern"></textarea>
                        </div>
                        <div id="categoryEditErrors" class="alert alert-danger d-none mt-3 mb-0"></div>
                    </form>
                </div>
                <div class="modal-footer modal-footer-modern">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-modern" id="categoryEditSubmit">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    (() => {
        const filtersForm = document.getElementById('categoriesFilters');
        const wrapper = document.getElementById('categoriesTableWrapper');
        const searchInput = filtersForm.querySelector('input[name="search"]');
        let editId = null;
        let timeoutId = null;

        const toggleTypingState = () => {
            searchInput.parentElement.classList.toggle('is-typing', searchInput.value.trim() !== '');
        };

        const refresh = async () => {
            const response = await fetch(`{{ route('categories.index') }}?${new URLSearchParams(new FormData(filtersForm)).toString()}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
            });
            wrapper.innerHTML = await response.text();
        };

        window.refreshCurrentTable = refresh;

        filtersForm.addEventListener('input', () => {
            toggleTypingState();
            clearTimeout(timeoutId);
            timeoutId = setTimeout(refresh, 220);
        });

        filtersForm.querySelector('[data-clear-search]').addEventListener('click', () => {
            searchInput.value = '';
            toggleTypingState();
            refresh();
        });

        document.getElementById('categoryCreateSubmit').addEventListener('click', async () => {
            const form = document.getElementById('categoryCreateForm');
            const errorBox = document.getElementById('categoryCreateErrors');
            errorBox.classList.add('d-none');

            const response = await fetch('{{ route('categories.store') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: new FormData(form),
            });

            const data = await response.json();

            if (!response.ok) {
                errorBox.innerHTML = Object.values(data.errors || { error: ['No se pudo guardar la categoría.'] }).flat().join('<br>');
                errorBox.classList.remove('d-none');
                return;
            }

            bootstrap.Modal.getInstance(document.getElementById('categoryCreateModal')).hide();
            form.reset();
            refresh();
        });

        window.viewCategory = async (id) => {
            const response = await fetch(`/categories/${id}/show`);
            document.getElementById('categoryViewContent').innerHTML = await response.text();
            new bootstrap.Modal(document.getElementById('categoryViewModal')).show();
        };

        window.editCategory = async (id) => {
            const response = await fetch(`/categories/${id}/edit`, {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            });
            const data = await response.json();
            editId = id;
            document.getElementById('editCategoryName').value = data.name;
            document.getElementById('editCategoryDescription').value = data.description ?? '';
            document.getElementById('categoryEditErrors').classList.add('d-none');
            new bootstrap.Modal(document.getElementById('categoryEditModal')).show();
        };

        document.getElementById('categoryEditSubmit').addEventListener('click', async () => {
            const form = document.getElementById('categoryEditForm');
            const errorBox = document.getElementById('categoryEditErrors');
            errorBox.classList.add('d-none');

            const response = await fetch(`/categories/${editId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: new FormData(form),
            });

            const data = await response.json();

            if (!response.ok) {
                errorBox.innerHTML = Object.values(data.errors || { error: ['No se pudo actualizar la categoría.'] }).flat().join('<br>');
                errorBox.classList.remove('d-none');
                return;
            }

            bootstrap.Modal.getInstance(document.getElementById('categoryEditModal')).hide();
            refresh();
        });

        toggleTypingState();
    })();
</script>
@endpush
