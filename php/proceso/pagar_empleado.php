<? 
require('../librerias/empleado_pago.php');
require('../librerias/detalle_empleado_pago.php');
$empleado_pago = new empleado_pago();


$ind_imprimir = $_REQUEST['ind_imprimir'];

$array_result = array();


$array_result['data'] 		= $empleado_pago->p_registrar_pago(
														$cod_empleado_pago		,
														$fec_pago_empleado		,
														$cod_usuario			,
														$txt_nota_pago			,
														$arr_txt_concepto		,
														$arr_num_valor
													);
$array_result['printer'] 	= $ind_imprimir;



// convertimo a json el array para ser leido por javascript
echo json_encode($array_result);

?>