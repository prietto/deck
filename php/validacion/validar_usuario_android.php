<?
include ("../librerias/tabla_autonoma.php");
//=== Valida si el perfil puede ejecutar la accion >>>
$ind_tiene_permiso = $seg_navegacion->f_permiso_navegacion($cod_navegacion,$cod_perfil);

if(!$row_usuario){
	echo "password_incorrecto";
	exit();	
}else if(!$ind_tiene_permiso){
	echo "password_incorrecto";
	exit();
}
?>