<?php
require_once __DIR__ . '/../models/ArchivoTag.php';
require_once __DIR__ . '/../models/Archivo.php';
require_once __DIR__ . '/../models/Tag.php';

/**
 * Controlador para la gestión de archivo_tag.
 */
class ArchivoTagController {
    private $modelo;
    private $db;

    public function __construct($db) {
        $this->modelo = new ArchivoTag($db);
        $this->db = $db;
    }

    // Listar todas las relaciones
    public function obtenerTodos() {
        $relaciones = $this->modelo->obtenerTodos();
        header('Content-Type: application/json');
        echo json_encode($relaciones);
    }

    // Obtener relación por id
    public function obtenerPorId($id) {
        $relacion = $this->modelo->obtenerPorId($id);
        header('Content-Type: application/json');
        if ($relacion) {
            echo json_encode($relacion);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Relación no encontrada']);
        }
    }

    // Crear nueva relación (valida existencia de claves foráneas)
    public function crear() {
        $data = json_decode(file_get_contents("php://input"), true);
        $requeridos = ['archivo_id', 'tag_id'];
        foreach ($requeridos as $campo) {
            if (!isset($data[$campo])) {
                http_response_code(400);
                echo json_encode(['error' => "Falta el campo '$campo'"]);
                return;
            }
        }
        // Validar archivo
        $archivoModelo = new Archivo($this->db);
        if (!$archivoModelo->obtenerPorId($data['archivo_id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'El archivo no existe']);
            return;
        }
        // Validar tag
        $tagModelo = new Tag($this->db);
        if (!$tagModelo->obtenerPorId($data['tag_id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'El tag no existe']);
            return;
        }
        // Crear relación
        $exito = $this->modelo->crear($data['archivo_id'], $data['tag_id']);
        if ($exito) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'Relación creada correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo crear la relación']);
        }
    }

    // Eliminar relación
    public function eliminar($id) {
        $exito = $this->modelo->eliminar($id);
        if ($exito) {
            echo json_encode(['mensaje' => 'Relación eliminada correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo eliminar la relación']);
        }
    }

    // Extra: Listar tags de un archivo
    public function tagsPorArchivo($archivo_id) {
        $datos = $this->modelo->tagsPorArchivo($archivo_id);
        header('Content-Type: application/json');
        echo json_encode($datos);
    }

    // Extra: Listar archivos de un tag
    public function archivosPorTag($tag_id) {
        $datos = $this->modelo->archivosPorTag($tag_id);
        header('Content-Type: application/json');
        echo json_encode($datos);
    }
}
?>
