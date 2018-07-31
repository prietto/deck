<?php 
include('../librerias/pedido.php');
$pedido = new pedido();


//exec('net use LPT1 \\USER\printer /persistent:yes');



//exec('START c:/Appserv/www/scistem/php/principal/imprime.bat');
//exec('c:\WINDOWS\system32\cmd.exe');
//exec("c:/Appserv/www/scistem/php/principal/imprime.bat", $res);

//exec("print /d:LPT2: C:\filename.txt")




/*$html = "<h1>Test de Impresión de Tickets</h1>";
$html .= "Aquí todo el contenido del Ticket";
$printer="HP Deskjet D1600 series";
$enlace=printer_open();
printer_write($enlace, $html);
printer_close();*/


  /* $handle = fopen("LPT1", "w");
    fwrite($handle,chr(27). chr(64));
    fwrite($handle, chr(27). chr(97). chr(1));//centrado
    fwrite($handle,"Cuando uno saca el fuaa\n\nEse es el verdadero FUAAA\n\n\n\n");
    fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
    fwrite($handle, chr(27). chr(97). chr(0)); //izquierda
    fwrite($handle, "texto");
    fclose($handle); // cierra el fichero LPT1
    $salida = shell_exec('lpr LPT1'); //lpr->puerto impresora, imprimir archivo LPT1*/



//exec('use net LPT1: \\USER\HP Deskjet D1600 series/persistent:yes 2>&1');




//sleep(4);

/*$handle = fopen("LPT1", "w");
    fwrite($handle,chr(27). chr(64));
    fwrite($handle, chr(27). chr(97). chr(1));//centrado
    fwrite($handle,"Cuando uno saca el fuaa\n\nEse es el verdadero FUAAA\n\n\n\n");
    fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
    fwrite($handle, chr(27). chr(97). chr(0)); //izquierda
    fwrite($handle, "texto");
    fclose($handle); // cierra el fichero LPT1
    $salida = shell_exec('lpr LPT1'); //lpr->puerto impresora, imprimir archivo LPT1
*/


for($i=0;$i<count($reg_seleccionado);$i++){
	
	$cod_pedido = $reg_seleccionado[$i];
	$row_pedido = $pedido->f_get_row($cod_pedido);
	
	$val_total	=	$row_pedido['val_total'];
	
	$handle 	= @fopen("LPT1", "w");
	
	if($handle === FALSE){
		die('No se puedo Imprimir, Verifique su conexion con la IMPRESORA');
		//return false;
    }
	
	//if($handle = @fopen("/dev/usb/usb3", "w") === FALSE){
      //  die('ERROR:\nNo se puedo Imprimir, Verifique la conexion de la IMPRESORA');
    //}

	
	
	fwrite($handle,chr(27). chr(64));//reinicio
	
	//fwrite($handle, chr(27). chr(112). chr(48));//ABRIR EL CAJON
	fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
	fwrite($handle, chr(27). chr(33). chr(8));//negrita
	fwrite($handle, chr(27). chr(97). chr(1));//centrado
	fwrite($handle,"=================================");
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle, chr(27). chr(32). chr(3));//ESPACIO ENTRE LETRAS
	fwrite($handle,"JENNY BRAVO BOLAÑOZ");
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle,"C.C. 1.144.141.006 REGIMEN SIMPLIFICADO");
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle,"Venta de toda clase de papa por mayor y detal");
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle,"CAVASA Bodega 8 local 19 y 20");
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle,"Tel: 448 40 11");
	fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
	fwrite($handle, chr(27). chr(33). chr(8));//negrita
	fwrite($handle, chr(27). chr(97). chr(1));//centrado
	fwrite($handle,"___________________________________");
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle,"Descripcion		 Val. U. 	Val. ");
	fwrite($handle, chr(27). chr(32). chr(0));//ESTACIO ENTRE LETRAS
	fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
	fwrite($handle, chr(27). chr(33). chr(8));//negrita
	fwrite($handle, chr(27). chr(100). chr(0));//salto de linea VACIO
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	//fwrite($handle,"Nacimos de Nuevo para ser grandes");
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle,"=================================");
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
	fwrite($handle,"TOTAL OPERACION ".$val_total);
	
	
	fclose($handle); // cierra el fichero PRN
	//shell_exec('lpr '.$cod.' 2>&1');
	$salida = shell_exec('lpr LPT1'); //lpr->puerto impresora, imprimir archivo PRN
	
}

?>