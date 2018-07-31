<?php 
$factura			=	new factura;
$pedido				=	new pedido();
$sis_genericos		=	new sis_genericos();

$factura->p_update_estado_impresa($reg_seleccionado,$_REQUEST);




?>