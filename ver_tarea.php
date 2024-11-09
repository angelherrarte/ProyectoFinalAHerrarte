<?php
header("Content-Type: text/html; charset=UTF-8");
require 'conexion.php';

// Consultar todas las tareas en la base de datos
$stmt = $pdo->query("SELECT * FROM tareas ORDER BY status, created_at");
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Si hay tareas, mostrarlas en una tabla
if ($tasks) {
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Lista de Tareas</title>
        
        <!-- Incluir Materialize CSS -->
        <link href='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css' rel='stylesheet'>
    </head>
    <body>
    
    <div class='container'>
        <h1 class='center-align'>Lista de Tareas</h1>
        <h5 class='left-align'>Se listan en orden, se priorizan tareas pendientes mas antiguas</h5>";
        
    // Iniciar la tabla con Materialize
    echo "<table class='highlight responsive-table'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>";

    // Mostrar cada tarea en una fila de la tabla
    foreach ($tasks as $task) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($task['id']) . "</td>";
        echo "<td>" . htmlspecialchars($task['titulo']) . "</td>";
        echo "<td>" . htmlspecialchars($task['description']) . "</td>";
        echo "<td>" . htmlspecialchars($task['status']) . "</td>";
        echo "<td>" . htmlspecialchars($task['created_at']) . "</td>";
        echo "<td>
                <a href='actualizar_tarea.php?id=" . $task['id'] . "' class='btn blue waves-effect waves-light col s6'>Editar</a>
                <a href='eliminar_tarea.php?id=" . $task['id'] . "' class='btn red waves-effect waves-light col s6' onclick='return confirm(\"¿Estás seguro de eliminar esta tarea?\")'>Eliminar</a>
              </td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>No hay tareas disponibles.</p>";
}

echo "</div>";

?>

<!-- Incluir Materialize JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>
</html>
