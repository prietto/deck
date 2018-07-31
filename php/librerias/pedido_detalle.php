<?php
/*===== 2014/07/10 =======================================D E C K===>>>>
DESCRIPCION: 	Contiene diferentes funciones realcionadas la tabla pedido
PROPIETARIO:	© Luis Prieto
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
HISTORIAL DE MODIFICACIONES
---------------------------------------------------------------------------					
FECHA	AUTOR		MODIFICACION
===========================================================================*/
class pedido_detalle{
	/*===== 2014/10/13  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
	DESCRIPCION: 		Proceso para modificar el valor del saldo sobre el pedido / factura
	AUTOR:				Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO			DESCRIPCION 
	$cod_pedido			Pedido que se quiere modificar
	$val_saldo			valor ingresado por el usuario
	$cod_usuario		usuario que esta conectado que ejecuta el proceso
	-----------------------------------------------------------------------------
	HISTORIAL DE MODIFICACIONES
	AUTOR				DESCRIPCION					FECHA
	Luis Prieto			Creacion de la funcion		2014/11/16
	===========================================================================*/
	function f_get_by_factura($cod_factura){
		global $db;
		
		$query = "
		
		
			select  pd.cod_pedido_detalle,
					pd.cod_pedido,
					p.cod_factura,
					pr.txt_nombre as txt_producto,
					pd.cantidad,
					pd.val_precio_unitario,
					pd.val_total,
					su.txt_nombre as txt_usuario,
					concat(c.txt_nombre,' ',c.txt_apellido) as txt_cliente,
					fp.txt_nombre as txt_forma_pago,
					ep.txt_nombre as txt_estado_pedido,
					p.fec_registro,
					um.txt_nombre as txt_unidad_medida
					
					
			from    pedido_detalle pd ,
					pedido            p,
					producto        pr,
					cliente         c,
					seg_usuario     su,
					forma_pago      fp,
					estado_pedido   ep,
					unidad_medida   um
			where   pd.cod_pedido     = p.cod_pedido
			and     pd.cod_producto   = pr.cod_producto
			and     p.cod_cliente       = c.cod_cliente
			and     p.cod_usuario       = su.cod_usuario_pk
			and     p.cod_forma_pago    = fp.cod_forma_pago
			and     p.cod_estado_pedido = ep.cod_estado_pedido
			and     pr.cod_unidad_medida = um.cod_unidad_medida
			and     p.cod_factura = $cod_factura		";
			
		$cursor = $db->consultar($query);
		
		return $cursor;
		
	}

}

?>