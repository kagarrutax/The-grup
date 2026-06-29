@extends('layouts.app')

@section('title', 'Movimientos de stock')
@section('page-title', 'Movimientos de stock')
@section('page-subtitle', 'Historial con filtros combinables, edición rápida y búsqueda desde base de datos')

@section('content')
<section class="module-toolbar mb-4">
    <form method="GET" id="stockFilters" class="search-toolbar search-toolbar-wide">
        <div class="search-input-group">
            <i class="bi bi-search"></i>
            <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-search" placeholder="Buscar por ID, nombre, código o usuario" autocomplete="off">
            <button type="button" class="search-clear" data-clear-search>&times;</button>
        </div>
        <select name="type" class="form-select">
            <option value="">Todos los tipos</option>
            <option value="entrada" @selected(request('type') === 'entrada')>Entrada</option>
            <option value="salida" @selected(request('type') === 'salida')>Salida</option>
        </select>
        <select name="product_id" class="form-select">
            <option value="">Todos los productos</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}" @selected(request('product_id') == $product->id)>#{{ $product->id }} · {{ $product->name }}</option>
            @endforeach
        </select>
        <select name="user_id" class="form-select">
            <option value="">Todos los usuarios</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" @selected(request('user_id') == $user->id)>{{ $user->name }}</option>
            @endforeach
        </select>
        <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control form-control-search search-date-input" aria-label="Fecha inicial">
        <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control form-control-search search-date-input" aria-label="Fecha final">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#movementCreateModal">
            <i class="bi bi-plus-lg me-1"></i> Registrar movimiento
        </button>
    </form>
</section>

<div id="stockTableWrapper">
    @include('stock.partials.table', ['movements' => $movements])
</div>

@include('components.modal-delete-confirmation')

