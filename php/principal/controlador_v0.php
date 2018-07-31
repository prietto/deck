<?php
ob_start();
session_cache_limiter('private, must-revalidate');
$cache_limiter = session_cache_limiter();
echo "The cache limiter is now set to $cache_limiter<br/>";
//session_start();
//==Carga de librerias >>>
include ("conecta_db.php");
include ("../librerias/seg_navegacion.php");
include ("../librerias/seg_usuario.php");
include ("../librerias/seg_perfil_usuario.php");
include ("../librerias/seg_navegacion_estadistica.php");
//=== Carga de variables globales>>>
// date_default_timezone_set('America/Bogota');
global 							$conecta_db;
$arr_mensajes 					= array();
$arr_parametro					= array();
$db								= new conecta_db;
$seg_usuario					= new seg_usuario;
$seg_navegacion_estadistica		= new seg_navegacion_estadistica;
$seg_perfil_usuario				= new seg_perfil_usuario;

date_default_timezone_set('America/Bogota');

//=== crea  dinamicamente todas las variables que vienen por $_REQUEST >>>
$array_variables = array_keys($_REQUEST);
foreach($array_variables as $variable) 	${$variable} = $_REQUEST[$variable];

//===Obtiene la informacion del seg_usuario >>>
if($_REQUEST['txt_login'] && $_REQUEST['txt_password'] && !$cod_usuario){
	$row_usuario	= $seg_usuario->f_get_seg_usuario_password($_REQUEST['txt_login'],$_REQUEST['txt_password']);
	$cod_usuario	= $row_usuario['cod_usuario_pk'];
}else	
	if(!$cod_usuario)	$cod_usuario = $_REQUEST['cod_usuario'];
if($cod_usuario)	$row_usuario	= $seg_usuario->f_get_seg_usuario($cod_usuario);


//=== Toma los perfiles que tiene el usuario autorizados>>>
if(!$cod_usuario) 	$cod_perfil = 2; //seg_usuario estandar de internet
else				$cod_perfil = $seg_perfil_usuario->f_get_perfiles($cod_usuario);	



//===Valida la navegacion >>>
$seg_navegacion 		= new seg_navegacion;
if(!$cod_navegacion)	$cod_navegacion	= $_REQUEST['cod_navegacion'];
if (!$cod_navegacion) 	$cod_navegacion = 36; //Entra a la pagina principal
$flujo_navegacion 		= $seg_navegacion->f_ver_navegacion($cod_navegacion);
$validacion			= strtolower($flujo_navegacion["txt_validacion"]);	//mantiene los nombres en minuscula
$proceso			= strtolower($flujo_navegacion["txt_proceso"]);		//mantiene los nombres en minuscula
$consulta			= strtolower($flujo_navegacion["txt_consulta"]);	//mantiene los nombres en minuscula
$salida				= strtolower($flujo_navegacion["txt_salida"]); 		//mantiene los nombres en minuscula

//===Registra la estadisitca de visitas >>>
$seg_navegacion_estadistica->p_registrar_visita($cod_navegacion);
//print_r($flujo_navegacion);
$fecha_actual = $hoy = date("F j, Y, g:i a");  
//echo $fecha_actual;

//print_r($_REQUEST);die();
//===Salidas del flujo de navegacion >>>



if($validacion) include ("../validacion/$validacion");
if($proceso)	include ("../proceso/$proceso");
if($consulta)	include ("../consulta/$consulta");

if($salida)		include ("../plantilla/$salida");
if($arr_mensajes)include ("../plantilla/mensaje.php"); //relacion de mensajes generados 
exit();
?>