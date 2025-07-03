<?php 
$title = 'Gestión de Citas - Administrador';
include '../app/views/includes/header.php'; 
include '../app/views/includes/navbar.php';
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-0">
            <div class="nav flex-column nav-pills p-3">
                <a class="nav-link" href="<?= BASE_URL ?>index.php?url=admin/dashboard">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a class="nav-link" href="<?= BASE_URL ?>index.php?url=admin/usuarios">
                    <i class="fas fa-users"></i> Usuarios
                </a>
                <a class="nav-link" href="<?= BASE_URL ?>index.php?url=admin/servicios">
                    <i class="fas fa-cut"></i> Servicios
                </a>
                <a class="nav-link active" href="<?= BASE_URL ?>index.php?url=admin/citas">
                    <i class="fas fa-calendar"></i> Citas
                </a>
                <a class="nav-link" href="<?= BASE_URL ?>index.php?url=admin/comisiones">
                    <i class="fas fa-money-bill"></i> Comisiones
                </a>
                <a class="nav-link" href="<?= BASE_URL ?>index.php?url=admin/pagos">
                    <i class="fas fa-credit-card"></i> Pagos
                </a>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <h2 class="mb-4">Gestión de Citas</h2>
            
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Barbero</th>
                                    <th>Servicio</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Precio</th>
                                    <th>Estado</th>
                                    <th>Creada</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($citas as $cita): ?>
                                <tr>
                                    <td><?= $cita['id'] ?></td>
                                    <td><?= htmlspecialchars($cita['cliente_nombre']) ?></td>
                                    <td><?= htmlspecialchars($cita['barbero_nombre']) ?></td>
                                    <td><?= htmlspecialchars($cita['servicio_nombre']) ?></td>
                                    <td><?= date('d/m/Y', strtotime($cita['fecha'])) ?></td>
                                    <td><?= date('H:i', strtotime($cita['hora'])) ?></td>
                                    <td>$<?= number_format($cita['servicio_precio'], 2) ?></td>
                                    <td>
                                        <span class="badge bg-<?= 
                                            $cita['estado'] === 'realizada' ? 'success' : 
                                            ($cita['estado'] === 'confirmada' ? 'info' : 
                                            ($cita['estado'] === 'pendiente' ? 'warning' : 'danger')) 
                                        ?>">
                                            <?= ucfirst($cita['estado']) ?>
                                        </span>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($cita['creado_en'])) ?></td>
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

<?php include '../app/views/includes/footer.php'; ?>
