<?php
    include 'phpqrcode/qrlib.php';
	
    $contenido = "Armando Alonso Fuentes";

    $filename = "qr.png";

    $level = 'M';	
    $tamanio = 10;
    $frameSize = 3;
    
    Qrcode::png($contenido, $filename, $level, $tamanio, $frameSize);

    echo "<div><img src='".$filename."'></div>";
    
?>