<?php 
include("../librerias/tabla_autonoma.php");

include("../librerias/columna_tabla_autonoma.php");
include("../librerias/sis_genericos.php");
include("../librerias/obj_listbox.php");
include("../librerias/tabla_autonoma_personalizado.php");
include("../librerias/proceso_adicional_pantalla.php");
include("../librerias/reporte_tabla.php");


include("../librerias/pedido.php");
$pedido						= new pedido();


if(!$row_usuario){
	array_push($arr_mensajes,'3'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,''); 	//registra el codigo del mensaje que se debe mostrar
	$proceso			= NULL;		//no procesa nada
	$consulta			= NULL; //lo envia a la pagina anterior
	$salida				= "ver_validar_usuario.php"; //lo envia a la pagina anterior
}

if(!$reg_seleccionado){
	array_push($arr_mensajes,'16'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,''); 	//registra el codigo del mensaje que se debe mostrar
	$proceso			= NULL;		//no procesa nada
	$consulta			= "ver_cambiar_estado_factura.php"; //lo envia a la pagina anterior
	$salida				= "ver_cambiar_estado_factura.php"; //lo envia a la pagina anterior
}



// DEBE VALIDAR SI EN EL RANGO SELECCIONADO HAY PEDIDOS EN ESTADO ANULADO O PAGADOS
$ind_error_40 = $pedido->f_get_valida_estado($reg_seleccionado,3);
if($ind_error_40){
	array_push($arr_mensajes,'40'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,''); 	//registra el codigo del mensaje que se debe mostrar
	$proceso			= NULL;		//no procesa nada
	$consulta			= "ver_consultar_maestro_detalle.php"; //lo envia a la pagina anterior
	$salida				= "ver_consultar_maestro_detalle.php"; //lo envia a la pagina anterior
}

$ind_error_41 = $pedido->f_get_valida_estado($reg_seleccionado,2);
if($ind_error_41 == true){
	array_push($arr_mensajes,'41'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,''); 	//registra el codigo del mensaje que se debe mostrar
	$proceso			= NULL;		//no procesa nada
	$consulta			= "ver_consultar_maestro_detalle.php"; //lo envia a la pagina anterior
	$salida				= "ver_consultar_maestro_detalle.php"; //lo envia a la pagina anterior
}


?>