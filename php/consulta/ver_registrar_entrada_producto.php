<?php
include_once("../librerias/entrada_producto.php");

//=== Instancias de las librerias creadas en la validacion >>>
$tabla_autonoma 				= new tabla_autonoma;
$columna_tabla_autonoma 		= new columna_tabla_autonoma;
$sis_genericos					= new sis_genericos;
$obj_listbox					= new obj_listbox();
$tabla_autonoma_personalizado	= new tabla_autonoma_personalizado();
$entrada_producto				= new entrada_producto();

$ind_registro = true;

// si existe el registro seleccionado y ya no es un vector lo vuelve vector
if($reg_seleccionado && !is_array($reg_seleccionado)){
	$reg_seleccionado = array('0'=>$reg_seleccionado);
}


// conserva las variables para los filtros en caso de que devuelva
$array_request_reporte			= $sis_genericos->f_genera_variables_anteriores($_REQUEST);


//=== Obtiene informacion detallada de la tabla >>>
$row_tabla_autonoma		= $tabla_autonoma->f_get_row($cod_tabla);

//=== Obtiene la llave primaria >>>
if(!$cod_pk){			
	$cod_pk			=	$tabla_autonoma->p_get_next_pk($cod_usuario,$row_tabla_autonoma);
	$ind_new_row	=	1;
}else {			
	//=== Esto es para casos donde se trabaja tablas uno a uno donde la llave primaria viene desde otra pagina
	$cod_pk			=	$tabla_autonoma->p_verificar_nuevo_pk($cod_pk, $cod_usuario,$row_tabla_autonoma);
}

//=== Obtiene los imputs de la consulta >>>
$row_imputs				=$columna_tabla_autonoma->f_get_imput($cod_tabla,$ind_registro);

//=== Obtiene los valores por defecto, antes de dar click en guardar >>>
if(!$ind_guardar_datos_tabla_autonoma){
	$row_imputs			=$columna_tabla_autonoma->f_get_valor_imput($cod_pk, $row_tabla_autonoma,$row_imputs);
}else{
	// valores obtenidos al refrescar pantalla >>>
	$row_imputs			=$columna_tabla_autonoma->f_replazar_valor_imput($row_tabla_autonoma,$row_imputs, $_REQUEST); 
}


$num_columnas			=count($row_imputs);
$alias_tabla_autonoma	= strtoupper($row_tabla_autonoma['txt_alias']);
$alias_tabla_autonoma	= str_replace("_"," ",$alias_tabla_autonoma);


//=== campos del formulario ==>>>
$fields_box = $columna_tabla_autonoma->set_fields_box(2,$row_imputs);

//=== Valida si puede mostrar el boton de guardar la modificacion de un registro>>>
$ind_mostrar_boton_guardar		= false;
if($ind_new_row)
	$ind_mostrar_boton_guardar	= 	$seg_permiso_tabla_autonoma->f_get_permiso_insert_tabla($cod_tabla,$cod_perfil);
else
	$ind_mostrar_boton_guardar	= 	$seg_permiso_tabla_autonoma->f_get_permiso_update_tabla($cod_tabla,$cod_perfil);

//=== Valida debe mostrar el boton de eliminar un registro>>>
$ind_mostrar_boton_eliminar = 	$seg_permiso_tabla_autonoma->f_get_permiso_delete_tabla($cod_tabla,$cod_perfil);

//=== Evalua algun java script especifico para esta tabla >>>

$row_js_personalizado	= $tabla_autonoma_personalizado->f_get_row($cod_tabla,$cod_navegacion);
if($row_js_personalizado['txt_js'])		$js_navegacion 	= "<script src='../../js/".$row_js_personalizado['txt_js']."'></script>";
else									$js_navegacion 	= "<script src='../../js/ver_default_script_maestro_detalle.js'></script>";


// ==== consulta todas las entradas que ha tenido el producto
$cursor_ntrdas_prdcto = $entrada_producto->f_get_x_producto($reg_seleccionado[0],10);

?>