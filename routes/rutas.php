<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/CiclosController.php';
require_once __DIR__ . '/../controllers/CarrerasController.php';
require_once __DIR__ . '/../controllers/TagsController.php';
require_once __DIR__ . '/../controllers/TiposArchivosController.php';
require_once __DIR__ . '/../controllers/UsuariosController.php';
require_once __DIR__ . '/../controllers/AsesoresController.php';
require_once __DIR__ . '/../controllers/AutoresController.php';
require_once __DIR__ . '/../controllers/ArchivosController.php';
require_once __DIR__ . '/../controllers/ArchivoAutorController.php';
require_once __DIR__ . '/../controllers/ArchivoTagController.php';
require_once __DIR__ . '/../controllers/ArchivoAsesorController.php';


// Endpoints para ciclos
if (preg_match('#^/api/ciclos/?([0-9]*)#', $request, $matches)) {
    $controlador = new CiclosController($db);

    if ($method == 'GET' && empty($matches[1])) {
        $controlador->obtenerTodos(); // GET /api/ciclos
    } elseif ($method == 'GET' && !empty($matches[1])) {
        $controlador->obtenerPorId($matches[1]); // GET /api/ciclos/5
    } elseif ($method == 'POST' && empty($matches[1])) {
        $controlador->crear(); // POST /api/ciclos
    } elseif ($method == 'PUT' && !empty($matches[1])) {
        $controlador->actualizar($matches[1]); // PUT /api/ciclos/5
    } elseif ($method == 'DELETE' && !empty($matches[1])) {
        $controlador->eliminar($matches[1]); // DELETE /api/ciclos/5
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
    }
    exit;
}
//Endpoints para carreras
if (preg_match('#^/api/carreras/?([0-9]*)#', $request, $matches)) {
    $controlador = new CarrerasController($db);

    if ($method == 'GET' && empty($matches[1])) {
        $controlador->obtenerTodas(); // GET /api/carreras
    } elseif ($method == 'GET' && !empty($matches[1])) {
        $controlador->obtenerPorId($matches[1]); // GET /api/carreras/5
    } elseif ($method == 'POST' && empty($matches[1])) {
        $controlador->crear(); // POST /api/carreras
    } elseif ($method == 'PUT' && !empty($matches[1])) {
        $controlador->actualizar($matches[1]); // PUT /api/carreras/5
    } elseif ($method == 'DELETE' && !empty($matches[1])) {
        $controlador->eliminar($matches[1]); // DELETE /api/carreras/5
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
    }
    exit;
}
// Endpoints para etiquetas (tags)
if (preg_match('#^/api/tags/?([0-9]*)#', $request, $matches)) {
    $controlador = new TagsController($db);

    if ($method == 'GET' && empty($matches[1])) {
        $controlador->obtenerTodas(); // GET /api/tags
    } elseif ($method == 'GET' && !empty($matches[1])) {
        $controlador->obtenerPorId($matches[1]); // GET /api/tags/5
    } elseif ($method == 'POST' && empty($matches[1])) {
        $controlador->crear(); // POST /api/tags
    } elseif ($method == 'PUT' && !empty($matches[1])) {
        $controlador->actualizar($matches[1]); // PUT /api/tags/5
    } elseif ($method == 'DELETE' && !empty($matches[1])) {
        $controlador->eliminar($matches[1]); // DELETE /api/tags/5
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
    }
    exit;
}
// Endpoints para tipos de archivos
if (preg_match('#^/api/tipos_archivos/?([0-9]*)#', $request, $matches)) {
    $controlador = new TiposArchivosController($db);

    if ($method == 'GET' && empty($matches[1])) {
        $controlador->obtenerTodos(); // GET /api/tipos_archivos
    } elseif ($method == 'GET' && !empty($matches[1])) {
        $controlador->obtenerPorId($matches[1]); // GET /api/tipos_archivos/5
    } elseif ($method == 'POST' && empty($matches[1])) {
        $controlador->crear(); // POST /api/tipos_archivos
    } elseif ($method == 'PUT' && !empty($matches[1])) {
        $controlador->actualizar($matches[1]); // PUT /api/tipos_archivos/5
    } elseif ($method == 'DELETE' && !empty($matches[1])) {
        $controlador->eliminar($matches[1]); // DELETE /api/tipos_archivos/5
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
    }
    exit;
}
// Endpoints para usuarios
if (preg_match('#^/api/usuarios/?([0-9]*)#', $request, $matches)) {
    $controlador = new UsuariosController($db);

    if ($method == 'GET' && empty($matches[1])) {
        $controlador->obtenerTodos(); // GET /api/usuarios
    } elseif ($method == 'GET' && !empty($matches[1])) {
        $controlador->obtenerPorId($matches[1]); // GET /api/usuarios/5
    } elseif ($method == 'POST' && empty($matches[1])) {
        $controlador->crear(); // POST /api/usuarios
    } elseif ($method == 'PUT' && !empty($matches[1])) {
        $controlador->actualizar($matches[1]); // PUT /api/usuarios/5
    } elseif ($method == 'DELETE' && !empty($matches[1])) {
        $controlador->eliminar($matches[1]); // DELETE /api/usuarios/5
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
    }
    exit;
}
// Endpoints para asesores
if (preg_match('#^/api/asesores/?([0-9]*)#', $request, $matches)) {
    $controlador = new AsesoresController($db);

    if ($method == 'GET' && empty($matches[1])) {
        $controlador->obtenerTodos(); // GET /api/asesores
    } elseif ($method == 'GET' && !empty($matches[1])) {
        $controlador->obtenerPorId($matches[1]); // GET /api/asesores/5
    } elseif ($method == 'POST' && empty($matches[1])) {
        $controlador->crear(); // POST /api/asesores
    } elseif ($method == 'PUT' && !empty($matches[1])) {
        $controlador->actualizar($matches[1]); // PUT /api/asesores/5
    } elseif ($method == 'DELETE' && !empty($matches[1])) {
        $controlador->eliminar($matches[1]); // DELETE /api/asesores/5
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
    }
    exit;
}
// Endpoints para autores
if (preg_match('#^/api/autores/?([0-9]*)#', $request, $matches)) {
    $controlador = new AutoresController($db);

    if ($method == 'GET' && empty($matches[1])) {
        $controlador->obtenerTodos(); // GET /api/autores
    } elseif ($method == 'GET' && !empty($matches[1])) {
        $controlador->obtenerPorId($matches[1]); // GET /api/autores/5
    } elseif ($method == 'POST' && empty($matches[1])) {
        $controlador->crear(); // POST /api/autores
    } elseif ($method == 'PUT' && !empty($matches[1])) {
        $controlador->actualizar($matches[1]); // PUT /api/autores/5
    } elseif ($method == 'DELETE' && !empty($matches[1])) {
        $controlador->eliminar($matches[1]); // DELETE /api/autores/5
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
    }
    exit;
}
// Endpoints para archivos
if (preg_match('#^/api/archivos/?([0-9]*)#', $request, $matches)) {
    $controlador = new ArchivosController($db);

    if ($method == 'GET' && empty($matches[1])) {
        $controlador->obtenerTodos(); // GET /api/archivos
    } elseif ($method == 'GET' && !empty($matches[1])) {
        $controlador->obtenerPorId($matches[1]); // GET /api/archivos/5
    } elseif ($method == 'POST' && empty($matches[1])) {
        $controlador->crear(); // POST /api/archivos
    } elseif ($method == 'PUT' && !empty($matches[1])) {
        $controlador->actualizar($matches[1]); // PUT /api/archivos/5
    } elseif ($method == 'DELETE' && !empty($matches[1])) {
        $controlador->eliminar($matches[1]); // DELETE /api/archivos/5
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
    }
    exit;
}
// Endpoints para archivo_autor
if (preg_match('#^/api/archivo_autor/?([0-9]*)#', $request, $matches)) {
    $controlador = new ArchivoAutorController($db);

    if ($method == 'GET' && empty($matches[1])) {
        $controlador->obtenerTodos(); // GET /api/archivo_autor
    } elseif ($method == 'GET' && !empty($matches[1])) {
        $controlador->obtenerPorId($matches[1]); // GET /api/archivo_autor/5
    } elseif ($method == 'POST' && empty($matches[1])) {
        $controlador->crear(); // POST /api/archivo_autor
    } elseif ($method == 'DELETE' && !empty($matches[1])) {
        $controlador->eliminar($matches[1]); // DELETE /api/archivo_autor/5
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
    }
    exit;
}
// Endpoints para archivo_tag
if (preg_match('#^/api/archivo_tag/?([0-9]*)#', $request, $matches)) {
    $controlador = new ArchivoTagController($db);

    if ($method == 'GET' && empty($matches[1])) {
        $controlador->obtenerTodos(); // GET /api/archivo_tag
    } elseif ($method == 'GET' && !empty($matches[1])) {
        $controlador->obtenerPorId($matches[1]); // GET /api/archivo_tag/5
    } elseif ($method == 'POST' && empty($matches[1])) {
        $controlador->crear(); // POST /api/archivo_tag
    } elseif ($method == 'DELETE' && !empty($matches[1])) {
        $controlador->eliminar($matches[1]); // DELETE /api/archivo_tag/5
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
    }
    exit;
}
// Endpoints para archivo_asesor
if (preg_match('#^/api/archivo_asesor/?([0-9]*)#', $request, $matches)) {
    $controlador = new ArchivoAsesorController($db);

    if ($method == 'GET' && empty($matches[1])) {
        $controlador->obtenerTodos(); // GET /api/archivo_asesor
    } elseif ($method == 'GET' && !empty($matches[1])) {
        $controlador->obtenerPorId($matches[1]); // GET /api/archivo_asesor/5
    } elseif ($method == 'POST' && empty($matches[1])) {
        $controlador->crear(); // POST /api/archivo_asesor
    } elseif ($method == 'DELETE' && !empty($matches[1])) {
        $controlador->eliminar($matches[1]); // DELETE /api/archivo_asesor/5
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
    }
    exit;
}

