<?php 

// aqui es la parte de lectura 

error_reporting(E_ALL);
ini_set('display_errors', '1');

$fp = fopen ("/dev/ttyUSB0", "w+");
if (!$fp) {
     echo 'not open';
  }else{sleep(3);
    echo '<br/> Puerto abierto para escribir <br><br>';
     $string = '1';
     fputs ($fp, $string );
     echo 'Enviando solicitud "'.$string.'"<br>';
     fclose ($fp);
 }

$fp = fopen ("/dev/ttyUSB0", "rb+");


 if (!$fp) {
     echo 'not open for read';
}
 else{
 	sleep(12);
    // echo '<br/> Puerto abierto para leer espere <br><br>';
    
     
	 $datos=fgets($fp);
	 //$datos = trim(fread($fp,1));
    // $datos= fread ($fp,20);
	  echo 'Mensaje recibido en BIN: '.$datos.'<br>';
	  $datos1=substr($datos,0,9); // substring para quitar el crc
	  echo 'datos1  = '.$datos1.'<br>';
	  //echo 'Mensaje recibido en BIN: '.$datos;
fclose ($fp);
//echo '<br> En de: ';
//echo hexdec($datos);

 }
 
 // termina parte de lectura 
 ?>
 