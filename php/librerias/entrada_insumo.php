<?php
/*===== 2016/02/10 =======================================D E C K===>>>>
DESCRIPCION: 	Contiene diferentes funciones realcionadas la tabla entrada_insumo
PROPIETARIO:	© Luis Prieto
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
HISTORIAL DE MODIFICACIONES
---------------------------------------------------------------------------					
FECHA	AUTOR		MODIFICACION
===========================================================================*/
if(class_exists('entrada_insumo') != true){

	class entrada_insumo{
		/*===== 2016/02/0 ================================================>>>>
		DESCRIPCION: 		Metodo para registrar la entrada de un insumo
		AUTOR:				Luis prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$var_request		variables que llegan por post
		===========================================================================*/
	  	function p_anula_entrada($cod_pedido_compra){
	  		if(!$cod_pedido_compra)return false;
	  		global $db;
	  		
	  		// solo asegura que exista la variable usuario
	  		$cod_usuario = $_SESSION['cod_pk_usuario'];
	  		if(!$cod_usuario)$cod_usuario = $GLOBALS['cod_usuario'];
	  		
	  		$query = "update entrada_insumo 
	  					set num_cantidad 			= 0		, 
	  					ind_anulado 				= 1		,
	  					cod_usuario_modificacion	= ".$cod_usuario."	,
	  					fec_modificacion 			= now()
	  					where cod_pedido_compra = ".$cod_pedido_compra;
	  		
	  		$db->consultar($query);
	  		
	  		return true;


	  	} // fin funcion

		/*===== 2016/02/0 ================================================>>>>
		DESCRIPCION: 		Metodo para registrar la entrada de un insumo
		AUTOR:				Luis prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$var_request		variables que llegan por post
		===========================================================================*/
	  	function p_guardar_registro($var_request){
	  		global $db;

	  		// tabla maestro
	  		$cod_proveedor 				= $var_request['cod_proveedor'];
	  		$txt_observacion			= $var_request['txt_observacion'];
	  		$fec_registro				= $var_request['fec_registro'];
	  		$cod_usuario				= $var_request['cod_usuario'];
	  		$cod_pedido_compra 			= $var_request['cod_pedido_compra'];	  		
	  		$cod_usuario_modificacion 	= $cod_usuario;
	  		$fec_modificacion			= $fec_registro;


	  		// array del detalle
	  		$arr_cod_pedido_detalle 	= $var_request['cod_pedido_detalle_compra'];
	  		$arr_cod_insumo				= $var_request['cod_insumo'];
	  		$arr_num_cantidad			= $var_request['cantidad'];
	  		$arr_val_precio_unitario	= $var_request['val_precio_unitario'];
	  		$arr_val_peso				= $var_request['num_peso'];

	  		// valida datos esenciales para el proceso
	  		if(!$cod_proveedor)return false;
			if(!$fec_registro)$fec_registro = 'now()';
	  		if(!$cod_usuario)return false;
	  		if(!$cod_pedido_compra)return false;

	  		for($i=0;$i<count($arr_cod_insumo);$i++){
	  			$cod_insumo 			= $arr_cod_insumo[$i];
	  			$num_cantidad 			= $arr_num_cantidad[$i];
	  			$num_peso				= $arr_val_peso[$i];
	  			$val_precio_unitario 	= $arr_val_precio_unitario[$i];

	  			// valida los detalles
	  			if(!$num_peso)$num_peso='NULL';

	  			if($cod_insumo != NULL && $num_cantidad > 0){
	  				// consulta contra la base de datos para crear el registro
			  		$query = "insert into entrada_insumo
			  								(
			  									cod_proveedor				,
			  									cod_insumo					,
			  									num_cantidad				,
			  									num_peso					,
			  									ind_contabilizado 			,
			  									cod_pedido_compra 			,
			  									fec_modificacion			,
			  									cod_usuario_modificacion 	,
			  									fec_registro 				,
			  									cod_usuario 				,
			  									ind_bloqueado
			  								)VALUES(
			  									".$cod_proveedor.",
			  									".$cod_insumo.",
			  									".$num_cantidad.",
			  									".$num_peso.",
			  									1,
			  									".$cod_pedido_compra.",
			  									'".$fec_modificacion."',
			  									".$cod_usuario_modificacion.",
			  									'".$fec_registro."',
			  									".$cod_usuario.",
			  									0
			  								)";
					
					if($db->consultar($query)){

						$this->p_sum_stock_insumo($cod_insumo,$num_cantidad);

					}

	  			} // if
	  		} // fin for
	  	} // fin funcion

	  	/*===== 2016/02/0 ================================================>>>>
		DESCRIPCION: 		Metodo para sumar una cantidad determinada al stock del producto 
							determinado
		AUTOR:				Luis prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$cod_producto 			codigo pk del producto en cuestion
		$num_cantidad			cantidad que se sumara al stock del producto (bodega)
		===========================================================================*/
	  	function p_sum_stock_insumo($cod_insumo,$num_cantidad){
	  		if(!$cod_insumo || $num_cantidad < 0)return false;
	  		global $db;

	  		//primero debe consultar la informacion del producto
	  		/*$query = "select num_cantidad from producto where cod_producto = ".$cod_producto;
	  		$row_producto = $db->consultar_registro($query);

	  		$num_stock = $row_producto['num_cantidad'];

	  		$num_actual = $num_stock + $num_cantidad;*/

	  		// actualiza la cantidad para el producto especifico
	  		// valida que el producto no este suspendido y no este bloqueado
	  		$query = "update insumo set 
	  					num_cantidad = (IFNULL(num_cantidad,0) + ".$num_cantidad.") 
	  					where cod_insumo = ".$cod_insumo."
	  					and ind_activo = 1
	  					and ind_bloqueado = 0";

	  		if($db->consultar($query))return true;
			else return false;






	  	} // fin funcion


	} // fin clase
} // fin IF