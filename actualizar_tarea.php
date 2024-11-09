<?php
header("Content-Type: text/html; charset=UTF-8");
require 'conexion.php';

// Obtener el id de la tarea desde la URL
if (isset($_GET['id'])) {
    $taskId = $_GET['id'];

    // Consultar la tarea que se va a actualizar
    $stmt = $pdo->prepare("SELECT * FROM tareas WHERE id = :id");
    $stmt->execute([':id' => $taskId]);
    $task = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si la tarea existe, mostrar el formulario para editar
    if ($task) {
        // Mostrar el formulario con los datos de la tarea
        echo "<h1>Actualizar Tarea</h1>";
        echo "<form action='actualizar_tarea.php?id=" . $task['id'] . "' method='POST'>";
        echo "<label for='titulo'>Título:</label>";
        echo "<input type='text' id='titulo' name='titulo' value='" . htmlspecialchars($task['titulo']) . "' required><br><br>";
        
        echo "<label for='description'>Descripción:</label>";
        echo "<input type='text' id='description' name='description' value='" . htmlspecialchars($task['description']) . "'><br><br>";

        echo "<label for='status'>Estado:</label>";
        echo "<select id='status' name='status'>";
        echo "<option value='pendiente'" . ($task['status'] == 'pendiente' ? ' selected' : '') . ">Pendiente</option>";
        echo "<option value='completado'" . ($task['status'] == 'completado' ? ' selected' : '') . ">Completado</option>";
        echo "</select><br><br>";

        echo "<input type='submit' value='Actualizar tarea'>";
        echo "</form>";
    } else {
        echo "<p>Tarea no encontrada.</p>";
    }
} else {
    echo "<p>El ID de la tarea no fue proporcionado.</p>";
}

// Si el formulario fue enviado, procesar el update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $titulo = $_POST['titulo'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Validar que los campos no estén vacíos
    if (!empty($titulo) && !empty($status)) {
        // Actualizar la tarea en la base de datos
        $stmt = $pdo->prepare("UPDATE tareas SET titulo = :titulo, description = :description, status = :status WHERE id = :id");
        $stmt->execute([
            ':titulo' => $titulo,
            ':description' => $description,
            ':status' => $status,
            ':id' => $taskId
        ]);

        echo "<p>Tarea actualizada exitosamente.</p>";
        echo "<a href='ver_tarea.php'>Volver a la lista de tareas</a>";
    } else {
        echo "<p>Todos los campos son obligatorios.</p>";
    }
}
?>