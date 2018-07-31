<?php 
include_once ("../librerias/seg_permiso_tabla_autonoma.php");
require ("../librerias/pedido.php");

$seg_permiso_tabla_autonoma		= new seg_permiso_tabla_autonoma();
$pedido							= new pedido();


$pedido->p_anular_pedido($reg_seleccionado);



?>