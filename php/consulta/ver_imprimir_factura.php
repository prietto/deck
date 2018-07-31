<?


$seg_empresa = new seg_empresa();

// === DATOS DE LA RESOLUCION ACTIVA ==== //
/*$row_resolucion_dian 		= $resolucion_dian->f_get_row_activa();
$num_resolucion				= $row_resolucion_dian['num_resolucion'];
$fec_resolucion				= $row_resolucion_dian['fec_resolucion'];
$num_rango_inicial			= $row_resolucion_dian['num_rango_inicial'];
$num_rango_final			= $row_resolucion_dian['num_rango_final'];*/



// === INFORMACION DE LA FACTURA ==== //
// retorna cursor de las facturas generadas a partir de los pedido sseleccionados
//$cursor_datos  = $pedido->f_get_facturas($reg_seleccionado);

$cursor_datos = $factura->f_get_cursor($reg_seleccionado);

// === INPUTS INFORMACION DE EMPRESA === //

// == primero debe validar que exista una empresa registrada
$cod_empresa = $seg_empresa->f_get_cod_empresa();

if($cod_empresa){
	$seg_empresa->cod_empresa = $cod_empresa;

	// == INFO DE LA EMPRESA == //
	$row_empresa = $seg_empresa->f_get_row();
	
	$txt_razon_social			= $row_empresa['txt_razon_social'];
	$txt_nombre_comercial		= $row_empresa['txt_nombre_comercial'];
	$cod_tipo_identificacion 	= $row_empresa['cod_tipo_identificacion'];
	$num_identificacion			= $row_empresa['num_identificacion'];
	$txt_direccion				= $row_empresa['txt_direccion'];
	$txt_telefono				= $row_empresa['txt_telefono'];
	$ind_genera_iva				= $row_empresa['ind_iva'];
	$val_porcentaje_iva			= $row_empresa['val_porcentaje_iva'];
	$txt_url_logo				= $row_empresa['txt_url_logo'] == NULL ? NULL : '<img style="max-width:100%; max-height:100%;" src="'.$row_empresa['txt_url_logo'].'" />';
	$cod_ciudad					= $row_empresa['cod_ciudad'];
	$cod_ciiu					= $row_empresa['cod_ciiu'];
	$fec_fundacion				= $row_empresa['fec_fundacion'];


}

?>