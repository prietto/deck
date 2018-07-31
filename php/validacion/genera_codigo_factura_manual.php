<? 
require_once('../librerias/factura.php');

$factura = new factura();

// debe validar que el numero de factura enviado que no haya sido bloqueado anteriormente
$factura->cod_factura_manual = $_REQUEST['num_factura_manual'];
$error = $factura->ind_factura_bloqueada();


if($error){
	$array_return = array();
	$array_return['code_error'] = 1;
	$array_return['msj_error'] = $error;

	echo json_encode($array_return);
	exit;
}




?>