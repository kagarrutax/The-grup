<!-- Modal para el Perfil del Administrador -->
<div class="modal fade" id="profileAdminModal" tabindex="-1" aria-labelledby="profileAdminLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modal-content-modern">
            <div class="modal-header modal-header-gradient">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-person-gear icon-header text-light"></i>
                    <div>
                        <h5 class="modal-title text-light mb-0" id="profileAdminLabel">Perfil del Administrador</h5>
                        <small class="text-light text-opacity-75">Gestiona tu cuenta</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-modern">
                <form action="{{ route('profile.update') }}" method="POST" id="profileForm">
                    @csrf
                    @method('PATCH')
                    
                    <!-- Sección: Información Personal -->
                    <div class="section-header mb-4">
                        <h6 class="mb-3">
                            <i class="bi bi-person-fill text-primary me-2"></i>Información Personal
                        </h6>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-medium">
                                <i class="bi bi-type text-primary me-2"></i>Nombre
                            </label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" 
                                   class="form-control form-control-modern @error('name') is-invalid @enderror" 
                                   placeholder="Tu nombre completo" required>
                            @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium">
                                <i class="bi bi-envelope text-primary me-2"></i>Correo Electrónico
                            </label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" 
                                   class="form-control form-control-modern @error('email') is-invalid @enderror" 
                                   placeholder="tu@email.com" required>
                            @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium\">
                                <i class=\"bi bi-shield-lock text-primary me-2\"></i>Rol
                            </label>
                            <div class=\"input-group\">
                                <span class=\"input-group-text bg-light\">
                                    <i class=\"bi bi-star-fill text-warning\"></i>
                                </span>
                                <input type=\"text\" class=\"form-control form-control-modern\" value=\"{{ ucfirst(auth()->user()->role) }}\" disabled>
                            </div>
                        </div>
                    </div>

                    <!-- Sección: Seguridad -->
                    <div class=\"section-header mb-4 mt-5 pt-3 border-top\">
                        <h6 class=\"mb-3\">
                            <i class=\"bi bi-lock-fill text-danger me-2\"></i>Seguridad
                        </h6>
                        <small class=\"text-muted\">Todos los campos son opcionales. Deja en blanco para no cambiar.</small>
                    </div>

                    <div class=\"row g-3\">
                        <div class=\"col-md-6\">
                            <label class=\"form-label fw-medium\">
                                <i class=\"bi bi-key text-danger me-2\"></i>Contraseña Actual
                            </label>
                            <input type=\"password\" name=\"current_password\" class=\"form-control form-control-modern\" 
                                   placeholder=\"Requerida para cambios de seguridad\">
                            <small class=\"text-muted d-block mt-2\">Solo si deseas cambiar contraseña</small>
                        </div>

                        <div class=\"col-md-6\">
                            <label class=\"form-label fw-medium\">
                                <i class=\"bi bi-key-fill text-success me-2\"></i>Nueva Contraseña
                            </label>
                            <input type=\"password\" name=\"password\" class=\"form-control form-control-modern\" 
                                   placeholder=\"Mínimo 8 caracteres\">
                            <small class=\"text-muted d-block mt-2\">Deja en blanco para no cambiar</small>
                        </div>

                        <div class=\"col-md-6\">
                            <label class=\"form-label fw-medium\">
                                <i class=\"bi bi-check-circle text-info me-2\"></i>Confirmar Contraseña
                            </label>
                            <input type=\"password\" name=\"password_confirmation\" class=\"form-control form-control-modern\" 
                                   placeholder=\"Confirma tu nueva contraseña\">
                            <small class=\"text-muted d-block mt-2\">Debe coincidir con la nueva contraseña</small>
                        </div>
                    </div>

                    <!-- Requisitos de contraseña -->
                    <div id=\"passwordRequirements\" class=\"alert alert-info alert-dismissible fade show mt-4\" style=\"display:none;\">
                        <strong>Requisitos de contraseña:</strong>
                        <ul class=\"mb-0 mt-2 small\">
                            <li>Mínimo 8 caracteres</li>
                            <li>Al menos una mayúscula</li>
                            <li>Al menos un número</li>
                            <li>Al menos un símbolo especial</li>
                        </ul>
                    </div>
                </form>
            </div>
            <div class=\"modal-footer modal-footer-modern\">
                <button type=\"button\" class=\"btn btn-light\" data-bs-dismiss=\"modal\">
                    <i class=\"bi bi-x-lg me-2\"></i>Cancelar
                </button>
                <button type=\"button\" class=\"btn btn-primary btn-modern\" onclick=\"document.getElementById('profileForm').submit()\">
                    <i class=\"bi bi-check-circle me-2\"></i>Guardar Cambios
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openProfileModal() {
        new bootstrap.Modal(document.getElementById('profileAdminModal')).show();
    }

    // Mostrar requisitos cuando hay entrada en campo de contraseña
    document.addEventListener('DOMContentLoaded', function() {
        const passwordField = document.querySelector('input[name=\"password\"]');
        const requirementsAlert = document.getElementById('passwordRequirements');
        
        if (passwordField) {
            passwordField.addEventListener('focus', function() {
                requirementsAlert.style.display = 'block';
            });
        }
    });
</script>
