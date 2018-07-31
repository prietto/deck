<?php 

// conserva las variables para los filtros en caso de que devuelva
$array_request_reporte			= $sis_genericos->f_genera_variables_anteriores_v2($_REQUEST);

// retorna cursor con la informacion de los pedidos seleccionados
$cursor_pedidos = $pedido->f_get_cursor_pedidos($reg_seleccionado);




?>