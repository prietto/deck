<?php
//si es necesario cambiar la config. del php.ini desde tu script	
session_cache_limiter('private, must-revalidate');
session_start();
// if(!isset($_SESSION['cod_pk_usuario']) && (!isset($_REQUEST['txt_login']) && (!isset($_REQUEST['txt_password'])) )){
// 	header('Location: ../proceso/logout.php');
// 	exit;
// }

//error_reporting(E_ALL);
//ini_set("display_errors", 1);



ob_start();
//==Carga de librerias >>>
include ("conecta_db.php");
include ("../librerias/seg_navegacion.php");
include ("../librerias/parametro_x_usuario.php");
include ("../librerias/seg_usuario.php");
include ("../librerias/seg_perfil_usuario.php");
include ("../librerias/seg_navegacion_estadistica.php");
include ("../librerias/seg_permiso_tabla_autonoma.php");
include_once ("../librerias/parametro_sistema.php");
include_once ("../librerias/seg_empresa.php");



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
$seg_empresa					= new seg_empresa();



// si utiliza el metodo de todas las variables del formulario
$ind_var_ajax = NULL;
if(isset($_POST['ind_var_ajax']))$ind_var_ajax = $_POST['ind_var_ajax'];

if($ind_var_ajax == 1){
	//==Carga las variables ajax en el request de forma dinamica >>>
	$tmp_num_post = count($_POST); // cuenta la cantidad de posiciones del post
	$keys = array_keys($_POST);
	

	for($i=0; $i<count($keys);$i++){ // entra por aqui la cantidad de keys que tiene el request
		
		$nom_key				= $keys[$i];
		if($nom_key == 'vars'){
			$arr_variables_ajax = $_POST['vars'];
		}else{
			$arr_variables_ajax		= $_POST[$nom_key]; // arranca desde la primera posicion sin importar si comienza por 0
		}
		
		$num_sub_var			= count($arr_variables_ajax); // cuenta para saber si la posicion del post tiene mas subvectores
		if(is_array($arr_variables_ajax)){
			unset($_REQUEST['vars']['cod_navegacion']);
			unset($_POST['vars']['cod_navegacion']);
		}
		
		//$tmp_nom_variable		= key(current($_POST));
		if($num_sub_var > 1){ // si tiene subvectores entra
			$keys_vars			= array_keys($_POST[$nom_key]);
			for($k=0; $k<$num_sub_var;$k++){
				$ind_multiple = NULL;

				$key_nom_tmp		= $keys_vars[$k];
				$val_variable		= $_POST[$nom_key][$key_nom_tmp]; // recorre las posiciones para la variable especial de ajax	
				
				if($val_variable || $val_variable != NULL ){
					$$key_nom_tmp				= $val_variable; //asigna el valor dinamicamente
					if($ind_multiple){ // si es una array la variable esto para la ultima posicion
						$_REQUEST[$key_nom_tmp][] 	= $val_variable; 	// alimenta el request		
					}else{
						$_REQUEST[$key_nom_tmp] 	= $val_variable; 	// alimenta el request	
					}
				}
			}
			
			// borra la variables del request ya que es innecesari
			$_REQUEST['vars']	 = NULL; 
			$_POST['vars'] 		= NULL;
			unset($_REQUEST['vars']);
			unset($_POST['vars']);
		}else{
			$tmp_nom_variable		= $nom_key;
			$$tmp_nom_variable		= $_POST[$tmp_nom_variable]; //asigna el valor dinamicamente
		}
		//next($_POST); // sinieguiente posisicon del post
	}
}else{
	//==Carga las variables $request de forma dinamica >>>
	$tmp_num_request = count($_REQUEST);
	for($i=0; $i<$tmp_num_request;$i++){
		$tmp_val_variable 		= current($_REQUEST);
		$tmp_nom_variable		= key($_REQUEST);
		$$tmp_nom_variable		= $tmp_val_variable; //asigna el valor dinamicamente
		 next($_REQUEST);
	}
}



date_default_timezone_set('America/Bogota');

//=== crea  dinamicamente todas las variables que vienen por $_REQUEST >>>
/*$array_variables = array_keys($_REQUEST);
foreach($array_variables as $variable) 	${$variable} = $_REQUEST[$variable];*/



