<? 
include_once('../librerias/pedido.php');
include_once('../librerias/factura_pago.php');
include_once('../librerias/factura.php');
include_once('../librerias/cliente.php');

$pedido 		= new pedido();
$factura_pago 	= new factura_pago();
$factura		= new factura();	


$result = $pedido->p_update_val_saldo($cod_pedido,$val_saldo,$cod_usuario,$fec_pago_factura);

echo $result;


?>