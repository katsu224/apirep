<?php
/**
 * Modelo para la tabla 'archivos'.
 * Permite operaciones CRUD sobre archivos del repositorio.
 */
class Archivo {
    private $conn;
    private $tabla = "archivos";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Listar todos los archivos, mostrando nombres de tipo de archivo y más
    public function obtenerTodos() {
        $sql = "SELECT 
                    a.*, 
                    ta.nombre AS nombre_tipo_archivo
                FROM archivos a
                LEFT JOIN tipos_archivos ta ON a.tipo_archivo_id = ta.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener archivo por id, mostrando nombres de tipo de archivo y más
    public function obtenerPorId($id) {
        $sql = "SELECT 
                    a.*, 
                    ta.nombre AS nombre_tipo_archivo
                FROM archivos a
                LEFT JOIN tipos_archivos ta ON a.tipo_archivo_id = ta.id
                WHERE a.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear nuevo archivo
    public function crear($tipo, $titulo, $descripcion, $portada, $paginas, $categoria, $anio, $fecha_creacion, $fecha_modificacion, $estado, $version, $metadatos, $tipo_archivo_id) {
        $sql = "INSERT INTO archivos 
            (tipo, titulo, descripcion, portada, paginas, categoria, anio, fecha_creacion, fecha_modificacion, estado, version, metadatos, tipo_archivo_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $tipo, $titulo, $descripcion, $portada, $paginas, $categoria, $anio, $fecha_creacion, $fecha_modificacion, $estado, $version, $metadatos, $tipo_archivo_id
        ]);
    }

    // Actualizar archivo por id
    public function actualizar($id, $tipo, $titulo, $descripcion, $portada, $paginas, $categoria, $anio, $fecha_creacion, $fecha_modificacion, $estado, $version, $metadatos, $tipo_archivo_id) {
        $sql = "UPDATE archivos SET 
                    tipo = ?, 
                    titulo = ?, 
                    descripcion = ?, 
                    portada = ?, 
                    paginas = ?, 
                    categoria = ?, 
                    anio = ?, 
                    fecha_creacion = ?, 
                    fecha_modificacion = ?, 
                    estado = ?, 
                    version = ?, 
                    metadatos = ?, 
                    tipo_archivo_id = ?
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $tipo, $titulo, $descripcion, $portada, $paginas, $categoria, $anio, $fecha_creacion, $fecha_modificacion, $estado, $version, $metadatos, $tipo_archivo_id, $id
        ]);
    }

    // Eliminar archivo por id
    public function eliminar($id) {
        $sql = "DELETE FROM archivos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
