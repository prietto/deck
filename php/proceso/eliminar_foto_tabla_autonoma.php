<?
$tabla_autonoma				=	new tabla_autonoma;
$columna_tabla_autonoma		=	new columna_tabla_autonoma;
//=== Guarda los datos de la tabla autonoma>>>
$columna_tabla_autonoma->f_eliminar_foto(
$cod_tabla				,
$_POST					,
$cod_pk					,
$nom_columna_con_foto
);

$ind_limpiar_variables	= 1;
$ind_conservar_pk		= 1;
$ind_buscar				= 1;
?>	
