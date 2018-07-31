<?php
/*===== 2016/02/10 =======================================D E C K===>>>>
DESCRIPCION: 	Contiene diferentes funciones realcionadas la tabla pedido_compra
PROPIETARIO:	© Luis Prieto
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
HISTORIAL DE MODIFICACIONES
---------------------------------------------------------------------------					
FECHA	AUTOR		MODIFICACION
===========================================================================*/
if(class_exists('pedido_compra') != true){

	class pedido_compra{
		/*===== 2016/04/05 =======================================D E C K===>>>>
		DESCRIPCION: 	Anula un pedido/compra realizado con anteriordad y resta las
						cantidades compradas de insumos
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		HISTORIAL DE MODIFICACIONES
		---------------------------------------------------------------------------					
		FECHA			AUTOR			MODIFICACION
		2016/04/05		Luis Prieto		Creacion de la fuincion
		===========================================================================*/
		function p_anular_pedido($cod_pedido_compra){
			if(!$cod_pedido_compra)return false;
			global $db;

			$entrada_insumo = new entrada_insumo();
			
			//informacion del pedido
			$row_pedido = $this->f_get_row($cod_pedido_compra);

			//detalle del pedido
			$query = "select 	cod_insumo,
								cantidad 
						from 	pedido_detalle_compra 
						where 	cod_pedido_compra = ".$cod_pedido_compra;
						
			$cursor_detalle = $db->consultar($query);

			// traigo en vector la cantidad actual de los insumos relacionados al pedido
			$query = "select cod_insumo,num_cantidad 
						from insumo where cod_insumo in (
															select cod_insumo 
															from pedido_detalle_compra 
															where cod_pedido_compra = ".$cod_pedido_compra."
														)";
			$cursor_stock = $db->consultar($query);

			// ingresa en vector donde e indice es el insumo y su valor el stock en la base de datos
			$arr_insumo_stock = array();
			while($row_insumo_stock=$db->sacar_registro($cursor_stock)){
				$cod_insumo 	= $row_insumo_stock['cod_insumo'];
				$num_stock		= $row_insumo_stock['num_cantidad'];

				$arr_insumo_stock[$cod_insumo] = $num_stock;
			} // fin while

			
			// recorre el cursor detalle por detalle para validar si no existe error
			$error = 0;
			$arr_insumo_detalle = array();
			$indice = 0; // indice
			while($row_detalle = $db->sacar_registro($cursor_detalle)){

				$cod_insumo 	= $row_detalle['cod_insumo'];
				$num_restar		= $row_detalle['cantidad'];

				// debe verificar si el insumo posee la cantidad que se desea restar
				$num_stock = $arr_insumo_stock[$cod_insumo];				

				// si la cantidad a retirar es mayor a la existente en bodega no se puede realizar la anulacion
				if($num_restar>$num_stock){
					$error++;
				}

				// almacena los insumos en un vector para ser utilizados despues
				//array_push($cod_insumo,$arr_insumo_detalle);
				$arr_insumo_detalle[$indice]['cod_insumo'] = $cod_insumo;
				$arr_insumo_detalle[$indice]['num_restar'] = $num_restar;



				$indice++;

			} // fin while

			
			// no se detecto ningun error de calculos 
			if($error == 0){
				for($i=0;$i<count($arr_insumo_detalle);$i++){
					$cod_insumo 	= $arr_insumo_detalle[$i]['cod_insumo'];
					$num_restar		= $arr_insumo_detalle[$i]['num_restar'];

					$query = "update 	insumo 
								set 	num_cantidad = num_cantidad - ".$num_restar." 
								where 	cod_insumo = ".$cod_insumo;

					$db->consultar($query);
				} // fin for

				// ACTUALIZA EL ESTADO DEL PEDIDO
				$query = "update pedido_compra 
							set cod_estado_pedido_compra = 3 
							where cod_pedido_compra = ".$cod_pedido_compra;
				$db->consultar($query);

				// llama a funcion para anular la entradas de insumo
				$entrada_insumo->p_anula_entrada($cod_pedido_compra);

				return 1;

			}else return 0; // retorna error
 

		} // fin funcion


		/*===== 2016/02/10 =======================================D E C K===>>>>
		DESCRIPCION: 	Retorna informacion de un registro especifico
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		HISTORIAL DE MODIFICACIONES
		---------------------------------------------------------------------------					
		FECHA			AUTOR			MODIFICACION
		2014/09/30		Luis Prieto		Creacion de la fuincion
		===========================================================================*/
		function f_get_row($cod_pedido_compra){
			if(!$cod_pedido_compra)return false;
			global $db;
			
			$query = "select * from pedido_compra where cod_pedido_compra  = $cod_pedido_compra";

			$row = $db->consultar_registro($query);
			
			return $row;
		} // fin funcion

		/*===== 2016/02/10 =======================================D E C K===>>>>
		DESCRIPCION: 	Actualiza el estado de un pedido especificp
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		HISTORIAL DE MODIFICACIONES
		---------------------------------------------------------------------------					
		FECHA			AUTOR			MODIFICACION
		2014/09/30		Luis Prieto		Creacion de la fuincion
		---------------------------------------------------------------------------
		===========================================================================
		PARAMETROS
		===========================================================================
		cod_pedido_compra => codigo pk del pedido en cuestion que se actualizara
		cod_estado_pedido => codigo del estado  
								1 = REGISTRADO
								2 = INGRESADO
								3 = ANULADO
		===========================================================================*/
		function p_update_estado($cod_pedido_compra,$cod_estado_pedido){
			if(!$cod_pedido_compra || !$cod_estado_pedido)return false;
			global $db;
			
			$query = "update 	pedido_compra set cod_estado_pedido_compra = ".$cod_estado_pedido."
						where 	cod_estado_pedido_compra not in (3) 
						and 	cod_pedido_compra = ".$cod_pedido_compra; 

			
			if($db->consultar($query))return true;
			else return fasle;


		} // fin funcion

		/*===== 2016/03/02 =======================================D E C K===>>>>
		DESCRIPCION: 	Consulta y retorna el numero de entradas que genero un pedido de compra
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		HISTORIAL DE MODIFICACIONES
		---------------------------------------------------------------------------					
		FECHA			AUTOR			MODIFICACION
		2016/03/02		Luis Prieto		Creacion de la fuincion
		---------------------------------------------------------------------------
		===========================================================================
		PARAMETROS
		===========================================================================
		$cod_pedido_compra  ==>  codigo pk del pedido que se desea guardar
		===========================================================================*/
		function f_get_count_entrada($cod_pedido_compra){
			if(!$cod_pedido_compra)return false;
			global $db;

			$query = "select count(*) as num from entrada_insumo where cod_pedido_compra = ".$cod_pedido_compra;
			$row = $db->consultar_registro($query);

			$num = $row['num'];

			return $num;
			

			

		} // fin funcion

	} // fin clase
} // fin validacion