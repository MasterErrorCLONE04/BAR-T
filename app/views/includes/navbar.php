<?php
$role_names = [
    'admin' => 'Administrador',
    'barbero' => 'Barbero',
    'cliente' => 'Cliente'
];
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><i class="fas fa-cut"></i> Barbería Pro</a>
        
        <div class="navbar-nav ms-auto">
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user"></i> <?= SessionHelper::getUserName() ?>
                    <span class="badge bg-secondary"><?= $role_names[SessionHelper::getUserRole()] ?></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>index.php?url=auth/logout">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
