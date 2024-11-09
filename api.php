<?php
header("Content-Type: application/json");
require 'conexion.php';

$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

// Ajusta la URL para obtener solo las partes después de 'api.php'
$request = explode('/', trim(str_replace('/proyfinal/api.php', '', $requestUri), '/'));  // Ajusta la ruta base según sea necesario

// Verifica que $request[0] exista antes de acceder a él
if (!isset($request[0]) || $request[0] === '') {
    echo json_encode(["success" => false, "message" => "Ruta no especificada"]);
    exit;
}

switch ($method) {
    case 'POST':
        if ($request[0] === 'tareas') {
            createTask();
        }
        break;

    case 'GET':
        if ($request[0] === 'tareas') {
            if (isset($request[1])) {
                getTask($request[1]);
            } else {
                listTasks();
            }
        }
        break;

    case 'PUT':
        if ($request[0] === 'tareas' && isset($request[1])) {
            updateTask($request[1]);
        }
        break;

    case 'DELETE':
        if ($request[0] === 'tareas' && isset($request[1])) {
            deleteTask($request[1]);
        }
        break;

    default:
        echo json_encode(["success" => false, "message" => "Método no soportado"]);
        break;
}

function createTask() {
    global $pdo;
    
    // Leer el cuerpo de la solicitud (JSON)
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (!isset($data['titulo']) || empty($data['titulo'])) {
        echo json_encode(["success" => false, "message" => "El título es requerido"]);
        return;
    }

    // Insertar la tarea en la base de datos
    $stmt = $pdo->prepare("INSERT INTO tareas (titulo, description, status) VALUES (:titulo, :description, :status)");
    $stmt->execute([
        ':titulo' => $data['titulo'],
        ':description' => $data['description'] ?? null,
        ':status' => $data['status'] ?? 'pendiente'
    ]);

    echo json_encode([
        "success" => true,
        "message" => "Tarea creada exitosamente",
        "task_id" => $pdo->lastInsertId()
    ]);
}

function listTasks() {
    global $pdo;
    
    $stmt = $pdo->query("SELECT * FROM tareas");
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode(["success" => true, "tasks" => $tasks]);
}

function getTask($id) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT * FROM tareas WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $task = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($task) {
        echo json_encode(["success" => true, "task" => $task]);
    } else {
        echo json_encode(["success" => false, "message" => "Tarea no encontrada"]);
    }
}

function updateTask($id) {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"), true);
    
    $stmt = $pdo->prepare("UPDATE tareas SET titulo = :titulo, description = :description, status = :status WHERE id = :id");
    $stmt->execute([
        ':titulo' => $data['titulo'],
        ':description' => $data['description'],
        ':status' => $data['status'],
        ':id' => $id
    ]);

    echo json_encode(["success" => true, "message" => "Tarea actualizada exitosamente"]);
}

function deleteTask($id) {
    global $pdo;
    
    $stmt = $pdo->prepare("DELETE FROM tareas WHERE id = :id");
    $stmt->execute([':id' => $id]);

    echo json_encode(["success" => true, "message" => "Tarea eliminada exitosamente"]);
}
?>