<? 
include('../librerias/obj_listbox.php');
include('../librerias/tabla_autonoma.php');
include('lib/estado_tabla_autonoma.php');
include('lib/tipo_tabla_autonoma.php');


$obj_listbox 			= new obj_listbox();
$estado_tabla_autonoma 	= new estado_tabla_autonoma();
$tipo_tabla_autonoma 	= new tipo_tabla_autonoma();
$tabla_autonoma 		= new tabla_autonoma();


if(!$cod_pk){			
	$cod_pk			=	$tabla_autonoma->p_get_next_pk_by_user($cod_usuario,'tabla_autonoma','cod_tabla');
	$ind_new_row	=	1;
}

$csr_estado_tabla	= $estado_tabla_autonoma->f_get_all();
$cmb_estado_tabla	= $obj_listbox->f_crear_lista($csr_estado_tabla);

$crs_tipo_tabla 	= $tipo_tabla_autonoma->f_get_all();
$cmb_tipo_tabla		= $obj_listbox->f_crear_lista($crs_tipo_tabla);





?>