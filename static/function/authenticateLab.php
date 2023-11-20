<?php 
    include 'api_token_service.php';
    if (isset($_GET['token'])) {
        // Obtiene el valor del parámetro 'nombre'
        $token = $_GET['token'];
    } else {
        die("El parámetro 'token' no está presente en la URL");
    }

    $response = validateToken($token);

    // Verifica si la solicitud fue exitosa
    if($response["codigo"] !== null)
    {
        echo "	<script type='text/javascript'>
                    window.location='logout.php';
                </script>";
        $tokenValido = false;
        die();
    }
    else
    {
        $tokenValido = true;
    }
?>