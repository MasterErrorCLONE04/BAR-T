<?php 
$title = 'Mis Citas - Barbero';
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
                <a class="nav-link active" href="<?= BASE_URL ?>index.php?url=barbero/citas">
                    <i class="fas fa-calendar"></i> Mis Citas
                </a>
                <a class="nav-link" href="<?= BASE_URL ?>index.php?url=barbero/comisiones">
                    <i class="fas fa-money-bill"></i> Comisiones
                </a>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-10 p-4">
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
