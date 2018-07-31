<? 
require('../librerias/detalle_empleado_pago.php');
require('../librerias/empleado_pago.php');
require('../librerias/sis_genericos.php');

$detalle_empleado_pago 	= new detalle_empleado_pago();
$sis_genericos			= new sis_genericos();
$empleado_pago 			= new empleado_pago();

// informacion del recibo o pago total
$row_empleado_pago = $empleado_pago->f_get_row_detallado($cod_empleado_pago);
$fec_registro 	   = $sis_genericos->f_nombre_fecha_con_hora($row_empleado_pago['fec_registro']);

// cursor con informacion de los detalles
$cursor_detalle_pago = $detalle_empleado_pago->f_get_cursor($cod_empleado_pago);


?>