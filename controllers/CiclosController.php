<?php
require_once __DIR__ . '/../models/Ciclo.php';

/**
 * Controlador para la gestión de ciclos académicos.
 * Expone métodos para el CRUD.
 */
class CiclosController {
    private $modelo;

    public function __construct($db) {
        $this->modelo = new Ciclo($db);
    }

    // Obtener todos los ciclos
    public function obtenerTodos() {
        $ciclos = $this->modelo->obtenerTodos();
        header('Content-Type: application/json');
        echo json_encode($ciclos);
    }

    // Obtener un ciclo por id
    public function obtenerPorId($id) {
        $ciclo = $this->modelo->obtenerPorId($id);
        header('Content-Type: application/json');
        if ($ciclo) {
            echo json_encode($ciclo);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Ciclo no encontrado']);
        }
    }

    // Crear un nuevo ciclo
    public function crear() {
        // Leer datos JSON enviados por POST
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['nombre'], $data['fecha_inicio'], $data['fecha_fin'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan datos requeridos']);
            return;
        }
        $exito = $this->modelo->crear($data['nombre'], $data['fecha_inicio'], $data['fecha_fin']);
        if ($exito) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'Ciclo creado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo crear el ciclo']);
        }
    }

    // Actualizar un ciclo existente
    public function actualizar($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['nombre'], $data['fecha_inicio'], $data['fecha_fin'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan datos requeridos']);
            return;
        }
        $exito = $this->modelo->actualizar($id, $data['nombre'], $data['fecha_inicio'], $data['fecha_fin']);
        if ($exito) {
            echo json_encode(['mensaje' => 'Ciclo actualizado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo actualizar el ciclo']);
        }
    }

    // Eliminar un ciclo
    public function eliminar($id) {
        $exito = $this->modelo->eliminar($id);
        if ($exito) {
            echo json_encode(['mensaje' => 'Ciclo eliminado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo eliminar el ciclo']);
        }
    }
}
?>
