<?php 

$estado_factura 				= 	new estado_factura;
$obj_listbox					=	new obj_listbox;
$sis_genericos					=	new sis_genericos;
$tabla_autonoma_personalizado	=	new tabla_autonoma_personalizado;
$proceso_adicional_pantalla		=	new proceso_adicional_pantalla;
$periodo_facturacion			=	new periodo_facturacion;


// retorna las facturas que han sido anuladas previamente
$cusror_facturas = $factura->f_get_fact_anlads();


// combo de los periodos de facturacion 
$cursor						=	$periodo_facturacion->f_get_by_num(10);
$cmb_periodo_facturacion	=	$obj_listbox->f_crear_lista($cursor,$_REQUEST['cod_periodo_facturacion']);




//=== Evalua algun java script especifico para esta tabla >>>
$row_js_personalizado	= $tabla_autonoma_personalizado->f_get_row($cod_tabla,$cod_navegacion);
if($row_js_personalizado['txt_js'])		$js_navegacion = "../../js/".$row_js_personalizado['txt_js'];
else									$js_navegacion = "../../js/ver_default_script_tabla_autonoma.js";

//=== Evalua algun java script especifico para esta tabla >>>
//$cursor_procesos_adicionales	= $proceso_adicional_pantalla->f_get_procesos_asociados($cod_tabla, $cod_navegacion);

$cursor_procesos_adicionales	= $proceso_adicional_pantalla->f_get_procesos_asociados($cod_tabla, $cod_navegacion,0,$cod_perfil);
$cursor_procesos_por_registro	= $proceso_adicional_pantalla->f_get_procesos_asociados($cod_tabla, $cod_navegacion,1,$cod_perfil);

?>