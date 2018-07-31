<? 
require('../principal/conecta_db.php');
include_once('../librerias/factura_pago.php');
include_once('../librerias/factura.php');
include_once('../librerias/parametro_sistema.php');
include_once('../librerias/sis_genericos.php');
$db = new conecta_db();
global $db;

$factura_pago 	= new factura_pago();

if(isset($_GET['cod_factura_pago'])){
	$cod_factura_pago = $_GET['cod_factura_pago'];
	$result = $factura_pago->p_eliminar_registro($cod_factura_pago);
	
	echo $result;
}

?>