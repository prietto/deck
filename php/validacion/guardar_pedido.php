<?
//sleep(1);
/*echo "hola mundo";
exit;*/
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

//print_r($_REQUEST);

// debe modificar la cookie para la funcion de facturacion automatica
setcookie('ind_facturar_automatico',$ind_funcion_facturar);

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


// debe validar si el pedido es de contador y de serlo 
if($cod_forma_pago == 1){
	if((!$val_recibido || $val_recibido == 0) || $val_recibido != $val_real){
		array_push($arr_mensajes,'42'); 	//registra el codigo del mensaje que se debe mostrar
		array_push($arr_parametro,'El pedido es de contado, el valor recibido debe ser igual al valor total'); 	
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

// debe validar si el cliente puede tener credito
if($cod_forma_pago != 1){ // si es diferente a contado
	$row_cliente = $cliente->f_get_row($cod_cliente);
	$ind_permite_credito = $row_cliente['ind_credito'];
	
	if($ind_permite_credito == 0){
		array_push($arr_mensajes,'42'); 	//registra el codigo del mensaje que se debe mostrar
		array_push($arr_parametro,'El cliente no tiene permitido Credito, solamente de CONTADO'); 	
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
if(count($cod_producto) == 0){
	array_push($arr_mensajes,'42'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,'El pedido no tiene productos, debe ingresar al menos un producto'); 	
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



// si no hay mensajes de error devuelve el numero de factura siguiente
// si la forma de pago no es a contado
if(count($arr_mensajes)==0 && $cod_formato_pago != 1 && $ind_no_factura == NULL){
	$cod_pk_factura = $factura->f_get_next_pk();
	$arr_retorno['cod_pk_factura'] = $cod_pk_factura;
	echo json_encode($arr_retorno);
}




?>