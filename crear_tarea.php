<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Tarea</title>

    <!-- Incluir Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">

    <!-- Incluir Materialize JS (en el pie de página) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<body>
    <div class="container">
        <center><h1>To-Do List</h1></center>
    
        <!-- Formulario de creación de tarea -->
        <form id="create-task-form" class="col s12">
            <!-- Campo para el título -->
            <div class="input-field">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required class="validate">
            </div>

            <!-- Campo para la descripción -->
            <div class="input-field">
                <label for="description">Descripción:</label>
                <input type="text" id="description" name="description">
            </div>

            <!-- Campo para el estado -->
            <div class="input-field">
                <select id="status" name="status">
                    <option value="pendiente" selected>Pendiente</option>
                    <option value="completado">Completada</option>
                </select>
                <label for="status">Estado</label>
            </div>

            <!-- Botón para enviar el formulario -->
            <button type="submit" class="btn waves-effect waves-light">Crear tarea</button>
        </form>
    </div>

    <script>
        // Inicializar el select de Materialize
        $(document).ready(function(){
            $('select').formSelect();
        });

        // Manejar el envío del formulario
        $('#create-task-form').submit(function(e) {
            e.preventDefault();  // Prevenir el envío normal del formulario

            // Recoger los datos del formulario
            var formData = {
                titulo: $('#titulo').val(),
                description: $('#description').val(),
                status: $('#status').val()
            };

            // Enviar los datos usando AJAX (en formato JSON)
            $.ajax({
                url: 'http://localhost/proyfinal/api.php/tareas',
                method: 'POST',
                contentType: 'application/json',  // Enviar como JSON
                data: JSON.stringify(formData),  // Convertir los datos en JSON
                success: function(response) {
                    // Mostrar mensaje en base a la respuesta
                    if (response.success) {
                        alert('Tarea creada exitosamente!');
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Ocurrió un error: ' + error);
                }
            });
        });
    </script>
</body>
</html>