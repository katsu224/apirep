<?php
require_once __DIR__ . '/../models/Tag.php';

/**
 * Controlador para la gestión de etiquetas (tags).
 * Expone métodos para el CRUD.
 */
class TagsController {
    private $modelo;

    public function __construct($db) {
        $this->modelo = new Tag($db);
    }

    // Obtener todas las etiquetas
    public function obtenerTodas() {
        $tags = $this->modelo->obtenerTodas();
        header('Content-Type: application/json');
        echo json_encode($tags);
    }

    // Obtener una etiqueta por id
    public function obtenerPorId($id) {
        $tag = $this->modelo->obtenerPorId($id);
        header('Content-Type: application/json');
        if ($tag) {
            echo json_encode($tag);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Etiqueta no encontrada']);
        }
    }

    // Crear una nueva etiqueta
    public function crear() {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['nombre'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Falta el nombre de la etiqueta']);
            return;
        }
        $exito = $this->modelo->crear($data['nombre']);
        if ($exito) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'Etiqueta creada correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo crear la etiqueta']);
        }
    }

    // Actualizar una etiqueta existente
    public function actualizar($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['nombre'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Falta el nombre de la etiqueta']);
            return;
        }
        $exito = $this->modelo->actualizar($id, $data['nombre']);
        if ($exito) {
            echo json_encode(['mensaje' => 'Etiqueta actualizada correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo actualizar la etiqueta']);
        }
    }

    // Eliminar una etiqueta
    public function eliminar($id) {
        $exito = $this->modelo->eliminar($id);
        if ($exito) {
            echo json_encode(['mensaje' => 'Etiqueta eliminada correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo eliminar la etiqueta']);
        }
    }
}
?>
