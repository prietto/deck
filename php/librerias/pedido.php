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
class pedido{
	

	
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
	function p_update_val_saldo($cod_pedido,$val_saldo,$cod_usuario,$fec_pago_factura=NULL){
		if(!$cod_pedido || !$val_saldo || !$cod_usuario)return false;
		global $db;
		
		$cliente 		= new cliente();
		$factura_pago 	= new factura_pago();

		// limpiar el dato ingresado por el usuario
		$val_saldo_post = str_replace(',','',$val_saldo);
		$val_saldo_post = $db->real_escape_string($val_saldo_post);

				
		// debe consultar cual es el saldo actual del pedido
		$query = "select val_saldo,cod_factura,cod_cliente,val_recibido,val_total 
					from pedido where cod_pedido = $cod_pedido";
		$row = $db->consultar_registro($query);
		
		$cod_factura		= $row['cod_factura'];
		$val_saldo_db 		= $row['val_saldo'];
		$cod_cliente		= $row['cod_cliente'];
		$val_recibido_db	= $row['val_recibido'];
		$val_total_pedido	= $row['val_total'];

		if($val_saldo_post > $val_saldo_db)return 0; // validar en php por si algo, igual ya lo valida en pantalla
		
		// registra el pago que ingresa el usuario
		$factura_pago->p_guardar_registro($cod_factura,$val_saldo_post,$cod_usuario,$fec_pago_factura);

		// para averiguar el saldo se consulta la tabla factura pago depues de haber registrado el pago
		$query = "select SUM(val_pago) as val_pagado 
					from factura_pago where cod_factura = $cod_factura group by cod_factura";
		$row_pago =  $db->consultar_registro($query);
		$new_val_recibido = $row_pago['val_pagado'];

		// el valor del saldo nuevo es la resta entre el valor total menos el valor recibido
		$new_val_saldo 	= $val_total_pedido - $new_val_recibido;
				
		// valor del nuevo saldo a guardar para la factura
		//$new_val_saldo 		= $val_saldo_db - $val_saldo_post;
		
		$query = "update pedido set 
					val_saldo 		= $new_val_saldo ,
					val_recibido	= $new_val_recibido
					where cod_pedido = $cod_pedido";		

		if($db->consultar($query) == true){
			if($val_saldo_post == $val_saldo_db){ // si son iguales los valores entonces la facutra se paga totalmente
				$query = "update factura set cod_estado_factura = 4 where cod_factura = $cod_factura";
				$db->consultar($query);
			}
			
		
			// actualiza el estado de cuenta del cliente despues de efectuar un pago
			$cliente->p_update_estado_cuenta($cod_cliente);
			return 1;
		}
		
		
			
	}
	
	
	/*===== 2014/10/13  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
	DESCRIPCION: 		Retorna informacion del pedido que se quiere consultar
	AUTOR:				Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO			DESCRIPCION 
	$cod_pedido			Pedido que se quiere consultar
	-----------------------------------------------------------------------------
	HISTORIAL DE MODIFICACIONES
	AUTOR				DESCRIPCION					FECHA
	Luis Prieto			Creacion de la funcion		2014/11/16
	===========================================================================*/
	function f_get_row_detallado($cod_pedido){
		if(!$cod_pedido)return false;
		global $db;
		
		
		$query = "select 	p.*,
							concat(c.txt_nombre,' ',c.txt_apellido) as txt_cliente,
							c.num_identificacion ,
							fp.txt_nombre as txt_forma_pago,
							ep.txt_nombre as txt_estado_pedido,
							su.txt_nombre as txt_usuario,
							ti.txt_nombre_corto as txt_tipo_identificacion
					from 	pedido 	p			,
							cliente c			,
							forma_pago fp		,
							estado_pedido ep	,
							seg_usuario su		,
							tipo_identificacion ti
					where  	p.cod_pedido		= $cod_pedido
					and		p.cod_cliente		= c.cod_cliente	
					and		p.cod_forma_pago 	= fp.cod_forma_pago
					and		p.cod_estado_pedido	= ep.cod_estado_pedido
					and		p.cod_usuario		= su.cod_usuario_pk	
					and		c.cod_tipo_identificacion = c.cod_tipo_identificacion

					";

		$row = $db->consultar_registro($query);
		
		return $row;
		
	}
	
