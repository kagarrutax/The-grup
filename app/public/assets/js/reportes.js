/**
 * Reportes — gráficos Chart.js (demo)
 */
(function () {
  if (typeof Chart === 'undefined') return;

  const colors = {
    green: '#059669',
    red: '#DC2626',
    blue: '#2563EB',
    purple: '#4F46E5',
    amber: '#D97706',
    slate: '#64748B',
  };

  const movementsCanvas = document.getElementById('reportMovementsChart');
  if (movementsCanvas) {
    new Chart(movementsCanvas, {
      type: 'bar',
      data: {
        labels: ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4'],
        datasets: [
          {
            label: 'Entradas',
            data: [52, 68, 58, 70],
            backgroundColor: 'rgba(5, 150, 105, 0.75)',
            borderRadius: 6,
            borderSkipped: false,
          },
          {
            label: 'Salidas',
            data: [40, 55, 45, 52],
            backgroundColor: 'rgba(220, 38, 38, 0.7)',
            borderRadius: 6,
            borderSkipped: false,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false },
          tooltip: {
            backgroundColor: '#1E293B',
            padding: 12,
            cornerRadius: 8,
          },
        },
        scales: {
          x: {
            grid: { display: false },
            ticks: { color: colors.slate, font: { size: 12 } },
          },
          y: {
            grid: { color: '#F1F5F9' },
            ticks: { color: colors.slate, font: { size: 12 } },
            beginAtZero: true,
          },
        },
      },
    });
  }

  const categoryCanvas = document.getElementById('reportCategoryChart');
  if (categoryCanvas) {
    new Chart(categoryCanvas, {
      type: 'doughnut',
      data: {
        labels: ['Lácteos', 'Bebidas', 'Despensa', 'Limpieza', 'Panadería'],
        datasets: [{
          data: [14200, 11800, 9600, 7400, 5200],
          backgroundColor: [
            colors.blue,
            colors.purple,
            colors.green,
            colors.amber,
            colors.slate,
          ],
          borderWidth: 0,
          hoverOffset: 6,
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '62%',
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              boxWidth: 10,
              padding: 12,
              font: { size: 11 },
              color: colors.slate,
            },
          },
          tooltip: {
            backgroundColor: '#1E293B',
            padding: 12,
            cornerRadius: 8,
            callbacks: {
              label: function (ctx) {
                return ' $' + ctx.raw.toLocaleString();
              },
            },
          },
        },
      },
    });
  }

  const detailModal = document.getElementById('reportDetailModal');
  if (detailModal) {
    detailModal.addEventListener('show.bs.modal', function (event) {
      const btn = event.relatedTarget;
      if (!btn) return;
      const set = function (id, val) {
        const el = document.getElementById(id);
        if (el) el.textContent = val || '—';
      };
      set('reportDetailTitle', btn.dataset.title);
      set('reportDetailPeriod', btn.dataset.period);
      set('reportDetailType', btn.dataset.type);
      set('reportDetailUser', btn.dataset.user);
      set('reportDetailSummary', btn.dataset.summary);
      set('reportDetailDate', 'Generado el ' + (btn.dataset.date || '—'));
    });
  }

  document.querySelectorAll('[data-export-report]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      if (typeof showToast === 'function') {
        showToast('Descarga iniciada (demo)', 'success');
      }
    });
  });
})();
