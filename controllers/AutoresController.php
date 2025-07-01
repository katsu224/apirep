<?php
require_once __DIR__ . '/../models/Autor.php';

/**
 * Controlador para la gestión de autores.
 * Expone métodos para el CRUD.
 */
class AutoresController {
    private $modelo;

    public function __construct($db) {
        $this->modelo = new Autor($db);
    }

    // Obtener todos los autores
    public function obtenerTodos() {
        $autores = $this->modelo->obtenerTodos();
        header('Content-Type: application/json');
        echo json_encode($autores);
    }

    // Obtener un autor por id
    public function obtenerPorId($id) {
        $autor = $this->modelo->obtenerPorId($id);
        header('Content-Type: application/json');
        if ($autor) {
            echo json_encode($autor);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Autor no encontrado']);
        }
    }

    // Crear un nuevo autor
    public function crear() {
        $data = json_decode(file_get_contents("php://input"), true);
        $requeridos = ['nombre', 'email', 'foto', 'bio', 'fecha_registro', 'estado', 'telefono', 'direccion', 'fecha_nacimiento', 'nacionalidad', 'nivel_educativo', 'institucion', 'carrera_id'];
        foreach ($requeridos as $campo) {
            if (!isset($data[$campo])) {
                http_response_code(400);
                echo json_encode(['error' => "Falta el campo '$campo'"]);
                return;
            }
        }
        $exito = $this->modelo->crear(
            $data['nombre'], $data['email'], $data['foto'], $data['bio'], $data['fecha_registro'], $data['estado'],
            $data['telefono'], $data['direccion'], $data['fecha_nacimiento'], $data['nacionalidad'],
            $data['nivel_educativo'], $data['institucion'], $data['carrera_id']
        );
        if ($exito) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'Autor creado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo crear el autor']);
        }
    }

    // Actualizar un autor existente
    public function actualizar($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        $requeridos = ['nombre', 'email', 'foto', 'bio', 'fecha_registro', 'estado', 'telefono', 'direccion', 'fecha_nacimiento', 'nacionalidad', 'nivel_educativo', 'institucion', 'carrera_id'];
        foreach ($requeridos as $campo) {
            if (!isset($data[$campo])) {
                http_response_code(400);
                echo json_encode(['error' => "Falta el campo '$campo'"]);
                return;
            }
        }
        $exito = $this->modelo->actualizar(
            $id,
            $data['nombre'], $data['email'], $data['foto'], $data['bio'], $data['fecha_registro'], $data['estado'],
            $data['telefono'], $data['direccion'], $data['fecha_nacimiento'], $data['nacionalidad'],
            $data['nivel_educativo'], $data['institucion'], $data['carrera_id']
        );
        if ($exito) {
            echo json_encode(['mensaje' => 'Autor actualizado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo actualizar el autor']);
        }
    }

    // Eliminar un autor
    public function eliminar($id) {
        $exito = $this->modelo->eliminar($id);
        if ($exito) {
            echo json_encode(['mensaje' => 'Autor eliminado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo eliminar el autor']);
        }
    }
}
?>
