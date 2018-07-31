<? 

include('../librerias/pedido.php');
include('../librerias/sis_genericos.php');
include('../librerias/factura.php');

$pedido 			= new pedido();
$sis_genericos		= new sis_genericos();
$factura			= new factura();


//generar cursor de los registros seleccionados
$cursor_datos 	= $pedido->f_get_cursor_by_reg($reg_seleccionado);	
$num_registros	= $db->num_registros($cursor_datos);

?>