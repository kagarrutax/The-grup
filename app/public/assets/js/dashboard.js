/**
 * Dashboard — gráfico principal + sparklines
 */
(function () {
  const colors = { blue: '#2563EB', green: '#059669' };

  const mainCanvas = document.getElementById('salesChart');
  if (mainCanvas && typeof Chart !== 'undefined') {
    new Chart(mainCanvas, {
      type: 'line',
      data: {
        labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
        datasets: [
          {
            label: 'Ventas',
            data: [820, 950, 880, 1100, 1050, 1240],
            borderColor: colors.blue,
            backgroundColor: 'rgba(13, 110, 253, 0.06)',
            fill: true,
            tension: 0.42,
            borderWidth: 2.5,
            pointRadius: 0,
            pointHoverRadius: 5,
          },
          {
            label: 'Entradas',
            data: [620, 720, 680, 890, 840, 980],
            borderColor: colors.green,
            backgroundColor: 'transparent',
            tension: 0.42,
            borderWidth: 2.5,
            pointRadius: 0,
            pointHoverRadius: 5,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: { mode: 'index', intersect: false },
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
            ticks: { color: '#64748B', font: { size: 12 } },
          },
          y: {
            grid: { color: '#F1F5F9' },
            ticks: { color: '#64748B', font: { size: 12 } },
            beginAtZero: true,
          },
        },
      },
    });
  }

  document.querySelectorAll('[data-sparkline]').forEach(function (el) {
    const values = (el.dataset.sparkline || '').split(',').map(Number);
    if (!values.length || typeof Chart === 'undefined') return;

    new Chart(el, {
      type: 'line',
      data: {
        labels: values.map(function (_, i) { return i; }),
        datasets: [{
          data: values,
          borderColor: el.dataset.color || colors.blue,
          borderWidth: 2,
          pointRadius: 0,
          tension: 0.4,
          fill: false,
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false }, tooltip: { enabled: false } },
        scales: {
          x: { display: false },
          y: { display: false },
        },
      },
    });
  });
})();
