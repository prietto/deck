<?
include("../librerias/tabla_autonoma.php");
include("../librerias/columna_tabla_autonoma.php");
include("../librerias/sis_genericos.php");
include("../librerias/obj_listbox.php");
include("../librerias/tabla_autonoma_personalizado.php");
include("../librerias/proceso_adicional_pantalla.php");
include("../librerias/c_file.php");
include("../librerias/reporte_tabla.php");
include_once("../librerias/cliente.php");
include_once("../librerias/factura.php");


$cod_navegacion_formulario	= 	44; 
$seg_permiso_tabla_autonoma	=	new seg_permiso_tabla_autonoma;
$columna_tabla_autonoma		=	new columna_tabla_autonoma;
$cliente					= 	new cliente();
$factura					= 	new factura();




// permisos del usuario sobre los modulos a los que puede ingresar
$cursor_permisos_template = $seg_permiso_tabla_autonoma->f_get_permisos_modulos($cod_perfil);

if($ind_new_row)	
	$ind_tiene_permiso = $seg_permiso_tabla_autonoma->f_get_permiso_insert_tabla($cod_tabla,$cod_perfil);
else
	$ind_tiene_permiso = $seg_permiso_tabla_autonoma->f_get_permiso_update_tabla($cod_tabla,$cod_perfil);

if(!$row_usuario){
	array_push($arr_mensajes,'3'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,''); 	//registra el codigo del mensaje que se debe mostrar
	if(!$ind_navegacion_ajax){
		$proceso				= NULL;		//no procesa nada
		$consulta				= "ver_registrar_maestro_detalle_autonomo.php";	//Regresa a  la pagina anterior
		$salida					= "ver_registrar_maestro_detalle_autonomo.php";	 //Regresa a  la pagina anterior
	}else if($ind_navegacion_ajax == 1){
		$proceso				= NULL;		//no procesa nada
		$consulta				= NULL;	//Regresa a  la pagina anterior
		$salida					= NULL;	 //Regresa a  la pagina anterior
	}
}else if(!$ind_tiene_permiso){
	array_push($arr_mensajes,'3'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,''); 	//registra el codigo del mensaje que se debe mostrar
	if(!$ind_navegacion_ajax){
		$proceso				= NULL;		//no procesa nada
		$consulta				= "ver_registrar_maestro_detalle_autonomo.php";	//Regresa a  la pagina anterior
		$salida					= "ver_registrar_maestro_detalle_autonomo.php";	 //Regresa a  la pagina anterior
	}else if($ind_navegacion_ajax == 1){
		$proceso				= NULL;		//no procesa nada
		$consulta				= NULL;	//Regresa a  la pagina anterior
		$salida					= NULL;	 //Regresa a  la pagina anterior
	}
}else{
	//=== Valida los datos de la tabla primaria >>>		
	$array_retorno			= 	$columna_tabla_autonoma->f_valida_tabla(
								$cod_tabla			,
								$cod_tabla_detalle	,
								$_POST				,
								$cod_pk				,
								$arr_mensajes		,
								$arr_parametro		,
								$cod_navegacion_formulario
								);
	$arr_mensajes			=	$array_retorno['arr_mensajes'];
	$arr_parametro			=	$array_retorno['arr_parametro'];
	//=== Valida los datos de la tabla detalle >>>		

	$array_retorno			= 	$columna_tabla_autonoma->f_valida_tabla_detalle(
								$cod_navegacion_formulario	,
								$cod_tabla_detalle			,
								$_POST						,
								$arr_mensajes				,
								$arr_parametro		
								);
	$arr_mensajes			=	$array_retorno['arr_mensajes'];
	$arr_parametro			=	$array_retorno['arr_parametro'];

	//=== En caso de error indica a que pantalla debe regresar>>>		
	if ($arr_mensajes[0] ){
		if(!$ind_navegacion_ajax){
			$proceso				= NULL;		//no procesa nada
			$consulta				= "ver_registrar_maestro_detalle_autonomo.php";	//Regresa a  la pagina anterior
			$salida					= "ver_registrar_maestro_detalle_autonomo.php";	 //Regresa a  la pagina anterior
		}else if($ind_navegacion_ajax == 1){
			$proceso				= NULL;		//no procesa nada
			$consulta				= NULL;	//Regresa a  la pagina anterior
			$salida					= NULL;	 //Regresa a  la pagina anterior
		}
	}
}


// debe validar si el pedido es de contado y de serlo 
if($cod_forma_pago == 1){
	if((!$val_pagado || $val_pagado == 0) || $val_pagado != $val_real){
		array_push($arr_mensajes,'42'); 	//registra el codigo del mensaje que se debe mostrar
		array_push($arr_parametro,'El pedido es de contado, el valor pagado debe ser igual al valor total'); 	
		if(!$ind_navegacion_ajax){
			$proceso				= NULL;		//no procesa nada
			$consulta				= "ver_registrar_maestro_detalle_autonomo.php";	//Regresa a  la pagina anterior
			$salida					= "ver_registrar_maestro_detalle_autonomo.php";	 //Regresa a  la pagina anterior
		}else if($ind_navegacion_ajax == 1){
			$proceso				= NULL;		//no procesa nada
			$consulta				= NULL;	//Regresa a  la pagina anterior
			$salida					= NULL;	 //Regresa a  la pagina anterior
		}
	}
} 


// debe validar que haya ingresado productos
if(count($cod_insumo) == 0){
	array_push($arr_mensajes,'42'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,'Debe ingresar al menos un insumo'); 	
	if(!$ind_navegacion_ajax){
			$proceso				= NULL;		//no procesa nada
			$consulta				= "ver_registrar_maestro_detalle_autonomo.php";	//Regresa a  la pagina anterior
			$salida					= "ver_registrar_maestro_detalle_autonomo.php";	 //Regresa a  la pagina anterior
	}else if($ind_navegacion_ajax == 1){
			$proceso				= NULL;		//no procesa nada
			$consulta				= NULL;	//Regresa a  la pagina anterior
			$salida					= NULL;	 //Regresa a  la pagina anterior
	}
}

?>