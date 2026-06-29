@extends('layouts.app')

@section('title', 'Reportes')
@section('page-title', 'Reportes')
@section('page-subtitle', 'Genera vista previa, PDF y Excel desde un único módulo')

@section('content')
    <div class="card-app module-card mb-4">
        <div class="card-body">
            <form id="reportsFilters" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Fecha inicial</label>
                    <input type="date" name="date_from" value="{{ $filters['date_from'] }}" class="form-control form-control-modern">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Fecha final</label>
                    <input type="date" name="date_to" value="{{ $filters['date_to'] }}" class="form-control form-control-modern">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Categoría</label>
                    <select name="category_id" class="form-select form-select-modern">
                        <option value="">Todas</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected($filters['category_id'] == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Producto</label>
                    <select name="product_id" class="form-select form-select-modern">
                        <option value="">Todos</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" @selected($filters['product_id'] == $product->id)>#{{ $product->id }} · {{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Proveedor</label>
                    <select name="supplier_id" class="form-select form-select-modern">
                        <option value="">Todos</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" @selected($filters['supplier_id'] == $supplier->id)>{{ $supplier->company_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-secondary" id="previewReports">Vista previa</button>
                    <a href="{{ route('reports.pdf', request()->query()) }}" class="btn btn-primary" target="_blank">Generar PDF</a>
                    <a href="{{ route('reports.excel', request()->query()) }}" class="btn btn-success">Generar Excel</a>
                    <a href="{{ route('reports.pdf', request()->query()) }}" class="btn btn-outline-primary" target="_blank">Descargar PDF</a>
                    <a href="{{ route('reports.excel', request()->query()) }}" class="btn btn-outline-success">Descargar Excel</a>
                </div>
            </form>
        </div>
    </div>

    <div id="reportsPreviewWrapper">
        @include('reports.partials.preview', ['rows' => $rows])
    </div>
@endsection

@push('scripts')
<script>
    (() => {
        const form = document.getElementById('reportsFilters');
        const previewButton = document.getElementById('previewReports');
        const wrapper = document.getElementById('reportsPreviewWrapper');

        const refreshActions = () => {
            const query = new URLSearchParams(new FormData(form)).toString();
            document.querySelectorAll('a[href*="{{ route('reports.pdf') }}"], a[href*="{{ route('reports.excel') }}"]').forEach((link) => {
                if (link.href.includes('/pdf')) {
                    link.href = `{{ route('reports.pdf') }}?${query}`;
                } else {
                    link.href = `{{ route('reports.excel') }}?${query}`;
                }
            });
        };

        previewButton.addEventListener('click', async () => {
            const query = new URLSearchParams(new FormData(form)).toString();
            const response = await fetch(`{{ route('reports.index') }}?${query}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
            });
            wrapper.innerHTML = await response.text();
            refreshActions();
        });

        form.addEventListener('change', refreshActions);
        refreshActions();
    })();
</script>
@endpush
