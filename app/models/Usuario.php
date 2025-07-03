<?php
class Usuario extends Model {
    
    public function authenticate($usuario, $password) {
        $sql = "SELECT * FROM usuarios WHERE usuario = ? AND activo = 1";
        $user = $this->fetch($sql, [$usuario]);
        
        if ($user && hash('sha256', $password) === $user['password']) {
            return $user;
        }
        
        return false;
    }
    
    public function create($nombre, $usuario, $password, $correo, $rol) {
        $sql = "INSERT INTO usuarios (nombre, usuario, password, correo, rol) VALUES (?, ?, ?, ?, ?)";
        return $this->execute($sql, [$nombre, $usuario, hash('sha256', $password), $correo, $rol]);
    }
    
    public function createBarbero($nombre, $usuario, $password, $correo, $comision) {
        $sql = "INSERT INTO usuarios (nombre, usuario, password, correo, rol, comision) VALUES (?, ?, ?, ?, 'barbero', ?)";
        return $this->execute($sql, [$nombre, $usuario, hash('sha256', $password), $correo, $comision]);
    }
    
    public function getByRole($rol) {
        $sql = "SELECT * FROM usuarios WHERE rol = ? AND activo = 1 ORDER BY nombre";
        return $this->fetchAll($sql, [$rol]);
    }
    
    public function getTotalByRole($rol) {
        $sql = "SELECT COUNT(*) as total FROM usuarios WHERE rol = ? AND activo = 1";
        $result = $this->fetch($sql, [$rol]);
        return $result['total'];
    }
    
    public function getById($id) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        return $this->fetch($sql, [$id]);
    }
    
    /**
     * Get the current balance of the administrator
     * @return float
     */
    public function getAdminBalance() {
        $sql = "SELECT saldo FROM usuarios WHERE rol = 'admin' AND activo = 1 LIMIT 1";
        $result = $this->fetch($sql);
        return $result ? (float)$result['saldo'] : 0.00;
    }
    
    /**
     * Update administrator balance (deduct commission amount)
     * @param float $amount Amount to deduct from balance
     * @return bool
     */
    public function deductFromAdminBalance($amount) {
        $sql = "UPDATE usuarios SET saldo = saldo - ? WHERE rol = 'admin' AND activo = 1";
        return $this->execute($sql, [$amount]) > 0;
    }
    
    /**
     * Add amount to administrator balance
     * @param float $amount Amount to add to balance
     * @return bool
     */
    public function addToAdminBalance($amount) {
        $sql = "UPDATE usuarios SET saldo = saldo + ? WHERE rol = 'admin' AND activo = 1";
        return $this->execute($sql, [$amount]) > 0;
    }
    
    /**
     * Get administrator user data
     * @return array|false
     */
    public function getAdmin() {
        $sql = "SELECT * FROM usuarios WHERE rol = 'admin' AND activo = 1 LIMIT 1";
        return $this->fetch($sql);
    }
}
?>
