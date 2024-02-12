<?php
// app/API.php
require 'Conexion.php';

// Obtener el segmento de la URL después del dominio (la ruta)
$url = $_SERVER['REQUEST_URI'];
$urlSegments = explode('/', $url);
$route = $urlSegments[count($urlSegments) - 1];

// Verificar la ruta y llamar a la función correspondiente
switch ($route) {
    case 'getUsers':
        $response = getUsers();
        break;
    // Agrega más casos para otras funciones
    default:
        $response = array('error' => 'Ruta no válida');
        break;
}

// Manejar la respuesta y enviarla
handleResponse($response);

function getUsers()
{
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sql = 'SELECT * FROM users';
        $users = mysqli_query(conexion(), $sql);

        if ($users) {
            $response = array();

            foreach ($users as $user) {
                $response[] = $user;
            }

            mysqli_free_result($users);

            return $response;
        } else {
            http_response_code(500);
            return array('error' => 'Error al obtener usuarios desde la base de datos');
        }
    } else {
        http_response_code(405);
        return array('error' => 'Método no permitido');
    }
}

function handleResponse($response)
{
    // Establecer la cabecera de respuesta como JSON
    header('Content-Type: application/json');

    // Convertir la respuesta a JSON y enviarla
    echo json_encode($response);
}
