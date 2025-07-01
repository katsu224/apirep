<?php
/**
 * Modelo de la tabla 'asesores'
 * Permite operaciones CRUD sobre los asesores académicos.
 */
class Asesor {
    private $conn;
    private $tabla = "asesores";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los asesores
    public function obtenerTodos() {
        $sql = "SELECT * FROM " . $this->tabla;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener asesor por id
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM " . $this->tabla . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear nuevo asesor
    public function crear($nombre, $email, $foto, $bio, $fecha_registro, $especialidad, $grado, $institucion_grado, $anios_experiencia, $areas_investigacion, $publicaciones, $proyectos_activos, $estado, $telefono, $oficina) {
        $sql = "INSERT INTO " . $this->tabla . " (nombre, email, foto, bio, fecha_registro, especialidad, grado, institucion_grado, anios_experiencia, areas_investigacion, publicaciones, proyectos_activos, estado, telefono, oficina) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $nombre, $email, $foto, $bio, $fecha_registro, $especialidad, $grado, $institucion_grado,
            $anios_experiencia, $areas_investigacion, $publicaciones, $proyectos_activos, $estado, $telefono, $oficina
        ]);
    }

    // Actualizar asesor por id
    public function actualizar($id, $nombre, $email, $foto, $bio, $fecha_registro, $especialidad, $grado, $institucion_grado, $anios_experiencia, $areas_investigacion, $publicaciones, $proyectos_activos, $estado, $telefono, $oficina) {
        $sql = "UPDATE " . $this->tabla . " SET nombre = ?, email = ?, foto = ?, bio = ?, fecha_registro = ?, especialidad = ?, grado = ?, institucion_grado = ?, anios_experiencia = ?, areas_investigacion = ?, publicaciones = ?, proyectos_activos = ?, estado = ?, telefono = ?, oficina = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $nombre, $email, $foto, $bio, $fecha_registro, $especialidad, $grado, $institucion_grado,
            $anios_experiencia, $areas_investigacion, $publicaciones, $proyectos_activos, $estado, $telefono, $oficina, $id
        ]);
    }

    // Eliminar asesor por id
    public function eliminar($id) {
        $sql = "DELETE FROM " . $this->tabla . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
