<?
include("../librerias/tabla_autonoma.php");

include("../librerias/columna_tabla_autonoma.php");
include("../librerias/sis_genericos.php");
include("../librerias/obj_listbox.php");
include("../librerias/tabla_autonoma_personalizado.php");
include("../librerias/proceso_adicional_pantalla.php");
include("../librerias/reporte_tabla.php");

include("../librerias/hora_minuto.php");
include("../librerias/parametro_sistema.php");

include("../librerias/factura.php");

include("../librerias/estado_factura.php");
include("../librerias/guarda_impuesto.php");



//=== crea  dinamicamente todas las variables que vienen por $_REQUEST >>>
$array_variables = array_keys($_REQUEST);
foreach($array_variables as $variable) 
	${$variable} = $_REQUEST[$variable];


$seg_permiso_tabla_autonoma	=	new seg_permiso_tabla_autonoma;
//=== Valida si puede consultar la informacion>>>
$ind_tiene_permiso 			= 	$seg_permiso_tabla_autonoma->f_get_permiso_select_tabla($cod_tabla,$cod_perfil);
if(!$row_usuario){
	array_push($arr_mensajes,'3'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,''); 	//registra el codigo del mensaje que se debe mostrar
	$proceso			= NULL;		//no procesa nada
	$consulta			= "ver_consultar_tabla_autonoma.php"; //lo envia a la pagina anterior
	$salida				= "ver_consultar_tabla_autonoma.php"; //lo envia a la pagina anterior
}else if(!$ind_tiene_permiso){
	array_push($arr_mensajes,'3'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,''); 	//registra el codigo del mensaje que se debe mostrar
	$proceso			= NULL;		//no procesa nada
	$consulta			= "ver_consultar_tabla_autonoma.php"; //lo envia a la pagina anterior
	$salida				= "ver_consultar_tabla_autonoma.php"; //lo envia a la pagina anterior
}
if(!$cod_tabla){
	array_push($arr_mensajes,'2'); 				//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,'Codigo de la Tabla'); 		//registra el codigo del mensaje que se debe mostrar		
	$proceso			= NULL;							//no procesa nada
	$consulta			= "ver_tablas_autonomas.php";	//Regresa a  la pagina anterior
	$salida				= "ver_tablas_autonomas.php";	//Regresa a  la pagina anterior
}
if(!$reg_seleccionado){
	array_push($arr_mensajes,'16'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,''); 	//registra el codigo del mensaje que se debe mostrar
	$proceso			= NULL;		//no procesa nada
	$consulta			= "ver_registrar_impuesto.php"; //lo envia a la pagina anterior
	$salida				= "ver_registrar_impuesto.php"; //lo envia a la pagina anterior
}


if($val_iva_porc == NULL  && $val_cree_porc == NULL){
	array_push($arr_mensajes,'1'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,'VALOR IVA / VALOR RETEFUENTE'); 	//registra el codigo del mensaje que se debe mostrar
	$proceso			= NULL;		//no procesa nada
	$consulta			= "ver_registrar_impuesto.php"; //lo envia a la pagina anterior
	$salida				= "ver_registrar_impuesto.php"; //lo envia a la pagina anterior
}

// recorre cada registro seleccionado para impedir el cambio de una factura que no se deba
/*for($i=0;$i<count($reg_seleccionado);$i++){
	
	$cod_factura 		= $reg_seleccionado[$i];
	$row_factura 		= $factura->f_get_row($cod_factura);
	$cod_estado_factura = $row_factura['cod_estado_factura'];
	

}*/




?>