<?php 

require('../librerias/producto.php');

$producto = new producto();

$num_cantidad_producto = $producto->f_get_cantidad_by_pedido($cod_producto,$cod_pedido);

echo $num_cantidad_producto;



?>