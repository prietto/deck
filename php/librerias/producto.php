<?php
/*===== 2014/07/10 =======================================D E C K===>>>>
DESCRIPCION: 	Contiene diferentes funciones realcionadas la tabla pedido
PROPIETARIO:	© Luis Prieto
AUTOR:			Cristian Arellano
---------------------------------------------------------------------------					
HISTORIAL DE MODIFICACIONES
---------------------------------------------------------------------------					
FECHA	AUTOR		MODIFICACION
===========================================================================*/
class producto{

	var $cod_producto;

	/*===== 2014/10/13 =========================================>>>>
	DESCRIPCION: 		Metodo para actualizar cantidades de los productos segun array del pedido
	AUTOR:				Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO				DESCRIPCION 
	===========================================================================*/
	function f_get_ultimos_movimientos($num_limit=10){
		global $db;

		$query = "
					(
						select 	ep.cod_producto, 
								ep.num_cantidad,
								ep.fec_registro,
								'Entrada Producto' as txt_concepto,
								eep.txt_nombre as txt_estado,
								ep.cod_entrada_producto as id_concepto
						from 	entrada_producto ep,
								estado_entrada_producto eep
						
						where 	ep.cod_producto = ".$this->cod_producto."
						and		ep.cod_estado_entrada_producto = eep.cod_estado_entrada_producto

					)union all(
						select 	pd.cod_producto,
								pd.cantidad as num_cantidad,
								p.fec_registro,
								'Salida Producto' as txt_concepto,
								ep.txt_nombre as txt_estado,
								p.cod_pedido as id_concepto
						from 	pedido_detalle pd,
								pedido p,
								estado_pedido ep
						where 	pd.cod_producto = ".$this->cod_producto."
						and		p.cod_estado_pedido not in (3)
						and		p.ind_bloqueado = 0
						and		pd.cod_pedido = p.cod_pedido
						and		ep.cod_estado_pedido = p.cod_estado_pedido
					)
						order by fec_registro desc limit 0,".$num_limit;
						
		$cursor = $db->consultar($query);

		return $cursor;

	}

	/*===== 2014/10/13 =========================================>>>>
	DESCRIPCION: 		Metodo para actualizar cantidades de los productos segun array del pedido
	AUTOR:				Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO				DESCRIPCION 
	===========================================================================*/
	function f_get_cantidad_by_pedido($cod_producto,$cod_pedido){
		
		if(!$cod_pedido || !$cod_producto)return false;
		global $db;
		
		$query  = "
			select  p.cod_producto,
                p.num_cantidad as cantidad_bodega,
                pd.cantidad as cantidad_pedido
                
        from    producto  p left join  pedido_detalle pd on 
               (p.cod_producto = pd.cod_producto  and pd.cod_pedido = $cod_pedido)
        where p.cod_producto = $cod_producto";

		$row = $db->consultar_registro($query);

		$cantidad_bodega 	= $row['cantidad_bodega'];
		$cantidad_pedido	= $row['cantidad_pedido'];
		
		$cantidad_final  = $cantidad_bodega + $cantidad_pedido;
		
		return $cantidad_final;
		
		
	}
	
	
	/*===== 2014/07/10 =========================================>>>>
	DESCRIPCION: 		Metodo para actualizar cantidades de los productos segun array del pedido
	AUTOR:				Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO				DESCRIPCION 
	===========================================================================*/
	function p_update_cantidades($var_request){
		global $db;

		
		$arr_pedido_detalle 	= $var_request['cod_pedido_detalle'];
		$arr_producto			= $var_request['cod_producto'];
		$arr_cantidad			= $var_request['cantidad'];
		
		$cod_pedido				= $var_request['cod_pedido'];
		$query = "select cod_pedido_detalle from pedido_detalle where cod_pedido = $cod_pedido";
		$cursor = $db->consultar($query);
		$arr_pedido_detalle_db = array();
		
		while($row=$db->sacar_registro($cursor)){
			$cod_pedido_detalle_db = $row['cod_pedido_detalle'];
			array_push($arr_pedido_detalle_db,$cod_pedido_detalle_db);
		}
		
		
		for($i=0;$i<count($arr_pedido_detalle);$i++){ 
			$cod_pedido_detalle 	= $arr_pedido_detalle[$i];
			$cod_pedido_detalle_db	= $arr_pedido_detalle_db[$i];
			if($cod_pedido_detalle == NULL && $cod_pedido_detalle_db != NULL){
				$cod_pedido_detalle = $cod_pedido_detalle_db;			
			}
			$cod_producto		= $arr_producto[$i];
			$cantidad_post		= $arr_cantidad[$i];
			
			if($cod_pedido_detalle){ // si el registro esta codificado en la db
				$query = "select cantidad,ind_cant_restada from pedido_detalle where cod_pedido_detalle = $cod_pedido_detalle";
				$row_detalle 		= $db->consultar_registro($query);
				
				$ind_cant_restada 	= $row_detalle['ind_cant_restada'];
				$cantidad_db		= $row_detalle['cantidad'];
			}
			// informacion de la cantidad del producto
			$query = "select num_cantidad from producto where cod_producto = $cod_producto";
			$row_producto = $db->consultar_registro($query);
			$cantidad_prod_db = $row_producto['num_cantidad'];
			
			if($ind_cant_restada == 1){ // es decir si ya se habia hecho el calculo con este dato para la cantidad en bodega
				
				if($cantidad_db !=  $cantidad_post){ // si modifico la cantidad
					
					$cant_restante 		= $cantidad_db - $cantidad_post;
					$numero_operacion 	= abs($cant_restante); // convierte cualquier numero a positivo
					
					if($cant_restante < 0){ // resta a la cantidad del producto
					
						$num_resultado = $cantidad_prod_db - $numero_operacion;
						$query = "update producto set num_cantidad = $num_resultado where cod_producto = $cod_producto";
						$db->consultar($query);
						
					}else if($cant_restante > 0){ // suma a la cantidad en bodega
					
						$num_resultado = $cantidad_prod_db + $numero_operacion;
						$query = "update producto set num_cantidad = $num_resultado where cod_producto = $cod_producto";
						$db->consultar($query);
					}
					
				}
			}else{
				
				
				// actualiza la cantidad total en bodega del producto
				$cantidad_total = $cantidad_prod_db - $cantidad_post;
				$query = "update producto set num_cantidad = $cantidad_total where cod_producto = $cod_producto";
				
				$db->consultar($query);
				
			}
		} // fin ciclo		
	}// fin funcion
	
	/*===== 2014/07/10 =========================================>>>>
	DESCRIPCION: 		Metodo para actualizar la fecha y usuario que modifica 
	AUTOR:				Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO				DESCRIPCION 
	===========================================================================*/
	function p_update_fec_user($cod_pk,$cod_usuario){
		if(!$cod_pk)return false;
		global $db;
		
		
		//$fec_modificacion = date('Y-m-j H:m:s');
		
		$query ="update producto set 
					fec_modificacion 			= now(),
					cod_usuario_modificacion	= $cod_usuario
					where cod_producto  		= $cod_pk	";
		
		$db->consultar($query);
		
	
	}
	
	/*===== 2014/07/10 =========================================>>>>
	DESCRIPCION: 		Metodo para retornar informacion de un registro especifico
	AUTOR:				Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO			DESCRIPCION 
	$cod_pk				llave primaria del registro para realizar la consulta
	===========================================================================*/
	function f_get_row($cod_pk){
		global $db;
		
		$query = "select * from producto where cod_producto = $cod_pk";
		$row = $db->consultar_registro($query);
		return $row;
	
	}
	
}

?>