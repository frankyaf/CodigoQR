<?php
    $servidor = "localhost";
    $bd = "prueba1";
    $usuario = "root";
    $password= "";
    
    try{
        $conn = new PDO("mysql:host=$servidor;dbname=$bd;",$usuario, $password);
    }catch (PDOException $e) {
        die('Conection failed'.$e->getMessage());
    }

?>