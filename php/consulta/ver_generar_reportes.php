<?php 

//== obtiene las variables en el reporte para que regrese despues a la misma ubicacion >>>
$array_request_reporte	= $sis_genericos->f_genera_variables_anteriores($_REQUEST); //identifica que viene desde la consulta




if(!$reg_seleccionado){

	$reg_seleccionado = explode(',',$_REQUEST['cod_facturas']);
	$_REQUEST['reg_seleccionado'] = $reg_seleccionado;
};



// obtiene los arcvhivos de las facturas seleccionadas
$cursor					=	$detalle_nombre_archivos->f_get_by_factura($reg_seleccionado);
$cmb_archivos			=	$obj_listbox->f_crear_lista($cursor);


// cadena de codigos de facturas
$string_facturas = implode(',',$reg_seleccionado);
if($year_facturacion == -1)$cod_periodo_facturacion = NULL;

// combo del año de facturacion
$cursor					=	$periodo_facturacion->f_get_year_all();
$cmb_year_facturacion	=	$obj_listbox->f_crear_lista($cursor,$_REQUEST['year_facturacion']);

//averigua año del periodo de facturacion
$row_periodo = $periodo_facturacion->f_get_row($_REQUEST['year_facturacion']);
$num_year = $row_periodo['year_facturacion'];

// combo de los periodos de facturacion por año
$cursor						=	$periodo_facturacion->f_get_by_year($num_year);
$cmb_periodo_facturacion	=	$obj_listbox->f_crear_lista($cursor,$_REQUEST['cod_periodo_facturacion']);


// combo de las entidades 
/*$cursor						=	$entidad->f_get_activos();
$cmb_entidad				=	$obj_listbox->f_crear_lista($cursor,$_REQUEST['cod_entidad_cmb']);*/


// combo de las entidades MULTIPLES
$cursor								=	$entidad->f_get_by_factura($string_entidad);
$cmb_entidad_multiple				=	$obj_listbox->f_crear_lista_multiple($cursor);


// combo del separador para el texto plano
$cursor						=	$separador_txt->f_get_activos();
$cmb_separador_txt			=	$obj_listbox->f_crear_lista($cursor,$_REQUEST['cod_separador']);


//=== Evalua algun java script especifico para esta tabla y codigo de navegacion >>>
$row_js_personalizado	= $tabla_autonoma_personalizado->f_get_row($cod_tabla,$cod_navegacion);
if($row_js_personalizado['txt_js'])		$js_navegacion = "../../js/".$row_js_personalizado['txt_js'];
else									$js_navegacion = "../../js/ver_default_script_tabla_autonoma.js";

?>