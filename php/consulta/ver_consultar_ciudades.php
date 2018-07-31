<?
include("../librerias/pais.php");
include("../librerias/departamento.php");
include("../librerias/ciudad.php");
include("../librerias/obj_listbox.php");

$pais	 				= 	new pais;
$departamento			= 	new departamento;
$ciudad					= 	new ciudad;
$obj_listbox			=	new obj_listbox;

if(!$cod_pais)			$cod_pais 			= 97; //colombia
if(!$cod_departamento)	$cod_departamento 	= 590; //Valle
//=== Obtiene informacion del PAIS>>>
$cursor					=	$pais->f_get_all();
$cmb_pais				= 	$obj_listbox->f_crear_lista($cursor, $cod_pais);

//=== Obtiene informacion del DEPARTAMENTO >>>
if($cod_pais){
	$cursor					=	$departamento->f_get_departamentos_pais($cod_pais);
	$cmb_departamento		= 	$obj_listbox->f_crear_lista($cursor, $cod_departamento);
}

//=== Obtiene informacion de las CIUDADES >>>
if($cod_departamento){
	$cursor					=	$ciudad->f_get_ciudades_departamento($cod_departamento);
	$cmb_ciudad				= 	$obj_listbox->f_crear_lista($cursor, $cod_ciudad);
}


?>