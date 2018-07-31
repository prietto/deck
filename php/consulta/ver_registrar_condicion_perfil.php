<?php 
$seg_perfil 			= new seg_perfil;
$seg_perfil_usuario		= new seg_perfil_usuario;
$obj_listbox			= new obj_listbox;
$tabla_autonoma			= new tabla_autonoma;
$seg_operacion_tabla	= new seg_operacion_tabla;
$entidad				= new entidad;
$condicion_consulta		= new condicion_consulta;



// === informacion del perfil
$row_perfil 	= $seg_perfil->f_get_row($cod_perfil_pk);
$txt_perfil		= $row_perfil['txt_nombre'];



$cadena_usuarios 		= $seg_perfil_usuario->f_get_usuarios($cod_perfil_pk);

// retorna cursor con los permisos por perfil
$cursor_permisos 		= $condicion_consulta->f_get_permisos_modulos($cod_perfil_pk); 



?>