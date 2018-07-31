<?php

require_once('../librerias/parametro_sistema.php');
require_once('../librerias/estado_factura.php');
require_once('../librerias/estado_pedido.php');
require_once('../librerias/seg_permiso_tabla_autonoma.php');
require_once('../librerias/tipo_operacion_parametro.php');
require_once('../librerias/obj_listbox.php');
require_once('../librerias/sis_genericos.php');
require_once('../librerias/seg_empresa.php');
require_once('../librerias/tipo_identificacion.php');
require_once('../librerias/ciudad.php');
require_once('../librerias/booleano.php');




$parametro_sistema 				= new parametro_sistema(); 
$estado_factura					= new estado_factura();
$estado_pedido					= new estado_pedido();
$seg_permiso_tabla_autonoma 	= new seg_permiso_tabla_autonoma();
$tipo_operacion_parametro		= new tipo_operacion_parametro();
$obj_listbox					= new obj_listbox();
$sis_genericos					= new sis_genericos();
$seg_empresa					= new seg_empresa();
$tipo_identificacion 			= new tipo_identificacion();
$ciudad 						= new ciudad();
$booleano 						= new booleano();


//retornar cusror con los registros de la tabla parametros y que sean visibles para el usuario
$cursor_parametros = $parametro_sistema->f_get_visibles();

// retorna todos los registros activos de la tabla estado_factura
$cursor_estado_factura = $estado_factura->f_get_all();


// RETORNA TODOS LOS REGISTROS ACTIVOS DE LA TABLA ESTADO PEDIDO
$cursor_estado_pedido	= $estado_pedido->f_get_all();



//=== Valida si puede mostrar el boton de guardar la modificacion de un registro>>>
$ind_mostrar_boton_guardar		= false;


$ind_mostrar_boton_guardar	= 	$seg_permiso_tabla_autonoma->f_get_permiso_update_tabla($cod_tabla,$cod_perfil);

//=== Valida debe mostrar el boton de eliminar un registro>>>
$ind_mostrar_boton_eliminar = 	$seg_permiso_tabla_autonoma->f_get_permiso_delete_tabla($cod_tabla,$cod_perfil);



// === INPUTS INFORMACION DE EMPRESA === //

// == primero debe validar que exista una empresa registrada
$cod_empresa = $seg_empresa->f_get_cod_empresa();

if($cod_empresa || 1==1){
	$seg_empresa->cod_empresa = $cod_empresa;

	// == INFO DE LA EMPRESA == //
	$row_empresa = $seg_empresa->f_get_row();
	
	$txt_razon_social			= $row_empresa['txt_razon_social'];
	$txt_nombre_comercial		= $row_empresa['txt_nombre_comercial'];
	$cod_tipo_identificacion 	= $row_empresa['cod_tipo_identificacion'];
	$num_identificacion			= $row_empresa['num_identificacion'];
	$txt_direccion				= $row_empresa['txt_direccion'];
	$txt_telefono				= $row_empresa['txt_telefono'];
	$ind_genera_iva				= $row_empresa['ind_iva'];
	$val_porcentaje_iva			= $row_empresa['val_porcentaje_iva'];
	$txt_url_logo				= $row_empresa['txt_url_logo'] == NULL ? NULL : '<img style="max-width:250px; max-height:250px;" src="'.$row_empresa['txt_url_logo'].'" />';
	$cod_ciudad					= $row_empresa['cod_ciudad'];
	$cod_ciiu					= $row_empresa['cod_ciiu'];
	$fec_fundacion				= $row_empresa['fec_fundacion'];
	



	// == cursor tipo identificacion empresa == //
	$cursor_tipo_identificacion = $tipo_identificacion->f_get_all_activos();

	//== cursor para la ciudad == //
	$cursor_ciudad				= $ciudad->f_get_all_activos();


	// == cursor para ind genera iva == //
	$cursor_booleano			= $booleano->f_get_all();


	$cmb_tipo_identificacion	= $obj_listbox->f_crear_lista($cursor_tipo_identificacion, $cod_tipo_identificacion);
	$cbm_ajax_ciiu 				= $obj_listbox->f_crear_buscador_ajax('cod_ciiu',341,$cod_ciiu,'50%');
	$cmb_ajax_ciudad			= $obj_listbox->f_crear_buscador_ajax('cod_ciudad',344,$cod_ciudad,'50%');
	$cmb_genera_iva				= $obj_listbox->f_crear_lista($cursor_booleano, $ind_genera_iva);

	


}
?>