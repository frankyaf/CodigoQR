<?php 
    include 'phpqrcode/qrlib.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creación QR</title>

    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <main class= "contenedor"> 
    <header>
            <div class="portada">
                <!-- <img src="imagenes/escudo_fes.png" alt="Fes Acatlán"> -->
                <div class="texto">
                    <h1>Universidad Nacional Autónoma de México</h1>
                    <p>Facultad de Estudios Superiores</p>
                    <p>Programa Político</p>
                </div>
            </div>
    </header>
    <nav>
        <label for="menu" class="menu">Menú Principal</label>
                <ul id="menu"> 
                    <li><a href="#">Creación QR</a></li>
                    <li><a href="#">Asistencia</a></li>
                </ul>
    </nav>
    <section class= "formulario">
        <div class="contenido">
            <div class="izquierda">
                <h1>Formulario para la creación de códigos QR</h1>
                <form method="get">
                        <label for="Info">Texto</label>
                        <input type="text" name="texto">
                        <label for="nombre">Nombre del archivo</label>
                        <input type="text" name="archive_name">
                        <input type="submit" value="Enviar">
                </form>
            </div>

            
            <div class="derecha">
                <h3>Vista previa</h3>
                <?php
                    
                    $contenido = $_GET['texto'];
                    $name = $_GET['archive_name'];
                    if(!empty($name)){
                        $filename = "temp/".$name.".png";
                    }
                    
                    $level = 'M';	
                    $tamanio = 10;
                    $frameSize = 3;
                    
                    Qrcode::png($contenido, $filename, $level, $tamanio, $frameSize);

                    echo "<div><img src='".$filename."'></div>";   
                ?>
            </div>
        </div>  
    </section>

    </main>
</body>
</html>