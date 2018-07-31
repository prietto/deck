<?php
$factura			=	new factura;
$guarda_impuesto	= 	new guarda_impuesto;


//asigna descuento a las facturas seleccionadas
$guarda_impuesto->p_guardar_impuestos($reg_seleccionado,$_REQUEST);

$factura->p_modifica_impuestos($reg_seleccionado,$_REQUEST);




?>