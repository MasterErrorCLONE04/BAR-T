<?php
class Comision extends Model {
    
    public function getAllWithDetails() {
        $sql = "SELECT c.*, 
                       b.nombre as barbero_nombre,
                       ci.fecha as cita_fecha,
                       s.nombre as servicio_nombre
                FROM comisiones c
                JOIN usuarios b ON c.barbero_id = b.id
                JOIN citas ci ON c.cita_id = ci.id
                JOIN servicios s ON ci.servicio_id = s.id
                ORDER BY c.creado_en DESC";
        return $this->fetchAll($sql);
    }
    
    public function getComisionesByBarbero($barbero_id) {
        $sql = "SELECT c.*, 
                       ci.fecha as cita_fecha,
                       s.nombre as servicio_nombre
                FROM comisiones c
                JOIN citas ci ON c.cita_id = ci.id
                JOIN servicios s ON ci.servicio_id = s.id
                WHERE c.barbero_id = ?
                ORDER BY c.creado_en DESC";
        return $this->fetchAll($sql, [$barbero_id]);
    }
    
    public function getTotalPendientes() {
        $sql = "SELECT SUM(monto) as total FROM comisiones WHERE estado = 'pendiente'";
        $result = $this->fetch($sql);
        return $result['total'] ?? 0;
    }
    
    public function getTotalPendienteByBarbero($barbero_id) {
        $sql = "SELECT SUM(monto) as total FROM comisiones WHERE barbero_id = ? AND estado = 'pendiente'";
        $result = $this->fetch($sql, [$barbero_id]);
        return $result['total'] ?? 0;
    }
    
    public function getTotalPagadoByBarbero($barbero_id) {
        $sql = "SELECT SUM(monto) as total FROM comisiones WHERE barbero_id = ? AND estado = 'pagada'";
        $result = $this->fetch($sql, [$barbero_id]);
        return $result['total'] ?? 0;
    }
    
    public function getComisionesMesByBarbero($barbero_id) {
        $sql = "SELECT SUM(monto) as total FROM comisiones 
                WHERE barbero_id = ? AND MONTH(creado_en) = MONTH(CURDATE()) AND YEAR(creado_en) = YEAR(CURDATE())";
        $result = $this->fetch($sql, [$barbero_id]);
        return $result['total'] ?? 0;
    }
    
    public function getTotalComisionesByBarbero($barbero_id) {
        $sql = "SELECT SUM(monto) as total FROM comisiones WHERE barbero_id = ?";
        $result = $this->fetch($sql, [$barbero_id]);
        return $result['total'] ?? 0;
    }
    
    public function getPendientesByBarbero() {
        $sql = "SELECT b.id as barbero_id, b.nombre as barbero_nombre,
                       COUNT(c.id) as total_comisiones,
                       SUM(c.monto) as total_monto
                FROM usuarios b
                LEFT JOIN comisiones c ON b.id = c.barbero_id AND c.estado = 'pendiente'
                WHERE b.rol = 'barbero' AND b.activo = 1
                GROUP BY b.id, b.nombre
                HAVING total_monto > 0
                ORDER BY b.nombre";
        return $this->fetchAll($sql);
    }
    
    public function marcarComoPagadas($comisiones_ids) {
        if (empty($comisiones_ids)) {
            return false;
        }
        
        // Convert string to array if needed
        if (is_string($comisiones_ids)) {
            $comisiones_ids = explode(',', $comisiones_ids);
        }
        
        // Filter out empty values
        $comisiones_ids = array_filter($comisiones_ids);
        
        if (empty($comisiones_ids)) {
            return false;
        }
        
        $placeholders = str_repeat('?,', count($comisiones_ids) - 1) . '?';
        $sql = "UPDATE comisiones SET estado = 'pagada', pagado_en = NOW() WHERE id IN ($placeholders)";
        return $this->execute($sql, $comisiones_ids) > 0;
    }
}
?>
