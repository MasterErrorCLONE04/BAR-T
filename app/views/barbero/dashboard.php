<?php 
$title = 'Dashboard - Barbero';
include '../app/views/includes/header.php'; 
include '../app/views/includes/navbar.php';
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include '../app/views/includes/sidebar.php'; ?>
        
        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <h2 class="mb-4">Dashboard - Barbero</h2>
            
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4><?= count($citas_hoy) ?></h4>
                                    <p>Citas Hoy</p>
                                </div>
                                <i class="fas fa-calendar-day fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4><?= $citas_pendientes ?></h4>
                                    <p>Pendientes</p>
                                </div>
                                <i class="fas fa-clock fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>$<?= number_format($comisiones_mes, 2) ?></h4>
                                    <p>Este Mes</p>
                                </div>
                                <i class="fas fa-dollar-sign fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>$<?= number_format($total_comisiones, 2) ?></h4>
                                    <p>Total Comisiones</p>
                                </div>
                                <i class="fas fa-chart-line fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Citas de Hoy -->
            <div class="card">
                <div class="card-header">
                    <h5>Citas de Hoy</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($citas_hoy)): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Hora</th>
                                        <th>Cliente</th>
                                        <th>Servicio</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($citas_hoy as $cita): ?>
                                    <tr>
                                        <td><?= date('H:i', strtotime($cita['hora'])) ?></td>
                                        <td><?= htmlspecialchars($cita['cliente_nombre']) ?></td>
                                        <td><?= htmlspecialchars($cita['servicio_nombre']) ?></td>
                                        <td>
                                            <span class="badge bg-<?= 
                                                $cita['estado'] === 'realizada' ? 'success' : 
                                                ($cita['estado'] === 'confirmada' ? 'info' : 'warning') 
                                            ?>">
                                                <?= ucfirst($cita['estado']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($cita['estado'] === 'pendiente'): ?>
                                                <a href="<?= BASE_URL ?>index.php?url=barbero/citas" class="btn btn-sm btn-primary">
                                                    Gestionar
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> No tienes citas programadas para hoy.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../app/views/includes/footer.php'; ?>
