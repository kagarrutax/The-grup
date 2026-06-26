/**
 * App — sidebar, modales, toasts demo
 */
(function () {
  const sidebar = document.getElementById('appSidebar');
  const overlay = document.getElementById('sidebarOverlay');
  const toggle = document.getElementById('sidebarToggle');

  function closeSidebar() {
    sidebar?.classList.remove('show');
    overlay?.classList.remove('show');
  }

  toggle?.addEventListener('click', () => {
    sidebar?.classList.toggle('show');
    overlay?.classList.toggle('show');
  });

  overlay?.addEventListener('click', closeSidebar);

  window.showToast = function (message, type) {
    if (typeof Toastify === 'undefined') return;
    const colors = {
      success: '#22C55E',
      error: '#EF4444',
      info: '#2563EB',
    };
    Toastify({
      text: message,
      duration: 3000,
      gravity: 'top',
      position: 'right',
      style: { background: colors[type] || colors.info, borderRadius: '12px' },
    }).showToast();
  };

  window.closeModal = function (id) {
    const el = document.getElementById(id);
    if (el && typeof bootstrap !== 'undefined') {
      bootstrap.Modal.getInstance(el)?.hide();
    }
  };

  window.saveModal = function (modalId, message) {
    if (typeof showToast === 'function') {
      showToast(message, 'success');
    }
    closeModal(modalId);
  };

  /* Modales fuera de .app-wrapper para que el blur no los afecte */
  document.querySelectorAll('.modal').forEach(function (modalEl) {
    if (modalEl.parentElement !== document.body) {
      document.body.appendChild(modalEl);
    }
  });

  /* Categorías — crear / editar */
  const categoryModal = document.getElementById('categoryModal');
  if (categoryModal) {
    const categoryTitle = categoryModal.querySelector('#categoryModalTitle');
    const categorySubtitle = categoryModal.querySelector('#categoryModalSubtitle');
    const categoryName = categoryModal.querySelector('#categoryName');
    const categoryDesc = categoryModal.querySelector('#categoryDesc');
    const categoryStatus = categoryModal.querySelector('#categoryStatus');

    document.querySelector('[data-category-new]')?.addEventListener('click', function () {
      if (categoryTitle) categoryTitle.textContent = 'Nueva categoría';
      if (categorySubtitle) categorySubtitle.textContent = 'Agrega una categoría al catálogo';
      if (categoryName) categoryName.value = '';
      if (categoryDesc) categoryDesc.value = '';
      if (categoryStatus) categoryStatus.value = 'activa';
    });

    document.querySelectorAll('[data-edit-category]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        if (categoryTitle) categoryTitle.textContent = 'Editar categoría';
        if (categorySubtitle) categorySubtitle.textContent = 'Modifica los datos de la categoría';
        if (categoryName) categoryName.value = btn.dataset.name || '';
        if (categoryDesc) categoryDesc.value = btn.dataset.desc || '';
        if (categoryStatus) categoryStatus.value = btn.dataset.status || 'activa';
        if (typeof bootstrap !== 'undefined') {
          bootstrap.Modal.getOrCreateInstance(categoryModal).show();
        }
      });
    });
  }

  /* Productos — crear / editar */
  const productModal = document.getElementById('productModal');
  if (productModal) {
    const productTitle = productModal.querySelector('#productModalTitle');
    const productSubtitle = productModal.querySelector('#productModalSubtitle');
    const fields = {
      name: productModal.querySelector('#productName'),
      sku: productModal.querySelector('#productSku'),
      category: productModal.querySelector('#productCategory'),
      price: productModal.querySelector('#productPrice'),
      stockMin: productModal.querySelector('#productStockMin'),
      status: productModal.querySelector('#productStatus'),
    };

    function fillProduct(data) {
      if (fields.name) fields.name.value = data.name || '';
      if (fields.sku) fields.sku.value = data.sku || '';
      if (fields.category) fields.category.value = data.category || 'lacteos';
      if (fields.price) fields.price.value = data.price || '';
      if (fields.stockMin) fields.stockMin.value = data.stockMin || '15';
      if (fields.status) fields.status.value = data.status || 'activo';
    }

    document.querySelector('[data-product-new]')?.addEventListener('click', function () {
      if (productTitle) productTitle.textContent = 'Nuevo producto';
      if (productSubtitle) productSubtitle.textContent = 'Completa los datos del producto';
      fillProduct({});
      if (fields.sku) fields.sku.removeAttribute('readonly');
    });

    document.querySelectorAll('[data-edit-product]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        if (productTitle) productTitle.textContent = 'Editar producto';
        if (productSubtitle) productSubtitle.textContent = btn.dataset.name || 'Modifica los datos';
        fillProduct({
          name: btn.dataset.name,
          sku: btn.dataset.sku,
          category: btn.dataset.category,
          price: btn.dataset.price,
          stockMin: btn.dataset.stockMin,
          status: btn.dataset.status,
        });
        if (fields.sku) fields.sku.setAttribute('readonly', 'readonly');
        if (typeof bootstrap !== 'undefined') {
          bootstrap.Modal.getOrCreateInstance(productModal).show();
        }
      });
    });
  }

  /* Detalle producto */
  const productDetailModal = document.getElementById('productDetailModal');
  if (productDetailModal) {
    productDetailModal.addEventListener('show.bs.modal', function (event) {
      const btn = event.relatedTarget;
      if (!btn) return;
      const set = function (id, val) {
        const el = document.getElementById(id);
        if (el) el.textContent = val || '—';
      };
      set('detailProductName', btn.dataset.name);
      set('detailProductSku', btn.dataset.sku);
      set('detailProductCategory', btn.dataset.category);
      set('detailProductPrice', btn.dataset.price);
      set('detailProductStock', btn.dataset.stock + ' uds');
      set('detailProductStatus', btn.dataset.status);
    });
  }

  document.querySelectorAll('[data-table]').forEach(function (el) {
    if (typeof $ !== 'undefined' && $.fn.DataTable) {
      $(el).DataTable({
        language: { url: '//cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json' },
        pageLength: 10,
        responsive: true,
      });
    }
  });

  document.querySelectorAll('[data-confirm-delete]').forEach(function (btn) {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      if (typeof Swal === 'undefined') return;
      Swal.fire({
        title: '¿Eliminar registro?',
        text: 'Esta acción no se puede deshacer.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2563EB',
        cancelButtonColor: '#64748B',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        backdrop: true,
        customClass: { popup: 'swal-app' },
      }).then(function (result) {
        if (result.isConfirmed && typeof showToast === 'function') {
          showToast('Registro eliminado (demo)', 'success');
        }
      });
    });
  });
})();
