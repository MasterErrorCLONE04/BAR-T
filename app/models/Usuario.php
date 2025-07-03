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

    // ✅ NUEVO MÉTODO PARA OBTENER EL SALDO DEL ADMINISTRADOR
    public function getSaldoAdmin() {
        $sql = "SELECT saldo FROM usuarios WHERE rol = 'admin' LIMIT 1";
        $result = $this->fetch($sql);
        return $result['saldo'] ?? 0;
    }
}
?>
