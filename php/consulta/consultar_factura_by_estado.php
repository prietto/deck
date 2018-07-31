<? 
include_once('../librerias/cliente.php');
include_once('../librerias/factura.php');
include_once('../librerias/sis_genericos.php');
$cliente = new cliente();
$factura = new factura();
$sis_genericos = new sis_genericos();


$cursor_factura = $factura->f_get_factura_by_estado($cod_cliente,$cod_estado_factura);
$num_registros = $db->num_registros($cursor_factura);

if($num_registros == 0){
	echo 0;
	exit;
}




?>