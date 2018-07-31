<?php 
$atencion					=	new atencion();
$tipo_atencion				=	new tipo_atencion;
$autorizacion				=	new autorizacion;
$entidad					=	new entidad;
$factura					=	new factura;
$periodo_facturacion		=	new periodo_facturacion;



// buscar y asocia todas las autorizaciones con sus entidades
$cursor_autorizaciones 	= 	$autorizacion->f_get_all_by_entidad();

// crea codigos de factura para las atenciones de manera masiva
$factura->p_genera_factras_anldas($cursor_autorizaciones,$cod_usuario);

// calcula si el consecutivo de facturacion llego a su limite
$ind_limite_rango = $factura->f_get_ind_limite();

if($ind_limite_rango){
	// solo muestra mensaje en caso 
	array_push($arr_mensajes,'30'); 				//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,''); 		//registra el codigo del mensaje que se debe mostrar		
//	$proceso			= NULL;							//no procesa nada
//	$consulta			= "ver_consultar_tabla_autonoma.php";	//Regresa a  la pagina anterior
//	$salida				= "ver_consultar_tabla_autonoma.php";	//Regresa a  la pagina anterior
}

sleep(1); // retrasa un segundo para evitar problemas de velocidad en las consultas

// debe validar si abre un nuevo periodo de facturacion 
//$periodo_facturacion->p_update_periodo_facturacion();


// obtiene un codigo tipo atencion a partir de una cadena
//$cod_tipo_atencion=$tipo_atencion->f_get_by_string($string_tipo_atencion);

// obtiene cadena de codigos de atencion que estan asociadas a la autorizacion
//$atencion->f_get_string_atencion($cod_autorizacion,$cod_tipo_atencion);



?>