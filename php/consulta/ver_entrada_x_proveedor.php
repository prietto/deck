<?php 
include('../librerias/entrada_producto.php');
include('../librerias/proveedor.php');

$entrada_producto 	= new entrada_producto();
$proveedor			= new proveedor();

//retorna cursor con las entradas de bodega por proveedor
$crsor_ntrada_prvdor = $entrada_producto->f_get_x_proveedor($cod_pk_proveedor);

// informacion del proveedor
$row_proveedor = $proveedor->f_get_row($cod_pk_proveedor);
$txt_nombre_proveedor = $row_proveedor['txt_nombre']." ".$row_proveedor['txt_apellido'];


?>