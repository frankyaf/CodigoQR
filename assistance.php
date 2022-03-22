<?php 
    include 'phpqrcode/qrlib.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistencia QR</title>

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
                    <li><a href="index.php">Creación QR</a></li>
                    <li><a href="assistance.php">Asistencia</a></li>
                </ul>
    </nav>
    <section class= "ventana">
        <div class="contenido">
                <div class="izquierda">
                        <h1>Asistencia de los alumnos</h1>
                        <?php  
                            /*$fp = fopen("decrypted.txt","r") or die ("Error al leer");
                            while(!feof($fp)){
                                $linea = fgets($fp);   
                            }
                            $nombre = $linea;
                            fclose($fp); */

                            $fp = fopen("decrypted.txt", "rb");
                            $datos = fread($fp, filesize("decrypted.txt"));
                            $nombre = $datos;
                            fclose($fp);

                            $needle   = 'Nombre:';
                            $needle2  = 'Cuenta:';

                            $pos      = strripos($nombre, $needle);

                            if ($pos === false) {
                                //echo "Sorry, we did not find ($needle) in ($nombre)";
                            } else {
                            // echo "Congratulations!\n";
                                //echo "We found the last ($needle) in ($nombre) at position ($pos)";
                            }

                            //$cuenta = substr($nombre,0,-1);
                            //$name = substr($nombre,-$pos-6);

                            $nombre2 = array();

                            $token = strtok($nombre, "\n"); // Primer token
                            //echo "<br>";
                            $nombre2[0] = $token;
                            while($token !== false) {
                            // En los tokens subsecuentes no se include el string $cadena
                                //echo $token . "<br>";
                                $token = strtok("\n");
                                $nombre2[] = $token;
                            }
                            $posicion = strpos($nombre2[0],"Cuenta:");
                            $nombre2[0] =  substr_replace($nombre2[0],'',$posicion,7);
                            $pos = strpos($nombre2[1],"Nombre:");
                            $nombre2[1] =  substr_replace($nombre2[1],'',$pos,7);
                        ?>
                        <label for="Persona"> Cuenta: <?php echo $nombre2[0]?> </label> <br>
                        <label for="Persona"> Nombre: <?php echo $nombre2[1]?> </label>
                        
                        <?php
                            $cuenta = $nombre2[0];
                            $name = $nombre2[1];
                        ?>
                </div>

                
                <div class="derecha">
                    <h3>Registro en la base de datos</h3>
                        <?php 
                            include 'php/conexion.php';
                            $alumnos = "alumnos";    
                            $sql = "SELECT * FROM $alumnos WHERE cuenta = $cuenta";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($fila = $result->fetch_assoc()) {
                        ?>
                                <label for="id"> <?php echo $fila['id_alumnos']?></label> <br>
                                <label for="Nombre"> <?php echo $fila['cuenta']?></label> <br>
                                <label for="Efemeride"><?php echo $fila['nombre'] ?></label> <br>
                        <?php
                                }
                            } 
                        ?>
                </div>
            
        </div>  
        </section>

        <section class="foot">


        </section>
    </main>
</body>
</html>