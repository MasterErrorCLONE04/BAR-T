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
        $sql = "DELETE FROM servicios WHERE id = ?";
        return $this->execute($sql, [$id]);
    }
}
?>