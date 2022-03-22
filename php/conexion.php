<?php
    $servidor = "localhost";
    $bd = "prueba1";
    $usuario = "root";
    $password= "";
    // Crear la conexion
    $conn = new mysqli($servidor, $usuario, $password, $bd);
    // Verificar la conexion
    if($conn->connect_error){
        die("Falló la conexion: " . $conn->connect_error);
    }else{
        //echo "Conexión exitosa";
    }

?>