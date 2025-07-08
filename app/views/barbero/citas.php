<?php 
$title = 'Mis Citas - Barbero';
include '../app/views/includes/header.php'; 
include '../app/views/includes/navbar.php';
?>

<div class="container-fluid">
    <div class="d-flex">
        <!-- Sidebar -->
        <?php include '../app/views/includes/sidebar.php'; ?>
        
        <!-- Main Content -->
        <div class="main-content flex-grow-1 bg-light p-4 transition-all" id="mainContent">
            <h2 class="mb-4">Mis Citas</h2>
            
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Cliente</th>
                                    <th>Servicio</th>
                                    <th>Precio</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($citas as $cita): ?>
                                <tr>
                                    <td><?= date('d/m/Y', strtotime($cita['fecha'])) ?></td>
                                    <td><?= date('H:i', strtotime($cita['hora'])) ?></td>
                                    <td><?= htmlspecialchars($cita['cliente_nombre']) ?></td>
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
                                    <td>
                                        <?php if ($cita['estado'] === 'pendiente'): ?>
                                            <form method="POST" class="d-inline">
                                                <input type="hidden" name="action" value="confirmar">
                                                <input type="hidden" name="cita_id" value="<?= $cita['id'] ?>">
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-check"></i> Confirmar
                                                </button>
                                            </form>
                                        <?php elseif ($cita['estado'] === 'confirmada'): ?>
                                            <form method="POST" class="d-inline">
                                                <input type="hidden" name="action" value="completar">
                                                <input type="hidden" name="cita_id" value="<?= $cita['id'] ?>">
                                                <button type="submit" class="btn btn-sm btn-success"
                                                        onclick="return confirmarAccion('¿Marcar como completada?')">
                                                    <i class="fas fa-check-double"></i> Completar
                                                </button>
                                            </form>
                                        <?php endif; ?>
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
