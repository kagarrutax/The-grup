@extends('layouts.guest')

@section('title', 'Inicio')

@section('content')
<div class="welcome-hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="mb-3">
                    <span class="auth-brand"><i class="bi bi-shop-window"></i></span>
                </div>
                <h1 class="display-5 fw-bold mb-3">The Grup</h1>
                <p class="lead text-muted mb-4">
                    Sistema de inventario para supermercado. Controla productos, categorías y movimientos de stock en un solo lugar.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 rounded-3">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar sesión
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="welcome-card">
                    <div class="row g-3 text-center">
                        <div class="col-4">
                            <div class="fs-2 fw-bold text-primary">{{ $highlights['products'] }}</div>
                            <div class="small text-muted">Productos</div>
                        </div>
                        <div class="col-4">
                            <div class="fs-2 fw-bold text-success">{{ $highlights['categories'] }}</div>
                            <div class="small text-muted">Categorías</div>
                        </div>
                        <div class="col-4">
                            <div class="fs-2 fw-bold text-warning">{{ $highlights['movements'] }}</div>
                            <div class="small text-muted">Movimientos</div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <ul class="list-unstyled mb-0 small text-muted">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Dashboard con resumen en tiempo real</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Registro de entradas y salidas</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Alertas de stock bajo</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
