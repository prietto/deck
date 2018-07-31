<? 
include_once('../principal/conecta_db.php');
include_once('../librerias/factura.php');
include_once('../librerias/sis_genericos.php');
include_once('../librerias/parametro_sistema.php');

$db = new conecta_db();
$factura = new factura();


$factura->p_update_vencimiento();	


?>