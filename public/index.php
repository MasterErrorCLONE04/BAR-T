<?php
// 1. Cargar configuración (incluye ini_set de sesiones)
require_once '../app/config/config.php';

// 2. Iniciar la sesión (ya después de ini_set)
session_start();

// 3. Cargar bootstrap
require_once '../app/bootstrap.php';

// 4. Redirigir según sesión
if (isset($_SESSION['user_id']) && isset($_SESSION['rol'])) {
    $rol = $_SESSION['rol'];
    switch ($rol) {
        case 'admin':
            header('Location: index.php?url=admin/dashboard');
            exit;
        case 'barbero':
            header('Location: index.php?url=barbero/dashboard');
            exit;
        case 'cliente':
            header('Location: index.php?url=cliente/dashboard');
            exit;
        default:
            session_destroy();
            header('Location: index.php?url=auth/login');
            exit;
    }
}

// 5. Ejecutar app
$app = new App();
