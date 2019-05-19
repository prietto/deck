<? 
include_once('../librerias/factura.php');
include_once('../librerias/pedido.php');
include_once('../librerias/pedido_detalle.php');
include_once('../librerias/cliente.php');
include_once('../librerias/factura_pago.php');
include_once('../librerias/tabla_autonoma.php');


$factura 		= new factura();
$pedido			= new pedido();
$pedido_detalle	= new pedido_detalle();
$sis_genericos	= new sis_genericos();
$cliente		= new cliente();
$factura_pago	= new factura_pago();
$tabla_autonoma = new tabla_autonoma();

$cod_factura = $cod_pk;


// ENCABEZADO DE LA FACTURA
$row_factura				= $factura->f_get_row_detallado($cod_factura);
$txt_cliente 				= $row_factura['txt_cliente']; 
$cod_cliente				= $row_factura['cod_cliente']; 
$num_identificacion			= $row_factura['num_identificacion']; 
$txt_estado_factura			= $row_factura['txt_estado_factura']; 
$txt_usuario				= $row_factura['txt_usuario']; 
$txt_usuario_modificacion	= $row_factura['txt_usuario_modificacion']; 
$fec_creacion				= $row_factura['fec_registro']; 
$fec_modificacion			= $row_factura['fec_modificacion']; 
$fec_fec_vencimiento		= $row_factura['fec_vencimiento']; 
$txt_forma_pago				= $row_factura['txt_forma_pago']; 
$val_saldo_fact				= $row_factura['val_saldo']; 
if(!$val_saldo_fact)$val_saldo_fact = 0;


// consulta los valores de la factura
$row_valores		= $factura->f_get_info_valores($cod_factura);
$val_saldo_fact		= $row_valores['val_saldo']; 
if(!$val_saldo_fact)$val_saldo_fact = 0;

// -----------------------------------------
// INFORMACION DEL CLIENTE
// -----------------------------------------
$row_cliente				= $cliente->f_get_row_detallado($cod_cliente);
$txt_cliente 				= $row_cliente['txt_nombre']." ".$row_cliente['txt_apellido'];
$txt_tipo_identificacion 	=  $row_cliente['txt_tipo_identificacion'];
$num_identificacion			=  $row_cliente['num_identificacion'];


// CURSOR DEL HISTORIAL DE PAGOS DE UNA FACTURA A CREDITO
$cursor_pagos_factura = $factura_pago->f_get_by_factura($cod_factura);



// CURSOR DEL DETALLE DEL PEDIDO
$cursor_pedido_detalle = $pedido_detalle->f_get_by_factura($cod_factura);


// conserva las variables para los filtros en caso de que devuelva
$array_request_reporte			= $sis_genericos->f_genera_variables_anteriores_v2($_REQUEST);


//=== Obtiene informacion detallada de la tabla >>>
$row_tabla_autonoma		= $tabla_autonoma->f_get_row($cod_tabla);


$alias_tabla_autonoma	= strtoupper($row_tabla_autonoma['txt_alias']);
$alias_tabla_autonoma	= str_replace("_"," ",$alias_tabla_autonoma);


//=== Valida si puede mostrar el boton de guardar la modificacion de un registro>>>
$ind_mostrar_boton_guardar		= false;
if($ind_new_row)
	$ind_mostrar_boton_guardar	= 	$seg_permiso_tabla_autonoma->f_get_permiso_insert_tabla($cod_tabla,$cod_perfil);
else
	$ind_mostrar_boton_guardar	= 	$seg_permiso_tabla_autonoma->f_get_permiso_update_tabla($cod_tabla,$cod_perfil);

//=== Valida debe mostrar el boton de eliminar un registro>>>
$ind_mostrar_boton_eliminar = 	$seg_permiso_tabla_autonoma->f_get_permiso_delete_tabla($cod_tabla,$cod_perfil);


?>