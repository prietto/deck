<?
include("../librerias/tabla_autonoma.php");
include("../librerias/columna_tabla_autonoma.php");
include("../librerias/sis_genericos.php");
include("../librerias/obj_listbox.php");
include("../librerias/tabla_autonoma_personalizado.php");
include("../librerias/proceso_adicional_pantalla.php");
include("../librerias/reporte_tabla.php");
include("../librerias/parametro_sistema.php");
include("../librerias/factura.php");
include("../librerias/pedido.php");
include("../librerias/resolucion_dian.php");
include("../librerias/factura_pago.php");

$sis_genericos 		= 	new sis_genericos();
$pedido				=	new pedido();


$seg_permiso_tabla_autonoma	=	new seg_permiso_tabla_autonoma;
//=== Valida si puede consultar la informacion>>>
$ind_tiene_permiso 			= 	$seg_permiso_tabla_autonoma->f_get_permiso_select_tabla($cod_tabla,$cod_perfil);
if(!$row_usuario){
	array_push($arr_mensajes,'3'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,''); 	//registra el codigo del mensaje que se debe mostrar
	$proceso			= NULL;		//no procesa nada
	$consulta			= "ver_menu_usuario.php"; //lo envia a la pagina anterior
	$salida				= "ver_menu_usuario.php"; //lo envia a la pagina anterior
}else if(!$ind_tiene_permiso){
	array_push($arr_mensajes,'3'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,''); 	//registra el codigo del mensaje que se debe mostrar
	$proceso			= NULL;		//no procesa nada
	$consulta			= "ver_tablas_autonomas.php"; //lo envia a la pagina anterior
	$salida				= "ver_tablas_autonomas.php"; //lo envia a la pagina anterior
}
if(!$cod_tabla){
	array_push($arr_mensajes,'1'); 				//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,'Codigo de la Tabla'); 		//registra el codigo del mensaje que se debe mostrar		
	$proceso			= NULL;							//no procesa nada
	$consulta			= "ver_tablas_autonomas.php";	//Regresa a  la pagina anterior
	$salida				= "ver_tablas_autonomas.php";	//Regresa a  la pagina anterior
}


// === VALIDA QUE LOS PEDIDOS SELECCIONADOS SE PUEDAN FACTURAR
// retorna el nombre de los estados encontrados
$ind_error_37 = $pedido->f_valida_multiple_estado($reg_seleccionado,"3");
if($ind_error_37){
	$array_request_reporte			= $sis_genericos->f_genera_variables_anteriores($_REQUEST);
	array_push($arr_mensajes,'37'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,"<br>".$ind_error_37); 	//registra el codigo del mensaje que se debe mostrar
	$proceso			= NULL;		//no procesa nada
	$consulta			= "ver_consultar_maestro_detalle.php"; //lo envia a la pagina anterior
	$salida				= "ver_consultar_maestro_detalle.php"; //lo envia a la pagina anterior
}


if(!$reg_seleccionado){
	$array_request_reporte			= $sis_genericos->f_genera_variables_anteriores($_REQUEST);
	array_push($arr_mensajes,'34'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,'GENERAR FACTURA(S)'); 	//registra el codigo del mensaje que se debe mostrar
	$proceso			= NULL;		//no procesa nada
	$consulta			= "ver_consultar_maestro_detalle.php"; //lo envia a la pagina anterior
	$salida				= "ver_consultar_maestro_detalle.php"; //lo envia a la pagina anterior
}



?>	