<?
include('../librerias/parametro_sistema.php');
include('../librerias/estado_factura.php');
include('../librerias/estado_pedido.php');

$parametro_sistema  = 	new parametro_sistema();
$estado_factura		=	new estado_factura();
$estado_pedido		=	new estado_pedido();


// guarda los datos de la configuracion del sistema
if($parametro_sistema->p_update_registro_vector($_REQUEST)){
	$mensaje_1 = "<div style='text-align:center; background-color:green; color:white;'>Se guardaron los cambios exitosamente</div>";
}else $mensaje_1 = "<div style='text-align:center; background-color:red; color:white;'>No se lograron guardar los cambios</div>";

// guarda el color para los estado de las factura
if($estado_factura->p_update_color_vector($_REQUEST)){
	$mensaje_2 = "<div style='text-align:center; background-color:green; color:white;'>Se guardaron los cambios exitosamente</div>";
}else $mensaje_2 = "<div style='text-align:center; background-color:red; color:white;'>No se lograron guardar los cambios</div>";

// actualiza el color para los estados de los pedido (REPORTES)
if($estado_pedido->p_update_color_vector($_REQUEST)){
	$mensaje_3 = "<div style='text-align:center; background-color:green; color:white;'>Se guardaron los cambios exitosamente</div>";
}else $mensaje_3 =  "<div style='text-align:center; background-color:red; color:white;'>No se lograron guardar los cambios</div>";


//exec('net use LPT1 \\USER\printer /persistent:yes');



?>