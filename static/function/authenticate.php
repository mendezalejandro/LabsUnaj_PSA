<?php
    include 'api_token_service.php';
    if (isset($_GET['token'])) {
        // Obtiene el valor del parámetro 'nombre'
        $token = $_GET['token'];
    } else {
        echo "<script type='text/javascript'>
        window.location='access-denied.php';
        </script>";
    }

    $response = validateToken($token);

    // Verifica si la solicitud fue exitosa
    if($response["codigo"] !== null)
    {
        $codigo = $response["codigo"];

        if($codigo === 'TURNOS-ERR-012'){
            echo "<script type='text/javascript'>
            window.location='logout.php';
            </script>";    
        }
        else
        {
            echo "<script type='text/javascript'>
                window.location='access-denied.php';
            </script>";
        }
        $tokenValido = false;
    }
    else
    {
        $tokenValido = true;
        $labURL = '/lab.php?token=' . $token;

        echo "	<script type='text/javascript'>
                   window.location.replace('" . $labURL . "');
                </script>";
    }
?>