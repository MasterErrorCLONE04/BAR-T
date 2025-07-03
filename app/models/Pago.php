<?php
class Pago extends Model {
    
    public function procesarPago($barbero_id, $comisiones_ids) {
        try {
            $this->db->beginTransaction();
            
            // Convert string to array if needed
            if (is_string($comisiones_ids)) {
                $comisiones_ids = explode(',', $comisiones_ids);
            }
            
            // Filter out empty values
            $comisiones_ids = array_filter($comisiones_ids);
            
            if (empty($comisiones_ids)) {
                throw new Exception("No hay comisiones para procesar");
            }
            
            // Calcular total
            $placeholders = str_repeat('?,', count($comisiones_ids) - 1) . '?';
            $sql = "SELECT SUM(monto) as total FROM comisiones WHERE id IN ($placeholders) AND estado = 'pendiente'";
            $result = $this->fetch($sql, $comisiones_ids);
            $total = $result['total'] ?? 0;
            
            if ($total <= 0) {
                throw new Exception("No hay comisiones pendientes para procesar");
            }
            
            // Crear registro de pago
            $sql = "INSERT INTO pagos (barbero_id, total_pagado) VALUES (?, ?)";
            $this->execute($sql, [$barbero_id, $total]);
            $pago_id = $this->db->lastInsertId();
            
            // Crear detalles del pago
            foreach ($comisiones_ids as $comision_id) {
                $sql = "INSERT INTO detalle_pagos (pago_id, comision_id) VALUES (?, ?)";
                $this->execute($sql, [$pago_id, $comision_id]);
            }
            
            // Marcar comisiones como pagadas
            $comisionModel = new Comision();
            $comisionModel->marcarComoPagadas($comisiones_ids);
            
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollback();
            error_log("Error en procesarPago: " . $e->getMessage());
            return false;
        }
    }
    
    public function getAll() {
        $sql = "SELECT p.*, b.nombre as barbero_nombre
                FROM pagos p
                JOIN usuarios b ON p.barbero_id = b.id
                ORDER BY p.creado_en DESC";
        return $this->fetchAll($sql);
    }
    
    public function getByBarbero($barbero_id) {
        $sql = "SELECT * FROM pagos WHERE barbero_id = ? ORDER BY creado_en DESC";
        return $this->fetchAll($sql, [$barbero_id]);
    }
}
?>