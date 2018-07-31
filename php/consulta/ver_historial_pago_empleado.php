<? 
require('../librerias/empleado_pago.php');
require('../librerias/sis_genericos.php');

$empleado_pago = new empleado_pago();
$sis_genericos = new sis_genericos();


$cod_empleado = $reg_seleccionado;

$cursor_historial = $empleado_pago->f_get_by_condicion($cod_empleado,$fec_ini_pago,$fec_fin_pago,$num_limit_pago);




?>