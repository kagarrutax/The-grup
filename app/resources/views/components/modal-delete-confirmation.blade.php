<!-- Modal de Confirmación para Eliminar -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-danger">
            <div class="modal-header modal-header-danger">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-triangle-fill icon-header-lg text-danger"></i>
                    <div>
                        <h5 class="modal-title text-danger mb-0" id="deleteConfirmationLabel">Confirmar eliminación</h5>
                        <small class="text-muted">Esta acción no se puede deshacer</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-modern">
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-start" role="alert">
                    <i class="bi bi-info-circle me-3 flex-shrink-0 mt-1"></i>
                    <div>
                        <p id="deleteMessage" class="mb-2">¿Está seguro de que desea eliminar este elemento?</p>
                        <div id="deleteDetails" class="mt-3 p-3 bg-white rounded-2 border border-danger border-opacity-25">
                            <small class="text-muted d-block mb-1">Elemento a eliminar:</small>
                            <small id="deleteItemInfo" class="fw-bold d-block text-dark"></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-danger">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    <i class="bi bi-arrow-left me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-danger btn-modern" id="confirmDeleteBtn">
                    <i class="bi bi-trash3 me-2"></i>Eliminar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let deleteAction = null;

    function showDeleteConfirmation(itemName, deleteRoute, itemType = 'producto') {
        deleteAction = deleteRoute;
        document.getElementById('deleteMessage').innerHTML = 
            `¿Está seguro de que desea eliminar este <strong>${itemType}</strong>?<br><small class="text-muted">Esta acción es permanente y no se puede deshacer.</small>`;
        document.getElementById('deleteItemInfo').textContent = itemName;
        
        new bootstrap.Modal(document.getElementById('deleteConfirmationModal')).show();
    }

    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (!deleteAction) return;
        
        const btn = this;
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Eliminando...';
        
        fetch(deleteAction, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
        .then(response => response.json())
        .then(async data => {
            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('deleteConfirmationModal')).hide();
                // Mostrar feedback de éxito
                const alert = document.createElement('div');
                alert.className = 'alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3';
                alert.style.zIndex = '9999';
                alert.innerHTML = `
                    <i class="bi bi-check-circle me-2"></i>
                    <strong>¡Eliminado!</strong> ${data.message || 'Elemento eliminado correctamente.'}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                document.body.appendChild(alert);

                setTimeout(async () => {
                    if (typeof window.refreshCurrentTable === 'function') {
                        await window.refreshCurrentTable();
                        alert.remove();
                    } else {
                        location.reload();
                    }
                }, 900);
            } else {
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-trash3 me-2"></i>Eliminar';
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-trash3 me-2"></i>Eliminar';
            alert('Error al eliminar');
        });
    });
</script>
