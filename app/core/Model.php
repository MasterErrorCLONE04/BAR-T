<?php
class Model {
    protected $db;
    
    public function __construct() {
        // Asegúrate de que la clase Database esté cargada
        if (!class_exists('Database')) {
            require_once '../app/config/database.php';
        }

        $this->db = Database::getInstance()->getConnection();
    }

    // Métodos públicos para ser accesibles desde controladores
    public function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch($sql, $params = []) {
        return $this->query($sql, $params)->fetch(PDO::FETCH_ASSOC);
    }

    public function execute($sql, $params = []) {
        return $this->query($sql, $params)->rowCount();
    }
}
?>
