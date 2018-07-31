<?php 
require('../librerias/entrada_producto.php');
require('../librerias/producto.php');
$entrada_producto 	= new entrada_producto();
$producto			= new producto();

// cambia el codigo de tabla
$cod_tabla = 21;

$entrada_producto->p_guardar_entrada($cod_entrada_producto,$cod_producto,$num_cantidad,$cod_usuario);

?>