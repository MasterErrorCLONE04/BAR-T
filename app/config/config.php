<?php
// Session configuration MUST be set before session_start()
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Change to 1 in HTTPS

// Configuración general del sistema
define('BASE_URL', 'http://localhost/BAR-T/public/');
define('APP_NAME', 'Barbería Pro');

// Configuración de base de datos
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'barberia_db2');
define('DB_USER', 'root');
define('DB_PASS', '');

// Zona horaria
date_default_timezone_set('America/Mexico_City');

// Autoload de clases
spl_autoload_register(function($class) {
    $paths = [
        '../app/core/',
        '../app/controllers/',
        '../app/models/',
        '../app/helpers/',
        '../app/config/'  // Add config directory
    ];
    
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return; // Stop after finding the first match
        }
    }
});

// Load Database class explicitly
require_once '../app/config/database.php';
?>