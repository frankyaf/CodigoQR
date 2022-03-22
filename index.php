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
                        <li><a href="index.php">Creación QR</a></li>
                        <li><a href="assistance.php">Asistencia</a></li>
                    </ul>
        </nav>
        <section class= "ventana">
            <div class="contenido">
                <div class="arriba">
                    <div class="izquierda">
                        
                            <h2>Formulario para la creación de códigos QR</h2>
                            <form method="get">
                                    <label for="Info">Texto</label>
                                    <input type="text" name="texto">
                                    <br> <br>
                                    <label for="nombre">Nombre del archivo</label>
                                    <input type="text" name="archive_name">
                                    <br> <br>
                                    <label for="nivel">Nivel: </label>
                                    <select name="level" id="level">
                                        <option value="L">L</option>
                                        <option value="M">M</option>
                                        <option value="Q">Q</option>
                                        <option value="H">H</option>
                                    </select>
                                    <br> <br>
                                    <label for="size">Tamaño:</label>
                                    <input type="number" class="numb" name="numero" id="id_size" min="5" max="15" value= "5">
                                    <input type="submit" value="Enviar">
                            </form> 
                    </div>

                    
                    <div class="derecha">
                        <h3>Vista previa del código QR</h3>
                        <?php
                            error_reporting(E_ERROR  | E_PARSE);
                            $contenido = $_GET['texto'];
                            $name = $_GET['archive_name'];
                            $level = $_GET['level'];
                            $tamanio = $_GET['numero'];
                            if(!empty($name)){
                                $filename = "temp/".$name.".png";
                            }
                            $frameSize = 2;
                            
                            Qrcode::png($contenido, $filename, $level, $tamanio, $frameSize);
                        ?>
                        <div ><img src= <?php echo $filename ?> > </div> 
                    </div>
                </div>

                <div class="abajo">
                    <div class="izquierda_1">
                        <h3>Formulario para creación QR de alumno</h3>
                        <form method="get">
                                    <label for="Info">Cuenta</label>
                                    <input type="text" name="cuenta">
                                    <br> <br>

                                    <label for="nombre">Nombre del alumno:</label>
                                    <input type="text" name="student_name">
                                    <br> <br>
                                    
                                    <!--<label for="nivel">Nivel: </label>
                                    <select name="level" id="level">
                                        <option value="L">L</option>
                                        <option value="M">M</option>
                                        <option value="Q">Q</option>
                                        <option value="H">H</option>
                                    </select>
                                    <br> <br>
                                    
                                    <label for="size">Tamaño:</label>

                                    <input type="number" class="numb" name="numero" id="id_size" min="5" max="15" value= "5">
                                    <br><br> !-->

                                    <label for="nombre">Nombre del archivo</label>
                                    <input type="text" name="archive_name2">
                                    <br> <br>

                                    <input type="submit" value="Enviar">
                            </form> 
                    </div>

                    <div class="derecha_1">
                    <h3>Vista previa del código QR del alumno</h3>
                        <?php
                            error_reporting(E_ERROR  | E_PARSE);

                            $s_name = $_GET['student_name'];
                            $s_cuenta = $_GET['cuenta'];
                            $name2 = $_GET['archive_name2'];
                            $level2 = 'Q';	
                            $tamanio2 = 8;
                            $frameSize2 = 2;
                           
                            $filename2 = "temp/".$name2.".png";
                            
                            //$codeContents = 'BEGIN:VCARD'."\n";
                            //$codeContents .= 'VERSION:4.0'."\n";
                            //$codeContents .= 'Cuenta:'.$s_cuenta."\n";
                            //$codeContents .= 'FN:'.$s_name."\n";
                            //$codeContents .= 'END:VCARD';

                            $codeContents = "Cuenta: ".$s_cuenta."\n";
                            $codeContents .= "Nombre: ".$s_name;

                            Qrcode::png($codeContents, $filename2, $level2, $tamanio2, $frameSize2);
                        ?>
                        <div ><img src= <?php echo $filename2 ?> > </div>
                    </div>
                </div>

            </div>

        </section>

        <section class="foot">


        </section>
    </main>
</body>
</html>