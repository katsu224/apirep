<?php
require_once __DIR__ . '/../models/TipoArchivo.php';

/**
 * Controlador para la gestión de tipos de archivos.
 * Expone métodos para el CRUD.
 */
class TiposArchivosController {
    private $modelo;

    public function __construct($db) {
        $this->modelo = new TipoArchivo($db);
    }

    // Obtener todos los tipos de archivo
    public function obtenerTodos() {
        $tipos = $this->modelo->obtenerTodos();
        header('Content-Type: application/json');
        echo json_encode($tipos);
    }

    // Obtener un tipo de archivo por id
    public function obtenerPorId($id) {
        $tipo = $this->modelo->obtenerPorId($id);
        header('Content-Type: application/json');
        if ($tipo) {
            echo json_encode($tipo);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Tipo de archivo no encontrado']);
        }
    }

    // Crear un nuevo tipo de archivo
    public function crear() {
        $data = json_decode(file_get_contents("php://input"), true);
        // Validación simple: los campos más importantes
        $requeridos = ['nombre', 'codigo', 'descripcion', 'formatos_permitidos', 'tamano_maximo', 'requisitos', 'estado', 'fecha_creacion'];
        foreach ($requeridos as $campo) {
            if (!isset($data[$campo])) {
                http_response_code(400);
                echo json_encode(['error' => "Falta el campo '$campo'"]);
                return;
            }
        }
        $exito = $this->modelo->crear(
            $data['nombre'], $data['codigo'], $data['descripcion'],
            $data['formatos_permitidos'], $data['tamano_maximo'],
            $data['requisitos'], $data['estado'], $data['fecha_creacion']
        );
        if ($exito) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'Tipo de archivo creado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo crear el tipo de archivo']);
        }
    }

    // Actualizar un tipo de archivo existente
    public function actualizar($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        $requeridos = ['nombre', 'codigo', 'descripcion', 'formatos_permitidos', 'tamano_maximo', 'requisitos', 'estado', 'fecha_creacion'];
        foreach ($requeridos as $campo) {
            if (!isset($data[$campo])) {
                http_response_code(400);
                echo json_encode(['error' => "Falta el campo '$campo'"]);
                return;
            }
        }
        $exito = $this->modelo->actualizar(
            $id,
            $data['nombre'], $data['codigo'], $data['descripcion'],
            $data['formatos_permitidos'], $data['tamano_maximo'],
            $data['requisitos'], $data['estado'], $data['fecha_creacion']
        );
        if ($exito) {
            echo json_encode(['mensaje' => 'Tipo de archivo actualizado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo actualizar el tipo de archivo']);
        }
    }

    // Eliminar un tipo de archivo
    public function eliminar($id) {
        $exito = $this->modelo->eliminar($id);
        if ($exito) {
            echo json_encode(['mensaje' => 'Tipo de archivo eliminado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo eliminar el tipo de archivo']);
        }
    }
}
?>
