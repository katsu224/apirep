<?php
require_once __DIR__ . '/../models/Archivo.php';
require_once __DIR__ . '/../models/TipoArchivo.php';

/**
 * Controlador para la gestión de archivos del repositorio.
 * Expone métodos CRUD.
 */
class ArchivosController {
    private $modelo;

    public function __construct($db) {
        $this->modelo = new Archivo($db);
        $this->db = $db;
    }

    // Obtener todos los archivos
    public function obtenerTodos() {
        $archivos = $this->modelo->obtenerTodos();
        header('Content-Type: application/json');
        echo json_encode($archivos);
    }

    // Obtener un archivo por id
    public function obtenerPorId($id) {
        $archivo = $this->modelo->obtenerPorId($id);
        header('Content-Type: application/json');
        if ($archivo) {
            echo json_encode($archivo);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Archivo no encontrado']);
        }
    }

    // Crear un nuevo archivo
    public function crear() {
        $data = json_decode(file_get_contents("php://input"), true);
        // Lista de campos requeridos
        $requeridos = ['tipo', 'titulo', 'descripcion', 'portada', 'paginas', 'categoria', 'anio', 'fecha_creacion', 'fecha_modificacion', 'estado', 'version', 'metadatos', 'tipo_archivo_id'];
        foreach ($requeridos as $campo) {
            if (!isset($data[$campo])) {
                http_response_code(400);
                echo json_encode(['error' => "Falta el campo '$campo'"]);
                return;
            }
        }
        // Validar que el tipo de archivo exista
        $modeloTipoArchivo = new TipoArchivo($this->modelo->conn);
        $tipoArchivo = $modeloTipoArchivo->obtenerPorId($data['tipo_archivo_id']);
        if (!$tipoArchivo) {
            http_response_code(400);
            echo json_encode(['error' => 'El tipo de archivo indicado no existe']);
            return;
        }
        $exito = $this->modelo->crear(
            $data['tipo'], $data['titulo'], $data['descripcion'], $data['portada'], $data['paginas'],
            $data['categoria'], $data['anio'], $data['fecha_creacion'], $data['fecha_modificacion'], $data['estado'],
            $data['version'], json_encode($data['metadatos']), $data['tipo_archivo_id']
        );
        if ($exito) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'Archivo creado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo crear el archivo']);
        }
    }

    // Actualizar archivo existente
    public function actualizar($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        $requeridos = ['tipo', 'titulo', 'descripcion', 'portada', 'paginas', 'categoria', 'anio', 'fecha_creacion', 'fecha_modificacion', 'estado', 'version', 'metadatos', 'tipo_archivo_id'];
        foreach ($requeridos as $campo) {
            if (!isset($data[$campo])) {
                http_response_code(400);
                echo json_encode(['error' => "Falta el campo '$campo'"]);
                return;
            }
        }
        // Validar que el tipo de archivo exista
        $modeloTipoArchivo = new TipoArchivo($this->modelo->conn);
        $tipoArchivo = $modeloTipoArchivo->obtenerPorId($data['tipo_archivo_id']);
        if (!$tipoArchivo) {
            http_response_code(400);
            echo json_encode(['error' => 'El tipo de archivo indicado no existe']);
            return;
        }
        $exito = $this->modelo->actualizar(
            $id,
            $data['tipo'], $data['titulo'], $data['descripcion'], $data['portada'], $data['paginas'],
            $data['categoria'], $data['anio'], $data['fecha_creacion'], $data['fecha_modificacion'], $data['estado'],
            $data['version'], json_encode($data['metadatos']), $data['tipo_archivo_id']
        );
        if ($exito) {
            echo json_encode(['mensaje' => 'Archivo actualizado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo actualizar el archivo']);
        }
    }

    // Eliminar un archivo
    public function eliminar($id) {
        $exito = $this->modelo->eliminar($id);
        if ($exito) {
            echo json_encode(['mensaje' => 'Archivo eliminado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo eliminar el archivo']);
        }
    }
}
?>