// Extras:
// Listar archivos de un autor y autores de un archivo, arhivo_autor
if (preg_match('#^/api/archivo_autor/archivos_por_autor/([0-9]+)#', $request, $matches)) {
    $controlador = new ArchivoAutorController($db);
    $controlador->archivosPorAutor($matches[1]); // GET /api/archivo_autor/archivos_por_autor/3
    exit;
}
if (preg_match('#^/api/archivo_autor/autores_por_archivo/([0-9]+)#', $request, $matches)) {
    $controlador = new ArchivoAutorController($db);
    $controlador->autoresPorArchivo($matches[1]); // GET /api/archivo_autor/autores_por_archivo/2
    exit;
}
// Listar tags de un archivo y archivos de un tag, archivo_tag
if (preg_match('#^/api/archivo_tag/tags_por_archivo/([0-9]+)#', $request, $matches)) {
    $controlador = new ArchivoTagController($db);
    $controlador->tagsPorArchivo($matches[1]); // GET /api/archivo_tag/tags_por_archivo/2
    exit;
}
if (preg_match('#^/api/archivo_tag/archivos_por_tag/([0-9]+)#', $request, $matches)) {
    $controlador = new ArchivoTagController($db);
    $controlador->archivosPorTag($matches[1]); // GET /api/archivo_tag/archivos_por_tag/1
    exit;
}
// Listar asesores de un archivo y archivos de un asesor, archivo_asesor
if (preg_match('#^/api/archivo_asesor/asesores_por_archivo/([0-9]+)#', $request, $matches)) {
    $controlador = new ArchivoAsesorController($db);
    $controlador->asesoresPorArchivo($matches[1]); // GET /api/archivo_asesor/asesores_por_archivo/4
    exit;
}
if (preg_match('#^/api/archivo_asesor/archivos_por_asesor/([0-9]+)#', $request, $matches)) {
    $controlador = new ArchivoAsesorController($db);
    $controlador->archivosPorAsesor($matches[1]); // GET /api/archivo_asesor/archivos_por_asesor/2
    exit;
}
?>


