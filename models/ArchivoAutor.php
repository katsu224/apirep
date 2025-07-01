<?php
/**
 * Modelo para la tabla 'archivo_autor'.
 * Permite operaciones CRUD y consultas extendidas sobre la relación.
 */
class ArchivoAutor {
    private $conn;
    private $tabla = "archivo_autor";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Listar todas las relaciones con nombres de archivo, autor y ciclo
    public function obtenerTodos() {
        $sql = "SELECT
                    aa.id,
                    ar.titulo AS nombre_archivo,
                    au.nombre AS nombre_autor,
                    ci.nombre AS nombre_ciclo
                FROM archivo_autor aa
                JOIN archivos ar ON aa.archivo_id = ar.id
                JOIN autores au ON aa.autor_id = au.id
                JOIN ciclos ci ON aa.ciclo_id = ci.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener una relación por id
    public function obtenerPorId($id) {
        $sql = "SELECT
                    aa.id,
                    ar.titulo AS nombre_archivo,
                    au.nombre AS nombre_autor,
                    ci.nombre AS nombre_ciclo
                FROM archivo_autor aa
                JOIN archivos ar ON aa.archivo_id = ar.id
                JOIN autores au ON aa.autor_id = au.id
                JOIN ciclos ci ON aa.ciclo_id = ci.id
                WHERE aa.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear nueva relación
    public function crear($archivo_id, $autor_id, $ciclo_id) {
        $sql = "INSERT INTO archivo_autor (archivo_id, autor_id, ciclo_id) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$archivo_id, $autor_id, $ciclo_id]);
    }

    // Eliminar una relación
    public function eliminar($id) {
        $sql = "DELETE FROM archivo_autor WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Extra: Listar todos los archivos de un autor
    public function archivosPorAutor($autor_id) {
        $sql = "SELECT
                    ar.id,
                    ar.titulo,
                    ci.nombre AS ciclo
                FROM archivo_autor aa
                JOIN archivos ar ON aa.archivo_id = ar.id
                JOIN ciclos ci ON aa.ciclo_id = ci.id
                WHERE aa.autor_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$autor_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Extra: Listar todos los autores de un archivo
    public function autoresPorArchivo($archivo_id) {
        $sql = "SELECT
                    au.id,
                    au.nombre,
                    ci.nombre AS ciclo
                FROM archivo_autor aa
                JOIN autores au ON aa.autor_id = au.id
                JOIN ciclos ci ON aa.ciclo_id = ci.id
                WHERE aa.archivo_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$archivo_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