	/*===== 2014/10/13  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
	DESCRIPCION: 		Retorna informacion del pedido a partor del codigo de factura
	AUTOR:				Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO			DESCRIPCION 
	$cod_factura		factura que se consultara
	-----------------------------------------------------------------------------
	HISTORIAL DE MODIFICACIONES
	AUTOR				DESCRIPCION					FECHA
	Luis Prieto			Creacion de la funcion		2014/11/16
	===========================================================================*/
	function f_get_row_by_factura($cod_factura){
		if(!$cod_factura)return false;
		global $db;
		
		
		$query = "select * from pedido where  cod_factura = $cod_factura";
		$row = $db->consultar_registro($query);
		
		return $row;
		
	}
	
	
	/*===== 2014/10/13  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
	DESCRIPCION: 		Retorna el numero de detalles que tiene la factura
	AUTOR:				Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO			DESCRIPCION 
	$cod_factura		factura que se consultara
	===========================================================================*/
	function f_get_count_detalle($cod_pedido){
		if(!$cod_pedido)return false;
		global $db;

		$query = " 
				select  count(pd.cod_pedido_detalle) as num_registros
				from 	pedido			p,
						pedido_detalle  pd
				where 	p.cod_pedido in ($cod_pedido)
				and   	pd.cod_pedido = p.cod_pedido";
				
		$row = $db->consultar_registro($query);
		$num_registros = $row['num_registros'];
		
		return $num_registros;
		
	}	
	
	/*===== 2014/10/08 =======	illili_d[^.^]b_ililli =============>>>>
	DESCRIPCION: 		Retorna cursor de los pedidos seleccionados 			
	AUTOR:				Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO			DESCRIPCION 
	$reg_seleccionado		vector de codigos de pedidos 
	===========================================================================*/
   	function f_get_cursor_by_reg($reg_seleccionado){
		global $db;
		
		if(count($reg_seleccionado)==0)return false; // si no hay registros seleccionados
		
		$string_pedidos = implode(',',$reg_seleccionado);
		
		//$query = "select *  from pedido where cod_pedido in ($string_pedidos)";
		
		$query=" 
				select 	p.cod_pedido,
						p.fec_registro,
						concat(c.txt_nombre,' ',c.txt_apellido) as txt_cliente ,
						c.txt_direccion as txt_direccion_cliente,
						c.txt_telefono as txt_telefono_cliente,
						c.num_identificacion as num_identificacion_cliente,
						ep.txt_nombre as txt_estado_factura,
						if(p.val_negociado,p.val_negociado,p.val_total) as val_total_factura,
						pd.cod_pedido_detalle			,
						pd.cantidad						,
						pd.val_precio_unitario			,
						pd.val_total as val_total_linea	,
						pr.cod_producto 				,
						concat(pr.txt_nombre,' (',um.txt_nombre,')') as txt_producto,
						fp.txt_nombre as txt_forma_pago	,
						fp.num_dias as num_dias_forma_pago		,
						su.txt_nombre as txt_usuario			

						         
			from 	cliente			c,
					estado_pedido 	ep,
					pedido			p,
					pedido_detalle  pd,
				  	producto        pr,
					forma_pago		fp,
					seg_usuario		su,
					unidad_medida	um
					
			where 	p.cod_pedido in ($string_pedidos)
			and		c.cod_cliente			= p.cod_cliente
			and		ep.cod_estado_pedido 	= p.cod_estado_pedido
			and   	pd.cod_pedido 			= p.cod_pedido
			and   	pr.cod_producto 		= pd.cod_producto
			and 	p.cod_forma_pago 		= fp.cod_forma_pago
			and		p.cod_usuario			= su.cod_usuario_pk
			and		um.cod_unidad_medida	= pr.cod_unidad_medida
			
			order by p.cod_pedido asc";
		
		$cursor = $db->consultar($query);
		
		return $cursor;
	
	}
	
