<?php
//si es necesario cambiar la config. del php.ini desde tu script	
session_cache_limiter('private, must-revalidate');
session_start();
/*if(!isset($_SESSION['cod_pk_usuario']) && (!isset($_REQUEST['txt_login']) && (!isset($_REQUEST['txt_password'])) )){
	header('Location: ../proceso/logout.php');
	exit;
}*/

//error_reporting(E_ALL);
//ini_set("display_errors", 1);



ob_start();
//==Carga de librerias >>>
include ("../principal/conecta_db.php");
include ("lib/prv_seg_navegacion.php");
include ("../librerias/parametro_x_usuario.php");
include ("../librerias/seg_usuario.php");
include ("../librerias/seg_perfil_usuario.php");
include ("../librerias/seg_navegacion_estadistica.php");
include ("../librerias/seg_permiso_tabla_autonoma.php");
include_once ("../librerias/parametro_sistema.php");




//=== Carga de variables globales>>>
global 							$conecta_db;
global 							$cod_usuario_pk;
$arr_mensajes 					= array();
$arr_parametro					= array();
$db								= new conecta_db;
$seg_usuario					= new seg_usuario;
$seg_navegacion_estadistica		= new seg_navegacion_estadistica;
$seg_perfil_usuario				= new seg_perfil_usuario;
$parametro_x_usuario 			= new parametro_x_usuario();
$seg_permiso_tabla_autonoma		= new seg_permiso_tabla_autonoma();
$parametro_sistema				= new parametro_sistema();


$protocol 		= stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
$server_adr 	= $protocol.$_SERVER['SERVER_NAME']."/deck";





/*if(isset($_SESSION['cod_pk_usuario'])){ // si existe usuario y la session de usuario
	$row_usuario			= $seg_usuario->f_get_seg_usuario($_SESSION['cod_pk_usuario']);
	$cod_usuario			= $row_usuario['cod_usuario_pk'];
//	session_regenerate_id();
}else{
	$cod_usuario = NULL;
	$row_usuario = NULL;
}*/


// registra el parametro de mantener o no la sesion iniciada
/*$val_prmtro = $parametro_x_usuario->p_modificar_parametro($cod_usuario,4,$_REQUEST['ind_mantener_sesion']);

if($val_prmtro == 0 && $cod_usuario){
	
	// el usuario interactúa por primera vez
	$_SESSION["timeout"] = time();

	// establecemos el tiempo de espera en segundos
	$inactivo = 1200;
	// verificamos que ya exista un valor para timeout
	if (isset($_SESSION["timeout"])) {
		// calculamos el tiempo que lleva la sesión
		$tiempoSession = time() - $_SESSION["timeout"];
    	// si se pasó el umbral de inactividad
    	if ($tiempoSession > $inactivo) {
    		// destruimos la sesión y desconectamos al usuario
    		session_destroy();
        	header("Location: ../proceso/logout.php");
		}
	}
}*/


// INFORMACION DE LA VERSION DEL SISTEMA
$row_parametro_8 = $parametro_sistema->f_get_row(8);
$num_version = $row_parametro_8['val_parametro'];

if($cod_usuario)$cod_perfil = $seg_perfil_usuario->f_get_perfiles($cod_usuario);	



//===Valida la navegacion >>>
$prv_seg_navegacion 		= new prv_seg_navegacion;
if(!$cod_navegacion && $ind_var_ajax == 0)$cod_navegacion	= $_REQUEST['prv_cod_navegacion'];
else if(!$cod_navegacion && $ind_var_ajax == 0)$cod_navegacion = 36; //Entra a la pagina principal 
else if(!$cod_navegacion && $ind_var_ajax == 1){
	ob_clean();
	echo "Lo sentimos ocurrio un error en el flujo de navegacion";
	return false;
	exit;
}


$flujo_navegacion 		= $prv_seg_navegacion->f_ver_navegacion($cod_navegacion);

$row_flujo_navegacion	= $prv_seg_navegacion->f_get_row($cod_navegacion);
print_r($row_flujo_navegacion);
if(!$flujo_navegacion && $ind_var_ajax == 1){
	//ob_end_clean(); // destruye el bufer de salida para evitar otros echos anteriores
	ob_clean(); // limpia el bufer de salida de cualquier dato o caracter a imprimirse

	echo "error_flujo_navegacion";
	return false;
	exit;
}
$validation			= strtolower($flujo_navegacion["txt_validation"]);	//mantiene los nombres en minuscula
$model				= strtolower($flujo_navegacion["txt_model"]);	//mantiene los nombres en minuscula
$view				= strtolower($flujo_navegacion["txt_view"]); 		//mantiene los nombres en minuscula


//===Registra la estadisitca de visitas >>>
$seg_navegacion_estadistica->p_registrar_visita($cod_navegacion);
//if(!$contenido)print_r($flujo_navegacion);
//print_r($flujo_navegacion);
$fecha_actual = $hoy = date("F j, Y, g:i a");  

//print_r($_REQUEST);die();
//===Salidas del flujo de navegacion >>>
if(file_exists("validation/".$validation) && $validation != null) include ("/validation/".$validation); else {echo "No existe archivo ==> ".$validation;}
if($model) 	include ("model/".$model) ;



// permisos del usuario sobre los modulos a los que puede ingresar
$cursor_permisos_template = $seg_permiso_tabla_autonoma->f_get_permisos_modulos($cod_perfil);
if($view)	include ("views/".$view);
if($ind_navegacion_ajax == 1){
	if(count($arr_mensajes) > 0){
		//$arr_retorno['mensajes'] = include("../plantilla/mensaje.php");
		//echo json_encode($arr_retorno); //relacion de mensajes generados 
		
		ob_start();
		include '../plantilla/mensaje.php';
		$view = ob_get_clean();
		ob_end_flush();
		
		$arr_retorno['mensaje'] = $view;
		echo json_encode($arr_retorno); //relacion de mensajes generados 
	}
}else{
	if($arr_mensajes)include ("../plantilla/mensaje.php"); //relacion de mensajes generados 
}
exit();
?>