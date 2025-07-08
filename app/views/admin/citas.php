<?php 
$title = 'Gestión de Citas - Administrador';
include '../app/views/includes/header.php'; 
include '../app/views/includes/navbar.php';
?>

<div class="container-fluid">
    <div class="d-flex">
        <!-- Sidebar -->
        <?php include '../app/views/includes/sidebar.php'; ?>
        
        <!-- Main Content -->
        <div class="main-content flex-grow-1 bg-light p-4 transition-all" id="mainContent">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1">Gestión de Citas</h2>
                    <p class="text-muted mb-0">Administra y controla todas las citas de la barbería</p>
                </div>
                <div>
                    <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#nuevaCitaModal">
                        <i class="fas fa-plus"></i> Nueva Cita
                    </button>
                    <button class="btn btn-outline-success" onclick="exportarCitas()">
                        <i class="fas fa-download"></i> Exportar
                    </button>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Total Citas</h6>
                                    <h3 class="mb-0"><?= count($citas) ?></h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-calendar-alt fa-2x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Realizadas</h6>
                                    <h3 class="mb-0"><?= count(array_filter($citas, fn($c) => $c['estado'] === 'realizada')) ?></h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-check-circle fa-2x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card bg-info text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Confirmadas</h6>
                                    <h3 class="mb-0"><?= count(array_filter($citas, fn($c) => $c['estado'] === 'confirmada')) ?></h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-clock fa-2x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Pendientes</h6>
                                    <h3 class="mb-0"><?= count(array_filter($citas, fn($c) => $c['estado'] === 'pendiente')) ?></h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-hourglass-half fa-2x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Filters -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-xl-3 col-md-6">
                            <label class="form-label">Filtrar por Estado</label>
                            <select class="form-select" id="filtroEstado" onchange="filtrarCitas()">
                                <option value="">Todos los estados</option>
                                <option value="pendiente">Pendientes</option>
                                <option value="confirmada">Confirmadas</option>
                                <option value="realizada">Realizadas</option>
                                <option value="cancelada">Canceladas</option>
                            </select>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <label class="form-label">Filtrar por Fecha</label>
                            <input type="date" class="form-control" id="filtroFecha" onchange="filtrarCitas()">
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <label class="form-label">Buscar Cliente</label>
                            <input type="text" class="form-control" id="buscarCliente" placeholder="Nombre del cliente..." onkeyup="filtrarCitas()">
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <label class="form-label">Barbero</label>
                            <select class="form-select" id="filtroBarbero" onchange="filtrarCitas()">
                                <option value="">Todos los barberos</option>
                                <?php
                                $barberos = array_unique(array_column($citas, 'barbero_nombre'));
                                foreach ($barberos as $barbero): ?>
                                    <option value="<?= htmlspecialchars($barbero) ?>"><?= htmlspecialchars($barbero) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Table -->
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>Lista de Citas
                    </h5>
                    <div class="d-flex">
                        <button class="btn btn-sm btn-outline-secondary me-2" onclick="reloadTable()">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fas fa-columns"></i> Columnas
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><h6 class="dropdown-header">Mostrar/Ocultar</h6></li>
                                <li><a class="dropdown-item toggle-col" data-col="1"><i class="fas fa-check text-success me-2"></i>Cliente</a></li>
                                <li><a class="dropdown-item toggle-col" data-col="2"><i class="fas fa-check text-success me-2"></i>Barbero</a></li>
                                <li><a class="dropdown-item toggle-col" data-col="3"><i class="fas fa-check text-success me-2"></i>Servicio</a></li>
                                <li><a class="dropdown-item toggle-col" data-col="4"><i class="fas fa-check text-success me-2"></i>Fecha</a></li>
                                <li><a class="dropdown-item toggle-col" data-col="5"><i class="fas fa-check text-success me-2"></i>Precio</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="tablaCitas">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Cliente</th>
                                    <th>Barbero</th>
                                    <th>Servicio</th>
                                    <th>Fecha & Hora</th>
                                    <th>Precio</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($citas as $cita): ?>
                                <tr data-estado="<?= $cita['estado'] ?>" data-fecha="<?= $cita['fecha'] ?>" data-cliente="<?= strtolower($cita['cliente_nombre']) ?>" data-barbero="<?= $cita['barbero_nombre'] ?>">
                                    <td class="text-center fw-bold"><?= $cita['id'] ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; font-size: 14px;">
                                                <?= strtoupper(substr($cita['cliente_nombre'], 0, 2)) ?>
                                            </div>
                                            <div>
                                                <div class="fw-semibold"><?= htmlspecialchars($cita['cliente_nombre']) ?></div>
                                                <small class="text-muted">Cliente</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold"><?= htmlspecialchars($cita['barbero_nombre']) ?></div>
                                        <small class="text-muted">Barbero</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border"><?= htmlspecialchars($cita['servicio_nombre']) ?></span>
                                    </td>
                                    <td>
                                        <div class="fw-semibold"><?= date('d/m/Y', strtotime($cita['fecha'])) ?></div>
                                        <small class="text-muted"><?= date('H:i', strtotime($cita['hora'])) ?></small>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-success">$<?= number_format($cita['servicio_precio'], 2) ?></span>
                                    </td>
                                    <td>
                                        <span class="badge <?= 
                                            $cita['estado'] === 'realizada' ? 'bg-success' : 
                                            ($cita['estado'] === 'confirmada' ? 'bg-info' : 
                                            ($cita['estado'] === 'pendiente' ? 'bg-warning' : 'bg-danger')) 
                                        ?>">
                                            <i class="fas <?= 
                                                $cita['estado'] === 'realizada' ? 'fa-check' : 
                                                ($cita['estado'] === 'confirmada' ? 'fa-clock' : 
                                                ($cita['estado'] === 'pendiente' ? 'fa-hourglass-half' : 'fa-times')) 
                                            ?> me-1"></i>
                                            <?= ucfirst($cita['estado']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary" onclick="verDetalle(<?= $cita['id'] ?>)" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-warning" onclick="editarCita(<?= $cita['id'] ?>)" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <div class="btn-group">
                                                <button class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" title="Cambiar estado">
                                                    <i class="fas fa-cog"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" onclick="cambiarEstado(<?= $cita['id'] ?>, 'pendiente')">
                                                        <i class="fas fa-hourglass-half text-warning me-2"></i>Pendiente
                                                    </a></li>
                                                    <li><a class="dropdown-item" onclick="cambiarEstado(<?= $cita['id'] ?>, 'confirmada')">
                                                        <i class="fas fa-check-circle text-info me-2"></i>Confirmar
                                                    </a></li>
                                                    <li><a class="dropdown-item" onclick="cambiarEstado(<?= $cita['id'] ?>, 'realizada')">
                                                        <i class="fas fa-check text-success me-2"></i>Realizada
                                                    </a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-danger" onclick="cambiarEstado(<?= $cita['id'] ?>, 'cancelada')">
                                                        <i class="fas fa-times text-danger me-2"></i>Cancelar
                                                    </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Empty State -->
            <div id="emptyState" class="text-center py-5" style="display: none;">
                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No hay citas que coincidan con los filtros</h5>
                <p class="text-muted">Intenta cambiar los criterios de búsqueda</p>
                <button class="btn btn-primary" onclick="resetFilters()">
                    <i class="fas fa-undo me-2"></i>Reiniciar filtros
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilos para el sidebar colapsado */
    .sidebar-collapsed + .main-content {
        margin-left: 0;
        width: 100%;
    }
    
    /* Transición suave para el contenido principal */
    .main-content {
        transition: margin-left 0.3s ease;
        min-height: calc(100vh - 56px); /* Ajuste para el navbar */
    }
    
    /* Mejoras para las tarjetas */
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    
    /* Avatar circular */
    .avatar {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Badges mejorados */
    .badge {
        padding: 0.35em 0.65em;
        font-weight: 500;
    }
    
    /* Tabla responsive */
    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    }
    
    /* Estilo para columnas ocultas */
    .hidden-col {
        display: none;
    }
</style>

<script>
    
    // Función para filtrar citas
    function filtrarCitas() {
        const estado = document.getElementById('filtroEstado').value.toLowerCase();
        const fecha = document.getElementById('filtroFecha').value;
        const cliente = document.getElementById('buscarCliente').value.toLowerCase();
        const barbero = document.getElementById('filtroBarbero').value;
        
        const rows = document.querySelectorAll('#tablaCitas tbody tr');
        let visibleRows = 0;
        
        rows.forEach(row => {
            const rowEstado = row.getAttribute('data-estado');
            const rowFecha = row.getAttribute('data-fecha');
            const rowCliente = row.getAttribute('data-cliente');
            const rowBarbero = row.getAttribute('data-barbero');
            
            const matchEstado = !estado || rowEstado === estado;
            const matchFecha = !fecha || rowFecha === fecha;
            const matchCliente = !cliente || rowCliente.includes(cliente);
            const matchBarbero = !barbero || rowBarbero === barbero;
            
            if (matchEstado && matchFecha && matchCliente && matchBarbero) {
                row.style.display = '';
                visibleRows++;
            } else {
                row.style.display = 'none';
            }
        });
        
        // Mostrar u ocultar empty state
        const emptyState = document.getElementById('emptyState');
        if (visibleRows === 0) {
            emptyState.style.display = 'block';
        } else {
            emptyState.style.display = 'none';
        }
    }
    
    // Reiniciar filtros
    function resetFilters() {
        document.getElementById('filtroEstado').value = '';
        document.getElementById('filtroFecha').value = '';
        document.getElementById('buscarCliente').value = '';
        document.getElementById('filtroBarbero').value = '';
        filtrarCitas();
    }
    
    // Recargar tabla
    function reloadTable() {
        location.reload();
    }
    
    // Toggle columnas
    document.querySelectorAll('.toggle-col').forEach(item => {
        item.addEventListener('click', function() {
            const colIndex = this.getAttribute('data-col');
            const icon = this.querySelector('i');
            
            document.querySelectorAll(`#tablaCitas tbody tr td:nth-child(${colIndex}), #tablaCitas thead tr th:nth-child(${colIndex})`).forEach(cell => {
                cell.classList.toggle('hidden-col');
            });
            
            if (icon.classList.contains('fa-check')) {
                icon.classList.remove('fa-check', 'text-success');
                icon.classList.add('fa-times', 'text-danger');
            } else {
                icon.classList.remove('fa-times', 'text-danger');
                icon.classList.add('fa-check', 'text-success');
            }
        });
    });
</script>

<?php include '../app/views/includes/footer.php'; ?>