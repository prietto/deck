<?php
/*=====2013/12/27===================================D E C K===>>>>
DESCRIPCION: 	Contiene las atencions contra la tabla atencion
PROPIETARIO:	© D E C K
AUTOR:			Luis Prieto
===========================================================================*/
if(class_exists('pedido_detalle_compra') != true){
	class pedido_detalle_compra{
		/*===== 2016/04/05  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
		DESCRIPCION: 		Metodo para retornar el detalle de una compra
		AUTOR:				Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		-----------------------------------------------------------------------------
		HISTORIAL DE MODIFICACIONES
		AUTOR				DESCRIPCION					FECHA
		Luis Prieto			Creacion de la funcion		2016/04/05
		===========================================================================*/
		function f_get_cursor_by_pedido($cod_pedido_compra){
			if(!$cod_pedido_compra)return false;
			global $db;

			$query = "	select 	pdc.*,
								i.txt_nombre as txt_insumo
						from 	pedido_detalle_compra pdc,
								insumo i
						where 	pdc.cod_pedido_compra = ".$cod_pedido_compra."
						and 	pdc.cod_insumo = i.cod_insumo";
			
			$cursor = $db->consultar($query);

			return $cursor;



		}// fin funcion
	}// fin clase
}// if


?>