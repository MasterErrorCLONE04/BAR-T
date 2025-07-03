<?php
// Simple configuration checker
echo "<h2>Barbería System Configuration Check</h2>";

try {
    // Use bootstrap for proper loading
    require_once '../app/bootstrap.php';
    echo "✅ Bootstrap loaded successfully<br>";
    
    // Check database connection
    $db = Database::getInstance()->getConnection();
    echo "✅ Database connection successful<br>";
    
    // Check if tables exist
    $tables = ['usuarios', 'servicios', 'citas', 'comisiones', 'pagos'];
    foreach ($tables as $table) {
        $stmt = $db->query("SHOW TABLES LIKE '$table'");
        if ($stmt->rowCount() > 0) {
            echo "✅ Table '$table' exists<br>";
        } else {
            echo "❌ Table '$table' missing - Please run the SQL script<br>";
        }
    }
    
    // Check if admin user exists
    $stmt = $db->query("SELECT COUNT(*) as count FROM usuarios WHERE rol = 'admin'");
    $result = $stmt->fetch();
    if ($result['count'] > 0) {
        echo "✅ Admin user exists<br>";
    } else {
        echo "❌ Admin user missing - Please run the SQL script<br>";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "<br>";
}

// Check session functionality
session_start();
$_SESSION['test'] = 'working';
if (isset($_SESSION['test'])) {
    echo "✅ Session functionality working<br>";
    unset($_SESSION['test']);
} else {
    echo "❌ Session functionality not working<br>";
}

echo "<br><strong>Base URL:</strong> " . BASE_URL . "<br>";
echo "<strong>Current Directory:</strong> " . __DIR__ . "<br>";
echo "<strong>PHP Version:</strong> " . PHP_VERSION . "<br>";

echo "<br><a href='index.php'>Go to Application</a> | <a href='landing.php'>Go to Landing Page</a>";
?>