	/*===== 2014/10/08 =======	illili_d[^.^]b_ililli =============>>>>
	DESCRIPCION: 	Retorna codigos de facturas de los 
					pedidos seleccionados que ya fueron facturados					
	AUTOR:			Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO			DESCRIPCION 
	$array_pedidos		vector de codigos de pedidos 
	===========================================================================*/
   	function f_get_cod_facturas($array_pedidos){
		if(empty($array_pedidos))return false;
		global $db;
		$string_pedidos = implode(',',$array_pedidos);
		
		$query = "select cod_factura from pedido where cod_pedido in ($string_pedidos) 
					and cod_factura is not null order by cod_factura asc";
		$cursor = $db->consultar($query);
		
		$array_facturas = array();
		while($row=$db->sacar_registro($cursor)){
			$cod_factura = $row['cod_factura'];
			array_push($array_facturas,$cod_factura);
		}
		
		return $array_facturas;
		
	
	}
	
	
	/*===== 20131228 =======	illili_d[^.^]b_ililli ========D E C K===>>>>
	DESCRIPCION: 	Asigna un codigo de factura a uno o muchas atenciones
	AUTOR:			Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO			DESCRIPCION 
	$cod_atenciones		Codigos de atencion separados por coma
	$cod_factura		codigo para actualizar
	$ind_null=true		por defecto solo actualiza los datos de factura que esten en null
	===========================================================================*/
   	function p_update_cod_factura($cod_pedido,$cod_factura, $ind_null=true){
		global $db;
		if(!$cod_pedido || !$cod_factura)return false;
		
		$sis_genericos 	= new sis_genericos();
		$factura 		= new factura();
		$factura_pago	= new factura_pago();
		
		//$autorizacion = new autorizacion;
		
		$condicion_adicional = "";
		if($ind_null==true) $condicion_adicional = ' and cod_factura is null';

		$fec_vencimiento = 'NULL'; // inicializamos la variable en nula
		
		// saca informacion del pedido para saber si tiene fecha de vencimiento
		$row_pedido = $this->f_get_row($cod_pedido);
		$cod_forma_pago 		= $row_pedido['cod_forma_pago'];
		$fec_registro_pedido 	= $row_pedido['fec_registro'];
		$val_recibido			= $row_pedido['val_recibido'];

		$query 			= "select num_dias from forma_pago where cod_forma_pago = $cod_forma_pago";
		$row 					= $db->consultar_registro($query);
		$num_dias 				= $row['num_dias'];
	
		$query="update 	pedido set 
						cod_factura 		= $cod_factura	,
						cod_estado_pedido	= 4				
				where 	cod_pedido in($cod_pedido)	
				$condicion_adicional
				";
				
		if($db->consultar($query) == TRUE){
			if($num_dias>0){ // la forma de pago tiene dias para vencerse
				$fec_vencimiento = $sis_genericos->sumar_dias_habiles($fec_registro_pedido,$num_dias);
				$factura->p_update_fec_vencimiento($fec_vencimiento,$cod_factura);
			}
		}
		

		//crea el primer pago en la tabla factura pago
		$factura_pago = $factura_pago->f_guarda_val_recibido_pedido($cod_pedido,$val_recibido);
		
		// consulta a partir de las atenciones las autorizaciones y las asocia con la factura
		//$string_autrcnes = $autorizacion->f_get_by_atencion($cod_atenciones);
		
		
		//actualiza las autorizaciones añadiendole el codigo de factura al que finalmente  pertenecera
		//$autorizacion->p_actualiza_cod_factura($string_autrcnes,$cod_factura);
		
	}
	
	/*===== 2014/09/30 =======================================D E C K===>>>>
	DESCRIPCION: 	Retorna informacion de los pedidos seleccionados relacionando el parametro
					de si es permitido varios pedidos por factura o un soplo pedido por factura
	AUTOR:			Luis Prieto
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA			AUTOR			MODIFICACION
	2014/09/30		Luis Prieto		Creacion de la fuincion
	===========================================================================*/
	function f_get_cursor_to_fact($reg_seleccionado,$ind_varios_pedidos_x_factura=NULL){
		if(empty($reg_seleccionado))return false; // si el vector que trae los registros seleccionados esta vacio frena 
		if($ind_varios_pedidos_x_factura == NULL){$ind_varios_pedidos_x_factura == 0;}		
		global $db;
		
		
		$string_pedidos = implode(',',$reg_seleccionado);
		
		// para cuando se active esta funcionalidad
		/*if($ind_varios_pedidos_x_factura == 0){
			$query = "select * from pedido where cod_pedido in ($string_pedidos) order by cod_cliente asc";			
		}*/
		
		$query = "select * from pedido 
					where 	cod_pedido in ($string_pedidos) 
					and 	cod_factura is null 
					order by cod_pedido asc;";

		$cursor = $db->consultar($query);
		$num_registros = $db->num_registros($cursor);
		
		if($num_registros == 0)return false;
		
		return $cursor;
		
		
		
	}
	
