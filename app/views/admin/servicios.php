<?php 
$title = 'Gestión de Servicios - Administrador';
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
                <h2>Gestión de Servicios</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalServicio">
                    <i class="fas fa-plus"></i> Nuevo Servicio
                </button>
            </div>

            <?php if (isset($success)): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle"></i> <?= $success ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle"></i> <?= $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card flex-grow-1">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Total Citas</th>
                                    <th>Citas Realizadas</th>
                                    <th>Fecha Creación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($servicios as $servicio): ?>
                                <tr>
                                    <td><?= $servicio['id'] ?></td>
                                    <td><?= htmlspecialchars($servicio['nombre']) ?></td>
                                    <td><?= htmlspecialchars($servicio['descripcion']) ?></td>
                                    <td>$<?= number_format($servicio['precio'], 2) ?></td>
                                    <td><span class="badge bg-info"><?= $servicio['total_citas'] ?></span></td>
                                    <td><span class="badge bg-success"><?= $servicio['citas_realizadas'] ?></span></td>
                                    <td><?= date('d/m/Y', strtotime($servicio['creado_en'])) ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" 
                                            onclick="editarServicio(<?= $servicio['id'] ?>, '<?= htmlspecialchars($servicio['nombre'], ENT_QUOTES) ?>', '<?= htmlspecialchars($servicio['descripcion'], ENT_QUOTES) ?>', <?= $servicio['precio'] ?>)"
                                            data-bs-toggle="modal" data-bs-target="#modalEditarServicio">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" 
                                            onclick="eliminarServicio(<?= $servicio['id'] ?>, '<?= htmlspecialchars($servicio['nombre'], ENT_QUOTES) ?>', <?= $servicio['total_citas'] ?>)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- Fin main-content -->
    </div> <!-- Fin d-flex -->
</div> <!-- Fin container-fluid -->

<!-- Modales -->
<?php include '../app/views/includes/modales_servicios.php'; ?>

<!-- Scripts -->
<script>
function editarServicio(id, nombre, descripcion, precio) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_nombre').value = nombre;
    document.getElementById('edit_descripcion').value = descripcion;
    document.getElementById('edit_precio').value = precio;
}

function eliminarServicio(id, nombre, totalCitas) {
    document.getElementById('delete_id').value = id;
    document.getElementById('delete_service_name').textContent = nombre;
    document.getElementById('delete_appointments_count').textContent = totalCitas;

    const warningDiv = document.getElementById('delete_warning');
    const confirmBtn = document.getElementById('confirmDeleteBtn');

    if (totalCitas > 0) {
        warningDiv.style.display = 'block';
        confirmBtn.style.display = 'none';
    } else {
        warningDiv.style.display = 'none';
        confirmBtn.style.display = 'inline-block';
    }

    const modal = new bootstrap.Modal(document.getElementById('modalEliminar'));
    modal.show();
}
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
