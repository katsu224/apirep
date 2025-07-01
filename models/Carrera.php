<?php
/**
 * Modelo de la tabla 'carreras'
 * Permite operaciones CRUD sobre las carreras profesionales.
 */
class Carrera {
    private $conn;
    private $tabla = "carreras";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todas las carreras
    public function obtenerTodas() {
        $sql = "SELECT * FROM " . $this->tabla;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener carrera por id
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM " . $this->tabla . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear nueva carrera
    public function crear($nombre) {
        $sql = "INSERT INTO " . $this->tabla . " (nombre) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nombre]);
    }

    // Actualizar carrera por id
    public function actualizar($id, $nombre) {
        $sql = "UPDATE " . $this->tabla . " SET nombre = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nombre, $id]);
    }

    // Eliminar carrera por id
    public function eliminar($id) {
        $sql = "DELETE FROM " . $this->tabla . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
