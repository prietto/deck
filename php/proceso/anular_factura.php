<? 
include_once('../librerias/factura.php');
$factura = new factura();

$row_factura = $factura->f_get_row($reg_seleccionado);
$cod_estado_factura = $row_factura['cod_estado_factura'];

if($cod_estado_factura == 4){ // si la factura esta pagada 
	echo "La factura se encuentra pagada, no se puede anular";
	exit;
}else if($cod_estado_factura == 5){ // esta vencida
	echo "La factura esta vencida, no puede anularse";
	exit;
	
}else if($cod_estado_factura == 8){
	echo "La factura ya fue anulada";
	exit;
}else if($cod_estado_factura == 1 || $cod_estado_factura == 2){ // se puede anular la factura
	$result = $factura->p_anular_factura($reg_seleccionado,$cod_usuario);
	echo $result;
	exit;

}else echo "No se ha podido anular la factura, \n comunicate con el administrador del sistema";


exit;


?>