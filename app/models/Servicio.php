<?php
class Servicio extends Model {
    
    public function getAll() {
        $sql = "SELECT * FROM servicios ORDER BY nombre";
        return $this->fetchAll($sql);
    }
    
    public function create($nombre, $descripcion, $precio) {
        $sql = "INSERT INTO servicios (nombre, descripcion, precio) VALUES (?, ?, ?)";
        return $this->execute($sql, [$nombre, $descripcion, $precio]);
    }
    
    public function getById($id) {
        $sql = "SELECT * FROM servicios WHERE id = ?";
        return $this->fetch($sql, [$id]);
    }
    
    public function update($id, $nombre, $descripcion, $precio) {
        $sql = "UPDATE servicios SET nombre = ?, descripcion = ?, precio = ? WHERE id = ?";
        return $this->execute($sql, [$nombre, $descripcion, $precio, $id]);
    }
    
    public function delete($id) {
        try {
            // Check if service is being used in appointments
            $sql = "SELECT COUNT(*) as count FROM citas WHERE servicio_id = ?";
            $result = $this->fetch($sql, [$id]);
            
            if ($result['count'] > 0) {
                return ['success' => false, 'message' => 'No se puede eliminar el servicio porque tiene citas asociadas'];
            }
            
            // Delete the service
            $sql = "DELETE FROM servicios WHERE id = ?";
            $deleted = $this->execute($sql, [$id]);
            
            if ($deleted > 0) {
                return ['success' => true, 'message' => 'Servicio eliminado exitosamente'];
            } else {
                return ['success' => false, 'message' => 'No se pudo eliminar el servicio'];
            }
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Error al eliminar el servicio: ' . $e->getMessage()];
        }
    }
    
    /**
     * Check if service exists
     */
    public function exists($id) {
        $sql = "SELECT COUNT(*) as count FROM servicios WHERE id = ?";
        $result = $this->fetch($sql, [$id]);
        return $result['count'] > 0;
    }
    
    /**
     * Get services with appointment count
     */
    public function getAllWithStats() {
        $sql = "SELECT s.*, 
                       COUNT(c.id) as total_citas,
                       COUNT(CASE WHEN c.estado = 'realizada' THEN 1 END) as citas_realizadas
                FROM servicios s
                LEFT JOIN citas c ON s.id = c.servicio_id
                GROUP BY s.id, s.nombre, s.descripcion, s.precio, s.creado_en
                ORDER BY s.nombre";
        return $this->fetchAll($sql);
    }
}
?>