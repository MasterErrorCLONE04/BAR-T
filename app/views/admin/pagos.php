<?php 
$title = 'Gestión de Pagos - Administrador';
include '../app/views/includes/header.php'; 
include '../app/views/includes/navbar.php';
?>

<div class="container-fluid d-flex flex-column" style="min-height: 100vh;">
    <div class="d-flex flex-grow-1">
        <!-- Sidebar -->
        <?php include '../app/views/includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content flex-grow-1 bg-light p-4 d-flex flex-column">
            <h2 class="mb-4">Gestión de Pagos</h2>

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

            <!-- Comisiones Pendientes -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Comisiones Pendientes de Pago</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($comisiones_pendientes)): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Barbero</th>
                                        <th>Total Comisiones</th>
                                        <th>Monto Total</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($comisiones_pendientes as $pendiente): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($pendiente['barbero_nombre']) ?></td>
                                        <td><?= $pendiente['total_comisiones'] ?></td>
                                        <td>$<?= number_format($pendiente['total_monto'], 2) ?></td>
                                        <td>
                                            <form method="POST" class="d-inline">
                                                <input type="hidden" name="barbero_id" value="<?= $pendiente['barbero_id'] ?>">
                                                <button type="submit" class="btn btn-success btn-sm"
                                                    onclick="return confirmarAccion('¿Confirmar pago de $<?= number_format($pendiente['total_monto'], 2) ?> a <?= htmlspecialchars($pendiente['barbero_nombre']) ?>?')">
                                                    <i class="fas fa-credit-card"></i> Pagar $<?= number_format($pendiente['total_monto'], 2) ?>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> No hay comisiones pendientes de pago.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Historial de Pagos -->
            <div class="card flex-grow-1">
                <div class="card-header">
                    <h5>Historial de Pagos</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($pagos_realizados)): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Barbero</th>
                                        <th>Monto Pagado</th>
                                        <th>Fecha Pago</th>
                                        <th>Observaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pagos_realizados as $pago): ?>
                                    <tr>
                                        <td><?= $pago['id'] ?></td>
                                        <td><?= htmlspecialchars($pago['barbero_nombre']) ?></td>
                                        <td>$<?= number_format($pago['total_pagado'], 2) ?></td>
                                        <td><?= date('d/m/Y H:i', strtotime($pago['creado_en'])) ?></td>
                                        <td><?= htmlspecialchars($pago['observaciones'] ?? '-') ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> No hay pagos registrados aún.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div> <!-- Fin Main Content -->
    </div> <!-- Fin Row -->
</div> <!-- Fin Container -->

<script>
function confirmarAccion(mensaje) {
    return confirm(mensaje);
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
