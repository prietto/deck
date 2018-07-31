<?
include("../librerias/tabla_autonoma.php");

include("../librerias/columna_tabla_autonoma.php");
include("../librerias/sis_genericos.php");
include("../librerias/obj_listbox.php");
include("../librerias/tabla_autonoma_personalizado.php");
include("../librerias/proceso_adicional_pantalla.php");
include("../librerias/reporte_tabla.php");
include("../librerias/paciente.php");
include("../librerias/profesional_salud.php");
include("../librerias/antecedente_paciente.php");
include("../librerias/descripcion_antecedente.php");
include("../librerias/atencion.php");
include("../librerias/tipo_atencion.php");

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
	$consulta			= NULL; //lo envia a la pagina anterior
	$salida				= "ver_validar_usuario.php"; //lo envia a la pagina anterior
}else if(!$ind_tiene_permiso){
	array_push($arr_mensajes,'3'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,''); 	//registra el codigo del mensaje que se debe mostrar
	$proceso			= NULL;		//no procesa nada
	$consulta			= NULL; //lo envia a la pagina anterior
	$salida				= "ver_validar_usuario.php"; //lo envia a la pagina anterior
}
if(!$cod_tabla){
	array_push($arr_mensajes,'2'); 						//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,'Codigo de la Tabla'); 	//registra el codigo del mensaje que se debe mostrar		
	$proceso			= NULL;							//no procesa nada
	$consulta			= NULL;							//Regresa a  la pagina anterior
	$salida				= "ver_tablas_autonomas.php";	//Regresa a  la pagina anterior
}
if(!$cod_paciente){
	array_push($arr_mensajes,'12'); 					//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,''); 						//registra el codigo del mensaje que se debe mostrar
	$proceso			= NULL;							//no procesa nada
	$consulta			= NULL; 						//lo envia a la pagina anterior
	$salida				= "ver_validar_usuario.php"; 	//lo envia a la pagina anterior
}
?>