<?php
/**
 * Modelo de la tabla 'usuarios'
 * Permite operaciones CRUD sobre los usuarios del sistema.
 */
class Usuario {
    private $conn;
    private $tabla = "usuarios";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los usuarios
    public function obtenerTodos() {
        $sql = "SELECT * FROM " . $this->tabla;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener usuario por id
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM " . $this->tabla . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear nuevo usuario
    public function crear($nombre, $email, $password, $rol, $estado, $fecha_creacion, $ultimo_acceso, $permisos) {
        $sql = "INSERT INTO " . $this->tabla . " (nombre, email, password, rol, estado, fecha_creacion, ultimo_acceso, permisos) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $nombre, $email, $password, $rol, $estado, $fecha_creacion, $ultimo_acceso, $permisos
        ]);
    }

    // Actualizar usuario por id
    public function actualizar($id, $nombre, $email, $password, $rol, $estado, $fecha_creacion, $ultimo_acceso, $permisos) {
        $sql = "UPDATE " . $this->tabla . " SET nombre = ?, email = ?, password = ?, rol = ?, estado = ?, fecha_creacion = ?, ultimo_acceso = ?, permisos = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $nombre, $email, $password, $rol, $estado, $fecha_creacion, $ultimo_acceso, $permisos, $id
        ]);
    }

    // Eliminar usuario por id
    public function eliminar($id) {
        $sql = "DELETE FROM " . $this->tabla . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
