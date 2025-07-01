<?php
require_once __DIR__ . '/../models/Asesor.php';

/**
 * Controlador para la gestión de asesores académicos.
 * Expone métodos para el CRUD.
 */
class AsesoresController {
    private $modelo;

    public function __construct($db) {
        $this->modelo = new Asesor($db);
    }

    // Obtener todos los asesores
    public function obtenerTodos() {
        $asesores = $this->modelo->obtenerTodos();
        header('Content-Type: application/json');
        echo json_encode($asesores);
    }

    // Obtener un asesor por id
    public function obtenerPorId($id) {
        $asesor = $this->modelo->obtenerPorId($id);
        header('Content-Type: application/json');
        if ($asesor) {
            echo json_encode($asesor);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Asesor no encontrado']);
        }
    }

    // Crear un nuevo asesor
    public function crear() {
        $data = json_decode(file_get_contents("php://input"), true);
        $requeridos = ['nombre', 'email', 'foto', 'bio', 'fecha_registro', 'especialidad', 'grado', 'institucion_grado', 'anios_experiencia', 'areas_investigacion', 'publicaciones', 'proyectos_activos', 'estado', 'telefono', 'oficina'];
        foreach ($requeridos as $campo) {
            if (!isset($data[$campo])) {
                http_response_code(400);
                echo json_encode(['error' => "Falta el campo '$campo'"]);
                return;
            }
        }
        $exito = $this->modelo->crear(
            $data['nombre'], $data['email'], $data['foto'], $data['bio'], $data['fecha_registro'], $data['especialidad'],
            $data['grado'], $data['institucion_grado'], $data['anios_experiencia'], $data['areas_investigacion'],
            $data['publicaciones'], $data['proyectos_activos'], $data['estado'], $data['telefono'], $data['oficina']
        );
        if ($exito) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'Asesor creado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo crear el asesor']);
        }
    }

    // Actualizar un asesor existente
    public function actualizar($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        $requeridos = ['nombre', 'email', 'foto', 'bio', 'fecha_registro', 'especialidad', 'grado', 'institucion_grado', 'anios_experiencia', 'areas_investigacion', 'publicaciones', 'proyectos_activos', 'estado', 'telefono', 'oficina'];
        foreach ($requeridos as $campo) {
            if (!isset($data[$campo])) {
                http_response_code(400);
                echo json_encode(['error' => "Falta el campo '$campo'"]);
                return;
            }
        }
        $exito = $this->modelo->actualizar(
            $id,
            $data['nombre'], $data['email'], $data['foto'], $data['bio'], $data['fecha_registro'], $data['especialidad'],
            $data['grado'], $data['institucion_grado'], $data['anios_experiencia'], $data['areas_investigacion'],
            $data['publicaciones'], $data['proyectos_activos'], $data['estado'], $data['telefono'], $data['oficina']
        );
        if ($exito) {
            echo json_encode(['mensaje' => 'Asesor actualizado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo actualizar el asesor']);
        }
    }

    // Eliminar un asesor
    public function eliminar($id) {
        $exito = $this->modelo->eliminar($id);
        if ($exito) {
            echo json_encode(['mensaje' => 'Asesor eliminado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo eliminar el asesor']);
        }
    }
}
?>
