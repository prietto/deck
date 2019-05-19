<? 
include_once('../principal/conecta_db.php');
include_once('../librerias/parametro_sistema.php');
$db = new conecta_db();
$parametro_sistema = new parametro_sistema();

//verifica si el dia de hoy ya se ejecuto la actualizacion y si no
// ejecuta actualizacion de estados de facturas
$ind_actualizacion 	= $parametro_sistema->f_get_actualizacion_facturas();
//echo $ind_actualizacion;
?>