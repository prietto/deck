<?
include_once("../librerias/boleteria_numerada.php");
include_once("../librerias/pedido.php");
include_once("../librerias/sis_genericos.php");
include_once("../librerias/evento.php");
include_once("../librerias/funcion.php");
include_once("../librerias/comprador.php");
include_once("../librerias/pedido.php");

$cod_pedido				= $_REQUEST['cod_pedido'];
$sis_genericos			= new sis_genericos;
$boleteria_numerada		= new boleteria_numerada;
$evento					= new evento;
$funcion				= new funcion;
$comprador				= new comprador;
$pedido					= new pedido;

//==== informacion de pedido y comprador>>>
$row_pedido				= $pedido->f_ge_row_detallado($cod_pedido);
$txt_nombre				= $row_pedido['txt_nombre'];
$txt_direccion			= $row_pedido['txt_direccion'];
$txt_telefono			= $row_pedido['txt_telefono'];
$txt_email_comprador	= $row_pedido['txt_email'];
$txt_ciudad				= $row_pedido['txt_ciudad'];
$txt_comentario			= $row_pedido['txt_nota'];
$val_envio				= $row_pedido['val_envio'];


//=== Informacion de la funcion, evento y grupo >>>
$row_funcion			= $funcion->f_ge_info_funcion_detallado($cod_pedido);
$cod_funcion			= $row_funcion['cod_funcion'];
$txt_funcion			= $row_funcion['txt_funcion'];
$txt_grupo				= $row_funcion['txt_grupo'];
$txt_nombre_evento		= strtoupper($row_funcion['txt_evento']);
$txt_grupo 				= ucwords(strtolower($row_funcion['txt_grupo']));
$fec_funcion			= $row_funcion['fec_funcion'];
$fec_funcion_largo		= $sis_genericos->f_fecha_larga_con_hora_sin_year($fec_funcion);


//=== Detalle de las sillas seleccionadas >>>
$cursor_pedido			= $boleteria_numerada->f_get_info_pedido($cod_pedido,$cod_funcion);

//=== Valor total del descuento asignado>>>
$val_total_descuento = $boleteria_numerada->f_get_total_descuento($cod_pedido);
?>