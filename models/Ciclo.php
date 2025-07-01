<?php
/**
 * Modelo de la tabla 'ciclos'
 * Permite operaciones CRUD sobre los ciclos académicos.
 */
class Ciclo {
    private $conn;
    private $tabla = "ciclos";

    // Constructor recibe la conexión
    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los ciclos
    public function obtenerTodos() {
        $sql = "SELECT * FROM " . $this->tabla;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener ciclo por id
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM " . $this->tabla . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear nuevo ciclo
    public function crear($nombre, $fecha_inicio, $fecha_fin) {
        $sql = "INSERT INTO " . $this->tabla . " (nombre, fecha_inicio, fecha_fin) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nombre, $fecha_inicio, $fecha_fin]);
    }

    // Actualizar ciclo por id
    public function actualizar($id, $nombre, $fecha_inicio, $fecha_fin) {
        $sql = "UPDATE " . $this->tabla . " SET nombre = ?, fecha_inicio = ?, fecha_fin = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nombre, $fecha_inicio, $fecha_fin, $id]);
    }

    // Eliminar ciclo por id
    public function eliminar($id) {
        $sql = "DELETE FROM " . $this->tabla . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
