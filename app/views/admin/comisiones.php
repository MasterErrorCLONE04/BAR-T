<?php 
$title = 'Gestión de Comisiones - Administrador';
include '../app/views/includes/header.php'; 
include '../app/views/includes/navbar.php';
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include '../app/views/includes/sidebar.php'; ?>
        
        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <h2 class="mb-4">Gestión de Comisiones</h2>
            
            <!-- Administrator Balance Alert -->
            <div class="alert alert-<?= $admin_balance >= 0 ? 'info' : 'warning' ?>">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-wallet"></i> <strong>Saldo disponible del administrador:</strong> $<?= number_format($admin_balance, 2) ?>
                        <small class="d-block mt-1">
                            Este saldo aumenta con servicios completados y disminuye al pagar comisiones
                        </small>
                    </div>
                    <?php 
                    $total_pendiente = array_sum(array_column(array_filter($comisiones, function($c) { return $c['estado'] === 'pendiente'; }), 'monto'));
                    if ($admin_balance < $total_pendiente): 
                    ?>
                        <div class="text-end">
                            <span class="badge bg-warning">
                                ⚠️ Saldo insuficiente para pagar todas las comisiones pendientes
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-list"></i> Historial de Comisiones</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($comisiones)): ?>
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
                                        <td>
                                            <span class="text-<?= $comision['estado'] === 'pendiente' ? 'warning' : 'success' ?>">
                                                $<?= number_format($comision['monto'], 2) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?= $comision['estado'] === 'pagada' ? 'success' : 'warning' ?>">
                                                <?= $comision['estado'] === 'pagada' ? 'Pagada' : 'Pendiente' ?>
                                            </span>
                                        </td>
                                        <td><?= date('d/m/Y H:i', strtotime($comision['creado_en'])) ?></td>
                                        <td>
                                            <?= $comision['pagado_en'] ? date('d/m/Y H:i', strtotime($comision['pagado_en'])) : '-' ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> No hay comisiones registradas aún.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Summary Cards -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card bg-warning text-white">
                        <div class="card-body text-center">
                            <h4>$<?= number_format(array_sum(array_column(array_filter($comisiones, function($c) { return $c['estado'] === 'pendiente'; }), 'monto')), 2) ?></h4>
                            <p>Comisiones Pendientes</p>
                            <small>Por pagar a barberos</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <h4>$<?= number_format(array_sum(array_column(array_filter($comisiones, function($c) { return $c['estado'] === 'pagada'; }), 'monto')), 2) ?></h4>
                            <p>Comisiones Pagadas</p>
                            <small>Ya descontadas del saldo</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-info text-white">
                        <div class="card-body text-center">
                            <h4>$<?= number_format(array_sum(array_column($comisiones, 'monto')), 2) ?></h4>
                            <p>Total Comisiones</p>
                            <small>Generadas hasta ahora</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../app/views/includes/footer.php'; ?>
