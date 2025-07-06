<?php 
$title = 'Dashboard - Administrador';
include '../app/views/includes/header.php'; 
include '../app/views/includes/navbar.php';
?>

<div class="container-fluid admin-dashboard">
    <div class="row g-0">
        <!-- Sidebar -->
         <?php include '../app/views/includes/sidebar.php'; ?>
        <!-- Main Content -->
        <div class="col-lg-10 main-content bg-light">
            <div class="p-4">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0"><i class="fas fa-tachometer-alt me-2 text-primary"></i>Dashboard Administrativo</h2>
                    <div class="text-muted">
                        <i class="fas fa-calendar-alt me-2"></i><?= date('d F Y') ?>
                    </div>
                </div>
                
                <!-- Stats Cards -->
                <div class="row mb-4 g-4">
                    <!-- Saldo del administrador -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-dark text-white shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-subtitle mb-2 text-white-50">Saldo Disponible</h6>
                                        <h3 class="mb-0">$<?= number_format($admin_balance, 2) ?></h3>
                                    </div>
                                    <div class="bg-dark bg-opacity-50 p-3 rounded-circle">
                                        <i class="fas fa-wallet fa-2x"></i>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="<?= BASE_URL ?>index.php?url=admin/pagos" class="text-white small">
                                        Ver detalles <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total citas -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-subtitle mb-2 text-white-50">Total Citas</h6>
                                        <h3 class="mb-0"><?= $total_citas ?></h3>
                                    </div>
                                    <div class="bg-primary bg-opacity-50 p-3 rounded-circle">
                                        <i class="fas fa-calendar fa-2x"></i>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="<?= BASE_URL ?>index.php?url=admin/citas" class="text-white small">
                                        Ver todas <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total barberos -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-subtitle mb-2 text-white-50">Barberos Activos</h6>
                                        <h3 class="mb-0"><?= $total_barberos ?></h3>
                                    </div>
                                    <div class="bg-success bg-opacity-50 p-3 rounded-circle">
                                        <i class="fas fa-user-tie fa-2x"></i>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="<?= BASE_URL ?>index.php?url=admin/usuarios" class="text-white small">
                                        Administrar <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total clientes -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-info text-white shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-subtitle mb-2 text-white-50">Clientes Registrados</h6>
                                        <h3 class="mb-0"><?= $total_clientes ?></h3>
                                    </div>
                                    <div class="bg-info bg-opacity-50 p-3 rounded-circle">
                                        <i class="fas fa-users fa-2x"></i>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="<?= BASE_URL ?>index.php?url=admin/usuarios" class="text-white small">
                                        Ver lista <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Second Row of Stats -->
                <div class="row mb-4 g-4">
                    <!-- Comisiones pendientes -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-warning text-white shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-subtitle mb-2 text-white-50">Comisiones Pendientes</h6>
                                        <h3 class="mb-0">$<?= number_format($comisiones_pendientes, 2) ?></h3>
                                    </div>
                                    <div class="bg-warning bg-opacity-50 p-3 rounded-circle">
                                        <i class="fas fa-money-bill-wave fa-2x"></i>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="<?= BASE_URL ?>index.php?url=admin/comisiones" class="text-white small">
                                        Pagar ahora <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Financial Flow Explanation -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-white border-bottom-0">
                        <h5 class="mb-0"><i class="fas fa-exchange-alt text-primary me-2"></i>Flujo Financiero</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="p-3 bg-light rounded-3 h-100">
                                    <div class="icon-circle bg-success text-white mb-3 mx-auto">
                                        <i class="fas fa-check-circle fa-2x"></i>
                                    </div>
                                    <h5 class="text-success">1. Servicio Completado</h5>
                                    <p class="text-muted mb-0">El precio del servicio se agrega al saldo del administrador</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="p-3 bg-light rounded-3 h-100">
                                    <div class="icon-circle bg-warning text-white mb-3 mx-auto">
                                        <i class="fas fa-clock fa-2x"></i>
                                    </div>
                                    <h5 class="text-warning">2. Comisión Generada</h5>
                                    <p class="text-muted mb-0">Se crea una comisión pendiente para el barbero</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 bg-light rounded-3 h-100">
                                    <div class="icon-circle bg-danger text-white mb-3 mx-auto">
                                        <i class="fas fa-money-bill-wave fa-2x"></i>
                                    </div>
                                    <h5 class="text-danger">3. Pago de Comisión</h5>
                                    <p class="text-muted mb-0">El monto de la comisión se descuenta del saldo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Appointments & Quick Actions -->
                <div class="row">
                    <div class="col-lg-8 mb-4 mb-lg-0">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom-0">
                                <h5 class="mb-0"><i class="fas fa-history text-primary me-2"></i>Citas Recientes</h5>
                                <a href="<?= BASE_URL ?>index.php?url=admin/citas" class="btn btn-sm btn-outline-primary">
                                    Ver todas <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Cliente</th>
                                                <th>Barbero</th>
                                                <th>Servicio</th>
                                                <th>Fecha/Hora</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($citas_recientes as $cita): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($cita['cliente_nombre']) ?></td>
                                                <td><?= htmlspecialchars($cita['barbero_nombre']) ?></td>
                                                <td><?= htmlspecialchars($cita['servicio_nombre']) ?></td>
                                                <td><?= date('d/m/Y H:i', strtotime($cita['fecha'] . ' ' . $cita['hora'])) ?></td>
                                                <td>
                                                    <span class="badge rounded-pill bg-<?= 
                                                        $cita['estado'] === 'realizada' ? 'success' : 
                                                        ($cita['estado'] === 'pendiente' ? 'warning' : 
                                                        ($cita['estado'] === 'cancelada' ? 'danger' : 'info')) 
                                                    ?>">
                                                        <?= ucfirst($cita['estado']) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-secondary" title="Ver detalles">
                                                        <a href="<?= BASE_URL ?>index.php?url=admin/usuarios/create">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="col-lg-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-white border-bottom-0">
                                <h5 class="mb-0"><i class="fas fa-bolt text-primary me-2"></i>Acciones Rápidas</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="<?= BASE_URL ?>index.php?url=admin/usuarios/create" class="btn btn-outline-primary text-start">
                                        <i class="fas fa-user-plus me-2"></i> Agregar Usuario
                                    </a>
                                    <a href="<?= BASE_URL ?>index.php?url=admin/servicios/create" class="btn btn-outline-success text-start">
                                        <i class="fas fa-plus-circle me-2"></i> Crear Servicio
                                    </a>
                                    <a href="<?= BASE_URL ?>index.php?url=admin/citas/create" class="btn btn-outline-info text-start">
                                        <i class="fas fa-calendar-plus me-2"></i> Programar Cita
                                    </a>
                                    <a href="<?= BASE_URL ?>index.php?url=admin/comisiones/pagar" class="btn btn-outline-warning text-start">
                                        <i class="fas fa-hand-holding-usd me-2"></i> Pagar Comisiones
                                    </a>
                                    <a href="<?= BASE_URL ?>index.php?url=admin/reportes" class="btn btn-outline-dark text-start">
                                        <i class="fas fa-chart-pie me-2"></i> Generar Reporte
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .sidebar {
        min-height: 100vh;
        position: sticky;
        top: 0;
    }
    
    .main-content {
        min-height: 100vh;
    }
    
    .icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .bg-purple {
        background-color: #6f42c1 !important;
    }
    
    .bg-teal {
        background-color: #20c997 !important;
    }
    
    .nav-pills .nav-link.active {
        background-color: #0d6efd;
        font-weight: 500;
    }
    
    .nav-pills .nav-link {
        color: #adb5bd;
        transition: all 0.3s;
    }
    
    .nav-pills .nav-link:hover {
        color: white;
        background-color: rgba(255,255,255,0.1);
    }
    
    .card {
        border: none;
        border-radius: 10px;
        transition: transform 0.2s;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
</style>

<?php include '../app/views/includes/footer.php'; ?>