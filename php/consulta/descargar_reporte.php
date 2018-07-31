<?php
header('Content-type: text/html; charset=utf-8');
header("Content-type: application/vnd.ms-excel"); 
//header("Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document"); 
header("Content-Disposition: attachment; filename=$txt_nombre_archivo.csv");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Description: File Transfer"); 


$cursor_excel	= $resultado_cursor['DATOS'];

// === Imprime TITULOS >>>
$numero_columnas = $db->num_columnas($cursor_excel);
$array_nombres	=	array();
$array_datos 	= 	array();
for($i=0;$i<$numero_columnas;$i++) {
	$nom_columna = $db->nom_columna($cursor_excel,$i);
	$nom_columna	= ucfirst(strtolower($nom_columna));
	array_push($array_nombres,$nom_columna);
}
$nom_columna 	= implode(";",$array_nombres);
$nom_columna 	= str_replace('_',' ',$nom_columna);
$nom_columna 	= str_replace('yio','y/o',$nom_columna);
echo $nom_columna;


// === Imprime DETALLES >>>
while($row = $db->sacar_registro($cursor_excel) ) {
	for($i=0;$i<$numero_columnas;$i++) {
		$dato = $row[$i];
		
		//$ind_fec = $sis_genericos->is_date($dato);
		//if($ind_fec){$dato = date('d/m/Y', strtotime($dato));}

		array_push($array_datos,$dato);
	}


	$reg 	= implode("--,--",$array_datos);
	$reg 	= str_ireplace(";",",",$reg);
	$reg 	= str_ireplace("--,--",";",$reg);
	$reg 	= str_ireplace("\n","",$reg);
	$reg 	= str_ireplace("\r","",$reg);	
	$reg 	= str_ireplace("<br>","",$reg);		
//	$reg 	= str_ireplace(";","-",$reg);			
	echo 	 "\r$reg";		
	$array_datos = array();
}

/*	$f = fopen("reporte_excel3.csv","w");
	$sep = ";"; //separador

	while($reg = @mysql_fetch_array($datos_excel) ) {
		$reg = implode(";",$reg);
		$linea = "$reg\n\r";		
//		$linea = $reg['cod_cita_medica'].$sep.$reg['cod_paciente'].$sep.$reg['txt_paciente']."\n"; 
		fwrite($f,$linea);
	}
	fclose($f);*/


?>