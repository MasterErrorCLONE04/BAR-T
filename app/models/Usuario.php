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
        $sql = "INSERT INTO usuarios (nombre, usuario, password, correo, rol, comision) 
                VALUES (?, ?, ?, ?, 'barbero', ?)";
        return $this->execute($sql, [$nombre, $usuario, hash('sha256', $password), $correo, $comision]);
    }

    public function actualizarBarbero($id, $nombre, $usuario, $correo, $comision) {
        $sql = "UPDATE usuarios SET nombre = ?, usuario = ?, correo = ?, comision = ? 
                WHERE id = ? AND rol = 'barbero'";
        return $this->execute($sql, [$nombre, $usuario, $correo, $comision, $id]);
    }

    public function eliminarBarbero($id) {
        $sql = "DELETE FROM usuarios WHERE id = ? AND rol = 'barbero'";
        return $this->execute($sql, [$id]);
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
     * Obtener el saldo actual del administrador
     * @return float
     */
    public function getAdminBalance() {
        $sql = "SELECT saldo FROM usuarios WHERE rol = 'admin' AND activo = 1 LIMIT 1";
        $result = $this->fetch($sql);
        return $result ? (float)$result['saldo'] : 0.00;
    }

    /**
     * Restar una cantidad del saldo del administrador
     * @param float $amount Monto a restar
     * @return bool
     */
    public function deductFromAdminBalance($amount) {
        $sql = "UPDATE usuarios SET saldo = saldo - ? WHERE rol = 'admin' AND activo = 1";
        return $this->execute($sql, [$amount]) > 0;
    }

    /**
     * Agregar una cantidad al saldo del administrador
     * @param float $amount Monto a agregar
     * @return bool
     */
    public function addToAdminBalance($amount) {
        $sql = "UPDATE usuarios SET saldo = saldo + ? WHERE rol = 'admin' AND activo = 1";
        return $this->execute($sql, [$amount]) > 0;
    }

    /**
     * Obtener los datos del administrador
     * @return array|false
     */
    public function getAdmin() {
        $sql = "SELECT * FROM usuarios WHERE rol = 'admin' AND activo = 1 LIMIT 1";
        return $this->fetch($sql);
    }
}
