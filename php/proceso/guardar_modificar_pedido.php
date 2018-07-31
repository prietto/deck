<?
include_once("../librerias/boleteria_numerada.php");
include_once("../librerias/pedido.php");

$pedido					= new pedido;
$boleteria_numerada		= new boleteria_numerada;

//==== Actualiza los datos del pedido>>>
$pedido->p_update_estado($cod_estado_pedido,$txt_nota, $cod_pedido);

// === Guarda los descuentos asignados>>
$boleteria_numerada->p_actualizar_descuento($sillas_seleccionadas,$cod_descuento);


//==== Actualiza o desvincula los datos de la boleteria numerada >>>
if($cod_estado_pedido==3) $cod_estado_boleteria = 4; //impreso
if($cod_estado_pedido==4 ||  $cod_estado_pedido==5) $cod_estado_boleteria = 4;//entregado
if($cod_estado_pedido==6 ){//Estado anulado
	//=== Deja registro de las sillas que se dejaron disponibles>>
	$texto_registro =	$boleteria_numerada->f_get_listado_eliminables($cod_pedido);
	$pedido->p_update_estado($cod_estado_pedido,$texto_registro, $cod_pedido);
	$ind_consulta_2 = true; // para que genere el reporte requerido
	$boleteria_numerada->p_desvincular_pedido($cod_pedido);
}else{
	$boleteria_numerada->p_update($cod_estado_boleteria,0,$cod_pedido);
}
$_REQUEST['cod_estado_pedido'] 	= NULL;
$ind_buscar						= 1;
?>