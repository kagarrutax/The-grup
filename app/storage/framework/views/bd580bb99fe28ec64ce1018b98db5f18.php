

<?php $__env->startSection('title', 'Perfil'); ?>

<?php $__env->startSection('page-title', 'Mi Perfil'); ?>

<?php $__env->startSection('page-subtitle', 'Gestiona tu cuenta personal'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row g-4">
        <!-- Tarjeta de Perfil Principal -->
        <div class="col-md-8">
            <div class="card-app card-profile-header">
                <div class="card-body p-0">
                    <div class="profile-header-gradient">
                        <div class="profile-avatar">
                            <i class="bi bi-person-circle"></i>
                        </div>
                    </div>
                    <div class="profile-body p-4">
                        <h3 class="mb-1"><?php echo e($user->name); ?></h3>
                        <p class="text-muted mb-3">
                            <i class="bi bi-shield-lock me-2"></i>
                            <span class="badge bg-primary"><?php echo e(ucfirst($user->role)); ?></span>
                        </p>
                        <p class="text-muted small mb-4">
                            <i class="bi bi-envelope me-2"></i><?php echo e($user->email); ?>

                        </p>

                        <div class="profile-actions d-flex gap-3 flex-wrap">
                            <button class="btn btn-primary btn-modern" onclick="openProfileModal()">
                                <i class="bi bi-pencil-square me-2"></i>Editar Perfil
                            </button>
                            <button class="btn btn-outline-danger" onclick="showDeleteConfirmation('<?php echo e($user->name); ?>', '<?php echo e(route('profile.destroy')); ?>', 'cuenta de usuario')">
                                <i class="bi bi-trash3 me-2"></i>Eliminar Cuenta
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Opciones de Cuenta -->
            <div class="card-app mt-4">
                <div class="card-body">
                    <h5 class="mb-4">
                        <i class="bi bi-gear text-primary me-2"></i>Opciones de Cuenta
                    </h5>

                    <div class="account-options">
                        <div class="option-item">
                            <div class="option-icon">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div class="option-details">
                                <h6>Información Personal</h6>
                                <p class="text-muted small mb-0">Actualiza tu nombre, correo y contraseña</p>
                            </div>
                            <div class="option-action">
                                <button class="btn btn-sm btn-outline-primary" onclick="openProfileModal()">
                                    <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>

                        <div class="option-item">
                            <div class="option-icon">
                                <i class="bi bi-lock-fill"></i>
                            </div>
                            <div class="option-details">
                                <h6>Cambiar Contraseña</h6>
                                <p class="text-muted small mb-0">Actualiza tu contraseña de forma segura</p>
                            </div>
                            <div class="option-action">
                                <button class="btn btn-sm btn-outline-primary" onclick="openProfileModal()">
                                    <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>

                        <div class="option-item">
                            <div class="option-icon bg-danger">
                                <i class="bi bi-exclamation-triangle-fill text-white"></i>
                            </div>
                            <div class="option-details">
                                <h6 class="text-danger">Zona de Peligro</h6>
                                <p class="text-muted small mb-0">Eliminar tu cuenta permanentemente</p>
                            </div>
                            <div class="option-action">
                                <button class="btn btn-sm btn-outline-danger" onclick="showDeleteConfirmation('<?php echo e($user->name); ?>', '<?php echo e(route('profile.destroy')); ?>', 'cuenta de usuario')">
                                    <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel Lateral de Información -->
        <div class="col-md-4">
            <!-- Widget de Información -->
            <div class="card-app info-widget">
                <div class="card-body">
                    <h6 class="mb-3">
                        <i class="bi bi-info-circle-fill text-primary me-2"></i>Detalles de la Cuenta
                    </h6>

                    <div class="info-item">
                        <label class="text-muted small">Nombre</label>
                        <p class="fw-medium"><?php echo e($user->name); ?></p>
                    </div>

                    <div class="info-item">
                        <label class="text-muted small">Correo Electrónico</label>
                        <p class="fw-medium"><?php echo e($user->email); ?></p>
                    </div>

                    <div class="info-item">
                        <label class="text-muted small">Rol</label>
                        <p class="fw-medium">
                            <span class="badge bg-primary"><?php echo e(ucfirst($user->role)); ?></span>
                        </p>
                    </div>

                    <hr class="my-3">

                    <div class="info-item">
                        <label class="text-muted small">Miembro desde</label>
                        <p class="fw-medium"><?php echo e($user->created_at->format('d/m/Y')); ?></p>
                    </div>

                    <div class="info-item">
                        <label class="text-muted small">Última actualización</label>
                        <p class="fw-medium"><?php echo e($user->updated_at->format('d/m/Y H:i')); ?></p>
                    </div>
                </div>
            </div>

            <!-- Widget de Seguridad -->
            <div class="card-app info-widget mt-4\">
                <div class="card-body\">
                    <h6 class=\"mb-3\">
                        <i class=\"bi bi-shield-check text-success me-2\"></i>Estado de Seguridad
                    </h6>

                    <div class=\"security-status\">
                        <div class=\"status-item\">
                            <span class=\"status-indicator status-active\"></span>
                            <span class=\"text-small\">Sesión activa</span>
                        </div>

                        <div class=\"status-item\">
                            <span class=\"status-indicator status-active\"></span>
                            <span class=\"text-small\">Administrador verificado</span>
                        </div>

                        <div class=\"status-item\">
                            <span class=\"status-indicator status-active\"></span>
                            <span class=\"text-small\">Token CSRF protegido</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modales -->
    <?php echo $__env->make('components.modal-profile-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('components.modal-delete-confirmation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\The-grup\app\resources\views/profile/edit.blade.php ENDPATH**/ ?>