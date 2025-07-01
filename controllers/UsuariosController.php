<?php
require_once __DIR__ . '/../models/Usuario.php';

/**
 * Controlador para la gestión de usuarios.
 * Expone métodos para el CRUD.
 */
class UsuariosController {
    private $modelo;

    public function __construct($db) {
        $this->modelo = new Usuario($db);
    }

    // Obtener todos los usuarios
    public function obtenerTodos() {
        $usuarios = $this->modelo->obtenerTodos();
        header('Content-Type: application/json');
        echo json_encode($usuarios);
    }

    // Obtener un usuario por id
    public function obtenerPorId($id) {
        $usuario = $this->modelo->obtenerPorId($id);
        header('Content-Type: application/json');
        if ($usuario) {
            echo json_encode($usuario);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Usuario no encontrado']);
        }
    }

    // Crear un nuevo usuario
    public function crear() {
        $data = json_decode(file_get_contents("php://input"), true);
        // Validación simple
        $requeridos = ['nombre', 'email', 'password', 'rol', 'estado', 'fecha_creacion', 'ultimo_acceso', 'permisos'];
        foreach ($requeridos as $campo) {
            if (!isset($data[$campo])) {
                http_response_code(400);
                echo json_encode(['error' => "Falta el campo '$campo'"]);
                return;
            }
        }
        $exito = $this->modelo->crear(
            $data['nombre'], $data['email'], $data['password'], $data['rol'], $data['estado'],
            $data['fecha_creacion'], $data['ultimo_acceso'], $data['permisos']
        );
        if ($exito) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'Usuario creado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo crear el usuario']);
        }
    }

    // Actualizar un usuario existente
    public function actualizar($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        $requeridos = ['nombre', 'email', 'password', 'rol', 'estado', 'fecha_creacion', 'ultimo_acceso', 'permisos'];
        foreach ($requeridos as $campo) {
            if (!isset($data[$campo])) {
                http_response_code(400);
                echo json_encode(['error' => "Falta el campo '$campo'"]);
                return;
            }
        }
        $exito = $this->modelo->actualizar(
            $id,
            $data['nombre'], $data['email'], $data['password'], $data['rol'], $data['estado'],
            $data['fecha_creacion'], $data['ultimo_acceso'], $data['permisos']
        );
        if ($exito) {
            echo json_encode(['mensaje' => 'Usuario actualizado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo actualizar el usuario']);
        }
    }

    // Eliminar un usuario
    public function eliminar($id) {
        $exito = $this->modelo->eliminar($id);
        if ($exito) {
            echo json_encode(['mensaje' => 'Usuario eliminado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo eliminar el usuario']);
        }
    }
}
?>
