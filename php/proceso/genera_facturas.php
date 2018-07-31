<?php 

$parametro_sistema 	= new parametro_sistema();
$factura			= new factura();

$ind_varios_pedidos_x_factura = $parametro_sistema->f_get_row(5);

// genera cursor de los pedidos seleccionados
// manda un indicador para saber si permite la facturacion de varios pedido de un mismo cliente 
// en una sola factura
$cursor_pedidos_para_facturar	= 	$pedido->f_get_cursor_to_fact($reg_seleccionado,$ind_varios_pedidos_x_factura);

// crea codigos de factura para los pedidos segun el cursor
$factura->p_genera_facturas($cursor_pedidos_para_facturar,$cod_usuario);

$row_parametro_6 = $parametro_sistema->f_get_row(6);
if($row_parametro_6['val_parametro'] == 1){
	// calcula si el consecutivo de facturacion llego a su limite
	$ind_limite_rango = $factura->f_get_ind_limite();
}

sleep(1); // se frena un segundo para evitar probblemas

if($ind_limite_rango){
	//echo "<script type='text/javascript'>setTimeout(function(){parent.f_muestra_advertencia('El rango de facturacion ha llegado a su limite');},500);complete la linea	
	$array_request_reporte			= $sis_genericos->f_genera_variables_anteriores($_REQUEST);
	array_push($arr_mensajes,'33'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,''); 	//registra el codigo del mensaje que se debe mostrar
	$proceso			= NULL;		//no procesa nada
	$consulta			= "ver_consultar_tabla_autonoma.php"; //lo envia a la pagina anterior
	$salida				= "ver_consultar_tabla_autonoma.php"; //lo envia a la pagina anterior
}else{
	// cierra periodo de facturacion al ponerle fecha final
	//$periodo_facturacion->p_cierra_periodo();
	/*echo "<script type='text/javascript'>setTimeout(function(){parent.refresh_page();},1000);</script>";	*/
}

// cambia el valor de la variable de registros seleccionados por codigos de facturas para pasar a imprimir
$reg_seleccionado  = $pedido->f_get_cod_facturas($reg_seleccionado);



?>