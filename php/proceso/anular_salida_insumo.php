<? 
require('../librerias/salida_insumo.php');
$salida_insumo = new salida_insumo();

$cod_salida_insumo = $reg_seleccionado;

$result = $salida_insumo->p_anular_salida_insumo($cod_salida_insumo);
echo json_encode($result);


?>