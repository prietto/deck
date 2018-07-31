<?php 
require('../librerias/producto.php');
include_once('../librerias/sis_genericos.php');

$producto = new producto();
$sis_genericos = new sis_genericos();


// informacion del producto
if($cod_producto){
	$row_producto = $producto->f_get_row($cod_producto);
	
	$val_precio_unitario = $row_producto['val_precio_venta'];

	$val_precio_unitario	= $sis_genericos->formato_numero($val_precio_unitario);
	

}else{
	$val_precio_unitario = 0;
}

echo $val_precio_unitario;



?>