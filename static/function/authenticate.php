<?php
    include 'api_token_service.php';

    
    if (isset($_GET['token'])) {
        // Obtiene el valor del parámetro 'nombre'
        $token = $_GET['token'];
    } else {
        echo 'access-denied.php';
    }

    $response = validateToken($token);

    // Verifica si la solicitud fue exitosa
    if($response["codigo"] !== null)
    {
        $codigo = $response["codigo"];

        if($codigo === 'TURNOS-ERR-012'){
            echo 'logout.php';
        }
        else
        {
            echo 'access-denied.php';
        }
        $tokenValido = false;
    }
    else
    {
        $tokenValido = true;
        $labURL = '/lab.php?token=' . $token;

        echo $labURL;
    }
?>