<div class="modal fade" id="movementCreateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modal-content-modern">
            <div class="modal-header modal-header-gradient">
                <div>
                    <h5 class="modal-title mb-0">Registrar movimiento</h5>
                    <small class="text-muted">Todo el registro ocurre sin cambiar de página</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body modal-body-modern">
                <form id="movementCreateForm" class="row g-4">
                    @csrf
                    <div class="col-md-6">
                        <label class="form-label">Producto</label>
                        <select name="product_id" class="form-select form-select-modern" required>
                            <option value="">Seleccionar</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">#{{ $product->id }} · {{ $product->name }} · {{ $product->sku }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tipo</label>
                        <select name="type" class="form-select form-select-modern" required>
                            <option value="entrada">Entrada</option>
                            <option value="salida">Salida</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Cantidad</label>
                        <input type="number" min="1" name="quantity" class="form-control form-control-modern" required autocomplete="off">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Usuario</label>
                        <select name="user_id" class="form-select form-select-modern">
                            <option value="">Usuario actual</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @selected(auth()->id() === $user->id)>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Motivo</label>
                        <input type="text" name="reason" class="form-control form-control-modern" placeholder="Compra, ajuste, venta, devolución..." autocomplete="off">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Observaciones</label>
                        <textarea name="observations" rows="4" class="form-control form-control-modern" placeholder="Notas adicionales del movimiento" autocomplete="off"></textarea>
                    </div>
                    <div class="col-12">
                        <div id="movementErrors" class="alert alert-danger d-none mb-0"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer modal-footer-modern">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btn-modern" id="movementCreateSubmit">Guardar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="movementViewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-content-modern">
            <div class="modal-header modal-header-gradient">
                <div>
                    <h5 class="modal-title mb-0">Detalle del movimiento</h5>
                    <small class="text-muted">Consulta rápida sin salir del historial</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body modal-body-modern" id="movementViewContent"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="movementEditModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modal-content-modern">
            <div class="modal-header modal-header-gradient">
                <div>
                    <h5 class="modal-title mb-0">Editar movimiento</h5>
                    <small class="text-muted">La actualización ajusta el stock de forma consistente</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body modal-body-modern">
                <form id="movementEditForm" class="row g-4">
                    @csrf
                    @method('PATCH')
                    <div class="col-md-6">
                        <label class="form-label">Producto</label>
                        <select name="product_id" id="editMovementProductId" class="form-select form-select-modern" required>
                            <option value="">Seleccionar</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">#{{ $product->id }} · {{ $product->name }} · {{ $product->sku }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tipo</label>
                        <select name="type" id="editMovementType" class="form-select form-select-modern" required>
                            <option value="entrada">Entrada</option>
                            <option value="salida">Salida</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Cantidad</label>
                        <input type="number" min="1" name="quantity" id="editMovementQuantity" class="form-control form-control-modern" required autocomplete="off">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Usuario</label>
                        <select name="user_id" id="editMovementUserId" class="form-select form-select-modern">
                            <option value="">Usuario actual</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Motivo</label>
                        <input type="text" name="reason" id="editMovementReason" class="form-control form-control-modern" placeholder="Compra, ajuste, venta, devolución..." autocomplete="off">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Observaciones</label>
                        <textarea name="observations" rows="4" id="editMovementObservations" class="form-control form-control-modern" placeholder="Notas adicionales del movimiento" autocomplete="off"></textarea>
                    </div>
                    <div class="col-12">
                        <div id="movementEditErrors" class="alert alert-danger d-none mb-0"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer modal-footer-modern">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btn-modern" id="movementEditSubmit">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (() => {
        const form = document.getElementById('stockFilters');
        const wrapper = document.getElementById('stockTableWrapper');
        const searchInput = form.querySelector('input[name="search"]');
        const clearButton = form.querySelector('[data-clear-search]');
        const createForm = document.getElementById('movementCreateForm');
        const editForm = document.getElementById('movementEditForm');
        const createErrorBox = document.getElementById('movementErrors');
        const editErrorBox = document.getElementById('movementEditErrors');
        let timeoutId = null;
        let editMovementId = null;

        const refresh = async () => {
            const response = await fetch(`{{ route('stock.index') }}?${new URLSearchParams(new FormData(form)).toString()}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
            });
            wrapper.innerHTML = await response.text();
        };

        window.refreshCurrentTable = refresh;

        const toggleTypingState = () => {
            searchInput.parentElement.classList.toggle('is-typing', searchInput.value.trim() !== '');
        };

        const submitMovement = async ({ url, formElement, errorElement, method = 'POST', successModalId, resetAfterSave = false }) => {
            errorElement.classList.add('d-none');

            const formData = new FormData(formElement);

            if (method !== 'POST') {
                formData.set('_method', method);
            }

            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: formData,
            });

            const data = await response.json();

            if (!response.ok) {
                errorElement.innerHTML = Object.values(data.errors || { error: ['No se pudo guardar el movimiento.'] }).flat().join('<br>');
                errorElement.classList.remove('d-none');
                return false;
            }

            bootstrap.Modal.getInstance(document.getElementById(successModalId)).hide();

            if (resetAfterSave) {
                formElement.reset();
            }

            await refresh();
            return true;
        };

        form.addEventListener('input', (event) => {
            if (event.target === searchInput) {
                toggleTypingState();
            }

            clearTimeout(timeoutId);
            timeoutId = setTimeout(refresh, 220);
        });

        form.addEventListener('change', refresh);

        clearButton.addEventListener('click', () => {
            searchInput.value = '';
            form.querySelector('select[name="type"]').value = '';
            form.querySelector('select[name="product_id"]').value = '';
            form.querySelector('select[name="user_id"]').value = '';
            form.querySelector('input[name="date_from"]').value = '';
            form.querySelector('input[name="date_to"]').value = '';
            toggleTypingState();
            clearTimeout(timeoutId);
            refresh();
        });

        document.getElementById('movementCreateSubmit').addEventListener('click', async () => {
            await submitMovement({
                url: '{{ route('stock.store') }}',
                formElement: createForm,
                errorElement: createErrorBox,
                successModalId: 'movementCreateModal',
                resetAfterSave: true,
            });
        });

        document.getElementById('movementEditSubmit').addEventListener('click', async () => {
            if (!editMovementId) {
                return;
            }

            await submitMovement({
                url: `/stock/${editMovementId}`,
                formElement: editForm,
                errorElement: editErrorBox,
                method: 'PATCH',
                successModalId: 'movementEditModal',
            });
        });

        window.viewMovement = async (id) => {
            const response = await fetch(`/stock/${id}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
            });

            document.getElementById('movementViewContent').innerHTML = await response.text();
            new bootstrap.Modal(document.getElementById('movementViewModal')).show();
        };

        window.editMovement = async (id) => {
            const response = await fetch(`/stock/${id}/edit`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });
            const data = await response.json();

            editMovementId = id;
            document.getElementById('editMovementProductId').value = data.product_id;
            document.getElementById('editMovementType').value = data.type;
            document.getElementById('editMovementQuantity').value = data.quantity;
            document.getElementById('editMovementUserId').value = data.user_id ?? '';
            document.getElementById('editMovementReason').value = data.reason ?? '';
            document.getElementById('editMovementObservations').value = data.observations ?? '';
            editErrorBox.classList.add('d-none');
            new bootstrap.Modal(document.getElementById('movementEditModal')).show();
        };

        toggleTypingState();
    })();
</script>
@endpush
