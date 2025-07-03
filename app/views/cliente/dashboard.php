<?php 
$title = 'Dashboard - Cliente';
include '../app/views/includes/header.php'; 
include '../app/views/includes/navbar.php';
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-0">
            <div class="nav flex-column nav-pills p-3">
                <a class="nav-link active" href="<?= BASE_URL ?>index.php?url=cliente/dashboard">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a class="nav-link" href="<?= BASE_URL ?>index.php?url=cliente/agendar">
                    <i class="fas fa-plus"></i> Agendar Cita
                </a>
                <a class="nav-link" href="<?= BASE_URL ?>index.php?url=cliente/historial">
                    <i class="fas fa-history"></i> Historial
                </a>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <h2 class="mb-4">Bienvenido, <?= SessionHelper::getUserName() ?></h2>
            
            <!-- Próxima Cita -->
            <div class="row mb-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-calendar-check"></i> Próxima Cita</h5>
                        </div>
                        <div class="card-body">
                            <?php if ($proxima_cita): ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Fecha:</strong> <?= date('d/m/Y', strtotime($proxima_cita['fecha'])) ?></p>
                                        <p><strong>Hora:</strong> <?= date('H:i', strtotime($proxima_cita['hora'])) ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Barbero:</strong> <?= htmlspecialchars($proxima_cita['barbero_nombre']) ?></p>
                                        <p><strong>Servicio:</strong> <?= htmlspecialchars($proxima_cita['servicio_nombre']) ?></p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="text-center">
                                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                    <p>No tienes citas programadas</p>
                                    <a href="<?= BASE_URL ?>index.php?url=cliente/agendar" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Agendar Nueva Cita
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-cut fa-3x mb-3"></i>
                            <h5>¿Necesitas una cita?</h5>
                            <a href="<?= BASE_URL ?>index.php?url=cliente/agendar" class="btn btn-light">
                                Agendar Ahora
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Citas Recientes -->
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-history"></i> Citas Recientes</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($citas_recientes)): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Barbero</th>
                                        <th>Servicio</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($citas_recientes as $cita): ?>
                                    <tr>
                                        <td><?= date('d/m/Y', strtotime($cita['fecha'])) ?></td>
                                        <td><?= date('H:i', strtotime($cita['hora'])) ?></td>
                                        <td><?= htmlspecialchars($cita['barbero_nombre']) ?></td>
                                        <td><?= htmlspecialchars($cita['servicio_nombre']) ?></td>
                                        <td>
                                            <span class="badge bg-<?= 
                                                $cita['estado'] === 'realizada' ? 'success' : 
                                                ($cita['estado'] === 'confirmada' ? 'info' : 
                                                ($cita['estado'] === 'pendiente' ? 'warning' : 'danger')) 
                                            ?>">
                                                <?= ucfirst($cita['estado']) ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-3">
                            <a href="<?= BASE_URL ?>index.php?url=cliente/historial" class="btn btn-outline-primary">
                                Ver Historial Completo
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Aún no tienes citas registradas.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../app/views/includes/footer.php'; ?>
