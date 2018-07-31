<?php
$factura					=	new factura;
$facturas_anuladas			=	new facturas_anuladas;
$autorizacion				=	new autorizacion;
$detalle_nombre_archivos	=   new detalle_nombre_archivos;

//cambia el estado masivo  a las facturas seleccionadas
$factura->p_update_estado($reg_seleccionado,$cod_estado_factura);

if($cod_estado_factura == 8){
	// guarda en la tabla facturas anuladas las facturas anuladas relacionando las atenciones que tenia
	$facturas_anuladas->p_guarda_registro($reg_seleccionado,$_REQUEST);

	// desvincular atenciones de las facturas
	$factura->p_desvincular_atncn($reg_seleccionado,$_REQUEST);
	
	//desvincula codigo de archivo 
	$factura->p_desvincula_archivo($reg_seleccionado);
	
	// desvincula la factura de las autorizaciones pertinentes
	$autorizacion->p_desvincula_factura($reg_seleccionado);
	
	// desvincula la factura del detalle de los archivos
	$detalle_nombre_archivos->p_desvincula_factura($reg_seleccionado);
	
	
}


?>