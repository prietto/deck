<?php 

$periodo_facturacion 			= new periodo_facturacion;
$obj_listbox					= new obj_listbox;
$tabla_autonoma_personalizado	= new tabla_autonoma_personalizado;
$separador_txt					= new separador_txt;
$entidad						= new entidad;
$factura						= new factura;
$nombre_archivos				= new nombre_archivos;
$sis_genericos					= new sis_genericos;	
$detalle_nombre_archivos		= new detalle_nombre_archivos;	

// cadena separada por coma de  codigos de entidades de los
// registros seleccionados
$string_entidad = $factura->f_get_entidad($reg_seleccionado);


// pregunta es que pasara cuando el usuario solamente desea generar los reportes anteriores sin actualizar
$nombre_archivos->p_crea_registro($reg_seleccionado,$_REQUEST);

?>