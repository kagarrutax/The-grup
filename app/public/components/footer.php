    </main>
</div><!-- .app-wrapper -->

<script src="<?= $vendorBase ?? 'node_modules' ?>/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= $vendorBase ?? 'node_modules' ?>/chart.js/dist/chart.umd.min.js"></script>
<script src="<?= $vendorBase ?? 'node_modules' ?>/jquery/dist/jquery.min.js"></script>
<script src="<?= $vendorBase ?? 'node_modules' ?>/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= $vendorBase ?? 'node_modules' ?>/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= $vendorBase ?? 'node_modules' ?>/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="<?= $vendorBase ?? 'node_modules' ?>/toastify-js/src/toastify.js"></script>
<script src="<?= $assetBase ?? 'assets' ?>/js/app.js"></script>
<?php if (!empty($loadDashboardJs)): ?>
<script src="<?= $assetBase ?? 'assets' ?>/js/dashboard.js"></script>
<?php endif; ?>
<?php if (!empty($loadBusquedaJs)): ?>
<script src="<?= $assetBase ?? 'assets' ?>/js/busqueda.js"></script>
<?php endif; ?>
<?php if (!empty($loadReportesJs)): ?>
<script src="<?= $assetBase ?? 'assets' ?>/js/reportes.js"></script>
<?php endif; ?>
<?php if (!empty($extraScripts)): ?>
<?= $extraScripts ?>
<?php endif; ?>
</body>
</html>
