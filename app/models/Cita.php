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
    
    /**
     * Complete appointment: Add service price to admin balance and generate commission
     * @param int $id Appointment ID
     * @return bool
     */
    public function completarCita($id) {
        try {
            $this->db->beginTransaction();
            
            // Get appointment details with service price and barber commission
            $sql = "SELECT c.*, s.precio as servicio_precio, u.comision as barbero_comision
                    FROM citas c
                    JOIN servicios s ON c.servicio_id = s.id
                    JOIN usuarios u ON c.barbero_id = u.id
                    WHERE c.id = ? AND c.estado = 'confirmada'";
            
            $cita = $this->fetch($sql, [$id]);
            
            if (!$cita) {
                throw new Exception("Cita no encontrada o no está confirmada");
            }
            
            // Calculate commission amount
            $comision_monto = ($cita['servicio_precio'] * $cita['barbero_comision']) / 100;
            $service_price = $cita['servicio_precio'];
            
            // Update appointment status to completed
            $sql = "UPDATE citas SET estado = 'realizada' WHERE id = ?";
            $this->execute($sql, [$id]);
            
            // Add service price to administrator balance (income from completed service)
            $userModel = new Usuario();
            if (!$userModel->addToAdminBalance($service_price)) {
                throw new Exception("Error al agregar ingreso al saldo del administrador");
            }
            
            // Create commission record (pending payment)
            $sql = "INSERT INTO comisiones (cita_id, barbero_id, monto) VALUES (?, ?, ?)";
            $this->execute($sql, [$id, $cita['barbero_id'], $comision_monto]);
            
            $this->db->commit();
            return true;
            
        } catch (Exception $e) {
            $this->db->rollback();
            error_log("Error en completarCita: " . $e->getMessage());
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