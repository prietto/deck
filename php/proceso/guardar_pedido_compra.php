<?php 

include_once("../librerias/tabla_autonoma.php");
include_once("../librerias/columna_tabla_autonoma.php");
include_once("../librerias/sis_genericos.php");
include_once("../librerias/obj_listbox.php");
include_once("../librerias/tabla_autonoma_personalizado.php");
include_once("../librerias/proceso_adicional_pantalla.php");
include_once("../librerias/c_file.php");
include_once("../librerias/reporte_tabla.php");
include_once("../librerias/pedido_compra.php");
include_once("../librerias/insumo.php");
include_once("../librerias/proveedor.php");
include_once("../librerias/parametro_x_usuario.php");
include_once("../librerias/entrada_insumo.php");


$cod_navegacion_formulario	= 	44; 

$tabla_autonoma					=	new tabla_autonoma;
$columna_tabla_autonoma			=	new columna_tabla_autonoma;
$tabla_autonoma_personalizado	=	new tabla_autonoma_personalizado;
$arr_info_archivo				= 	$_FILES;
$pedido_compra 					= 	new pedido_compra();
$insumo							= 	new insumo();
$proveedor						= 	new proveedor();
$parametro_x_usuario			= 	new parametro_x_usuario();
$entrada_insumo 				= 	new entrada_insumo();




// === restar cantidades en la bodega de productos ===//
//$producto->p_update_cantidades($_REQUEST);



$row_pedido 			= $pedido_compra->f_get_row($cod_pk);
$cod_estado_pedido_db	= $row_pedido['cod_estado_pedido_compra'];


// debe averiguar si el pedido compra ha sido solamente registrado
// si el estado del pedido es igual a registrado permite la modificacion
if($cod_estado_pedido_db == 1){
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


// se debe validar que el pedido_compra no tenga entradas generadas para evitar incongruencia de datos
$num_entradas = $pedido_compra->f_get_count_entrada($cod_pk);
	
// DEBE CAPTURARSE EL INDICADOR DE ENTRADA DE INSUMO A BODEGA
if(!$ind_entrada_insumo)$ind_entrada_insumo = '0';

// debe dar entrada a bodega y aumentar el stockç
if($ind_entrada_insumo==1 && $cod_estado_pedido_compra == 1 && $num_entradas == 0){

	// debe modificar el estado del pedido a "INGRESADO"
	// 2 => "INGRESADO"
	$pedido_compra->p_update_estado($cod_pk,2);

	// debe registrar la entrada en la tabla "entrada_insumo"
	$result_entrada = $entrada_insumo->p_guardar_registro($_REQUEST);
}


$ind_limpiar_variables	= 1;
//$ind_conservar_pk		= 1;
$ind_buscar				= 1;

?>