<!-- Modal para Ver Detalles del Producto -->
<div class="modal fade" id="viewProductModal" tabindex="-1" aria-labelledby="viewProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modal-content-modern">
            <div class="modal-header modal-header-gradient">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-box-seam icon-header"></i>
                    <div>
                        <h5 class="modal-title mb-0" id="viewProductModalLabel">Detalles del Producto</h5>
                        <small class="text-muted">Información completa</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-modern">
                <div id="productDetailsContent" class="product-details-loader">
                    <div class="text-center py-5">
                        <div class="spinner-border spinner-border-sm text-primary mb-3" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                        <p class="text-muted">Cargando detalles del producto...</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-modern">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function viewProduct(productId) {
        const modal = document.getElementById('viewProductModal');
        const content = document.getElementById('productDetailsContent');
        
        // Mostrar spinner
        content.innerHTML = `
            <div class="text-center py-5">
                <div class="spinner-border spinner-border-sm text-primary mb-3" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
                <p class="text-muted">Cargando detalles del producto...</p>
            </div>
        `;
        
        new bootstrap.Modal(modal).show();
        
        fetch(`/products/${productId}/show`)
            .then(response => response.text())
            .then(data => {
                content.innerHTML = data;
                content.classList.add('fade-in');
            })
            .catch(error => {
                console.error('Error:', error);
                content.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        <strong>Error al cargar</strong>
                        <p class="mb-0">No se pudo cargar los detalles del producto. Por favor, intenta nuevamente.</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;
            });
    }
</script>
