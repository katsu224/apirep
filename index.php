<?php
// index.php en la raíz del proyecto

// Habilita CORS para desarrollo
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Preflight (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Conexión a la base de datos
require_once __DIR__ . '/config/database.php';

// Obtenemos la conexión PDO
$db = (new Database())->getConnection();

// Obtenemos la ruta y método de la petición
$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Limpiamos el path si es necesario
// (ajusta si tu proyecto está en un subdirectorio)
$request = str_replace('/api_repo', '', $request); // cuidado: usa mayúsculas o minúsculas según tu carpeta

// Incluimos el archivo de rutas
require_once __DIR__ . '/routes/rutas.php';
