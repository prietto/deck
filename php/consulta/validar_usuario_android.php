<?
include ("../librerias/profesional_salud.php");
//=== Valida si el perfil puede ejecutar la accion >>>
$profesional_salud		= new profesional_salud;
$row_profesional_salud	= $profesional_salud->f_get_by_user($cod_usuario);
$cod_profesional_salud	= $row_profesional_salud['cod_profesional_salud'];
$txt_nombre				= $row_profesional_salud['txt_nombre'];
$txt_apellido			= $row_profesional_salud['txt_apellido'];
$cod_estado_profesional	= $row_profesional_salud['cod_estado_profesional'];

//=== Si esta activo retorna los datos
if($cod_estado_profesional == 1) 
	echo "$cod_profesional_salud";
else 
	echo "usuario_inactivo";

?>