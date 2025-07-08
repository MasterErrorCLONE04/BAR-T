<!-- Modal Nuevo Barbero -->
<div class="modal fade" id="modalBarbero" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Barbero</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="create_barbero">
                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="comision" class="form-label">Comisión (%)</label>
                        <input type="number" class="form-control" id="comision" name="comision" min="0" max="100" step="0.01" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Barbero</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Barbero -->
<div class="modal fade" id="modalEditarBarbero" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Barbero</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="edit_barbero">
                    <input type="hidden" name="id" id="edit-id">

                    <div class="mb-3">
                        <label for="edit-nombre" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="edit-nombre" name="nombre" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="edit-usuario" name="usuario" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-correo" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="edit-correo" name="correo" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-comision" class="form-label">Comisión (%)</label>
                        <input type="number" class="form-control" id="edit-comision" name="comision" min="0" max="100" step="0.01" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
