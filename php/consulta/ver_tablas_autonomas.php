<?php
include_once ("../librerias/parametro_sistema.php");
include_once ("../librerias/factura.php");
include_once ("../librerias/seg_permiso_tabla_autonoma.php");
include_once ("../librerias/sis_genericos.php");
//=== Instancias requeridas >>>
$factura						=	new factura;
$parametro_sistema				= 	new parametro_sistema;
$seg_permiso_tabla_autonoma		= 	new seg_permiso_tabla_autonoma;




$ind_pantalla_menu = TRUE;

?>