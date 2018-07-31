<? 
require('../librerias/entrada_producto.php');
require('../librerias/producto.php');
require('../librerias/sis_genericos.php');



$entrada_producto = new entrada_producto();
$producto = new producto();
$sis_genericos = new sis_genericos();

$producto->cod_producto = $reg_seleccionado[0];
$cursor_producto = $producto->f_get_ultimos_movimientos();

// informacion del producto
$row_producto = $producto->f_get_row($reg_seleccionado[0]);



?>