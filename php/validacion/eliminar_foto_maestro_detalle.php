<?
include("../librerias/tabla_autonoma.php");

include("../librerias/columna_tabla_autonoma.php");
include("../librerias/tabla_autonoma_personalizado.php");
include("../librerias/sis_genericos.php");
include("../librerias/obj_listbox.php");
include("../librerias/proceso_adicional_pantalla.php");
include("../librerias/c_file.php");

$seg_permiso_tabla_autonoma	=	new seg_permiso_tabla_autonoma;
$columna_tabla_autonoma		=	new columna_tabla_autonoma;
$ind_tiene_permiso 			= 	$seg_permiso_tabla_autonoma->f_get_permiso_delete_tabla($cod_tabla,$cod_perfil);

if(!$row_usuario){
	array_push($arr_mensajes,'3'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,''); 	//registra el codigo del mensaje que se debe mostrar
	$proceso				= NULL;		//no procesa nada
	$consulta				= "ver_registrar_maestro_detalle_autonomo.php";	//Regresa a  la pagina anterior
	$salida					= "ver_registrar_maestro_detalle_autonomo.php";	 //Regresa a  la pagina anterior
}else if(!$ind_tiene_permiso){
	array_push($arr_mensajes,'3'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,''); 	//registra el codigo del mensaje que se debe mostrar
	$proceso				= NULL;		//no procesa nada
	$consulta				= "ver_registrar_maestro_detalle_autonomo.php";	//Regresa a  la pagina anterior
	$salida					= "ver_registrar_maestro_detalle_autonomo.php";	 //Regresa a  la pagina anterior
}
?>