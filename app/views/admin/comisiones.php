<?php 
$title = 'Gestión de Comisiones - Administrador';
include '../app/views/includes/header.php'; 
include '../app/views/includes/navbar.php';
?>

<div class="container-fluid d-flex flex-column" style="min-height: 100vh;">
    <div class="d-flex flex-grow-1">
        <!-- Sidebar -->
        <?php include '../app/views/includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content flex-grow-1 bg-light p-4 d-flex flex-column">
            <h2 class="mb-4">Gestión de Comisiones</h2>

            <!-- Alertas de saldo -->
            <div class="alert alert-<?= $admin_balance >= 0 ? 'info' : 'warning' ?>">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <i class="fas fa-wallet"></i> <strong>Saldo disponible del administrador:</strong>
                        $<?= number_format($admin_balance, 2) ?>
                        <small class="d-block mt-1">
                            Este saldo aumenta con servicios completados y disminuye al pagar comisiones
                        </small>
                    </div>
                    <?php 
                    $total_pendiente = array_sum(array_column(array_filter($comisiones, fn($c) => $c['estado'] === 'pendiente'), 'monto'));
                    if ($admin_balance < $total_pendiente): 
                    ?>
                        <div class="text-end mt-2 mt-sm-0">
                            <span class="badge bg-warning">
                                ⚠️ Saldo insuficiente para pagar todas las comisiones pendientes
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Tabla de comisiones -->
            <div class="card mb-4 flex-grow-0">
                <div class="card-header">
                    <h5><i class="fas fa-list"></i> Historial de Comisiones</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($comisiones)): ?>
                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
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
                                                <?= ucfirst($comision['estado']) ?>
                                            </span>
                                        </td>
                                        <td><?= date('d/m/Y H:i', strtotime($comision['creado_en'])) ?></td>
                                        <td><?= $comision['pagado_en'] ? date('d/m/Y H:i', strtotime($comision['pagado_en'])) : '-' ?></td>
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

            <!-- Tarjetas resumen -->
            <?php include '../app/views/includes/cards_resumen_comisiones.php'; ?>
        </div>
    </div>
</div>

<?php include '../app/views/includes/footer.php'; ?>
