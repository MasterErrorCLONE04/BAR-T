<?php
// Database setup script
echo "<h2>Database Setup</h2>";

try {
    // Connect to MySQL without selecting database
    $pdo = new PDO("mysql:host=" . (defined('DB_HOST') ? DB_HOST : 'localhost'), 
                   defined('DB_USER') ? DB_USER : 'root', 
                   defined('DB_PASS') ? DB_PASS : '');
    
    // Create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS barberia_db DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
    echo "✅ Database 'barberia_db' created/verified<br>";
    
    // Select database
    $pdo->exec("USE barberia_db");
    
    // Read and execute SQL file
    $sqlFile = '../sql/estructura_base.sql';
    if (file_exists($sqlFile)) {
        $sql = file_get_contents($sqlFile);
        
        // Split SQL into individual statements
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        
        foreach ($statements as $statement) {
            if (!empty($statement) && !preg_match('/^(CREATE DATABASE|USE barberia_db)/', $statement)) {
                try {
                    $pdo->exec($statement);
                } catch (PDOException $e) {
                    // Ignore table already exists errors
                    if (strpos($e->getMessage(), 'already exists') === false) {
                        echo "⚠️ Warning: " . $e->getMessage() . "<br>";
                    }
                }
            }
        }
        
        echo "✅ SQL script executed successfully<br>";
        
        // Verify tables were created
        $stmt = $pdo->query("SHOW TABLES");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        echo "<br><strong>Tables created:</strong><br>";
        foreach ($tables as $table) {
            echo "- $table<br>";
        }
        
        // Check admin user
        $stmt = $pdo->query("SELECT usuario FROM usuarios WHERE rol = 'admin' LIMIT 1");
        $admin = $stmt->fetch();
        if ($admin) {
            echo "<br>✅ Admin user found: " . $admin['usuario'] . "<br>";
            echo "<strong>Default login:</strong> admin / admin123<br>";
        }
        
    } else {
        echo "❌ SQL file not found: $sqlFile<br>";
    }
    
} catch (PDOException $e) {
    echo "❌ Database error: " . $e->getMessage() . "<br>";
}

echo "<br><a href='check-config.php'>Check Configuration</a> | <a href='index.php'>Go to Application</a>";
?>