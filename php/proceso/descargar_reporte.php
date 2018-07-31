<?php
include("../librerias/tabla_autonoma.php");
include("../librerias/columna_tabla_autonoma.php");
include("../librerias/sis_genericos.php");
include("../librerias/obj_listbox.php");
include("../librerias/tabla_autonoma_personalizado.php");
include("../librerias/proceso_adicional_pantalla.php");
include("../librerias/reporte_tabla.php");
include("../librerias/control_archivos.php");
include("../librerias/periodo_facturacion.php");
include("../librerias/entidad.php");



//=== Instancias de las librerias creadas en la validacion >>>
$tabla_autonoma 				= new tabla_autonoma;
$columna_tabla_autonoma 		= new columna_tabla_autonoma;
$sis_genericos					= new sis_genericos;
$obj_listbox					= new obj_listbox;
$tabla_autonoma_personalizado	= new tabla_autonoma_personalizado;
$proceso_adicional_pantalla		= new proceso_adicional_pantalla;
$reporte_tabla					= new reporte_tabla;
$control_archivos				= new control_archivos;
$periodo_facturacion			= new periodo_facturacion;
$entidad						= new entidad;

$cod_ntdad_pk 	= $_REQUEST['cod_entidad_pk'];

$row_entidad 	= $entidad->f_get_row($cod_ntdad_pk);
$txt_entidad	= $row_entidad['txt_nombre'];

$row_reporte 	= $reporte_tabla->f_get_row($_REQUEST['cod_pk_reporte']);
$txt_nombre_archivo = $row_reporte['txt_nombre'];
$txt_nombre_archivo = "$txt_nombre_archivo $txt_entidad";
$txt_nombre_archivo	= $sis_genericos->f_formato_texto($txt_nombre_archivo,'mayuscula');


$num_entidades 	= count($_REQUEST['cod_entidad_multiple']);
$cod_reporte_pk = $_REQUEST['cod_pk_reporte'];



if($num_entidades > 1){
	
	if($cod_reporte_pk != 18 && $cod_reporte_pk != 17){
		echo "<script type='text/javascript'>setTimeout(function(){parent.f_muestra_mensaje('Este reporte no permite multiples entidades');},1000);</script>";
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
//$control_archivos->p_guardar_registro($txt_nombre_archivo,$num_registros,$_REQUEST);


?>