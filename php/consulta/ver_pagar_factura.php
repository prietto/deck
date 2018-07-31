<? 
include_once('../librerias/factura.php');
include_once('../librerias/pedido.php');
include_once('../librerias/sis_genericos.php');

$pedido 			= new pedido();
$sis_genericos 		= new sis_genericos();

$cod_factura = $reg_seleccionado;
$row_pedido = $pedido->f_get_row_by_factura($cod_factura);
$row_pedido = $pedido->f_get_row_detallado($row_pedido['cod_pedido']);

$val_total 	= $sis_genericos->formato_numero($row_pedido['val_total']);
$val_saldo	= $row_pedido['val_saldo'];



if(($row_pedido['val_saldo'] == 0 || $row_pedido['val_saldo'] == NULL) && isset($row_pedido['val_saldo'])){
	echo 0;
	exit;
}else if(!$row_pedido){
	echo 1;
	exit;
}

?>