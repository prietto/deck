<? 
include_once('../librerias/tabla_autonoma.php');
$tabla_autonoma = new tabla_autonoma();


$arr_result = $tabla_autonoma->f_get_row_autonomo($cod_tabla,$cod_pk);

echo json_encode($arr_result);

?>