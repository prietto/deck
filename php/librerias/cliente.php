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
class cliente{
	/*===== 2014/11/23  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
	DESCRIPCION: 		Proceso para actualizar el estado del cliente segun el estado
						que llega como parametro
	AUTOR:				Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO			DESCRIPCION 
	$cod_cliente
	$cod_Estado
	-----------------------------------------------------------------------------
	HISTORIAL DE MODIFICACIONES
	AUTOR				DESCRIPCION					FECHA
	Luis Prieto			Creacion de la funcion		2014/11/23
	===========================================================================*/
	function p_update_estado($cod_cliente, $cod_estado){
		if(!$cod_cliente || !$cod_estado)return false;
		global $db;	
		
		$query = "update cliente set cod_estado_cliente = $cod_estado where cod_cliente = $cod_cliente	";
		if($db->consultar($query) == TRUE)return 1; // todo ok!
		else return 0; // salio mal!
		
	}
	
	
	/*===== 2014/11/23  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
	DESCRIPCION: 		Retorna informacion basica de un cliente especifico
	AUTOR:				Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO			DESCRIPCION 
	$cod_cliente
	-----------------------------------------------------------------------------
	HISTORIAL DE MODIFICACIONES
	AUTOR				DESCRIPCION					FECHA
	Luis Prieto			Creacion de la funcion		2014/11/23
	===========================================================================*/
	function p_update_estado_cuenta($cod_cliente){
		if(!$cod_cliente)return false;
		global $db;	
		
		// primero debe averiguar si tiene facturas vencidas, silas tiene su estado es "en mora" --> 3
		$query = "select count(*) as num_registros from factura where cod_estado_factura = 5 and cod_cliente = $cod_cliente";
		$row = $db->consultar_registro($query);
		$num_registros = $row['num_registros'];
		if($num_registros > 0)$this->p_update_estado($cod_cliente,3); // actualiza el estado a "En mora"
		else{ // si no 
			// === AVERIGUA SI TIENE PAGOS PENDIENTES DE FACTURA====
			$query = " select count(*) as num_registros
						 from   pedido p, 
								factura f
						 where  val_saldo is not null 
						 and    val_saldo > 0 
						 and    f.cod_cliente = $cod_cliente
						 and    f.cod_factura = p.cod_factura";
			$row = $db->consultar_registro($query);
			$num_registros = $row['num_registros'];
			if($num_registros > 0)$this->p_update_estado($cod_cliente,2); // actualiza el estado a "Pendiente Pago"
			else{ // si no encontro facturas, verifica pedidos para ver si apenas compro o q
				// === AVERIGUA SI TIENE PAGOS PENDIENTES DE PEDIDOS ====
				$query = "select count(*) as num_registros
						 from   pedido p
						where  	val_saldo is not null 
						 and    val_saldo > 0 
						 and	p.cod_factura is null
						 and    p.cod_cliente = $cod_cliente";
						 
				$row = $db->consultar_registro($query);
				$num_registros = $row['num_registros'];
				if($num_registros > 0)$this->p_update_estado($cod_cliente,2); // actualiza el estado a "Pendiente Pago"
				else if($num_registros == 0){ // si no encontro nada pendiente ni en mora entonces esta en paz y salvo
					$this->p_update_estado($cod_cliente,1); // actualiza el estado a "En mora"
				}
			}
		}

	} // fin funcion
	
	/*===== 2014/11/23  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
	DESCRIPCION: 		Retorna informacion basica de un cliente especifico
	AUTOR:				Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO			DESCRIPCION 
	$cod_cliente
	-----------------------------------------------------------------------------
	HISTORIAL DE MODIFICACIONES
	AUTOR				DESCRIPCION					FECHA
	Luis Prieto			Creacion de la funcion		2014/11/23
	===========================================================================*/
	function f_get_row($cod_cliente){
		if(!$cod_cliente)return false;
		global $db;	
		
		$query = "   select * from cliente where cod_cliente = $cod_cliente ";	
		$row = $db->consultar_registro($query);

		return $row;
		
	}
	
	/*===== 2014/10/13  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
	DESCRIPCION: 		Retorna informacion detallada del cliente
	AUTOR:				Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO			DESCRIPCION 
	$cod_cliente
	-----------------------------------------------------------------------------
	HISTORIAL DE MODIFICACIONES
	AUTOR				DESCRIPCION					FECHA
	Luis Prieto			Creacion de la funcion		2014/11/16
	===========================================================================*/
	function f_get_row_detallado($cod_cliente){
		if(!$cod_cliente)return false;
		global $db;
		
		
		$query = "     
			select    c.*,
					  ti.txt_nombre_corto as txt_tipo_identificacion,
					  ec.txt_nombre as txt_estado_cliente     ,
					  tc.txt_nombre as txt_tipo_cliente       ,
					  r.txt_nombre as txt_regimen           
			  from    cliente             c left join regimen r on (c.cod_regimen             = r.cod_regimen	) ,
					  tipo_identificacion ti,
					  estado_cliente      ec,
					  tipo_cliente        tc

					  
			  where   c.cod_tipo_identificacion = ti.cod_tipo_identificacion
			  and     c.cod_estado_cliente      = ec.cod_estado_cliente
			  and     c.cod_tipo_cliente        = tc.cod_tipo_cliente
			  and	  c.cod_cliente				= $cod_cliente		  ";
			  

		
		$row = $db->consultar_registro($query);

		return $row;
		
	}
	
}


?>