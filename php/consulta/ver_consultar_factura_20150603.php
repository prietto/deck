<? 

//verifica si el dia de hoy ya se ejecuto la actualizacion y si no
// ejecuta actualizacion de estados de facturas
$ind_actualizacion 	= $parametro_sistema->f_get_actualizacion_facturas();

// proceso para actualizar los dias de vencimiento
if($ind_actualizacion == 1){
	include_once('../librerias/factura.php');
	include_once('../librerias/sis_genericos.php');
	$factura = new factura();
	$factura->p_update_vencimiento();	
}

?>