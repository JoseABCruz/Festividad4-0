<?php

global $enlace;

function conexion() {
    $host = '35.184.106.188';
    $username = 'joseantonio';
    $password = '123456';
    $database = 'festividad';

    /*$host = '35.193.200.150';
    $username = 'joseantonio';
    $password = '123456';
    $database = 'festividad';*/

    $enlace = mysqli_connect($host, $username, $password, $database);

    if (!$enlace) {
        echo "Error: No se puede conectar a MySQL" . PHP_EOL;
        echo "Error de depuración: " . mysqli_connect_errno() . PHP_EOL;
        echo "Error de depuración: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }else{
        echo "Conexion exitosa";
        echo "¡Hola mundo!";
        //header("Location: index.php");
        //exit;
    }

    return $enlace;
}

?>