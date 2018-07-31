<?
require('../librerias/salida_insumo.php');
require('../librerias/insumo.php');
require('../librerias/sis_genericos.php');


$salida_insumo = new salida_insumo();
$insumo = new insumo();

// llenamos las propiedades del objeto
$salida_insumo->cod_insumo 		= $reg_seleccionado;
$salida_insumo->num_cantidad 	= $num_cantidad;
$salida_insumo->num_peso 		= $num_peso;
$salida_insumo->txt_nota 		= $txt_nota;
$salida_insumo->ind_anulado		= 0;

// llamamos la funcion
$return = $salida_insumo->p_guardar_registro();
echo json_encode($return);



?>