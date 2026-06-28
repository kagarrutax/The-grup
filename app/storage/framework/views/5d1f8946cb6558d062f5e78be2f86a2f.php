

<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>
<?php $__env->startSection('page-subtitle', 'Resumen general de tu inventario en tiempo real'); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard-page">
    <div class="dashboard-summary-grid">
        <?php $__currentLoopData = $summaryCards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <article class="summary-card summary-card-<?php echo e($card['tone']); ?>">
                <div class="summary-icon">
                    <i class="bi <?php echo e($card['icon']); ?>"></i>
                </div>
                <div class="summary-body">
                    <div class="summary-topline">
                        <span class="summary-title"><?php echo e($card['title']); ?></span>
                        <span class="summary-trend trend-<?php echo e($card['trendDirection']); ?>"><?php echo e($card['trend']); ?></span>
                    </div>
                    <div class="summary-value"><?php echo e($card['value']); ?></div>
                    <div class="summary-caption"><?php echo e($card['description']); ?></div>
                </div>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="dashboard-main-grid">
        <section class="card-app dashboard-card dashboard-chart-card">
            <div class="card-header dashboard-card-header">
                <div>
                    <h2 class="dashboard-card-title">Movimientos mensuales</h2>
                </div>
                <button type="button" class="dashboard-filter-button">
                    Entradas vs Salidas
                    <i class="bi bi-chevron-down"></i>
                </button>
            </div>
            <div class="card-body chart-card-body">
                <canvas id="movementsChart" height="120"></canvas>
            </div>
        </section>

        <aside class="card-app dashboard-card activity-card">
            <div class="card-header dashboard-card-header">
                <h2 class="dashboard-card-title">Actividad reciente</h2>
                <a href="#" class="dashboard-card-link" onclick="return false;">Ver todas</a>
            </div>
            <div class="card-body activity-card-body">
                <?php $__currentLoopData = $recentActivity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="activity-item">
                        <div class="activity-icon activity-icon-<?php echo e($item['type']); ?>">
                            <i class="bi <?php echo e($item['icon']); ?>"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title-row">
                                <strong><?php echo e($item['product']); ?></strong>
                                <span class="activity-meta"><?php echo e($item['sku']); ?></span>
                            </div>
                            <div class="activity-meta"><?php echo e($item['detail']); ?> · <?php echo e($item['time']); ?></div>
                        </div>
                        <div class="activity-badge-wrap">
                            <span class="activity-badge <?php echo e($item['type'] === 'entrada' ? 'badge-entrada' : 'badge-salida'); ?>">
                                <?php echo e(strtoupper($item['type'])); ?> <?php echo e($item['qty']); ?>

                            </span>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </aside>
    </div>

    <div class="dashboard-bottom-grid">
        <section class="card-app dashboard-card">
            <div class="card-header dashboard-card-header">
                <h2 class="dashboard-card-title">Productos con poco stock</h2>
                <a href="#" class="dashboard-card-link" onclick="return false;">Ver todas</a>
            </div>
            <div class="card-body stock-card-body">
                <?php $__currentLoopData = $lowStock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="stock-row">
                        <div class="stock-row-icon stock-row-icon-<?php echo e($item['level']); ?>">
                            <i class="bi <?php echo e($item['icon']); ?>"></i>
                        </div>
                        <div class="stock-row-content">
                            <div class="stock-bar-label">
                                <span><?php echo e($item['name']); ?></span>
                                <span class="text-muted"><?php echo e($item['current']); ?> / <?php echo e($item['max']); ?> uds</span>
                            </div>
                            <div class="stock-bar">
                                <div class="stock-bar-fill <?php echo e($item['level']); ?>" style="width: <?php echo e($item['percent']); ?>%"></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>

        <section class="card-app dashboard-card">
            <div class="card-header dashboard-card-header">
                <h2 class="dashboard-card-title">Top categorías</h2>
                <a href="#" class="dashboard-card-link" onclick="return false;">Ver todas</a>
            </div>
            <div class="card-body category-card-body">
                <?php $__currentLoopData = $topCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="category-row">
                        <div class="category-info">
                            <div class="category-icon">
                                <i class="bi <?php echo e($cat['icon']); ?>"></i>
                            </div>
                            <div>
                                <strong><?php echo e($cat['name']); ?></strong>
                                <div class="activity-meta"><?php echo e($cat['count']); ?> productos</div>
                            </div>
                        </div>
                        <span class="category-count"><?php echo e(number_format($cat['stock_total'])); ?> uds</span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    new Chart(document.getElementById('movementsChart'), {
        type: 'line',
        data: {
            labels: <?php echo json_encode($chartLabels, 15, 512) ?>,
            datasets: [
                {
                    label: 'Entradas',
                    data: <?php echo json_encode($chartEntradas, 15, 512) ?>,
                    borderColor: '#6a5cff',
                    backgroundColor: 'rgba(106, 92, 255, 0.10)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#6a5cff',
                    pointBorderWidth: 0,
                    pointRadius: 4,
                },
                {
                    label: 'Salidas',
                    data: <?php echo json_encode($chartSalidas, 15, 512) ?>,
                    borderColor: '#9ca3af',
                    backgroundColor: 'transparent',
                    tension: 0.4,
                    pointBackgroundColor: '#9ca3af',
                    pointBorderWidth: 0,
                    pointRadius: 4,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: false,
                        boxWidth: 28,
                        color: '#667085',
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#edf0f7' },
                    border: { display: false },
                    ticks: { color: '#98a2b3' }
                },
                x: {
                    grid: { display: false },
                    border: { display: false },
                    ticks: { color: '#98a2b3' }
                }
            }
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\The-grup\app\resources\views/dashboard/index.blade.php ENDPATH**/ ?>