<?php 
$title = 'Mis Comisiones - Barbero';
include '../app/views/includes/header.php'; 
include '../app/views/includes/navbar.php';
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-0">
            <div class="nav flex-column nav-pills p-3">
                <a class="nav-link" href="<?= BASE_URL ?>index.php?url=barbero/dashboard">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a class="nav-link" href="<?= BASE_URL ?>index.php?url=barbero/citas">
                    <i class="fas fa-calendar"></i> Mis Citas
                </a>
                <a class="nav-link active" href="<?= BASE_URL ?>index.php?url=barbero/comisiones">
                    <i class="fas fa-money-bill"></i> Comisiones
                </a>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <h2 class="mb-4">Mis Comisiones</h2>
            
            <!-- Resumen -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card bg-warning text-white">
                        <div class="card-body text-center">
                            <h4>$<?= number_format($total_pendiente, 2) ?></h4>
                            <p>Pendiente de Pago</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <h4>$<?= number_format($total_pagado, 2) ?></h4>
                            <p>Total Pagado</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-info text-white">
                        <div class="card-body text-center">
                            <h4>$<?= number_format($total_pendiente + $total_pagado, 2) ?></h4>
                            <p>Total Generado</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Detalle de Comisiones -->
            <div class="card">
                <div class="card-header">
                    <h5>Detalle de Comisiones</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Fecha Cita</th>
                                    <th>Servicio</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                    <th>Generada</th>
                                    <th>Pagada</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($comisiones as $comision): ?>
                                <tr>
                                    <td><?= date('d/m/Y', strtotime($comision['cita_fecha'])) ?></td>
                                    <td><?= htmlspecialchars($comision['servicio_nombre']) ?></td>
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
