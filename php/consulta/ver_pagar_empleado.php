<? 
require('../librerias/empleado.php');
$empleado = new empleado();

$cod_empleado = $reg_seleccionado;

$row_empleado = $empleado->f_get_row_detallado($cod_empleado);

$ind_activo = $row_empleado['ind_activo']; // indicador para saber si el empleado esta activo y permitir el registro de un pago


?>