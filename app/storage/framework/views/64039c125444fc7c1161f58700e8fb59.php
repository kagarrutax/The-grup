<!-- Modal de Confirmación para Eliminar -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger bg-opacity-10 border-danger">
                <h5 class="modal-title text-danger" id="deleteConfirmationLabel">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Confirmar eliminación
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="deleteMessage">¿Está seguro de que desea eliminar este elemento? Esta acción no se puede deshacer.</p>
                <div id="deleteDetails" class="alert alert-warning mt-2" style="display:none;">
                    <small id="deleteItemInfo"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<script>
    let deleteAction = null;
    let deleteMethod = 'DELETE';

    function showDeleteConfirmation(itemName, deleteRoute, itemType = 'producto') {
        deleteAction = deleteRoute;
        document.getElementById('deleteMessage').textContent = 
            `¿Está seguro de que desea eliminar el ${itemType} "${itemName}"? Esta acción no se puede deshacer.`;
        document.getElementById('deleteItemInfo').textContent = `${itemType}: ${itemName}`;
        document.getElementById('deleteDetails').style.display = 'block';
        
        new bootstrap.Modal(document.getElementById('deleteConfirmationModal')).show();
    }

    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (!deleteAction) return;
        
        fetch(deleteAction, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('deleteConfirmationModal')).hide();
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al eliminar');
        });
    });
</script>
<?php /**PATH C:\laragon\www\The-grup\app\resources\views/components/modal-delete-confirmation.blade.php ENDPATH**/ ?>