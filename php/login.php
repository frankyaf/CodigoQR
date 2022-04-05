<?php

session_start();
if (isset($_SESSION['user_id'])) {
    header('Location:http://localhost/dashboard/QR/assistance.php');
  }

include 'conexion2.php';

if(!empty($_POST['usuario']) && !empty($_POST['password'])){
    $sql = $conn->prepare('SELECT * FROM usuarios WHERE usuario =:usuario');
    $sql->bindParam(':usuario',$_POST['usuario']);
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    
    echo $result['usuario'];
    $message = '';
    // contra: Jyl--4522
    if(count($result)>0 && md5($_POST['password'] )== $result['password']){
        $_SESSION['user_id'] = $result['id'];
        echo $result['password'];
        header("Location:http://localhost/dashboard/QR/assistance.php");
    } else{
        $message = 'sorry those credential';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/styles2.css">
</head>
<body>
    <main class="contenedor">
    <header >
    <div class="portada">
                <!-- <img src="imagenes/escudo_fes.png" alt="Fes Acatlán"> -->
                <div class="texto">
                    <h1>Universidad Nacional Autónoma de México</h1>
                    <p>Facultad de Estudios Superiores</p>
                    <p>Programa Político</p>
                </div>
            </div>
    </header>
    <h3>Iniciar sesión</h3>
    <?php if(!empty($message)) : ?>
        <p><?$message ?></p>
    <?php endif;?>

    <form action="login.php" method="post">
        <input type="text" name="usuario" placeholder="Usuario">
        <input type="password" name="password" placeholder="Contraseña">
        <input type="submit" value="Enviar">
    </form>
    </main>
</body>
</html>