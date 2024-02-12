<?php
// app/Conexion.php

function conexion()
    {
        $host = 'localhost'; // nombre del servidor de la base de datos
        $user = 'root'; // nombre de usuario de la base de datos
        $password = 'fji9ipbd'; // contraseña de la base de datos
        $database = 'PHP_practicing'; // nombre de la base de datos
        $conexion = mysqli_connect($host, $user, $password, $database);
        return $conexion;
    }