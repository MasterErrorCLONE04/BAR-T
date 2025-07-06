<?php 
$title = 'Gestión de Usuarios - Administrador';
include '../app/views/includes/header.php'; 
include '../app/views/includes/navbar.php';
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include '../app/views/includes/sidebar.php'; ?>
        
        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Gestión de Usuarios</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBarbero">
                    <i class="fas fa-plus"></i> Nuevo Barbero
                </button>
            </div>
            
            <!-- Barberos -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5><i class="fas fa-user-tie"></i> Barberos</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Usuario</th>
                                    <th>Correo</th>
                                    <th>Comisión (%)</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($barberos as $barbero): ?>
                                <tr>
                                    <td><?= $barbero['id'] ?></td>
                                    <td><?= htmlspecialchars($barbero['nombre']) ?></td>
                                    <td><?= htmlspecialchars($barbero['usuario']) ?></td>
                                    <td><?= htmlspecialchars($barbero['correo']) ?></td>
                                    <td><?= $barbero['comision'] ?>%</td>
                                    <td>
                                        <span class="badge bg-<?= $barbero['activo'] ? 'success' : 'danger' ?>">
                                            <?= $barbero['activo'] ? 'Activo' : 'Inactivo' ?>
                                        </span>
                                    </td>
                                    <td>
                                        <!-- Botón Editar -->
                                        <button class="btn btn-sm btn-outline-primary btnEditarBarbero"
                                            data-id="<?= $barbero['id'] ?>"
                                            data-nombre="<?= htmlspecialchars($barbero['nombre'], ENT_QUOTES) ?>"
                                            data-usuario="<?= htmlspecialchars($barbero['usuario'], ENT_QUOTES) ?>"
                                            data-correo="<?= htmlspecialchars($barbero['correo'], ENT_QUOTES) ?>"
                                            data-comision="<?= $barbero['comision'] ?>"
                                            data-bs-toggle="modal" data-bs-target="#modalEditarBarbero">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- Botón Eliminar -->
                                        <form method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas eliminar este barbero?');">
                                            <input type="hidden" name="action" value="delete_barbero">
                                            <input type="hidden" name="id" value="<?= $barbero['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Clientes -->
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-users"></i> Clientes</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Usuario</th>
                                    <th>Correo</th>
                                    <th>Fecha Registro</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($clientes as $cliente): ?>
                                <tr>
                                    <td><?= $cliente['id'] ?></td>
                                    <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                                    <td><?= htmlspecialchars($cliente['usuario']) ?></td>
                                    <td><?= htmlspecialchars($cliente['correo']) ?></td>
                                    <td><?= date('d/m/Y', strtotime($cliente['creado_en'])) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $cliente['activo'] ? 'success' : 'danger' ?>">
                                            <?= $cliente['activo'] ? 'Activo' : 'Inactivo' ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

<script>
document.querySelectorAll('.btnEditarBarbero').forEach(button => {
    button.addEventListener('click', function () {
        document.getElementById('edit-id').value = this.dataset.id;
        document.getElementById('edit-nombre').value = this.dataset.nombre;
        document.getElementById('edit-usuario').value = this.dataset.usuario;
        document.getElementById('edit-correo').value = this.dataset.correo;
        document.getElementById('edit-comision').value = this.dataset.comision;
    });
});
</script>



<?php include '../app/views/includes/footer.php'; ?>
