<?php 
$title = 'Historial de Citas - Cliente';
include '../app/views/includes/header.php'; 
include '../app/views/includes/navbar.php';
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include '../app/views/includes/sidebar.php'; ?>
        
        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <h2 class="mb-4">Historial de Citas</h2>
            
            <div class="card">
                <div class="card-body">
                    <?php if (!empty($citas)): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Barbero</th>
                                        <th>Servicio</th>
                                        <th>Precio</th>
                                        <th>Estado</th>
                                        <th>Agendada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($citas as $cita): ?>
                                    <tr>
                                        <td><?= date('d/m/Y', strtotime($cita['fecha'])) ?></td>
                                        <td><?= date('H:i', strtotime($cita['hora'])) ?></td>
                                        <td><?= htmlspecialchars($cita['barbero_nombre']) ?></td>
                                        <td><?= htmlspecialchars($cita['servicio_nombre']) ?></td>
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
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-times fa-5x text-muted mb-3"></i>
                            <h4>No tienes citas registradas</h4>
                            <p class="text-muted">Agenda tu primera cita para comenzar</p>
                            <a href="<?= BASE_URL ?>index.php?url=cliente/agendar" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Agendar Primera Cita
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../app/views/includes/footer.php'; ?>
