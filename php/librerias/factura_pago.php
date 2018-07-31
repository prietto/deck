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
class factura_pago{
	
	/*===== 2015/03/10  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
	DESCRIPCION: 		Metodo para eliminar un registro o pago realizado por un usuario
	AUTOR:				Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO			DESCRIPCION 
	$cod_factura_pago	codigo pk del pago que se quiere eliminar
	-----------------------------------------------------------------------------
	HISTORIAL DE MODIFICACIONES
	AUTOR				DESCRIPCION					FECHA
	Luis Prieto			Creacion de la funcion		2015/03/04
	===========================================================================*/
	function p_eliminar_registro($cod_factura_pago){
		if(!$cod_factura_pago)return false;
		global $db;
		
		$factura = new factura();
		
		// informacion del pago a eliminar
		$query = "select * from factura_pago where cod_factura_pago = $cod_factura_pago";
		$row_pago = $db->consultar_registro($query);
		
		$cod_factura 	= $row_pago['cod_factura'];
		$val_pago		= $row_pago['val_pago'];
		
		$query = "delete from factura_pago where cod_factura_pago = $cod_factura_pago";
		$db->consultar($query);
		
		// debe cambiar el estado de la factura puesto que ya no estaria completamente pagada
		$query = "update factura set cod_estado_factura = 1 where cod_factura = $cod_factura";
		$db->consultar($query);
		
		// debe calcular si las facturas estan vencidas
		$factura->p_update_vencimiento($cod_factura);
		
		// averigua cuanto es el nuevo valor del recibido
		$query = "select 	SUM(val_pago) as val_recbido 
					from 	factura_pago  
					where 	cod_factura = $cod_factura 
					group by cod_factura";
		$row = $db->consultar_registro($query);
		$val_recibido = $row['val_recibido'];
		if(!$val_recibido)$val_recibido = 0;
		
		// informacion de valores de la factura
		$row_valores = $factura->f_get_info_valores($cod_factura);
		$val_saldo = $row_valores['val_saldo'];
		if(!$val_saldo)$val_saldo = 0;
		
		// actualiza el valor del saldo del pedido
		$query = "update 	pedido set 
							val_saldo 		= ".$val_saldo.",
							val_recibido	= $val_recibido
					where 	cod_factura = $cod_factura";
		$db->consultar($query);
		
		if($val_saldo == 0){ // debe pagar la factura
			$factura->p_pagar_factura($cod_factura);
		}
		
		return 1;
		
	}
	
	/*===== 2015/03/04  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
	DESCRIPCION: 		Metodo para guardar la primera cuota de una factura a credito
						de acuerdo a su pedido
	AUTOR:				Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO			DESCRIPCION 
	$cod_pedido			codigo pk del pedido que se guarda
	$val_recibido		valor que el usuario ingresa
	-----------------------------------------------------------------------------
	HISTORIAL DE MODIFICACIONES
	AUTOR				DESCRIPCION					FECHA
	Luis Prieto			Creacion de la funcion		2015/03/04
	===========================================================================*/
	function f_guarda_val_recibido_pedido($cod_pedido,$val_recibido){
		if(!$cod_pedido)return false;
		global $db;
		
		// consulta el codigo de factura contra el codigo de pedido
		$query = "select cod_factura,fec_registro,cod_usuario,val_total from pedido where cod_pedido = $cod_pedido";
		$row = $db->consultar_registro($query);
		$cod_factura	= $row['cod_factura'];
		$fec_registro	= $row['fec_registro'];
		$cod_usuario	= $row['cod_usuario'];
		$val_total		= $row['val_total'];
		
		// debemos limpiar el valor de posibles comas
		$val_recibido = str_replace(',','',$val_recibido);
		
		
		
		
		if($cod_factura){
			// consulta si el registro ya existe esto para evitar duplicidad en datos
			$query = "select count(*) as num_registros from factura_pago where cod_factura = $cod_factura";
			$row_pago = $db->consultar_registro($query);
			$num_registros = $row_pago['num_registros'];
			if($num_registros == 0){
				$this->p_guardar_registro($cod_factura,$val_recibido,$cod_usuario,$fec_registro);
				
				if($val_recibido == $val_total){
					// si el valor recibido es igual al valor del pedido se dice que el pedido o factura esta pagada
					$query = "update factura set cod_estado_factura = 4 where cod_factura = $cod_factura";
					$db->consultar($query);
				}
			}
		}
		return false;
	
	}
	
	/*===== 2014/11/17  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
	DESCRIPCION: 		Proceso para guardar el registro
	AUTOR:				Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO			DESCRIPCION 
	$cod_Factura		factura a la que se le desea abonar o relizar pago
	$val_pago			Valor que el usuario ingresa
	$cod_usuario		usuario que esta conectado
	-----------------------------------------------------------------------------
	HISTORIAL DE MODIFICACIONES
	AUTOR				DESCRIPCION					FECHA
	Luis Prieto			Creacion de la funcion		2014/11/16
	===========================================================================*/
	function f_get_by_factura($cod_factura){
		if(!$cod_factura)return false;
		global $db;
		
		$query = "select 	fp.* ,
							su.txt_nombre as txt_usuario
					from 	factura_pago fp,
							seg_usuario su
					where	fp.cod_usuario = su.cod_usuario_pk
					and		fp.cod_factura = $cod_factura
					and		fp.ind_bloqueado = 0
					order by fp.fec_registro desc		";

		$cursor = $db->consultar($query);
		
		return $cursor;
	
	}
	
	/*===== 2014/11/17  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
	DESCRIPCION: 		Proceso para guardar el registro
	AUTOR:				Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO			DESCRIPCION 
	$cod_Factura		factura a la que se le desea abonar o relizar pago
	$val_pago			Valor que el usuario ingresa
	$cod_usuario		usuario que esta conectado
	-----------------------------------------------------------------------------
	HISTORIAL DE MODIFICACIONES
	AUTOR				DESCRIPCION					FECHA
	Luis Prieto			Creacion de la funcion		2014/11/16
	===========================================================================*/
	function p_guardar_registro($cod_factura,$val_pago,$cod_usuario,$fec_pago=NULL){
		if(!$cod_factura || !$val_pago || !$cod_usuario)return false;
		global $db;
		
		if(!$fec_pago)$fec_pago = 'now()';
		else $fec_pago = "'$fec_pago'";
		
		
		$query = "insert into factura_pago 
								(
									cod_factura		,
									val_pago		,
									fec_registro	,
									cod_usuario		,
									ind_bloqueado
								)VALUES(
									$cod_factura	,
									$val_pago		,
									$fec_pago		,
									$cod_usuario	,
									0							
								)";
		
		if($db->consultar($query) == true)return 1;
		else return 0;
	
	}
	
}