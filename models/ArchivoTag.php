<?php
/**
 * Modelo para la tabla 'archivo_tag'.
 * Permite operaciones CRUD y consultas extendidas sobre la relación.
 */
class ArchivoTag {
    private $conn;
    private $tabla = "archivo_tag";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Listar todas las relaciones con nombres
    public function obtenerTodos() {
        $sql = "SELECT
                    at.id,
                    ar.titulo AS nombre_archivo,
                    tg.nombre AS nombre_tag
                FROM archivo_tag at
                JOIN archivos ar ON at.archivo_id = ar.id
                JOIN tags tg ON at.tag_id = tg.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener una relación por id
    public function obtenerPorId($id) {
        $sql = "SELECT
                    at.id,
                    ar.titulo AS nombre_archivo,
                    tg.nombre AS nombre_tag
                FROM archivo_tag at
                JOIN archivos ar ON at.archivo_id = ar.id
                JOIN tags tg ON at.tag_id = tg.id
                WHERE at.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear nueva relación
    public function crear($archivo_id, $tag_id) {
        $sql = "INSERT INTO archivo_tag (archivo_id, tag_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$archivo_id, $tag_id]);
    }

    // Eliminar una relación
    public function eliminar($id) {
        $sql = "DELETE FROM archivo_tag WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Extra: Listar todos los tags de un archivo
    public function tagsPorArchivo($archivo_id) {
        $sql = "SELECT
                    tg.id,
                    tg.nombre
                FROM archivo_tag at
                JOIN tags tg ON at.tag_id = tg.id
                WHERE at.archivo_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$archivo_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Extra: Listar todos los archivos de un tag
    public function archivosPorTag($tag_id) {
        $sql = "SELECT
                    ar.id,
                    ar.titulo
                FROM archivo_tag at
                JOIN archivos ar ON at.archivo_id = ar.id
                WHERE at.tag_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$tag_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
