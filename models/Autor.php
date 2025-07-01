<?php
/**
 * Modelo de la tabla 'autores'
 * Permite operaciones CRUD sobre los autores (estudiantes o egresados).
 */
require_once __DIR__ . '/../models/Carrera.php'; // Necesario para validar

class Autor {
    private $conn;
    private $tabla = "autores";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los autores (opcional: con nombre de carrera)
    public function obtenerTodos() {
        $sql = "SELECT autores.*, carreras.nombre AS nombre_carrera
                FROM " . $this->tabla . "
                LEFT JOIN carreras ON autores.carrera_id = carreras.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener autor por id
    public function obtenerPorId($id) {
        $sql = "SELECT autores.*, carreras.nombre AS nombre_carrera
                FROM " . $this->tabla . "
                LEFT JOIN carreras ON autores.carrera_id = carreras.id
                WHERE autores.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear nuevo autor
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
        // Validar existencia de carrera_id
        $modeloCarrera = new Carrera($this->modelo->conn);
        $carrera = $modeloCarrera->obtenerPorId($data['carrera_id']);
        if (!$carrera) {
            http_response_code(400);
            echo json_encode(['error' => 'La carrera indicada no existe']);
            return;
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


    // Actualizar autor por id
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
        // Validar existencia de carrera_id
        $modeloCarrera = new Carrera($this->modelo->conn);
        $carrera = $modeloCarrera->obtenerPorId($data['carrera_id']);
        if (!$carrera) {
            http_response_code(400);
            echo json_encode(['error' => 'La carrera indicada no existe']);
            return;
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
}
?>
