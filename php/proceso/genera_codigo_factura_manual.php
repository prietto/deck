<? 
require_once('../librerias/factura.php');
$factura = new factura();



// se debe crear el codigo de factura y bloquearlo para evitar ser seleccionado por otro usuario
$cod_factura_pk = $factura->p_crea_registro_bloqueado($num_factura_manual);


if(!$cod_factura_pk){
	$array_return = array();
	$array_return['code_error'] = 1;
	$array_return['msj_error'] = 'Error al generar codigo de factura, comuniquese con el administrador';

	echo json_encode($array_return);
	exit;
}else{
	$array_return = array();
	$array_return['code_error'] = 0;
	$array_return['code_pk_factura'] = $cod_factura_pk;

	echo json_encode($array_return);
	exit;
}

?>