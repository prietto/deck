<? 

require('../librerias/insumo.php');
require('../librerias/sis_genericos.php');

$insumo 		= new insumo();
$sis_genericos 	= new sis_genericos();

$insumo->cod_insumo = $reg_seleccionado[0];
$cursor_insumo = $insumo->f_get_ultimos_movimientos();

// informacion del producto
$row_insumo = $insumo->f_get_row($reg_seleccionado[0]);



?>