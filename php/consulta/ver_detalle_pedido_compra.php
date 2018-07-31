<? 
include('../librerias/pedido_detalle_compra.php');
include('../librerias/sis_genericos.php');
$pedido_detalle_compra = new pedido_detalle_compra();
$sis_genericos = new sis_genericos();

$cursor_detalle_compra = $pedido_detalle_compra->f_get_cursor_by_pedido($reg_seleccionado);

?>