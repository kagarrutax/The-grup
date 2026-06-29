@extends('layouts.app')

@section('title', 'Proveedores')
@section('page-title', 'Proveedores')
@section('page-subtitle', 'Directorio operativo con alta, edición y consulta desde modales')

@section('content')
    <section class="module-toolbar mb-4">
        <form method="GET" id="suppliersFilters" class="search-toolbar">
            <div class="search-input-group">
                <i class="bi bi-search"></i>
                <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-search" placeholder="Buscar por empresa, responsable, teléfono o correo" autocomplete="off">
                <button type="button" class="search-clear" data-clear-search>&times;</button>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#supplierCreateModal">
                <i class="bi bi-plus-lg me-1"></i> Nuevo proveedor
            </button>
        </form>
    </section>

    <div id="suppliersTableWrapper">
        @include('suppliers.partials.table', ['suppliers' => $suppliers])
    </div>

    @include('components.modal-delete-confirmation')

    <div class="modal fade" id="supplierCreateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-modern">
                <div class="modal-header modal-header-gradient">
                    <h5 class="modal-title mb-0">Nuevo proveedor</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body modal-body-modern">
                    <form id="supplierCreateForm" class="row g-3">
                        @csrf
                        <div class="col-12">
                            <label class="form-label">Empresa</label>
                            <input type="text" name="company_name" class="form-control form-control-modern" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Responsable</label>
                            <input type="text" name="contact_name" class="form-control form-control-modern" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="phone" class="form-control form-control-modern">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Correo</label>
                            <input type="email" name="email" class="form-control form-control-modern">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Dirección</label>
                            <textarea name="address" rows="3" class="form-control form-control-modern"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Estado</label>
                            <select name="status" class="form-select form-select-modern">
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div id="supplierCreateErrors" class="alert alert-danger d-none mb-0"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer modal-footer-modern">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-modern" id="supplierCreateSubmit">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="supplierViewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-modern">
                <div class="modal-header modal-header-gradient">
                    <h5 class="modal-title mb-0">Detalle del proveedor</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body modal-body-modern" id="supplierViewContent"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="supplierEditModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-modern">
                <div class="modal-header modal-header-gradient">
                    <h5 class="modal-title mb-0">Editar proveedor</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body modal-body-modern">
                    <form id="supplierEditForm" class="row g-3">
                        @csrf
                        @method('PATCH')
                        <div class="col-12">
                            <label class="form-label">Empresa</label>
                            <input type="text" name="company_name" id="editSupplierCompanyName" class="form-control form-control-modern" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Responsable</label>
                            <input type="text" name="contact_name" id="editSupplierContactName" class="form-control form-control-modern" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="phone" id="editSupplierPhone" class="form-control form-control-modern">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Correo</label>
                            <input type="email" name="email" id="editSupplierEmail" class="form-control form-control-modern">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Dirección</label>
                            <textarea name="address" rows="3" id="editSupplierAddress" class="form-control form-control-modern"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Estado</label>
                            <select name="status" id="editSupplierStatus" class="form-select form-select-modern">
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div id="supplierEditErrors" class="alert alert-danger d-none mb-0"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer modal-footer-modern">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-modern" id="supplierEditSubmit">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    (() => {
        const filtersForm = document.getElementById('suppliersFilters');
        const wrapper = document.getElementById('suppliersTableWrapper');
        const searchInput = filtersForm.querySelector('input[name="search"]');
        let editId = null;
        let timeoutId = null;

        const toggleTypingState = () => {
            searchInput.parentElement.classList.toggle('is-typing', searchInput.value.trim() !== '');
        };

        const refresh = async () => {
            const response = await fetch(`{{ route('suppliers.index') }}?${new URLSearchParams(new FormData(filtersForm)).toString()}`, {
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

        document.getElementById('supplierCreateSubmit').addEventListener('click', async () => {
            const form = document.getElementById('supplierCreateForm');
            const errorBox = document.getElementById('supplierCreateErrors');
            errorBox.classList.add('d-none');

            const response = await fetch('{{ route('suppliers.store') }}', {
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
                errorBox.innerHTML = Object.values(data.errors || { error: ['No se pudo crear el proveedor.'] }).flat().join('<br>');
                errorBox.classList.remove('d-none');
                return;
            }

            bootstrap.Modal.getInstance(document.getElementById('supplierCreateModal')).hide();
            form.reset();
            refresh();
        });

        window.viewSupplier = async (id) => {
            const response = await fetch(`/suppliers/${id}/show`);
            document.getElementById('supplierViewContent').innerHTML = await response.text();
            new bootstrap.Modal(document.getElementById('supplierViewModal')).show();
        };

        window.editSupplier = async (id) => {
            const response = await fetch(`/suppliers/${id}/edit`, {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            });
            const data = await response.json();
            editId = id;
            document.getElementById('editSupplierCompanyName').value = data.company_name;
            document.getElementById('editSupplierContactName').value = data.contact_name;
            document.getElementById('editSupplierPhone').value = data.phone ?? '';
            document.getElementById('editSupplierEmail').value = data.email ?? '';
            document.getElementById('editSupplierAddress').value = data.address ?? '';
            document.getElementById('editSupplierStatus').value = data.status;
            document.getElementById('supplierEditErrors').classList.add('d-none');
            new bootstrap.Modal(document.getElementById('supplierEditModal')).show();
        };

        document.getElementById('supplierEditSubmit').addEventListener('click', async () => {
            const form = document.getElementById('supplierEditForm');
            const errorBox = document.getElementById('supplierEditErrors');
            errorBox.classList.add('d-none');

            const response = await fetch(`/suppliers/${editId}`, {
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
                errorBox.innerHTML = Object.values(data.errors || { error: ['No se pudo actualizar el proveedor.'] }).flat().join('<br>');
                errorBox.classList.remove('d-none');
                return;
            }

            bootstrap.Modal.getInstance(document.getElementById('supplierEditModal')).hide();
            refresh();
        });

        toggleTypingState();
    })();
</script>
@endpush
