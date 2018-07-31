<? 
include_once('../librerias/tabla_autonoma.php');
$tabla_autonoma = new tabla_autonoma();

$cursor_tablas =  $tabla_autonoma->f_get_by_tipo_tabla(2); // cod_tipo_tabla (primaria,secundaria)

?>