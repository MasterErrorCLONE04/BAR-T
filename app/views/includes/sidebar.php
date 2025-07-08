<?php
require_once dirname(__DIR__, 2) . '/helpers/session.php';
SessionHelper::start();
$rol = SessionHelper::getUserRole();
?>

<style>
    .sidebar {
        height: 100vh;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }
    
    .sidebar-collapsed {
        width: 70px !important;
    }
    
    .sidebar .nav-link {
        color: rgba(255,255,255,0.8) !important;
        border-radius: 8px;
        margin-bottom: 5px;
        transition: all 0.3s ease;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        border: none;
        padding: 12px 16px;
    }
    
    .sidebar .nav-link:hover {
        background: rgba(255,255,255,0.1) !important;
        color: white !important;
        transform: translateX(5px);
    }
    
    .sidebar .nav-link i {
        width: 20px;
        text-align: center;
        margin-right: 10px;
    }
    
    .sidebar-toggler {
        position: absolute;
        top: 15px;
        right: -15px;
        background: #34495e;
        color: white;
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        cursor: pointer;
        z-index: 1000;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .sidebar-toggler:hover {
        background: #2c3e50;
        transform: scale(1.1);
    }
    
    .sidebar-brand {
        background: rgba(0,0,0,0.1);
        border-radius: 10px;
        padding: 20px 15px;
        margin-bottom: 20px;
        text-align: center;
    }
    
    .sidebar-brand h5 {
        font-weight: 600;
        margin-bottom: 5px;
        text-shadow: 0 1px 2px rgba(0,0,0,0.3);
    }
    
    .user-badge {
        display: inline-block;
        background: rgba(255,255,255,0.2);
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 0.8em;
        margin-top: 5px;
    }
    
    .sidebar-footer {
        background: rgba(0,0,0,0.1);
        border-radius: 8px;
        margin: 10px;
        padding: 15px;
        text-align: center;
    }
    
    .sidebar-footer hr {
        border-color: rgba(255,255,255,0.2);
        margin: 10px 0;
    }
    
    /* Iconos con colores */
    .icon-dashboard { color: #3498db; }
    .icon-users { color: #2ecc71; }
    .icon-services { color: #e74c3c; }
    .icon-calendar { color: #f39c12; }
    .icon-money { color: #1abc9c; }
    .icon-payments { color: #9b59b6; }
    .icon-history { color: #95a5a6; }
    .icon-add { color: #e67e22; }
    
    /* Animación sutil para los iconos */
    .sidebar .nav-link:hover i {
        transform: scale(1.2);
        transition: transform 0.3s ease;
    }
    
    /* Efecto cuando está colapsado */
    .sidebar-collapsed .nav-link {
        text-align: center;
        padding: 12px 8px;
        justify-content: center;
    }
    
    .sidebar-collapsed .nav-link i {
        margin-right: 0;
    }
    
    .sidebar-collapsed .sidebar-brand h5,
    .sidebar-collapsed .user-badge,
    .sidebar-collapsed .sidebar-footer,
    .sidebar-collapsed .nav-link span {
        display: none !important;
    }
    
    .sidebar-collapsed .sidebar-brand {
        padding: 20px 5px;
        margin-bottom: 30px;
    }
    
    .sidebar-collapsed .sidebar-brand i {
        font-size: 1.8rem;
    }
    
    .sidebar-collapsed .nav-link {
        margin-bottom: 10px;
    }
    
    .sidebar-collapsed .nav-link:hover {
        transform: none;
        background: rgba(255,255,255,0.15) !important;
    }
</style>

<script>
    function toggleSidebar() {
    const sidebar = document.getElementById('mainSidebar');
    const toggleIcon = document.getElementById('toggleIcon');
    const mainContent = document.getElementById('mainContent');

    sidebar.classList.toggle('sidebar-collapsed');
    mainContent.classList.toggle('content-expanded');

    toggleIcon.classList.toggle('fa-chevron-left');
    toggleIcon.classList.toggle('fa-chevron-right');
}

</script>

<?php if (in_array($rol, ['admin', 'cliente', 'barbero'])): ?>
<div id="mainSidebar" class="col-lg-2 d-none d-lg-block sidebar bg-dark position-relative">
    <div class="sidebar-toggler" onclick="toggleSidebar()" title="Contraer/Expandir">
        <i id="toggleIcon" class="fas fa-chevron-left"></i>
    </div>

    <div class="nav flex-column nav-pills p-3 h-100">
        <div class="sidebar-brand">
            <i class="fas fa-user text-white mb-2" style="font-size: 2rem;"></i>
            <h5 class="text-white"><?= ucfirst($rol) ?></h5>
            <div class="user-badge text-white">
                <i class="fas fa-circle text-success me-1" style="font-size: 0.6em;"></i>
                En línea
            </div>
        </div>

        <?php if ($rol === 'admin'): ?>
            <a class="nav-link text-white" href="<?= BASE_URL ?>index.php?url=admin/dashboard" title="Dashboard">
                <i class="fas fa-tachometer-alt icon-dashboard"></i> 
                <span>Dashboard</span>
            </a>
            <a class="nav-link text-white" href="<?= BASE_URL ?>index.php?url=admin/usuarios" title="Usuarios">
                <i class="fas fa-users icon-users"></i> 
                <span>Usuarios</span>
            </a>
            <a class="nav-link text-white" href="<?= BASE_URL ?>index.php?url=admin/servicios" title="Servicios">
                <i class="fas fa-cut icon-services"></i> 
                <span>Servicios</span>
            </a>
            <a class="nav-link text-white" href="<?= BASE_URL ?>index.php?url=admin/citas" title="Citas">
                <i class="fas fa-calendar icon-calendar"></i> 
                <span>Citas</span>
            </a>
            <a class="nav-link text-white" href="<?= BASE_URL ?>index.php?url=admin/comisiones" title="Comisiones">
                <i class="fas fa-money-bill-wave icon-money"></i> 
                <span>Comisiones</span>
            </a>
            <a class="nav-link text-white" href="<?= BASE_URL ?>index.php?url=admin/pagos" title="Pagos">
                <i class="fas fa-credit-card icon-payments"></i> 
                <span>Pagos</span>
            </a>

        <?php elseif ($rol === 'cliente'): ?>
            <a class="nav-link text-white" href="<?= BASE_URL ?>index.php?url=cliente/dashboard" title="Dashboard">
                <i class="fas fa-tachometer-alt icon-dashboard"></i> 
                <span>Dashboard</span>
            </a>
            <a class="nav-link text-white" href="<?= BASE_URL ?>index.php?url=cliente/agendar" title="Agendar Cita">
                <i class="fas fa-plus icon-add"></i> 
                <span>Agendar Cita</span>
            </a>
            <a class="nav-link text-white" href="<?= BASE_URL ?>index.php?url=cliente/historial" title="Historial">
                <i class="fas fa-history icon-history"></i> 
                <span>Historial</span>
            </a>

        <?php elseif ($rol === 'barbero'): ?>
            <a class="nav-link text-white" href="<?= BASE_URL ?>index.php?url=barbero/dashboard" title="Dashboard">
                <i class="fas fa-tachometer-alt icon-dashboard"></i> 
                <span>Dashboard</span>
            </a>
            <a class="nav-link text-white" href="<?= BASE_URL ?>index.php?url=barbero/citas" title="Mis Citas">
                <i class="fas fa-calendar icon-calendar"></i> 
                <span>Mis Citas</span>
            </a>
            <a class="nav-link text-white" href="<?= BASE_URL ?>index.php?url=barbero/comisiones" title="Comisiones">
                <i class="fas fa-money-bill icon-money"></i> 
                <span>Comisiones</span>
            </a>
        <?php endif; ?>

        <div class="sidebar-footer mt-auto">
            <hr class="bg-light" />
            <i class="fas fa-code text-white-50 me-2"></i>
            <span class="text-white-50 small">Versión 1.0.0</span>
        </div>
    </div>
</div>
<?php else: ?>
    <div class="col-lg-2 p-3 bg-danger text-white text-center">
        <i class="fas fa-exclamation-triangle mb-2 d-block" style="font-size: 2rem;"></i>
        <strong>Acceso Denegado</strong>
        <p class="small mt-2">Rol no reconocido o sesión no válida.</p>
    </div>
<?php endif; ?>