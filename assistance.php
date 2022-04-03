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
                            

                            $fp = fopen("decrypted.txt", "rb");
                            $datos = fread($fp, filesize("decrypted.txt"));
                            $nombre = $datos;
                            fclose($fp);

                            $nombre2 = array();

                            $token = strtok($nombre,"\n"); // Primer token
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
                            $asistencia = "asistencia";    
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
                            date_default_timezone_set("America/Mexico_City");
                            setlocale(LC_ALL,"es_MX");
                            $fecha_actual = date('d-m-Y');
                            $hora_actual = date('h:i A');
     
                        ?>
                        <h3> Fecha y hora del registro</h3>
                        <label for="Fecha"> Fecha: <?php echo $fecha_actual ?> </label> <br>
                        <label for="Hora"> Hora: <?php echo $hora_actual ?> </label> <br>
                        
                        <?php   
                            
                            $sql = "SELECT * FROM $alumnos WHERE cuenta = $cuenta";
                            $result = $conn->query($sql);
                            if($result->num_rows>0){
                                while($fila = $result->fetch_assoc()) {
                                    ?>
                                    <label for="id"> <?php echo $fila['id_alumnos']?></label> <br>
                                    <label for="cuenta"> <?php echo $fila['cuenta']?></label> <br>
                                    <label for="nombre"><?php echo $fila['nombre'] ?></label> <br>
                                    <label for="Horario"><?php echo $fila['horario'] ?></label> <br>
                                    <?php $intentos = $fila['no_asistencia'] ?>
                            <?php   
                                    $horario = $fila['horario'];
                                }
                            }
                                
                                setlocale(LC_ALL,""); 
                                $dia_act = strftime('%A');
                                $dia_actual = utf8_encode($dia_act);
                                //echo $dia_actual;
                                
                                //echo $intentos;
                                $pos      = strripos($horario, $dia_actual);
                                //echo $fecha_actual;
                                ?><br> <label for="nota">Asistencia </label> <br> <?php
                                
                                $sql = "SELECT * FROM $asistencia WHERE cuenta = $cuenta AND fecha = '$fecha_actual'";
                                $result = $conn->query($sql);
                                $no_asistencias = $result->num_rows;
                                //echo $no_asistencias;
                                if($no_asistencias < $intentos) {
                                    if ($pos === false ) {
                                        //echo "Sorry, we did not find ($horario) in ($dia_actual)";
                                        echo "Hoy no es tú día de asistencia";
                                    } else {
                                        $sql2 = "INSERT INTO $asistencia(cuenta,nombre,fecha,hora) 
                                        VALUES ('$cuenta','$name','$fecha_actual','$hora_actual')";
                                        if ($conn->query($sql2) === TRUE) {
                                            echo "La asistencia ha sido guardada";
                                        } else {
                                            echo "Error: " . $sql2 . "<br>" . $conn->error;
                                        }
                                    }
                                } else {
                                    echo "Ya sobrepasaste la cantidad de veces por día";
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