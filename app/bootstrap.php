<?php
// Bootstrap file to ensure proper loading order

// 1. Load configuration first
require_once __DIR__ . '/config/config.php';

// 2. Load Database class explicitly
require_once __DIR__ . '/config/database.php';

// 3. Load core classes
require_once __DIR__ . '/core/Model.php';
require_once __DIR__ . '/core/Controller.php';
require_once __DIR__ . '/core/App.php';

// 4. Load helpers
require_once __DIR__ . '/helpers/session.php';

// 5. Test database connection
try {
    $testDb = Database::getInstance()->getConnection();
    // Connection successful
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
