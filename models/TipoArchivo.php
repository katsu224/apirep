<?php
/**
 * Modelo de la tabla 'tipos_archivos'
 * Permite operaciones CRUD sobre los tipos de archivo.
 */
class TipoArchivo {
    private $conn;
    private $tabla = "tipos_archivos";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los tipos de archivo
    public function obtenerTodos() {
        $sql = "SELECT * FROM " . $this->tabla;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener tipo de archivo por id
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM " . $this->tabla . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear nuevo tipo de archivo
    public function crear($nombre, $codigo, $descripcion, $formatos_permitidos, $tamano_maximo, $requisitos, $estado, $fecha_creacion) {
        $sql = "INSERT INTO " . $this->tabla . " (nombre, codigo, descripcion, formatos_permitidos, tamano_maximo, requisitos, estado, fecha_creacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $nombre, $codigo, $descripcion, $formatos_permitidos, $tamano_maximo, $requisitos, $estado, $fecha_creacion
        ]);
    }

    // Actualizar tipo de archivo por id
    public function actualizar($id, $nombre, $codigo, $descripcion, $formatos_permitidos, $tamano_maximo, $requisitos, $estado, $fecha_creacion) {
        $sql = "UPDATE " . $this->tabla . " SET nombre = ?, codigo = ?, descripcion = ?, formatos_permitidos = ?, tamano_maximo = ?, requisitos = ?, estado = ?, fecha_creacion = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $nombre, $codigo, $descripcion, $formatos_permitidos, $tamano_maximo, $requisitos, $estado, $fecha_creacion, $id
        ]);
    }

    // Eliminar tipo de archivo por id
    public function eliminar($id) {
        $sql = "DELETE FROM " . $this->tabla . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
