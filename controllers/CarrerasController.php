<?php
require_once __DIR__ . '/../models/Carrera.php';

/**
 * Controlador para la gestión de carreras profesionales.
 * Expone métodos para el CRUD.
 */
class CarrerasController {
    private $modelo;

    public function __construct($db) {
        $this->modelo = new Carrera($db);
    }

    // Obtener todas las carreras
    public function obtenerTodas() {
        $carreras = $this->modelo->obtenerTodas();
        header('Content-Type: application/json');
        echo json_encode($carreras);
    }

    // Obtener una carrera por id
    public function obtenerPorId($id) {
        $carrera = $this->modelo->obtenerPorId($id);
        header('Content-Type: application/json');
        if ($carrera) {
            echo json_encode($carrera);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Carrera no encontrada']);
        }
    }

    // Crear una nueva carrera
    public function crear() {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['nombre'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Falta el nombre de la carrera']);
            return;
        }
        $exito = $this->modelo->crear($data['nombre']);
        if ($exito) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'Carrera creada correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo crear la carrera']);
        }
    }

    // Actualizar una carrera existente
    public function actualizar($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['nombre'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Falta el nombre de la carrera']);
            return;
        }
        $exito = $this->modelo->actualizar($id, $data['nombre']);
        if ($exito) {
            echo json_encode(['mensaje' => 'Carrera actualizada correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo actualizar la carrera']);
        }
    }

    // Eliminar una carrera
    public function eliminar($id) {
        $exito = $this->modelo->eliminar($id);
        if ($exito) {
            echo json_encode(['mensaje' => 'Carrera eliminada correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo eliminar la carrera']);
        }
    }
}
?>
