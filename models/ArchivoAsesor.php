<?php
/**
 * Modelo para la tabla 'archivo_asesor'.
 * Permite operaciones CRUD y consultas extendidas sobre la relación.
 */
class ArchivoAsesor {
    private $conn;
    private $tabla = "archivo_asesor";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Listar todas las relaciones con nombres
    public function obtenerTodos() {
        $sql = "SELECT
                    aa.id,
                    ar.titulo AS nombre_archivo,
                    asr.nombre AS nombre_asesor
                FROM archivo_asesor aa
                JOIN archivos ar ON aa.archivo_id = ar.id
                JOIN asesores asr ON aa.asesor_id = asr.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener una relación por id
    public function obtenerPorId($id) {
        $sql = "SELECT
                    aa.id,
                    ar.titulo AS nombre_archivo,
                    asr.nombre AS nombre_asesor
                FROM archivo_asesor aa
                JOIN archivos ar ON aa.archivo_id = ar.id
                JOIN asesores asr ON aa.asesor_id = asr.id
                WHERE aa.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear nueva relación
    public function crear($archivo_id, $asesor_id) {
        $sql = "INSERT INTO archivo_asesor (archivo_id, asesor_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$archivo_id, $asesor_id]);
    }

    // Eliminar una relación
    public function eliminar($id) {
        $sql = "DELETE FROM archivo_asesor WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Extra: Listar todos los asesores de un archivo
    public function asesoresPorArchivo($archivo_id) {
        $sql = "SELECT
                    asr.id,
                    asr.nombre
                FROM archivo_asesor aa
                JOIN asesores asr ON aa.asesor_id = asr.id
                WHERE aa.archivo_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$archivo_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Extra: Listar todos los archivos de un asesor
    public function archivosPorAsesor($asesor_id) {
        $sql = "SELECT
                    ar.id,
                    ar.titulo
                FROM archivo_asesor aa
                JOIN archivos ar ON aa.archivo_id = ar.id
                WHERE aa.asesor_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$asesor_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
