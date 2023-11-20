<?php
    //SI ESTAMOS VAMOS AL LOGIN PERO YA TENEMOS INICIADA UNA SESSION, SURGE UNA REDIRECCIÓN A MAIN.PHP
    // Verifica si el parámetro 'nombre' está presente en la URL
    if (isset($_GET['token'])) {
        // Obtiene el valor del parámetro 'nombre'
        $token = $_GET['token'];
        echo "token: $token<br>";
    } else {
        echo "El parámetro 'token' no está presente en la URL.<br>";
    }
    $tokenValido = false;

    if($tokenValido){    
        echo "	<script type='text/javascript'>
                   window.location.replace('/lab.php');
                </script>";
    }
    else{
        echo "	<script type='text/javascript'>
                    window.location='logout.php';
                </script>";
    }
    
?>