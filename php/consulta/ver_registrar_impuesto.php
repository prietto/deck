<?php 

$estado_factura 				= 	new estado_factura;
$obj_listbox					=	new obj_listbox;
$factura						= 	new factura;
$sis_genericos					=	new sis_genericos;
$tabla_autonoma_personalizado	=	new tabla_autonoma_personalizado;


// conserva las variables para los filtros en caso de que devuelva
$array_request_reporte			= $sis_genericos->f_genera_variables_anteriores($_REQUEST);



$codigos_factura = $reg_seleccionado;

// datos de las facturas seleccionadas
$cursor_facturas		=	$factura->f_get_cursor($reg_seleccionado);

// combo del estado de la factura
$cursor					=	$estado_factura->f_get_x_update();
$cmb_estado_factura		=	$obj_listbox->f_crear_lista($cursor, $cod_estado_factura);


//=== Evalua algun java script especifico para esta tabla >>>
$row_js_personalizado	= $tabla_autonoma_personalizado->f_get_row($cod_tabla,$cod_navegacion);
if($row_js_personalizado['txt_js'])		$js_navegacion = "../../js/".$row_js_personalizado['txt_js'];
else									$js_navegacion = "../../js/ver_default_script_tabla_autonoma.js";


?>