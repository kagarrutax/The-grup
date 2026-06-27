/**
 * Búsqueda avanzada — filtros demo (frontend mock)
 */
(function () {
  const grid = document.getElementById('productGrid');
  const items = grid ? Array.from(grid.querySelectorAll('.product-grid-item')) : [];
  const searchInput = document.getElementById('searchInput');
  const resultsCount = document.getElementById('searchResultsCount');
  const emptyState = document.getElementById('searchEmpty');
  const priceRange = document.getElementById('priceRange');
  const priceRangeLabel = document.getElementById('priceRangeLabel');
  const categoryFilter = document.getElementById('categoryFilter');

  let activeStatusFilters = ['activo'];
  let maxPrice = 5;
  let categoryValue = '';

  function getCheckedFilters(selector) {
    return Array.from(document.querySelectorAll(selector + ':checked')).map(function (el) {
      return el.dataset.filter;
    });
  }

  function syncFilterCheckboxes(statuses) {
    document.querySelectorAll('.sidebar-filter, .mobile-filter').forEach(function (el) {
      el.checked = statuses.includes(el.dataset.filter);
    });
    document.querySelectorAll('.filter-chip[data-filter]').forEach(function (chip) {
      chip.classList.toggle('active', statuses.includes(chip.dataset.filter));
    });
  }

  function applyFilters() {
    const query = (searchInput?.value || '').trim().toLowerCase();
    let visible = 0;

    items.forEach(function (item) {
      const name = item.dataset.name || '';
      const sku = item.dataset.sku || '';
      const category = item.dataset.category || '';
      const status = item.dataset.status || '';
      const price = parseFloat(item.dataset.price || '0');

      const matchesSearch = !query || name.includes(query) || sku.includes(query) || category.includes(query);
      const matchesStatus = activeStatusFilters.length === 0 || activeStatusFilters.includes(status);
      const matchesPrice = price <= maxPrice;
      const matchesCategory = !categoryValue || category === categoryValue.toLowerCase();

      const show = matchesSearch && matchesStatus && matchesPrice && matchesCategory;
      item.classList.toggle('d-none', !show);
      if (show) visible++;
    });

    if (resultsCount) {
      resultsCount.textContent = visible === 1
        ? 'Mostrando 1 producto'
        : 'Mostrando ' + visible + ' productos';
    }

    if (emptyState && grid) {
      emptyState.classList.toggle('d-none', visible > 0);
      grid.classList.toggle('d-none', visible === 0);
    }

    const clearBtn = document.getElementById('clearFilters');
    if (clearBtn) {
      const hasExtra = query || categoryValue || maxPrice < 10 || activeStatusFilters.join() !== 'activo';
      clearBtn.classList.toggle('d-none', !hasExtra);
    }
  }

  function setMaxPrice(val) {
    maxPrice = parseFloat(val);
    if (priceRangeLabel) priceRangeLabel.textContent = '$' + maxPrice.toFixed(2);
    const mobileLabel = document.getElementById('mobilePriceLabel');
    if (mobileLabel) mobileLabel.textContent = maxPrice.toFixed(2);
    if (priceRange) priceRange.value = maxPrice;
    const mobileRange = document.getElementById('mobilePriceRange');
    if (mobileRange) mobileRange.value = maxPrice;
  }

  searchInput?.addEventListener('input', applyFilters);

  priceRange?.addEventListener('input', function () {
    setMaxPrice(this.value);
  });

  document.getElementById('mobilePriceRange')?.addEventListener('input', function () {
    setMaxPrice(this.value);
  });

  categoryFilter?.addEventListener('change', function () {
    categoryValue = this.value;
    const mobile = document.getElementById('mobileCategoryFilter');
    if (mobile) mobile.value = this.value;
    applyFilters();
  });

  document.getElementById('mobileCategoryFilter')?.addEventListener('change', function () {
    categoryValue = this.value;
    if (categoryFilter) categoryFilter.value = this.value;
    applyFilters();
  });

  document.querySelectorAll('.sidebar-filter').forEach(function (el) {
    el.addEventListener('change', function () {
      activeStatusFilters = getCheckedFilters('.sidebar-filter');
      syncFilterCheckboxes(activeStatusFilters);
      applyFilters();
    });
  });

  document.querySelectorAll('.filter-chip[data-filter]').forEach(function (chip) {
    chip.addEventListener('click', function () {
      const filter = chip.dataset.filter;
      if (chip.classList.contains('active')) {
        chip.classList.remove('active');
        activeStatusFilters = activeStatusFilters.filter(function (f) { return f !== filter; });
      } else {
        chip.classList.add('active');
        if (!activeStatusFilters.includes(filter)) activeStatusFilters.push(filter);
      }
      syncFilterCheckboxes(activeStatusFilters);
      applyFilters();
    });
  });

  document.getElementById('applySidebarFilters')?.addEventListener('click', function () {
    activeStatusFilters = getCheckedFilters('.sidebar-filter');
    applyFilters();
    if (typeof showToast === 'function') showToast('Filtros aplicados (demo)', 'success');
  });

  document.getElementById('applyMobileFilters')?.addEventListener('click', function () {
    activeStatusFilters = getCheckedFilters('.mobile-filter');
    syncFilterCheckboxes(activeStatusFilters);
    categoryValue = document.getElementById('mobileCategoryFilter')?.value || '';
    if (categoryFilter) categoryFilter.value = categoryValue;
    applyFilters();
    if (typeof bootstrap !== 'undefined') {
      bootstrap.Modal.getInstance(document.getElementById('searchFilterModal'))?.hide();
    }
    if (typeof showToast === 'function') showToast('Filtros aplicados (demo)', 'success');
  });

  document.getElementById('clearFilters')?.addEventListener('click', resetSearch);
  document.getElementById('resetSearch')?.addEventListener('click', resetSearch);

  function resetSearch() {
    if (searchInput) searchInput.value = '';
    activeStatusFilters = ['activo'];
    categoryValue = '';
    setMaxPrice(10);
    if (categoryFilter) categoryFilter.value = '';
    syncFilterCheckboxes(activeStatusFilters);
    applyFilters();
  }

  document.getElementById('searchSort')?.addEventListener('change', function () {
    const sort = this.value;
    const sorted = items.slice().sort(function (a, b) {
      if (sort === 'price-asc') return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
      if (sort === 'price-desc') return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
      if (sort === 'stock') return parseInt(a.dataset.stock, 10) - parseInt(b.dataset.stock, 10);
      return (a.dataset.name || '').localeCompare(b.dataset.name || '');
    });
    sorted.forEach(function (el) { grid.appendChild(el); });
  });

  const detailModal = document.getElementById('searchProductModal');
  if (detailModal) {
    detailModal.addEventListener('show.bs.modal', function (event) {
      const card = event.relatedTarget;
      if (!card) return;
      const set = function (id, val) {
        const el = document.getElementById(id);
        if (el) el.textContent = val || '—';
      };
      set('searchDetailName', card.dataset.name);
      set('searchDetailSku', card.dataset.sku);
      set('searchDetailCategory', card.dataset.category);
      set('searchDetailPrice', card.dataset.price);
      set('searchDetailStock', card.dataset.stock);
      const statusEl = document.getElementById('searchDetailStatus');
      if (statusEl) {
        statusEl.innerHTML = '<span class="badge-pill ' + (card.dataset.badge || 'badge-active') + '">' +
          (card.dataset.status || '—') + '</span>';
      }
    });
  }

  applyFilters();
})();