	/*===== 2014/07/10 =======================================D E C K===>>>>
	DESCRIPCION: 	Retorna informacion de un registro especifico
	AUTOR:			Luis Prieto
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA			AUTOR			MODIFICACION
	2014/09/30		Luis Prieto		Creacion de la fuincion
	===========================================================================*/
	function f_get_row($cod_pedido){
		global $db;
		
		$query = "select * from pedido where cod_pedido  = $cod_pedido";

		$row = $db->consultar_registro($query);
		
		return $row;
	}
	
	
	/*	====== 2014/09/13  ========= ıllılı_d[^.^]b_ılıllı  ==== D E C K======>>>
	DESCRIPCION: 	Valida los pedidos seleccionados se puedan facturar y devuelve cadena 
					separada por coma
	AUTOR:			Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO				DESCRIPCION 
	$reg_seleccionado		registros seleccionados
	$cod_estado				estado contra el que se quiere validar
	===========================================================================*/
	function f_valida_multiple_estado($reg_seleccionado,$string_cod_estado){
		global $db;	
		if(!$reg_seleccionado)return false;
		
		$cadena_registros = implode(',',$reg_seleccionado);
		$arr_cod_estado = explode(',',$string_cod_estado);
		
		$array_estado_pedido = array();
		$arr_pedidos = array(); // array que almacenara las autorizaciones invalidas
		for($i=0;$i<count($reg_seleccionado);$i++){
			
			$cod_pedido = $reg_seleccionado[$i];
			$row_pedido = $this->f_get_row($cod_pedido);

			$cod_estado_pedido	= $row_pedido['cod_estado_pedido'];
			

			if(in_array($cod_estado_pedido, $arr_cod_estado)){// si el estado del pedido esta dentro de los estados en elo array
			//if($cod_estado_pedido == $cod_estado){ // si el estado de la autorizacion es diferente al pasado por parametro
				array_push($arr_pedidos,$cod_pedido);
				array_push($array_estado_pedido,$cod_estado_pedido);
				
			}
		}

		
				
		if($arr_pedidos){
			$string_pedidos = implode(',',$arr_pedidos);
			$string_estado_pedido = implode(',',$array_estado_pedido);
			$query = "select GROUP_CONCAT(concat(' ',txt_nombre)) as txt_nombre 
						from estado_pedido where  cod_estado_pedido in ($string_estado_pedido)";
			$row = $db->consultar_registro($query);
			$string_nom_estado = $row['txt_nombre'];
			return $string_nom_estado;
		}else{
			return false;		
		}
	}
	
	
	/*===== 2014/08/18 ======================================================>>>>
	DESCRIPCION: 	Metodo para modificar el estado de pedidos que llegan como vector
	---------------------------------------------------------------------------					
	PARAMETRO				DESCRIPCION 
	$arr_row				vector con los codigos de pedidos
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA			AUTOR			MODIFICACION
	2014/08/18		Luis Prieto		Creacion de la funcion
	===========================================================================*/
	function p_modificar_estado_array($arr_row,$cod_estado_pedido){
		if(empty($arr_row) || !$cod_estado_pedido)return false;
		global $db;
		
		
		$arr_row = array_filter($arr_row); // limpia las posiciones nulas del vector
		$string_pedido = implode(',',$arr_row);	
		
		$query = "update pedido set cod_estado_pedido = $cod_estado_pedido where cod_pedido in ($string_pedido)";
		$db->consultar($query);
	
	}
	
	
	/*===== 2014/08/18 ======================================================>>>>
	DESCRIPCION: 	Metodo para modificar un registro en este caso un pedido
	---------------------------------------------------------------------------					
	PARAMETRO				DESCRIPCION 
	$var_request			variables por post
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA			AUTOR			MODIFICACION
	2014/08/18		Luis Prieto		Creacion de la funcion
	===========================================================================*/
	function p_modificar_registro($var_request){
		global $db;
		
		$sis_genericos = new sis_genericos();
		
		$val_real 			= $var_request['val_real'];
		$val_negociado		= $var_request['val_negociado'];
		$cod_pedido			= $var_request['cod_pk'];
		
		if(!$cod_pedido)return false;
		
		if($val_negociado > 0){
			$val_total 		= $val_negociado;
		}else if(!$val_negociado){
			$val_total 		= $val_real;
		}
		
		$val_total = $sis_genericos->p_elimina_coma($val_total);
		
		$query = "update 	pedido set 
							val_total = $val_total
							
					where cod_pedido = $cod_pedido";
		

		
		$db->consultar($query);
		
		
	}

