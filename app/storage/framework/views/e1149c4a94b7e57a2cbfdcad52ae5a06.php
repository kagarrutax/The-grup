<!-- Modal para Ver Detalles del Producto -->
<div class="modal fade" id="viewProductModal" tabindex="-1" aria-labelledby="viewProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewProductModalLabel">Detalles del Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="productDetailsContent">
                    <p class="text-center text-muted">Cargando...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function viewProduct(productId) {
        fetch(`/products/${productId}/show`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('productDetailsContent').innerHTML = data;
                new bootstrap.Modal(document.getElementById('viewProductModal')).show();
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('productDetailsContent').innerHTML = '<p class="text-danger">Error al cargar los detalles del producto.</p>';
            });
    }
</script>
<?php /**PATH C:\laragon\www\The-grup\app\resources\views/components/modal-view-product.blade.php ENDPATH**/ ?>