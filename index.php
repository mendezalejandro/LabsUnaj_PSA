<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "static/include/head.php"; ?>
    <title>Login</title>
</head>

<style>
    .btn-color {
        background-color: #0e1c36;
        color: #fff;

    }

    .profile-image-pic {
        height: 180px;
        width: 180px;
        object-fit: cover;
    }



    .cardbody-color {
        background-color: #ebf2fa;
    }

    a {
        text-decoration: none;
    }

    #ini:hover {
         background-color: #536382;
         color:#ebf2fa;
    }
</style>

<body>
<div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-dark mt-5">Laboratorio remoto de sistemas embebidos</h2>

                <div class="container">
                    <div class="row justify-content-center mt-5">
                        <div class="col-md-4 text-center">
                            <h2>Validando acceso</h2>
                            <!-- Agrega un div para el spinner -->
                            <div id="loading-spinner" class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Muestra el spinner al hacer la petición AJAX
            $("#loading-spinner").show();

            // Obtener la URL actual
            var urlActual = window.location.href;

            // Crear un objeto URL
            var url = new URL(urlActual);

            // Obtener los parámetros de consulta
            var queryParams = url.searchParams;

            // Acceder a un parámetro específico
            var token = queryParams.get('token');

            if(!token)
            {
                window.location.href = "access-denied.php";
            }else
            {

            // Realiza la petición AJAX
            $.ajax({
                type: "POST",
                url: "static/function/authenticate.php?token="+token,
                success: function (response) {
                    // Oculta el spinner al recibir la respuesta del servidor
                    $("#loading-spinner").hide();

                    window.location.href = response;
                },
                error: function () {
                    window.location.href = "access-denied.php";
                }
            });
        }
        });
    </script>
</body>

</html>