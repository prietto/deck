<?php
include("../librerias/tabla_autonoma.php");
include("../librerias/columna_tabla_autonoma.php");
include("../librerias/sis_genericos.php");
include("../librerias/tabla_autonoma_personalizado.php");
include("../librerias/proceso_adicional_pantalla.php");
include("../librerias/reporte_tabla.php");
include("../librerias/control_archivos.php");
include("../librerias/periodo_facturacion.php");
include("../librerias/separador_txt.php");
include("../librerias/periodo_x_entidad.php");
include("../librerias/detalle_nombre_archivos.php");
include("../librerias/nombre_archivos.php");

//=== Instancias de las librerias creadas en la validacion >>>
$tabla_autonoma 				= new tabla_autonoma;
$columna_tabla_autonoma 		= new columna_tabla_autonoma;
$sis_genericos					= new sis_genericos;
$tabla_autonoma_personalizado	= new tabla_autonoma_personalizado;
$proceso_adicional_pantalla		= new proceso_adicional_pantalla;
$reporte_tabla					= new reporte_tabla;
$control_archivos				= new control_archivos;
$periodo_facturacion			= new periodo_facturacion;
$separador_txt					= new separador_txt;
$detalle_nombre_archivos		= new detalle_nombre_archivos;

$row_reporte = $reporte_tabla->f_get_row($_REQUEST['cod_pk_reporte']);
$txt_nombre_archivo = $row_reporte['txt_nombre'];


$num_entidades 			= count($_REQUEST['cod_entidad_multiple']);
$cod_reporte_pk 		= $_REQUEST['cod_pk_reporte'];
$arr_cod_archivo 		= $_REQUEST['cod_archivo'];



if(count($arr_cod_archivo) == 1 && $arr_cod_archivo[0] == -1){
	echo "<script type='text/javascript'>setTimeout(function(){parent.f_muestra_mensaje('No puede continuar, seleccione el archivo');},500);</script>";
	exit;
}

if($num_entidades > 1){
	if($cod_reporte_pk != 18 && $cod_reporte_pk != 17){
		echo "<script type='text/javascript'>setTimeout(function(){parent.f_muestra_mensaje('Este reporte no permite multiples entidades');},500);</script>";
	exit;
	}
}


// cursor de resultado del script de consulta que trae desde la tabla reporte tabla
$resultado_cursor	= 	$columna_tabla_autonoma->f_consultar_reportes(
						$cod_tabla			,
						$_REQUEST			,
						$ord_por			,
						$num_max_registros	,
						$num_pagina			
						);
	
$num_registros		= 	$resultado_cursor['NUM_REGISTROS'];

if($num_registros == 0){
	echo "<script type='text/javascript'>setTimeout(function(){parent.f_muestra_mensaje('No se encontraron registros \\n Seleccione otras condiciones para generar el(los) reporte(s)');},1000);</script>";
	exit;
}

sleep(2); // Se detiene 2 segundos 

// se debe guardar en la tabla control archivos apra llevar un historial 
$nom_archivo_plano = $control_archivos->p_guardar_registro($txt_nombre_archivo,$num_registros,$_REQUEST);

// valida si el usuario escogio el separador del archivo plano que por defecto sera punto y coma
$row_separador 	= $separador_txt->f_get_row($_REQUEST['cod_separador']);
$txt_separador 	= $row_separador['txt_caracter'];

?>