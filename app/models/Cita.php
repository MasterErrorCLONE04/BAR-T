<?php
class Cita extends Model {
    
    public function create($cliente_id, $barbero_id, $servicio_id, $fecha, $hora) {
        $sql = "INSERT INTO citas (cliente_id, barbero_id, servicio_id, fecha, hora) VALUES (?, ?, ?, ?, ?)";
        return $this->execute($sql, [$cliente_id, $barbero_id, $servicio_id, $fecha, $hora]);
    }
    
    public function getAllWithDetails() {
        $sql = "SELECT c.*, 
                       cl.nombre as cliente_nombre,
                       b.nombre as barbero_nombre,
                       s.nombre as servicio_nombre,
                       s.precio as servicio_precio
                FROM citas c
                JOIN usuarios cl ON c.cliente_id = cl.id
                JOIN usuarios b ON c.barbero_id = b.id
                JOIN servicios s ON c.servicio_id = s.id
                ORDER BY c.fecha DESC, c.hora DESC";
        return $this->fetchAll($sql);
    }
    
    public function getCitasByBarbero($barbero_id) {
        $sql = "SELECT c.*, 
                       cl.nombre as cliente_nombre,
                       s.nombre as servicio_nombre,
                       s.precio as servicio_precio
                FROM citas c
                JOIN usuarios cl ON c.cliente_id = cl.id
                JOIN servicios s ON c.servicio_id = s.id
                WHERE c.barbero_id = ?
                ORDER BY c.fecha DESC, c.hora DESC";
        return $this->fetchAll($sql, [$barbero_id]);
    }
    
    public function getCitasByCliente($cliente_id) {
        $sql = "SELECT c.*, 
                       b.nombre as barbero_nombre,
                       s.nombre as servicio_nombre,
                       s.precio as servicio_precio
                FROM citas c
                JOIN usuarios b ON c.barbero_id = b.id
                JOIN servicios s ON c.servicio_id = s.id
                WHERE c.cliente_id = ?
                ORDER BY c.fecha DESC, c.hora DESC";
        return $this->fetchAll($sql, [$cliente_id]);
    }
    
    public function updateEstado($id, $estado) {
        $sql = "UPDATE citas SET estado = ? WHERE id = ?";
        return $this->execute($sql, [$estado, $id]);
    }
    
    public function completarCita($id) {
    try {
        $this->db->beginTransaction();
        
        // Actualizar estado de la cita
        $this->updateEstado($id, 'realizada');
        
        // Obtener datos de la cita
        $cita = $this->getCitaById($id);
        
        // Calcular comisión
        $barbero = $this->fetch("SELECT comision FROM usuarios WHERE id = ?", [$cita['barbero_id']]);
        $comision_monto = ($cita['servicio_precio'] * $barbero['comision']) / 100;

        // Crear comisión
        $sql = "INSERT INTO comisiones (cita_id, barbero_id, monto) VALUES (?, ?, ?)";
        $this->execute($sql, [$id, $cita['barbero_id'], $comision_monto]);

        // Sumar el precio del servicio al saldo del administrador
        $sql = "UPDATE usuarios SET saldo = saldo + ? WHERE rol = 'admin'";
        $this->execute($sql, [$cita['servicio_precio']]);

        $this->db->commit();
        return true;
    } catch (Exception $e) {
        $this->db->rollback();
        error_log("Error al completar cita: " . $e->getMessage());
        return false;
    }
}

    
    public function getCitaById($id) {
        $sql = "SELECT c.*, s.precio as servicio_precio
                FROM citas c
                JOIN servicios s ON c.servicio_id = s.id
                WHERE c.id = ?";
        return $this->fetch($sql, [$id]);
    }
    
    public function getTotalCitas() {
        $sql = "SELECT COUNT(*) as total FROM citas";
        $result = $this->fetch($sql);
        return $result['total'];
    }
    
    public function getRecientes($limit = 5) {
        $sql = "SELECT c.*, 
                       cl.nombre as cliente_nombre,
                       b.nombre as barbero_nombre,
                       s.nombre as servicio_nombre
                FROM citas c
                JOIN usuarios cl ON c.cliente_id = cl.id
                JOIN usuarios b ON c.barbero_id = b.id
                JOIN servicios s ON c.servicio_id = s.id
                ORDER BY c.creado_en DESC
                LIMIT ?";
        return $this->fetchAll($sql, [$limit]);
    }
    
    public function getCitasHoyByBarbero($barbero_id) {
        $sql = "SELECT c.*, 
                       cl.nombre as cliente_nombre,
                       s.nombre as servicio_nombre
                FROM citas c
                JOIN usuarios cl ON c.cliente_id = cl.id
                JOIN servicios s ON c.servicio_id = s.id
                WHERE c.barbero_id = ? AND c.fecha = CURDATE()
                ORDER BY c.hora";
        return $this->fetchAll($sql, [$barbero_id]);
    }
    
    public function getCitasPendientesByBarbero($barbero_id) {
        $sql = "SELECT COUNT(*) as total FROM citas WHERE barbero_id = ? AND estado = 'pendiente'";
        $result = $this->fetch($sql, [$barbero_id]);
        return $result['total'];
    }
    
    public function getProximaCitaByCliente($cliente_id) {
        $sql = "SELECT c.*, 
                       b.nombre as barbero_nombre,
                       s.nombre as servicio_nombre
                FROM citas c
                JOIN usuarios b ON c.barbero_id = b.id
                JOIN servicios s ON c.servicio_id = s.id
                WHERE c.cliente_id = ? AND c.fecha >= CURDATE() AND c.estado != 'cancelada'
                ORDER BY c.fecha, c.hora
                LIMIT 1";
        return $this->fetch($sql, [$cliente_id]);
    }
    
    public function getCitasRecientesByCliente($cliente_id, $limit = 5) {
        $sql = "SELECT c.*, 
                       b.nombre as barbero_nombre,
                       s.nombre as servicio_nombre
                FROM citas c
                JOIN usuarios b ON c.barbero_id = b.id
                JOIN servicios s ON c.servicio_id = s.id
                WHERE c.cliente_id = ?
                ORDER BY c.fecha DESC, c.hora DESC
                LIMIT ?";
        return $this->fetchAll($sql, [$cliente_id, $limit]);
    }
}
?>
