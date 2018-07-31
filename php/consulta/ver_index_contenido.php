<?
include("../librerias/evento.php");
include("../librerias/funcion.php");
include("../librerias/sis_genericos.php");
include("../librerias/taller.php");
include("../librerias/modulo_taller.php");

$taller				= new taller;
$modulo_taller		= new modulo_taller;
$evento				= new evento;
$funcion 			= new funcion;
//=== Obtiene las fechas para las presentaciones y las guarda en forma de vector
$array_fechas			= array();
$array_agenda			= array();

$cursor_agenda	 		= $evento->f_get_orden_agenda();
$num_registros 			= $db->num_registros($cursor_agenda);
for($i=0; $i<$num_registros; $i++){
	$row_agenda		= 	$db->sacar_registro($cursor_agenda,$i);
	$cod_evento		=	$row_agenda['cod_evento'];
	$cod_taller		=	$row_agenda['cod_taller'];	

	//Evalua si va un evento con venta de boleteria >>>
	if($cod_evento){
		$array_fechas						= $funcion->f_get_fechas($cod_evento,4);		
		$array_agenda[$i]['tabla_fechas']	= $funcion->f_ordenar_fechas_home($cod_evento,$array_fechas, "texto_gris");		
		$array_agenda[$i]['row_evento']		= $evento->f_get_row_detallado($cod_evento);
		$array_agenda[$i]['row_taller']		= NULL;
	}
	//Evalua si va un taller >>>
	else if ($cod_taller){
		$array_fechas						= $modulo_taller->f_get_fechas($cod_taller,4);		
		$array_agenda[$i]['tabla_fechas']	= $modulo_taller->f_ordenar_fechas_home($cod_taller,$array_fechas, "texto_gris");		
		$array_agenda[$i]['row_evento']		= NULL;
		$array_agenda[$i]['row_taller']		= $taller->f_get_row($cod_taller);
	}
}

?>