<?
require_once("../librerias/profesional_salud.php");

$profesional_salud = new profesional_salud;
$cod_usuario		= $_REQUEST['cod_usuario'];
$txt_login			= $_REQUEST['txt_login'];
$txt_password		= $_REQUEST['txt_password'];
$seg_perfil_usuario		= new seg_perfil_usuario();

//=== Evalua si ya tiene un codigo de usuario >>>
$row_profesional_salud =  $profesional_salud->f_get_row($cod_profesional_salud);

//=== actualiza el login y la contraseña en la tabla de usuario >>>
$cod_usuario_pk = $row_profesional_salud['cod_usuario_pk'];
if($cod_usuario_pk){
	$seg_usuario->	p_update_row(
					$cod_usuario_pk,
					$cod_usuario		,
					$txt_login			,
					$txt_password
					);
//=== Crea un nuevo usuario y lo enlaza a la tabla de profesional de la salud >>>
}else{
	$cod_usuario_pk	=	$seg_usuario->	p_crear_usuario(
						$cod_usuario		,
						$txt_login			,
						$txt_password
						);
	$profesional_salud->p_update_usuario_pk($cod_profesional_salud,$cod_usuario_pk);
}
//=== Asigna al usuario el perfil >>>
$seg_perfil_usuario-> p_crear_registro($cod_usuario_pk	,2);
?>