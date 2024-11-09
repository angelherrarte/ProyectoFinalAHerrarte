<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tareas</title>

    <!-- Incluir Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">

    <!-- Incluir Materialize JS (en el pie de página) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>

    <!-- Barra de navegación -->
    <nav>
        <div class="nav-wrapper blue">
            <a href="#" class="brand-logo center">Gestión de Tareas</a>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li><a href="ver_tarea.php">Ver Tareas</a></li>
                <li><a href="crear_tarea.php">Crear Tarea</a></li>
            </ul>
        </div>
    </nav>

    <!-- Contenedor principal -->
    <div class="container" style="margin-top: 30px;">
        <h2 class="center-align">Bienvenido a la gestión de tareas</h2>
        <p class="center-align">Desde aquí puedes gestionar las tareas pendientes, ver las tareas existentes o agregar nuevas.</p>

        <!-- Fila de tarjetas centradas -->
        <div class="row center-align">

            <!-- Tarjeta para Ver Tareas -->
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image">
                        <img src="https://www.pipelinersales.com/wp-content/uploads/2023/03/app-marketplace-logo-badge-microsoft-tasks-1507.png" alt="Ver tareas">
                        <span class="card-title"></span>
                    </div>
                    <div class="card-content">
                        <p>Consulta todas las tareas existentes, con opciones para editar o eliminar.</p>
                    </div>
                    <div class="card-action">
                        <a href="ver_tarea.php" class="waves-effect waves-light btn blue">Ver Tareas</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta para Crear Tarea -->
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image">
                        <img src="https://www.pipelinersales.com/wp-content/uploads/2023/03/app-marketplace-logo-badge-microsoft-tasks-1507.png" alt="Crear tarea">
                        <span class="card-title"></span>
                    </div>
                    <div class="card-content">
                        <p>Agrega nuevas tareas a la lista. Rellena el formulario para crear una tarea.</p>
                    </div>
                    <div class="card-action">
                        <a href="crear_tarea.php" class="waves-effect waves-light btn blue">Crear Tarea</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Inicializar el menú de Materialize (necesario para el menú en móvil) -->
    <script>
        $(document).ready(function(){
            $(".sidenav").sidenav();
        });
    </script>

</body>
<p>Angel de Jesus Herrarte Ambrocio</p>
<p>Carné 22-50-222</p>
<p>Programación Web y Base de Datos</p>
<p>Catedrático: Ing. Luis Felipe Molina</p>
</html>
