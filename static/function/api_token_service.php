<?php
include 'environment.php';

function validateToken($token){
    $endpoint =  apiTokenURL . "/turno/token/" . $token;
    return http_get($endpoint);
}

function eliminarSesion($turnoId){
    $endpoint =  apiTokenURL . "/turno/" . $turnoId;
    return http_delete($endpoint);
}

function http_get($url) {
    $options = [
        'http' => [
            'ignore_errors' => true,
        ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === FALSE) {
        // Manejar el error de solicitud
        return ['error' => 'Error al obtener la respuesta de la API'];
    }
    $data = json_decode($response, true);
    return $data;
}

function http_delete($url) {
    // Initialize cURL session
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE'); // Set the request method to DELETE
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string

    // Execute cURL session and get the response
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    } else {
        // Process the response
        echo 'Response: ' . $response;
    }

    // Close cURL session
    curl_close($ch);

    $data = json_decode($response, true);
    return $data;
}
?>