//===Obtiene la informacion del seg_usuario >>>
if($_REQUEST['txt_login'] && $_REQUEST['txt_password'] && !$cod_usuario && !isset($_SESSION['cod_pk_usuario'])){ 

	// por aca ingresa por la pantalla de login
	$row_usuario	= $seg_usuario->f_get_seg_usuario_password($_REQUEST['txt_login'],$_REQUEST['txt_password']);
	$cod_usuario	= $row_usuario['cod_usuario_pk'];
	$txt_login		= $row_usuario['txt_login'];
	

	if($cod_usuario){
		// creamos las sessiones
		session_start();
		session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0); 
		$_SESSION['cod_pk_usuario'] = $cod_usuario;
		$_SESSION['nom_user'] 		= $txt_login;

		// == averigua si existe una empresa creada en el sistema y guarda en la cookie la url del logo
		$cod_empresa = $seg_empresa->f_get_cod_empresa();
		$seg_empresa->cod_empresa = $cod_empresa;

		$row_empresa = $seg_empresa->f_get_row();
		//echo "row empresa=> ";
		//print_r($row_empresa);

		$txt_url_logo_head_template	= $row_empresa['txt_url_logo'] == NULL ? NULL : '<img style="max-width:100%; max-height:100%;" src="'.$row_empresa['txt_url_logo'].'" />';
		//$_SESSION['logo_empresa']	= $txt_url_logo_head_template;
		setcookie('logo_empresa',$txt_url_logo_head_template,0);
		setcookie('cod_empresa',$cod_empresa,0);
		setcookie('txt_seg_empresa',$row_empresa['txt_razon_social'],0);

	}
	
}else{

	// no viene de la pantalla de validacion de usuario
	if(!$cod_usuario)$cod_usuario 	= $_REQUEST['cod_usuario'];
	$row_usuario					= $seg_usuario->f_get_seg_usuario($cod_usuario);



}

if(isset($_SESSION['cod_pk_usuario'])){ // si existe usuario y la session de usuario
	$row_usuario			= $seg_usuario->f_get_seg_usuario($_SESSION['cod_pk_usuario']);
	$cod_usuario			= $row_usuario['cod_usuario_pk'];
//	session_regenerate_id();
}else{
	$cod_usuario = NULL;
	$row_usuario = NULL;
}


// registra el parametro de mantener o no la sesion iniciada
$val_prmtro = $parametro_x_usuario->p_modificar_parametro($cod_usuario,4,$_REQUEST['ind_mantener_sesion']);

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
}


// INFORMACION DE LA VERSION DEL SISTEMA
$row_parametro_8 = $parametro_sistema->f_get_row(8);
$num_version = $row_parametro_8['val_parametro'];

if($cod_usuario)$cod_perfil = $seg_perfil_usuario->f_get_perfiles($cod_usuario);	



//===Valida la navegacion >>>
$seg_navegacion 		= new seg_navegacion;
if(!$cod_navegacion && $ind_var_ajax == 0)$cod_navegacion	= $_REQUEST['cod_navegacion'];
else if(!$cod_navegacion && $ind_var_ajax == 0)$cod_navegacion = 36; //Entra a la pagina principal 
else if(!$cod_navegacion && $ind_var_ajax == 1){
	ob_clean();
	echo "Lo sentimos ocurrio un error en el flujo de navegacion";
	return false;
	exit;
}

$flujo_navegacion 		= $seg_navegacion->f_ver_navegacion($cod_navegacion);
$row_flujo_navegacion	= $seg_navegacion->f_get_row($cod_navegacion);
if(!$flujo_navegacion && $ind_var_ajax == 1){
	//ob_end_clean(); // destruye el bufer de salida para evitar otros echos anteriores
	ob_clean(); // limpia el bufer de salida de cualquier dato o caracter a imprimirse

	echo "error_flujo_navegacion";
	return false;
	exit;
}

$validacion			= strtolower($flujo_navegacion["txt_validacion"]);	//mantiene los nombres en minuscula
$proceso			= strtolower($flujo_navegacion["txt_proceso"]);		//mantiene los nombres en minuscula
$consulta			= strtolower($flujo_navegacion["txt_consulta"]);	//mantiene los nombres en minuscula
$salida				= strtolower($flujo_navegacion["txt_salida"]); 		//mantiene los nombres en minuscula
$contenido			= strtolower($flujo_navegacion["txt_contenido"]); 		//mantiene los nombres en minuscula

//===Registra la estadisitca de visitas >>>
$seg_navegacion_estadistica->p_registrar_visita($cod_navegacion);
//if(!$contenido)print_r($flujo_navegacion);
//print_r($flujo_navegacion);
$fecha_actual = $hoy = date("F j, Y, g:i a");  




//print_r($_REQUEST);die();
//===Salidas del flujo de navegacion >>>
if($validacion) include ("../validacion/$validacion");
if($proceso)	include ("../proceso/$proceso");
if($consulta)	include ("../consulta/$consulta");

include_once ("../librerias/tabla_autonoma.php");
$tabla_autonoma					=	new tabla_autonoma;

$arrayModules = $seg_permiso_tabla_autonoma->f_get_permisos_modulos_array($cod_perfil);

// == cursor de modulos==>
$cursor_modulos = $tabla_autonoma->get_modules_dashboard();



// permisos del usuario sobre los modulos a los que puede ingresar
//$cursor_permisos_template = $seg_permiso_tabla_autonoma->f_get_permisos_modulos($cod_perfil);
if($salida)		include ("../plantilla/$salida");
if($contenido)	include ("../contenido/$contenido");
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