	/*===== 2014/08/18 ======================================================>>>>
	DESCRIPCION: 	Metodo para retornar informacion de pedidos seleccionados
	---------------------------------------------------------------------------					
	PARAMETRO				DESCRIPCION 
	$reg_seleccionado		Pedidos seleccionados por el usuario
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA			AUTOR			MODIFICACION
	2014/08/18		Luis Prieto		Creacion de la funcion
	===========================================================================*/
	function f_get_cursor_pedidos($reg_seleccionado){
		global $db;
		
		if(is_array($reg_seleccionado)){
			$string_pedido = implode(',',$reg_seleccionado);
		}else{
			$string_pedido = $reg_seleccionado;
		}
		
		
		$query = "	select 	p.*,
							fp.txt_nombre as txt_forma_pago,
							ep.txt_nombre as txt_estado_pedido,
							concat(c.txt_nombre,' ',c.txt_apellido) as txt_cliente
					from 	pedido p,
							forma_pago fp,
							estado_pedido ep,
							cliente c
					where 	cod_pedido in ($string_pedido)
					and		p.cod_forma_pago 		= fp.cod_forma_pago
					and		p.cod_estado_pedido		= ep.cod_estado_pedido	
					and		p.cod_cliente			= c.cod_cliente
					";
		$cursor = $db->consultar($query);
		
		return $cursor;
		
	
	}

	
	/*===== 2014/08/14 ======================================================>>>>
	DESCRIPCION: 	Metodo para anular un pedido
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	$arr_pedido	vector con los codigos de pedidos seleccionados
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA			AUTOR			MODIFICACION
	2014/08/14		Luis Prieto		Creacion de la funcion
	===========================================================================*/
	function f_get_valida_estado($reg_seleccionado,$cod_estado_pedido){
		global $db;
		
		if(is_array($reg_seleccionado)){ // son varios
			$string_pedidos = implode(',',$reg_seleccionado);
		}else{
			$string_pedidos = $reg_seleccionado;
		}
		
		$query = "select count(*) as num_registros from pedido where cod_pedido in ($string_pedidos) 
							and cod_estado_pedido = $cod_estado_pedido";

		$row = $db->consultar_registro($query);
		$num_registros = $row['num_registros'];
		
		if($num_registros  > 0){
			$ind_error = true;
			return $ind_error;
		}
	
	}
	
	
	/*===== 2014/08/14 ======================================================>>>>
	DESCRIPCION: 	Metodo para anular un pedido
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	$arr_pedido	vector con los codigos de pedidos seleccionados
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA			AUTOR			MODIFICACION
	2014/08/14		Luis Prieto		Creacion de la funcion
	===========================================================================*/
	function p_anular_pedido($arr_pedido){
		if(!$arr_pedido)return false;
		global $db;
		
		if(is_array($arr_pedido)){
			$string_pedidos = implode(',',$arr_pedido);
			
		}else{
			$string_pedidos = $arr_pedido;
		}
		
		// error por existir pedidos pagados dentro del rango seleccionado
		$error_1 = "No se puede completar el proceso, Ha seleccionado pedidos PAGADOS"; 
		
		
		// consulta si dentro del rango seleccionado hay pedidos ya pagados
		// de ser verdadero manda codigo de error y frena el proceso
		$query="select count(*) as num_registros from pedido where cod_estado_pedido = 2 and cod_pedido in ($string_pedidos)";
		$row = $db->consultar($query);
		
		if($row['num_registros'] > 0){
			echo $error_1;
			return $error_1;  // devuelve codigo de error 1
		}
		
		
		
		//$query = "select * from pedido_detalle where cod_pedido in ($string_pedidos) order by cod_producto asc";	
		$query = "	select  pd.cod_producto , 
			        		sum(cantidad) as total_cantidad 
					from    pedido_detalle pd where cod_pedido in ($string_pedidos) 
					group   by cod_producto";
		$cursor = $db->consultar($query);
		
		
		while($row=$db->sacar_registro($cursor)){
			$cod_producto 		= $row['cod_producto'];
			$total_cantidad		= $row['total_cantidad'];
			
			$query = "update producto set num_cantidad = num_cantidad + $total_cantidad where cod_producto = $cod_producto";
			$db->consultar($query);
			
								
		}
		
		// elimina los detalles de los pedidos anulados
		$query = "delete from pedido_detalle where cod_pedido in ($string_pedidos)";
		$db->consultar($query);
		
		
		// actualiza el estado de los pedidos a estado anulado
		$query = "update pedido set cod_estado_pedido = 3 where cod_pedido in ($string_pedidos)";
		$db->consultar($query);
		
		
		
	}
	
	/*===== 2014/07/10 =========================================>>>>
	DESCRIPCION: 		Metodo para actualizar la fecha y usuario que modifica 
	AUTOR:				Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO				DESCRIPCION 
	===========================================================================*/
	function p_update_ind_restado($var_request){
		global $db;
		
		
		$cod_pedido = $var_request['cod_pedido'];
		
		// actualiza los registros del detalle para evitar que se descuente lo que no es
		$query="update pedido_detalle set ind_cant_restada = 1 where cod_pedido = $cod_pedido";
		
		$db->consultar($query);
	
	}
	
	
}

?>