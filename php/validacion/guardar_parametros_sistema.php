<? 
include_once('../librerias/seg_permiso_tabla_autonoma.php');

$seg_permiso_tabla_autonoma = new seg_permiso_tabla_autonoma();

if($ind_new_row)	
	$ind_tiene_permiso = $seg_permiso_tabla_autonoma->f_get_permiso_insert_tabla($cod_tabla,$cod_perfil);
else
	$ind_tiene_permiso = $seg_permiso_tabla_autonoma->f_get_permiso_update_tabla($cod_tabla,$cod_perfil);
if(!$row_usuario){
	array_push($arr_mensajes,'3'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,''); 	//registra el codigo del mensaje que se debe mostrar
	$proceso				= NULL;		//no procesa nada
	$consulta				= "ver_registrar_dato_tabla_autonoma.php";	//Regresa a  la pagina anterior
	$salida					= "ver_registrar_dato_tabla_autonoma.php";	 //Regresa a  la pagina anterior
}else if(!$ind_tiene_permiso){
	array_push($arr_mensajes,'3'); 	//registra el codigo del mensaje que se debe mostrar
	array_push($arr_parametro,''); 	//registra el codigo del mensaje que se debe mostrar
	$proceso				= NULL;		//no procesa nada
	$consulta				= "ver_registrar_dato_tabla_autonoma.php";	//Regresa a  la pagina anterior
	$salida					= "ver_registrar_dato_tabla_autonoma.php";	 //Regresa a  la pagina anterior
}

?>