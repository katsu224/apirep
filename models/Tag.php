<?php
/**
 * Modelo de la tabla 'tags'
 * Permite operaciones CRUD sobre las etiquetas del repositorio.
 */
class Tag {
    private $conn;
    private $tabla = "tags";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todas las etiquetas
    public function obtenerTodas() {
        $sql = "SELECT * FROM " . $this->tabla;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener etiqueta por id
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM " . $this->tabla . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear nueva etiqueta
    public function crear($nombre) {
        $sql = "INSERT INTO " . $this->tabla . " (nombre) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nombre]);
    }

    // Actualizar etiqueta por id
    public function actualizar($id, $nombre) {
        $sql = "UPDATE " . $this->tabla . " SET nombre = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nombre, $id]);
    }

    // Eliminar etiqueta por id
    public function eliminar($id) {
        $sql = "DELETE FROM " . $this->tabla . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
