<?php 
$title = 'Agendar Cita - Cliente';
include '../app/views/includes/header.php'; 
include '../app/views/includes/navbar.php';
?>

<div class="container-fluid">
    <div class="d-flex">
        <!-- Sidebar -->
        <?php include '../app/views/includes/sidebar.php'; ?>
        
        <!-- Main Content -->
        <div class="main-content flex-grow-1 bg-light p-4 transition-all" id="mainContent">
            <h2 class="mb-4">Agendar Nueva Cita</h2>
            
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
            
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="servicio_id" class="form-label">Servicio</label>
                                        <select class="form-select" id="servicio_id" name="servicio_id" required>
                                            <option value="">Seleccionar servicio...</option>
                                            <?php foreach ($servicios as $servicio): ?>
                                                <option value="<?= $servicio['id'] ?>" data-precio="<?= $servicio['precio'] ?>">
                                                    <?= htmlspecialchars($servicio['nombre']) ?> - $<?= number_format($servicio['precio'], 2) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="barbero_id" class="form-label">Barbero</label>
                                        <select class="form-select" id="barbero_id" name="barbero_id" required>
                                            <option value="">Seleccionar barbero...</option>
                                            <?php foreach ($barberos as $barbero): ?>
                                                <option value="<?= $barbero['id'] ?>">
                                                    <?= htmlspecialchars($barbero['nombre']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="fecha" class="form-label">Fecha</label>
                                        <input type="date" class="form-control" id="fecha" name="fecha" 
                                               min="<?= date('Y-m-d') ?>" required>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="hora" class="form-label">Hora</label>
                                        <select class="form-select" id="hora" name="hora" required>
                                            <option value="">Seleccionar hora...</option>
                                            <?php
                                            for ($h = 9; $h <= 18; $h++) {
                                                for ($m = 0; $m < 60; $m += 30) {
                                                    $time = sprintf('%02d:%02d', $h, $m);
                                                    echo "<option value='$time'>$time</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-calendar-plus"></i> Agendar Cita
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-info-circle"></i> Información</h5>
                        </div>
                        <div class="card-body">
                            <h6>Horarios de Atención:</h6>
                            <p>Lunes a Viernes: 9:00 - 18:00<br>
                               Sábados: 9:00 - 16:00<br>
                               Domingos: Cerrado</p>
                            
                            <h6>Servicios Disponibles:</h6>
                            <ul class="list-unstyled">
                                <?php foreach ($servicios as $servicio): ?>
                                    <li>
                                        <strong><?= htmlspecialchars($servicio['nombre']) ?></strong><br>
                                        <small class="text-muted"><?= htmlspecialchars($servicio['descripcion']) ?></small><br>
                                        <span class="text-primary">$<?= number_format($servicio['precio'], 2) ?></span>
                                    </li>
                                    <hr>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../app/views/includes/footer.php'; ?>
