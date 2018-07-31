<? 
require('../librerias/empleado_pago.php');
require('../librerias/empleado.php');
require('../librerias/detalle_empleado_pago.php');
require_once('../librerias/sis_genericos.php');

$empleado_pago 			= new empleado_pago();
$empleado 				= new empleado();
$detalle_empleado_pago 	= new detalle_empleado_pago();
$sis_genericos = new sis_genericos();


$row_pago 				= $empleado_pago->f_get_row($cod_empleado_pago);
$row_empleado			= $empleado->f_get_row_detallado($row_pago['cod_empleado']);
$cursor_detalle_pago	= $detalle_empleado_pago->f_get_cursor($cod_empleado_pago);
$cursor_detalle_pago_2	= $detalle_empleado_pago->f_get_cursor($cod_empleado_pago);


// === INFORMACION DEL PAGO ==== //
$fec_registro 			= date($row_pago['fec_registro']);

$dia_fec_registro		= date('d',$fec_registro);
$mes_fec_registro		= date('m',$fec_registro);
$year_fec_registro		= date('Y',$fec_registro);



// === INFORMACION DEL EMPLEADO === ///
$txt_nombre_empleado 			= $row_empleado['txt_nombre']." ".$row_empleado['txt_apellido'];
$num_identificacion				= $row_empleado['num_identificacion'];
$txt_tipo_identificacion		= $row_empleado['txt_tipo_identificacion'];
$txt_tipo_identificacion_corto	= $row_empleado['txt_tipo_identificacion_corto'];
$txt_ciudad_empleado			= $row_empleado['txt_ciudad'];
$fec_ingreso_empleado			= $row_empleado['fec_ingreso'];
$txt_cargo_empleado				= $row_empleado['txt_tipo_cargo'];



?>