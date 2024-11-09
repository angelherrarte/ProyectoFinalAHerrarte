<?php
header("Content-Type: text/html; charset=UTF-8");
require 'conexion.php';

// Verificar si se ha proporcionado el ID de la tarea en la URL
if (isset($_GET['id'])) {
    $taskId = $_GET['id'];

    // Eliminar la tarea de la base de datos
    $stmt = $pdo->prepare("DELETE FROM tareas WHERE id = :id");
    $stmt->execute([':id' => $taskId]);

    // Verificar si la tarea fue eliminada con éxito
    if ($stmt->rowCount() > 0) {
        echo "<p>Tarea eliminada exitosamente.</p>";
        echo "<a href='ver_tarea.php'>Volver a la lista de tareas</a>";
    } else {
        echo "<p>No se pudo eliminar la tarea. Puede que no exista.</p>";
        echo "<a href='ver_tarea.php'>Volver a la lista de tareas</a>";
    }
} else {
    echo "<p>El ID de la tarea no fue proporcionado.</p>";
    echo "<a href='ver_tarea.php'>Volver a la lista de tareas</a>";
}
?>
