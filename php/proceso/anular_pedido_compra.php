<? 
require('../librerias/pedido_compra.php');
require('../librerias/entrada_insumo.php');

$pedido_compra = new pedido_compra();


$cod_pedido_compra = $reg_seleccionado;
$result = $pedido_compra->p_anular_pedido($cod_pedido_compra);
echo $result;
?>