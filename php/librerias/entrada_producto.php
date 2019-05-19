<?php 
/*===== 2014/07/20 ==========================================>>>>
DESCRIPCION: 	Contiene diferentes funciones realcionadas la tabla entrada_producto
PROPIETARIO:	© Luis Prieto
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
HISTORIAL DE MODIFICACIONES
---------------------------------------------------------------------------					
FECHA	AUTOR		MODIFICACION
===========================================================================*/
if(class_exists('entrada_producto') != true){
	class entrada_producto{

		/*===== 2016/05/09 ================================================>>>>
		DESCRIPCION: 		Metodo retornar cursor con los registros de entradas por el empleado
		AUTOR:				Luis prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$cod_empleado		id o pk unico del empleado registrado en la base de datos
		$num_limit			ultimo numero de registros limite
		===========================================================================*/
	  	function f_get_x_empleado($cod_empleado,$num_limit = null){
	  		if(!$cod_empleado)return false;
	  		global $db;

	  		if($num_limit > 0){
	  			$condicion_extra = "limit 0,".$num_limit;
	  		}

	  		$query =  "select 	ep.*,
								pr.txt_nombre as txt_producto,
								ifnull(su.txt_nombre, su.txt_login) as txt_usuario,
								um.txt_nombre as txt_unidad_medida							
						from 	entrada_producto 	ep 	,
								unidad_medida		um	,
								seg_usuario			su	,
								producto			pr
						where 	ep.cod_empleado 		= ".$cod_empleado."
						and		um.cod_unidad_medida 	= ep.cod_unidad_medida
						and		ep.cod_usuario			= su.cod_usuario_pk	 
						and		ep.cod_producto			= pr.cod_producto
						and		ep.cod_estado_entrada_producto	= 1
						and 	ep.ind_bloqueado = 0 order by fec_registro desc ".$condicion_extra;

	  		$cursor = $db->consultar($query);
	  		return $cursor;

	  	}
		
		/*===== 2014/12/07 ================================================>>>>
		DESCRIPCION: 		Metodo para anular una entrada de producto y recalcular cantidad del producto
		AUTOR:				Luis prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$cod_entrada_producto	codigo pk unico del registro
		===========================================================================*/
	  	function p_anula_entrada($cod_entrada_producto,$cod_usuario){
			if(!$cod_entrada_producto || !$cod_usuario)return false;
			global $db;
			
			$producto =  new producto();
			$row_entrada 			= $this->f_get_row($cod_entrada_producto);
			$cod_producto			= $row_entrada['cod_producto'];
			$num_cantidad_entrada 	= $row_entrada['num_cantidad'];
			
			// INFORMACION DEL PRODUCTO RELACIONADO CON LA ENTRADA
			$row_producto 			= $producto->f_get_row($cod_producto);
			$num_cantidad_producto	= $row_producto['num_cantidad'];
			
			// si la cantidad en bodega es inferior a la de la entrada que se quiere anular no lo permite		
			if($num_cantidad_producto < $num_cantidad_entrada){ 
				return 0; // retorna el primer error
				
			}else{
				// si no si puede anular la entrada y recalcular la cntida de bodega
				$query = "update 	entrada_producto set 
									num_cantidad 				= 0				,
									cod_estado_entrada_producto = 2 			,
									cod_usuario_modificacion	= $cod_usuario	,
									fec_modificacion			= now()
							where 	cod_entrada_producto = $cod_entrada_producto";
				$db->consultar($query);
				
				// nueva cantidad del producto
				$new_cantidad = $num_cantidad_producto - $num_cantidad_entrada;
				
				// ahora actualiza la cantidad del producto restandole la cantidad de la entrada
				$query = "update producto set num_cantidad = $new_cantidad where cod_producto = $cod_producto";
				$db->consultar($query);
				
				return 1; // sin ningun error					
		
			}
		}
		
		
		/*===== 2014/12/07 ================================================>>>>
		DESCRIPCION: 		Metodo para retornar informacion de un registro unico
		AUTOR:				Luis prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$cod_entrada_producto	codigo pk unico del registro
		===========================================================================*/
	  	function f_get_row($cod_entrada_producto){
			if(!$cod_entrada_producto)return false;
			global $db;
			
			$query = "select * from entrada_producto where cod_entrada_producto = $cod_entrada_producto";

			$row = $db->consultar_registro($query);
			
			return $row;	
		
		}
		
		
		/*===== 2014/07/20 ================================================>>>>
		DESCRIPCION: 		Metodo para consultar las entradas que ha tenido un producto seleccionado
		AUTOR:				Luis prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		$cod_producto		codigo id del producto que se esta realizando la transaccion
		$num_limit			Numero limite de registros a mostrar
		===========================================================================*/
	  	function f_get_x_proveedor($cod_pk_proveedor,$num_limit=null){
	  		if(!$cod_pk_proveedor)return false;
			global $db;


	  		if($num_limit > 0){
	  			$condicion_extra = "limit 0,".$num_limit;
	  		}
			
			$query = "select 	ep.*,
								pr.txt_nombre as txt_producto,
								concat(p.txt_nombre,' ',ifnull(p.txt_apellido, '')) as txt_proveedor,
								ifnull(su.txt_nombre, su.txt_login) as txt_usuario,
								um.txt_nombre as txt_unidad_medida							
						from 	entrada_producto 	ep 	,
								proveedor 			p	,
								unidad_medida		um	,
								seg_usuario			su	,
								producto			pr
						where 	ep.cod_proveedor 		= $cod_pk_proveedor
						and		ep.cod_proveedor 		= p.cod_proveedor
						and		um.cod_unidad_medida 	= ep.cod_unidad_medida
						and		ep.cod_usuario			= su.cod_usuario_pk	 
						and		ep.cod_producto			= pr.cod_producto
						and		ep.cod_estado_entrada_producto	= 1
						and 	ep.ind_bloqueado = 0 order by fec_registro desc ".$condicion_extra;

			$cursor = $db->consultar($query);
			return $cursor;
			
		
		}
			
		
		/*===== 2014/07/20 ================================================>>>>
		DESCRIPCION: 		Metodo para consultar las entradas que ha tenido un producto seleccionado
		AUTOR:				Luis prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		$cod_producto		codigo id del producto que se esta realizando la transaccion
		$num_limit			Numero de registros limite a consultar
		===========================================================================*/
	  	function f_get_x_producto($cod_producto,$num_limit =null){
			global $db;
			if(!$cod_producto)return false;

			if($num_limit>0)$condicion_extra = "limit 0,".$num_limit;
			
			$query = "select 	ep.*,
								if(ep.cod_proveedor,concat(p.txt_nombre,' ',ifnull(p.txt_apellido, ''),' (Proveedor)') ,concat(e.txt_nombre,' ',ifnull(e.txt_apellido, ''),' (Empleado)')) as txt_proveedor,
								ifnull(su.txt_nombre, su.txt_login) as txt_usuario,
								um.txt_nombre as txt_unidad_medida	,
								eep.txt_nombre as txt_estado_entrada_producto						
						from 	(entrada_producto 	ep 	left join proveedor p on 
																	(ep.cod_proveedor = p.cod_proveedor)) 
								left join empleado e on (ep.cod_empleado = e.cod_empleado),
								unidad_medida		um	,
								seg_usuario			su	,
								estado_entrada_producto	eep
						where 	ep.cod_producto 				= ".$cod_producto." 
						and		um.cod_unidad_medida 			= ep.cod_unidad_medida
						and		ep.cod_usuario					= su.cod_usuario_pk	 
						and		ep.cod_estado_entrada_producto	= eep.cod_estado_entrada_producto
						and 	ep.ind_bloqueado = 0 
						order by fec_registro desc ".$condicion_extra;
			
			$cursor = $db->consultar($query);
			
			return $cursor;	
		
		}
		
		/*===== 2014/07/20 ================================================>>>>
		DESCRIPCION: 		Metodo para eliminar la foto de un registro de una tabla autonoma
		AUTOR:				Luis prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		$cod_producto		codigo id del producto que se esta realizando la transaccion
		$num_cantiodad		nueva cantidad ingresada por el usuario para realizar la entrada de bodega	
		===========================================================================*/
	  	function p_guardar_entrada($cod_entrada_producto,$cod_producto,$num_cantidad,$cod_usuario){
			global $db;
			if(!$cod_producto)return false;
			$producto = new producto();
					
			$row_producto 		= $producto->f_get_row($cod_producto);
			$num_cantidad_db 	= $row_producto['num_cantidad'];
			$num_cant_total 	= $num_cantidad + $num_cantidad_db;
			
			
			$row_entrada 			= $this->f_get_row($cod_entrada_producto);

			$ind_contabilizado		= $row_entrada['ind_contabilizado'];

			if($ind_contabilizado == 0 || $ind_contabilizado == NULL){
				$query = "update 	producto set 
									num_cantidad 				= $num_cant_total									
							where 	cod_producto = $cod_producto";	
							
				$db->consultar($query);	
				
				// actualiza el indicador para no volverlo a contar
				$query = "update entrada_producto set 
									ind_contabilizado = 1 							,
									cod_usuario_modificacion 	= $cod_usuario		,
									fec_modificacion 			= now() 			,
									cod_estado_entrada_producto	= 1
							where 	cod_entrada_producto = $cod_entrada_producto";

				$db->consultar($query);
				
				return true;
			}
			
			
			
		} // fin funcion
		
	} // fin clase
}// fin if



?>