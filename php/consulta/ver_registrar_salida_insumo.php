<?
require('../librerias/insumo.php');
$insumo = new insumo();


$insumo->cod_insumo = $reg_seleccionado; // parametro
$row_insumo = $insumo->f_get_info();

?>