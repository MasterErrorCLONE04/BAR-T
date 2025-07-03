<?php 
$title = 'Gestión de Comisiones - Administrador';
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
                <a class="nav-link" href="<?= BASE_URL ?>index.php?url=admin/citas">
                    <i class="fas fa-calendar"></i> Citas
                </a>
                <a class="nav-link active" href="<?= BASE_URL ?>index.php?url=admin/comisiones">
                    <i class="fas fa-money-bill"></i> Comisiones
                </a>
                <a class="nav-link" href="<?= BASE_URL ?>index.php?url=admin/pagos">
                    <i class="fas fa-credit-card"></i> Pagos
                </a>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <h2 class="mb-4">Gestión de Comisiones</h2>
            
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Barbero</th>
                                    <th>Servicio</th>
                                    <th>Fecha Cita</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                    <th>Generada</th>
                                    <th>Pagada</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($comisiones as $comision): ?>
                                <tr>
                                    <td><?= $comision['id'] ?></td>
                                    <td><?= htmlspecialchars($comision['barbero_nombre']) ?></td>
                                    <td><?= htmlspecialchars($comision['servicio_nombre']) ?></td>
                                    <td><?= date('d/m/Y', strtotime($comision['cita_fecha'])) ?></td>
                                    <td>$<?= number_format($comision['monto'], 2) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $comision['estado'] === 'pagada' ? 'success' : 'warning' ?>">
                                            <?= ucfirst($comision['estado']) ?>
                                        </span>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($comision['creado_en'])) ?></td>
                                    <td>
                                        <?= $comision['pagado_en'] ? date('d/m/Y', strtotime($comision['pagado_en'])) : '-' ?>
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

<?php include '../app/views/includes/footer.php'; ?>
