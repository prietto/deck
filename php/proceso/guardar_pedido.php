<?php 
include_once("../librerias/tabla_autonoma.php");
include_once("../librerias/columna_tabla_autonoma.php");
include_once("../librerias/sis_genericos.php");
include_once("../librerias/obj_listbox.php");
include_once("../librerias/tabla_autonoma_personalizado.php");
include_once("../librerias/proceso_adicional_pantalla.php");
include_once("../librerias/c_file.php");
include_once("../librerias/reporte_tabla.php");
include_once("../librerias/factura.php");
include_once("../librerias/pedido.php");
include_once("../librerias/producto.php");
include_once("../librerias/cliente.php");
include_once("../librerias/resolucion_dian.php");
include_once("../librerias/parametro_x_usuario.php");
include_once('../librerias/factura_pago.php');

$cod_navegacion_formulario	= 	44; 

$tabla_autonoma					=	new tabla_autonoma;
$columna_tabla_autonoma			=	new columna_tabla_autonoma;
$tabla_autonoma_personalizado	=	new tabla_autonoma_personalizado;
$arr_info_archivo				= 	$_FILES;
$pedido 						= 	new pedido();
$producto						= 	new producto();
$cliente						= 	new cliente();
$factura						= 	new factura();
$parametro_x_usuario			= 	new parametro_x_usuario();
$factura_pago 					= 	new factura_pago();		

// === restar cantidades en la bodega de productos ===//
$producto->p_update_cantidades($_REQUEST);



$row_pedido 			= $pedido->f_get_row($cod_pk);
$cod_factura_db			= $row_pedido['cod_factura'];
$cod_estado_pedido_db	= $row_pedido['cod_estado_pedido'];

// debe averiguar si el pedido ya esta facturado y no volver a ejecutar la funcion
// si el estado del pedido es diferente a facturado
if($cod_estado_pedido_db != 4){
	//=== Guarda los datos de la tabla maestro>>>
	$columna_tabla_autonoma->p_modificar_registro(
	$cod_tabla					,
	$_REQUEST					,
	$cod_pk						,
	$cod_tabla_detalle			,
	$cod_navegacion_formulario	,
	$arr_info_archivo	
	);

	//=== Guarda los datos de la tabla Detalle>>>
	$columna_tabla_autonoma->p_guardar_detalle(
	$cod_tabla					,
	$cod_tabla_detalle			,
	$_REQUEST					,
	$cod_pk						,
	$cod_navegacion_formulario	,
	$cod_usuario				,
	$arr_info_archivo
	);
}

//=== Evalua si al guardar los datos debe ejecutar algun tipo de proceso adicional>>>
$row_autonoma_personalizado	=	$tabla_autonoma_personalizado->f_get_row($cod_tabla_detalle,$cod_navegacion);
$txt_proceso_php			=	$row_autonoma_personalizado['txt_proceso_php'];
if($txt_proceso_php)include ("../proceso/$txt_proceso_php");



$pedido->p_update_ind_restado($_REQUEST);

// metodo para modificar valores del pedido
$pedido->p_modificar_registro($_REQUEST);

$cliente->p_update_estado_cuenta($cod_cliente);

if(!$ind_funcion_facturar)$ind_funcion_facturar = '0';
// guarda el parametro x usuario para la facturacion automatica
$parametro_x_usuario->p_modificar_parametro($cod_usuario,9,$ind_funcion_facturar);



// si llego el indicador para facturar el pedido
if($ind_facturar_pedido == 1){
	
	$arr_pedido[0] = $cod_pk;
	$cursor_pedidos_para_facturar	= 	$pedido->f_get_cursor_to_fact($arr_pedido);
	
	// crea codigos de factura para los pedidos segun el cursor
	$num_pedidos = $db->num_registros($cursor_pedidos_para_facturar);

	if($num_pedidos > 0){
		$factura->p_genera_facturas($cursor_pedidos_para_facturar,$cod_usuario);
	}
	
	// debe guardar en la tabla de pagos factura el valor recibido en el momento
	if($val_recibido && $val_recibido > 0){
		$factura_pago->f_guarda_val_recibido_pedido($cod_pk,$val_recibido);
	}
}

//echo $txt_proceso_php;

$ind_limpiar_variables	= 1;
//$ind_conservar_pk		= 1;
$ind_buscar				= 1;


?>