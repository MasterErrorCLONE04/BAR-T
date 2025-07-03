<?php 
$title = 'Dashboard - Administrador';
include '../app/views/includes/header.php'; 
include '../app/views/includes/navbar.php';
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-0">
            <div class="nav flex-column nav-pills p-3">
                <a class="nav-link active" href="<?= BASE_URL ?>index.php?url=admin/dashboard">
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
            <h2 class="mb-4">Dashboard Administrativo</h2>
            
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4><?= $total_citas ?></h4>
                                    <p>Total Citas</p>
                                </div>
                                <i class="fas fa-calendar fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4><?= $total_barberos ?></h4>
                                    <p>Barberos</p>
                                </div>
                                <i class="fas fa-user-tie fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4><?= $total_clientes ?></h4>
                                    <p>Clientes</p>
                                </div>
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>$<?= number_format($comisiones_pendientes, 2) ?></h4>
                                    <p>Comisiones Pendientes</p>
                                </div>
                                <i class="fas fa-money-bill fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-dark text-white shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4>$<?= isset($saldo_admin) ? number_format($saldo_admin, 2) : '0.00' ?></h4>
                                    <p class="mb-0">Saldo del Administrador</p>
                                </div>
                                <i class="fas fa-wallet fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
            
            <!-- Recent Appointments -->
            <div class="card">
                <div class="card-header">
                    <h5>Citas Recientes</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Barbero</th>
                                    <th>Servicio</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($citas_recientes as $cita): ?>
                                <tr>
                                    <td><?= htmlspecialchars($cita['cliente_nombre']) ?></td>
                                    <td><?= htmlspecialchars($cita['barbero_nombre']) ?></td>
                                    <td><?= htmlspecialchars($cita['servicio_nombre']) ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($cita['fecha'] . ' ' . $cita['hora'])) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $cita['estado'] === 'realizada' ? 'success' : ($cita['estado'] === 'pendiente' ? 'warning' : 'info') ?>">
                                            <?= ucfirst($cita['estado']) ?>
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

<?php include '../app/views/includes/footer.php'; ?>
