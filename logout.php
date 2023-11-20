<?php 
include "static/include/head.php"; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sesión Finalizada</title>

    <!-- Enlace a Bootstrap (puedes usar un CDN o descargar e incluir localmente) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }

        .container {
            text-align: center;
        }

        .message {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .icon {
            font-size: 50px;
            color: #dc3545; /* Color rojo de Bootstrap */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="message">
        <i class="icon fas fa-exclamation-circle"></i>
        <h4 class="mt-3">Sesión Finalizada</h4>
        <a href="<?php include "static/function/environment.php"; echo webTokenURL ?>" class="btn btn-primary">Volver a reservar un turno</a>
    </div>
</div>



</body>
</html>