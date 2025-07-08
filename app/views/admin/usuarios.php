<?php 
$title = 'Gestión de Usuarios - Administrador';
include '../app/views/includes/header.php'; 
include '../app/views/includes/navbar.php';
?>

<div class="container-fluid d-flex flex-column" style="min-height: 100vh;">
    <div class="d-flex flex-grow-1">
        <!-- Sidebar -->
        <?php include '../app/views/includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content flex-grow-1 bg-light p-4 d-flex flex-column">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Gestión de Usuarios</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBarbero">
                    <i class="fas fa-plus"></i> Nuevo Barbero
                </button>
            </div>

            <!-- Barberos -->
            <div class="card mb-4 flex-grow-0">
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
            <div class="card flex-grow-1">
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
        </div> <!-- Fin de main-content -->
    </div> <!-- Fin de fila -->
</div> <!-- Fin de container-fluid -->

<!-- Modales -->
<?php include '../app/models/modales_barberos.php'; ?>

<!-- Script para rellenar modal de edición -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.btnEditarBarbero').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('edit-id').value = this.dataset.id;
            document.getElementById('edit-nombre').value = this.dataset.nombre;
            document.getElementById('edit-usuario').value = this.dataset.usuario;
            document.getElementById('edit-correo').value = this.dataset.correo;
            document.getElementById('edit-comision').value = this.dataset.comision;
        });
    });
});
</script>

<style>
.sidebar {
    min-height: 100vh;
    position: sticky;
    top: 0;
}
.main-content {
    min-height: 100vh;
}
</style>

<?php include '../app/views/includes/footer.php'; ?>
