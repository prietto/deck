<?php
/*=====2013/12/27===================================D E C K===>>>>
DESCRIPCION: 	Contiene las atencions contra la tabla atencion
PROPIETARIO:	© D E C K
AUTOR:			Luis Prieto
===========================================================================*/
if(class_exists('factura') != true){
	class factura{
		var $cod_factura;
		var $cod_usuario;
		var $cod_usuario_modificacion;

		function __construct(){
			$this->cod_usuario 				= $GLOBALS['cod_usuario'];
	  		$this->cod_usuario_modificacion = $GLOBALS['cod_usuario'];
		}

		/*===== 2017/01/25  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
		DESCRIPCION: 		Metodo para creacion de factura y bloqueo de la misma con codigo 
							enviado por parametro
		AUTOR:				Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		$cod_Factura 		codigo pk de la factura que se creara!
		-----------------------------------------------------------------------------
		HISTORIAL DE MODIFICACIONES
		AUTOR				DESCRIPCION					FECHA
		Luis Prieto			Creacion de la funcion		2017/01/25
		===========================================================================*/
		function p_crea_registro_bloqueado($cod_factura){
			global $db;


			if(!$cod_factura)return false;
			if(!$this->cod_usuario)return false;

			// consulta si la factura ya existe ==>>
			$query = "select count(*) as num from factura where cod_factura = ".$cod_factura;
			$row = $db->consultar_registro($query);
			$num = $row['num'];

			if($num>0)return false; // ya existe la factura creada


			$fec_hoy = date('Y-m-d');

			$query = "insert into factura (
											cod_factura					,
											cod_cliente					,
											cod_estado_factura			,
											cod_resolucion_dian			,
											fec_registro				,
											fec_modificacion			,
											fec_vencimiento				,
											num_dias_vencidos			,
											val_descuento				,
											val_iva_porc				,
											val_rete_porc				,
											val_cree_porc				,
											ind_reimpresa				,
											cod_usuario_modificacion	,
											cod_usuario					,
											ind_anulada					,
											ind_bloqueado				
										
										)VALUES(
											".$cod_factura."	,
											NULL				,
											NULL				,
											NULL				,
											NULL				,
											'".$fec_hoy."'		,
											NULL				,
											NULL				,
											NULL				,
											NULL				,
											NULL				,
											NULL				,
											NULL				,
											".$this->cod_usuario_modificacion.",
											".$this->cod_usuario.",
											NULL			,
											1
										)";

			$db->consultar($query);
			$cod_pk	= $GLOBALS['fn_ultimo_registro'];

			return $cod_pk;

		}



		/*===== 2016/11/21  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
		DESCRIPCION: 		Metodo para validar el numero de factura digitado
		AUTOR:				Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		-----------------------------------------------------------------------------
		HISTORIAL DE MODIFICACIONES
		AUTOR				DESCRIPCION					FECHA
		Luis Prieto			Creacion de la funcion		2014/11/21
		===========================================================================*/
		function ind_factura_bloqueada(){
			global $db;

			$row_factura = $this->f_get_row($this->cod_factura);

			$error = NULL;

			// existe la factura
			if($row_factura){
				$ind_bloqueado 		= $row_factura['ind_bloqueado'];
				$cod_usuario_fact 	= $row_factura['cod_usuario'];

				// el numero de factura esta bloqueado por otro usuario
				if($ind_bloqueado == 1 && $cod_usuario != $cod_usuario_fact){
					$error = "El numero de factura esta siendo usado por otro usuario";

				}else if($ind_bloqueado == 0){ // la factura ya existe y fue cerrada
					$error = "La factura digitada ya fue emitida";

				}
			}else{

				//$error="no hay error, no existe la facura en la base de datos";
			}

			return $error;

		}




		/*===== 2015/05/03  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
		DESCRIPCION: 		Metodo para pagar una factura
		AUTOR:				Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		-----------------------------------------------------------------------------
		HISTORIAL DE MODIFICACIONES
		AUTOR				DESCRIPCION					FECHA
		Luis Prieto			Creacion de la funcion		2014/11/21
		===========================================================================*/
		function p_pagar_factura($cod_factura){
			if(!$cod_factura)return false;
			global $db;
			
			$query = "update factura set cod_estado_factura = 4 where cod_factura = $cod_factura";
			$db->consultar($query);
			
			// averiguia el codigo de cliente
			$query = "select cod_cliente from factura where cod_factura = $cod_factura";
			$row = $db->consultar_registro($query);
			$cod_cliente = $row['cod_cliente'];
			
			include_once('cliente.php');
			$cliente = new cliente();
			
			// actualiza el estado de cuenta del cliente despues de efectuar un pago
			$cliente->p_update_estado_cuenta($cod_cliente);
			
			return true;
		}
		
		/*===== 2015/05/03  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
		DESCRIPCION: 		Metodo para consultar el saldo a pagar
		AUTOR:				Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		-----------------------------------------------------------------------------
		HISTORIAL DE MODIFICACIONES
		AUTOR				DESCRIPCION					FECHA
		Luis Prieto			Creacion de la funcion		2014/11/21
		===========================================================================*/
		function f_get_info_valores($cod_factura){
			if(!$cod_factura)return false;
			global $db;
			
			include_once('pedido.php');
			$pedido = new pedido();
			
			$row_pedido = $pedido->f_get_row_by_factura($cod_factura);
			$val_total = $row_pedido['val_total'];
			
			$arr_retorno = array();
			
			$query = "select SUM(val_pago) as total_pago 
						from factura_pago where cod_factura = $cod_factura group by cod_factura";
			$row = $db->consultar_registro($query);
			$total_pago = $row['total_pago'];
			
			$arr_retorno['val_pagado'] 	= $total_pago;
			$arr_retorno['val_total'] 	= $val_total;
			$arr_retorno['val_saldo'] 	= $val_total - $total_pago;		
			
			
			return $arr_retorno;		
		
		}
		
		/*===== 2014/11/21  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
		DESCRIPCION: 		consulta las facturas dependiendo del estado pasado por parametro
		AUTOR:				Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		-----------------------------------------------------------------------------
		HISTORIAL DE MODIFICACIONES
		AUTOR				DESCRIPCION					FECHA
		Luis Prieto			Creacion de la funcion		2014/11/21
		===========================================================================*/
		function f_get_next_pk(){
			global $db;
			
			$nom_db = $GLOBALS['nom_db_pk'];
			$query = "	SELECT AUTO_INCREMENT
						FROM information_schema.TABLES
						WHERE TABLE_SCHEMA = '".$nom_db."' 
						AND TABLE_NAME = 'factura'";
			$row=$db->consultar_registro($query);
			
			$cod_factura = $row[0];
			return $cod_factura;
			
			
			return false;
		}

	
		/*===== 2014/11/21  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
		DESCRIPCION: 		consulta las facturas dependiendo del estado pasado por parametro
		AUTOR:				Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		$cod_cliente		codigo pk de cliente que se quiere consultar
		$cod_estado_factura	codigo pk del estado de la factura que se desea consultar
		-----------------------------------------------------------------------------
		HISTORIAL DE MODIFICACIONES
		AUTOR				DESCRIPCION					FECHA
		Luis Prieto			Creacion de la funcion		2014/11/21
		===========================================================================*/
		function f_get_factura_by_estado($cod_cliente,$cod_estado_factura){
	
			if(!$cod_cliente)return false;
	
			global $db;
	
			
			$query = "select 	f.*,
								concat(c.txt_nombre,' ',c.txt_apellido) as txt_cliente,
								c.num_identificacion,
								c.txt_telefono,
								c.cod_cliente,
								ef.txt_nombre as txt_estado_factura		,
								su1.txt_nombre as txt_usuario			,
								su2.txt_nombre as txt_usuario_modificacion,
								rd.cod_resolucion_dian,
								rd.num_resolucion,
								fp.txt_nombre as txt_forma_pago,
								p.val_saldo
				  
						from 	(factura	f 	left join seg_usuario su2 on (f.cod_usuario_modificacion = su2.cod_usuario_pk))
												left join resolucion_dian rd on (f.cod_resolucion_dian = rd.cod_resolucion_dian),
								cliente 		c,
								estado_factura 	ef,
								seg_usuario 	su1	,
								pedido			p	,
								forma_pago 		fp					
								
						where 	f.cod_cliente 			= c.cod_cliente
						and		f.cod_estado_factura 	= ef.cod_estado_factura
						and		f.cod_usuario			= su1.cod_usuario_pk
						and		p.cod_factura			= f.cod_factura
						and		p.cod_forma_pago		= fp.cod_forma_pago
						and		f.cod_cliente 			= $cod_cliente
						and		f.cod_estado_factura 	= $cod_estado_factura		";
	
			$cursor = $db->consultar($query);
			return $cursor;
			
			
		}
		
		/*===== 2014/11/17  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
		DESCRIPCION: 		Consulta y retorna informacion detallada de la factura
		AUTOR:				Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		$cod_factura		factura que se consultara
		===========================================================================*/
		function f_get_row_detallado($cod_factura){
			if(!$cod_factura)return false;
			global $db;
			
			$query = "	select 	f.*,
								concat(c.txt_nombre,' ',c.txt_apellido) as txt_cliente,
								c.num_identificacion,
								c.txt_telefono,
								c.cod_cliente,
								ef.txt_nombre as txt_estado_factura		,
								su1.txt_nombre as txt_usuario			,
								su2.txt_nombre as txt_usuario_modificacion,
								rd.cod_resolucion_dian,
								rd.num_resolucion,
								fp.txt_nombre as txt_forma_pago,
								p.val_saldo
				  
						from 	(factura	f 	left join seg_usuario su2 on (f.cod_usuario_modificacion = su2.cod_usuario_pk))
												left join resolucion_dian rd on (f.cod_resolucion_dian = rd.cod_resolucion_dian),
								cliente 		c,
								estado_factura 	ef,
								seg_usuario 	su1	,
								pedido			p	,
								forma_pago 		fp					
								
						where 	f.cod_cliente 			= c.cod_cliente
						and		f.cod_estado_factura 	= ef.cod_estado_factura
						and		f.cod_usuario			= su1.cod_usuario_pk
						and		p.cod_factura			= f.cod_factura
						and		p.cod_forma_pago		= fp.cod_forma_pago
						and		f.cod_factura = $cod_factura	";
			$row = $db->consultar_registro($query);
			return $row;
		
		}
		
		/*===== 2014/11/03  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
		DESCRIPCION: 		Actualiza el numero de dias transcurridos despues de vencerse la factura
		AUTOR:				Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		$cod_factura		factura que se consultara
		===========================================================================*/
		function p_anular_factura($cod_factura,$cod_usuario){
			if(!$cod_factura || !$cod_usuario)return false;
			global $db;
			
			// debe quitar el codigo de factura a los pedidos
			$query = "update 	pedido set 
								cod_factura = NULL ,
								cod_estado_pedido = 1
						where 	cod_factura = $cod_factura";
			if($db->consultar($query) == true) { // si actualizo con exito pasa a cambiar el estado a la factura
				
				if($this->p_modifica_estado_by_pk($cod_factura,8,$cod_usuario)==TRUE)return 1;			
				else return 0;
			}
			
			
			
				
		}
		
		/*===== 2014/11/03  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
		DESCRIPCION: 		Actualiza el numero de dias transcurridos despues de vencerse la factura
		AUTOR:				Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		$cod_factura		factura que se consultara
		===========================================================================*/
		function p_update_fec_vencimiento($fec_vencimiento,$cod_factura){
			if(!$cod_factura)return false;
			global $db;
			
			$query = "update factura set fec_vencimiento = '$fec_vencimiento' where cod_factura = $cod_factura";
			$db->consultar($query);
			
			
		}
		
		
		/*===== 2014/11/03  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
		DESCRIPCION: 		Actualiza el numero de dias transcurridos despues de vencerse la factura
		AUTOR:				Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		$cod_factura		factura que se consultara
		===========================================================================*/
		function p_update_dias_vencidos($cod_factura,$num_dias=0){
			if(!$cod_factura)return false;
			global $db;
			
			$query = "update factura set num_dias_vencidos = $num_dias where cod_factura  = $cod_factura";
			$db->consultar($query);
		
		}
		
		/*===== 2014/10/13  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı================== DECK ====>>>>
		DESCRIPCION: 		Retorna el numero de detalles que tiene la factura
		AUTOR:				Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		$cod_factura		factura que se consultara
		===========================================================================*/
		function f_get_count_detalle($cod_factura){
			if(!$cod_factura)return false;
			global $db;
	
			$query = " 
					select  count(pd.cod_pedido_detalle) as num_registros
					from 	factura 		f,
							pedido			p,
							pedido_detalle  pd
					where 	p.cod_factura in ($cod_factura)
					and   	f.cod_factura = p.cod_factura
					and   	pd.cod_pedido = p.cod_pedido";
			$row = $db->consultar_registro($query);
			$num_registros = $row['num_registros'];
			
			return $num_registros;
			
		}	
		
		
		/*===== 2014/01/28  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 		Actualiza el nombre del archivo donde quedo la factura
		AUTOR:				Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$cod_factura			factura que se actualizara
		$num_consecutivo		texto del consecutivo
		===========================================================================*/
		function f_valida_anulada($reg_seleccionado){
			global $db;
			if(!$reg_seleccionado)return false;
			
			for($i=0;$i<count($reg_seleccionado);$i++){
				
				$cod_factura	= $reg_seleccionado[$i];
				$row_factura 	= $this->f_get_row($cod_factura);
				$cod_estado_factura = $row_factura['cod_estado_factura'];
				
				if($cod_estado_factura == 8){
					return true;
								
				}
			
			}
			
		}	
		
		/*===== 2014/01/28  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 		Actualiza el nombre del archivo donde quedo la factura
		AUTOR:				Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$cod_factura			factura que se actualizara
		$num_consecutivo		texto del consecutivo
		===========================================================================*/
		function p_desvincula_archivo($reg_seleccionado){
			global $db;
			if(!$reg_seleccionado)return false;
			
			$cods_factura = implode(',',$reg_seleccionado);
			$query="	update 	factura set 
								cod_nombre_archivos = NULL, 
								txt_nombre_archivo = NULL 
						where 	cod_factura in ($cods_factura)";	
		
			$db->consultar($query);
			
			
		}	
		
		
		
		/*===== 2014/01/28  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 		Actualiza el nombre del archivo donde quedo la factura
		AUTOR:				Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$cod_factura			factura que se actualizara
		$num_consecutivo		texto del consecutivo
		===========================================================================*/
		function p_update_nom_archivo($cod_nombre_archivos,$num_consecutivo,$cod_factura){
			global $db;
			if(!$num_consecutivo || !$cod_factura)return false;
			
			$query="update 	factura set 
							cod_nombre_archivos = $cod_nombre_archivos		,	
							txt_nombre_archivo  = '$num_consecutivo'
					where 	cod_factura = $cod_factura";
			$db->consultar($query);
		
		}	
		
		
		/*===== 2014/01/27  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 		Retorna cadena de entidades separados por coma dentro de
							los registros seleccionados
		AUTOR:				Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		$reg_seleccionado	seleccion de facturas
		===========================================================================*/
		function f_get_entidad($reg_seleccionado){
			global $db;
			if(!$reg_seleccionado)return false;
			
			$string_fctras = implode(',',$reg_seleccionado);
			// consulta que trae todas las entidades de las facturas seleccionadas
			$query="select cod_entidad from factura where cod_factura in ($string_fctras) group by cod_entidad";
			$cursor = $db->consultar($query);
	
			$arr_entidades = array();		
			while($row=$db->sacar_registro($cursor)){ // recorre el cursor para almacenar las entidades en vector
				$cod_entidad = $row['cod_entidad'];
				array_push($arr_entidades,$cod_entidad);
			}
	
			$cods_entidad = implode(',',$arr_entidades);
			return $cods_entidad;	
		}	
		
		
		/*===== 2014/01/16  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 		Retorna datos de las facturas por entidad y periodo de facturacion
		AUTOR:				Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		$cod_reporte_tabla	trae el script desde la tabla  reporte_tabla
		$cod_entidad		codigo de la entidad seleccionado por el usuario
		$cod_periodo		periodod de facturacion seleccionado por el usuario
		===========================================================================*/
		function f_get_by_reporte($var_request){
			global $db;
			$reporte_tabla = new reporte_tabla;
			
			
			$cod_nombre_archivos 	= $var_request['cod_archivo'];
			
			$cod_nombre_archivos	= implode(',',$cod_nombre_archivos);
			
			if($cod_nombre_archivos){$condicion_archivo = "and t.cod_nombre_archivos in ($cod_nombre_archivos)";}
			else{$condicion_archivo = '';}
			
			//if($cod_periodo){$condicion_periodo = "and cod_periodo_facturacion = $cod_periodo";}
			//else{$condicion_periodo = '';}
			
			$query= " 
				select    t.cod_factura as numero_factura,
						  p.txt_identificacion as identificacion,
						  concat(p.txt_nombre,' ',p.txt_apellido) as nombre,
						  au.num_autorizacion as autorizacion,
						  count(a.cod_atencion) as cant,
						  a.val_atencion as vr_unit,
						  SUM(a.val_copago) as copago,
						  SUM(a.val_atencion - a.val_copago) AS total,
						  ta.cod_tipo_atencion,
						  ta.txt_nombre as servicio,
						  t.fec_registro as fec_expedicion
						  
				from      factura         t,
						  atencion        a,
						  paciente        p,
						  autorizacion    au,
						  tipo_atencion   ta
						  
				where     a.cod_factura  =  t.cod_factura          
				and       a.cod_paciente  = p.cod_paciente
				and       a.cod_autorizacion  = au.cod_autorizacion
				and       a.cod_tipo_atencion = ta.cod_tipo_atencion
				and       t.cod_estado_factura <> 8
				$condicion_archivo
				group     by a.cod_autorizacion 
				order by t.cod_factura asc";
	
	
			$cursor = $db->consultar($query);		
			
			return $cursor;
			
			
			
			
		}	
		
		
		/*===== 2014/01/16  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 		relaciona los periodos de facturacion con su respectiva factura
		AUTOR:				Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		===========================================================================*/
		function p_udte_prdo($arr_periodos,$arr_facturas){
			global $db;
			
			for($i=0;$i<count($arr_facturas);$i++){
				$cod_factura = $arr_facturas[$i];
				$cod_periodo = $arr_periodos[$i];
				
				$query="update 	factura set 
								cod_periodo_facturacion = $cod_periodo,
								ind_anulada				=  0
						where 	cod_factura = $cod_factura";
				$db->consultar($query);
			
			}
			
			
		}	
		
		
		/*===== 2014/01/16  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 	Retorna todas las facturas que fueron anuladas
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		===========================================================================*/
		function f_get_fact_anlads(){
			global $db;
			
			$query="
			select  t.*,
					vdf.`02iva` as iva, 
					vdf.`02retefuente` as retefuente, 
					vdf.`02valor_compartido` as val_compartido, 
					vdf.`02valor_copago` as val_copago, 
					vdf.`02valor_cuota` as val_cuota, 
					vdf.`02valor_descuento` as val_descuento, 
					vdf.`02valor_factura` as val_atenciones, 
					vdf.`02valor_total` as val_total,
					vdf.`01entidad` as txt_entidad,
					vdf.`01estado_factura` as txt_estado_factura
			from    factura t,
					v_detalle_factura vdf
			where   ind_anulada = 1 
			and     cod_periodo_facturacion IS NULL
			and     t.cod_factura = vdf.cod_factura";
			$cursor = $db->consultar($query);
			
			return $cursor;
			
		}	
		
		
		
		/*===== 2014/01/16  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 	Crea el pk de la factura con indicador de que fue anulada (CASOS ESPECIALES)
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		===========================================================================*/
		function p_crear_fctra_pk_anlda($cod_usuario,$cod_entidad){
			global $db;
			$resolucion_dian 		= new resolucion_dian;
			$periodo_facturacion	= new periodo_facturacion;
			
			// informacion sobre la resolucion que da la dian para el rango de facturacion
			$row_resolucion_dian = $resolucion_dian->f_get_row_activa();
			$num_rango_final 	= $row_resolucion_dian['num_rango_final'];
			
			// retorna el codigo del periodo de facturacion actual
			$row_periodo = $periodo_facturacion->f_get_activo();
			$cod_periodo_facturacion = $row_periodo['cod_periodo_facturacion'];
			
			
			$query2="select * from factura where ind_bloqueado = 0 order by cod_factura desc limit 1";
			$row=$db->consultar_registro($query2);
			//ultimo numero del consecutivo que lleva la facturacion
			$last_pk_factura = $row['cod_factura'];
			
			if($last_pk_factura == $num_rango_final){ 
				
				// 	retorna false si la ultima factura ingresada anteriormente alcanzo el limite del rango
				//	y frena el ciclo de ser asi
				return false;
			
			}else{
				
				$query	=	"
				insert 	into factura
						(cod_entidad,cod_estado_factura,fec_registro,ind_anulada,cod_usuario,ind_bloqueado)
				values	($cod_entidad,1,now(),1,$cod_usuario,0)";
				$db->consultar($query);
				$cod_pk	= $GLOBALS['fn_ultimo_registro'];
				
				return $cod_pk;	
				
			}
		}	
		
		
		/*===== 2014/01/16  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 	Genera facturas especiales que fueron anuladas previamente
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		===========================================================================*/
		function p_genera_factras_anldas($cursor_autorizaciones,$cod_usuario){
			global $db;
			if(!$cursor_autorizaciones)return false;
			$entidad = new entidad;
			$atencion = new atencion;
			$num_entidades			=	$db->num_registros($cursor_autorizaciones);
			
			for($i=0;$i<$num_entidades;$i++){
				$row 						= $db->sacar_registro($cursor_autorizaciones);
				$cod_entidad 				= $row['cod_entidad'];
				$row_entidad				= $entidad->f_get_row($cod_entidad);
				$string_cod_autorizacion 	= $row[1];
				
				if($row_entidad['cod_tipo_factura'] == 1 || $row_entidad['cod_tipo_factura'] == NULL){
					// si la entidad tiene parametrizado que la facturacion sea por tipo de atencion
					$count = count($row['cod_entidad']);
					
					$query="
					select 	cod_tipo_atencion,
							group_concat(concat(cod_atencion)) as cod_atencion 
					from 	atencion
							where 	cod_factura is null 
					and 	cod_autorizacion in ($string_cod_autorizacion) 
					group 	by cod_tipo_atencion";
					
					$cursor = $db->consultar($query);
									
				}else if($row_entidad['cod_tipo_factura'] == 2){
	
					$query="
					select 	cod_tipo_atencion,
							group_concat(concat(cod_atencion)) as cod_atencion 
					from 	atencion
					where 	cod_factura is null 
					and 	cod_autorizacion in ($string_cod_autorizacion) 
					group 	by cod_autorizacion ";
					$cursor = $db->consultar($query);
				}
				
				$arr_datos = array();
				while($row=$db->sacar_registro($cursor)){
					$cod_factura 		= $this->p_crear_fctra_pk_anlda($cod_usuario,$cod_entidad);
					if(!$cod_factura) break;
					$cod_pk				= $GLOBALS['fn_ultimo_registro'];
					$cod_atenciones 	= $row['cod_atencion'];
					$atencion->p_update_cod_factura($cod_atenciones,$cod_factura);
				}
				
						
	
			}
			
			
		}
		
		
		/*===== 20140116  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 	Desvincua todas las atenciones de las facturas que se pasa 
						por parametro
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$reg_seleccionado		Codigo de peridodo que se pasa por parametro
		===========================================================================*/
		function p_desvincular_atncn($reg_seleccionado,$var_request){
			global $db;
			if(!$reg_seleccionado)return false;
			
			$cod_usuario = $var_request['cod_usuario'];
			$string_factas = implode(',',$reg_seleccionado);
			
			// desvincula las atenciones
			$query="update atencion set cod_factura = NULL where cod_factura in ($string_factas)";
			$db->consultar($query);
			
			
	
			// limpiar valores de las facturas
			$query2="update 	factura set 
								val_descuento1 				= NULL,
								val_iva_porc				= NULL,
								val_rete_porc				= NULL,
								cod_usuario_modificacion	= $cod_usuario
					where 		cod_factura in ($string_factas)";
			$db->consultar($query2);
					
		
		}
		
		
		/*===== 20140114  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 	valida si puede actualizar el estado a impresa
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO					DESCRIPCION 
		$cod_periodo_facturacion	Codigo de peridodo que se pasa por parametro
		
		===========================================================================*/
		function p_update_estado_impresa($reg_seleccionado,$var_request){
			global $db;
			if(!$reg_seleccionado)return false;
			
			$cod_usuario = $var_request['cod_usuario'];
			
			for($i=0;$i<count($reg_seleccionado);$i++){
				
				$cod_factura = $reg_seleccionado[$i];
				$row_factura = $this->f_get_row($cod_factura);
				$cod_estado_factura = $row_factura['cod_estado_factura'];
				
				$this->p_update_ind_reimpresa($cod_factura,$cod_usuario);
				
				if($cod_estado_factura == 1){ // estado generada
					
					// cambia el estado de la factura a impresa si fue generada
					//$this->p_modifica_estado_by_pk($cod_factura,2,$cod_usuario);
				
				}else if($cod_estado_factura != 1){
					//$this->p_update_ind_reimpresa($cod_factura,$cod_usuario);								
				
				}
			}
		}
		
		
		/*===== 2014/01/14  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 	Actualiza el estado de la factura by factura
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$cod_factura		codigo de factura unico
		$cod_estado_factura		nuevo estado de la factura
		===========================================================================*/
		function p_update_ind_reimpresa($cod_factura,$cod_usuario){
			global $db;
			if(!$cod_factura)return false;
	
			$query	="	update 	factura set 
								ind_reimpresa = 1,
								cod_usuario_modificacion = $cod_usuario ,
								fec_modificacion = now()
						where 	cod_factura in ($cod_factura)";
	
			$db->consultar($query);
			
		}	
		
		
		/*===== 2014/01/14  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 	Actualiza el estado de la factura by factura
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$cod_factura		codigo de factura unico
		$cod_estado_factura		nuevo estado de la factura
		===========================================================================*/
		function p_modifica_estado_by_pk($cod_factura,$cod_estado_factura,$cod_usuario){
			global $db;
			if(!$cod_factura)return false;
	
			$query	="	update 	factura set 
								cod_estado_factura 			= $cod_estado_factura	,
								cod_usuario_modificacion	= $cod_usuario			,
								fec_modificacion			= now()			
						where 	cod_factura in ($cod_factura)";
			if($db->consultar($query)==TRUEr)return true;
			else return false;
			
		}	
		
		
		/*===== 20140110  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 	Cuenta cuantas facturas estan asociadas a un codigo de periodo 
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO					DESCRIPCION 
		$cod_periodo_facturacion	Codigo de peridodo que se pasa por parametro
		
		===========================================================================*/
		function f_count_by_periodo($cod_periodo_facturacion){
			global $db;
			if(!$cod_periodo_facturacion)return false;
	
			$query="select count(*) as num_registros from factura where cod_periodo_facturacion = $cod_periodo_facturacion";
	
			$row = $db->consultar_registro($query);
			$num_registros = $row['num_registros'];
	
			
			return $num_registros;
					
		}
		
		
		/*===== 20140109  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 	Guarda el valor del o los impuestos en la(s) factura(s) seleccionadas
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$reg_seleccionado		Codigos de facturas en vector
		$var_request			Valor del impuesto a asignar
		===========================================================================*/
		function p_modifica_impuestos($reg_seleccionado,$var_request){
			global $db;
			$sis_genericos = new sis_genericos;
			if(!$reg_seleccionado)return false;
			
			$string_cod_facturas	=	implode(',',$reg_seleccionado);
			$val_iva_porc		= $var_request['val_iva_porc'];
			$val_rete_porc		= $var_request['val_rete_porc'];
			$val_cree_porc		= $var_request['val_cree_porc'];
			
			$cod_usuario		= $var_request['cod_usuario'];
			
			if(!$val_iva_porc) 	$val_iva_porc 	= 'NULL';
			if(!$val_rete_porc)	$val_rete_porc	= 'NULL';
			if(!$val_cree_porc) $val_cree_porc	= 'NULL';
			
			$query="update 	factura 			set 
							val_iva_porc 				= $val_iva_porc		,
							val_rete_porc 				= $val_rete_porc	,
							val_cree_porc				= $val_cree_porc	,
							fec_modificacion			= now()				,
							cod_usuario_modificacion	= $cod_usuario
							
					where 	cod_factura 	in ($string_cod_facturas)";
	
			$db->consultar($query);
					
		}
		
		/*===== 20140108  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 	Guarda el valor del descuento en la(s) factura(s) seleccionadas
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$reg_seleccionado		Codigos de facturas en vector
		$val_descuento			Valor del descuento a asignar
		===========================================================================*/
		function p_guarda_descuento($reg_seleccionado,$val_descuento1){
			global $db;
			$sis_genericos = new sis_genericos;
			if(!$reg_seleccionado)return false;
			$string_cod_facturas	=	implode(',',$reg_seleccionado);
			
			if(!$val_descuento1 || $val_descuento1 == 0) $val_descuento1 = 'NULL';
			
			$val_descuento1 = $sis_genericos->p_elimina_coma($val_descuento1);
			$query="update factura set val_descuento1 = $val_descuento1 where cod_factura in ($string_cod_facturas)";
			
			
			$db->consultar($query);
					
		}
		
		/*===== 20140103  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 	Actualiza el estado de un registro especifico
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$cod_factura			codigo especifico de factura
		$cod_estado_factura		el nuevo estado para la(s) facturas
		===========================================================================*/
		function p_actualiza_estado($cod_factura,$cod_estado_factura){
			global $db;
			if(!$cod_factura || !$cod_estado_factura)return false;
			$query="update factura set cod_estado_factura = $cod_estado_factura where cod_factura = $cod_factura";
			$db->consultar($query);
		}
		
		/*===== 20140103  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 	Busca y actualiza el estado de vencimiento de las facturas
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$reg_seleccionado		codigos de factura seleccionados en el reporte
		$cod_estado_factura		el nuevo estado para la(s) facturas
		===========================================================================*/
		function p_update_vencimiento($cod_factura=NULL){
			global $db;
	
			$parametro_sistema 	= new parametro_sistema();
			$sis_genericos		=	new sis_genericos();

			ini_set('max_execution_time', 300); //300 seconds = 5 minutes
			
			if($cod_factura != NULL)$condicion_extra = "and f.cod_factura = $cod_factura";
			
			$query = "select  f.cod_factura,
					f.fec_registro,
					fp.cod_forma_pago,
					fp.num_dias
			from    factura f , 
					estado_factura ef,
					pedido p,
					forma_pago fp
			where 	p.cod_forma_pago = fp.cod_forma_pago
			and   	fp.num_dias > 0
			and   	f.cod_factura = p.cod_factura
			and		f.cod_estado_factura <> 4			
					$condicion_extra
			and   	f.cod_estado_factura = ef.cod_estado_factura ";
			
			$cursor=$db->consultar($query);
			
			$fec_actual = date("Y/m/d");
			while($row=$db->sacar_registro($cursor)){
	
				
				$cod_factura 		= $row['cod_factura']; // cod pk de factura
				$num_dias_credito	= $row['num_dias']; // numero de dias limite para credito/pago
				$fec_radicacion		= $row['fec_registro'];	 // fecha en que se genero la factura
				
				// convertirmos a tiempo los valores de las fechas a comprar
				$fec_actual 	= date('Y-m-d');
				
				// fecha limite de calendario para pagar la factura
				$fec_limite = $sis_genericos->sumar_dias_habiles($fec_radicacion,$num_dias_credito);
	
				$str_fec_actual = strtotime($fec_actual); // convierte a tiempo la fecha actual
				$str_fec_limit	= strtotime($fec_limite); // convierte a tiempo la fecha limite futura
				
				

					
				
				if(strtotime($fec_limite)<strtotime($fec_actual)){ // paso el tiempo y se ha vencido la factura
					

					// calcula diferencia en dias entre dos fechas
					$num_dias_vencidos = $sis_genericos->f_get_diferencia_dias_habiles($fec_limite,$fec_actual);
					
					$this->p_actualiza_estado($cod_factura,5);
					$this->p_update_dias_vencidos($cod_factura,$num_dias_vencidos);
				}else{
					// calcula diferencia en dias entre dos fechas
					$num_dias_vencidos = $sis_genericos->f_get_diferencia_dias_habiles($fec_limite,$fec_actual);
					
					$this->p_actualiza_estado($cod_factura,1);
					$this->p_update_dias_vencidos($cod_factura,$num_dias_vencidos);
					
				}
			}
			
			// despues de ejecutar todo el proceso de actualizacion
			// se actualiza la fecha de parametro sistema para no voler a ejecutar por hoy
			$parametro_sistema->p_update_fec_actual();
				
		}
		
		/*===== 20140102  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 	actualiza el estado de las facturas que llegan en array
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$reg_seleccionado		codigos de factura seleccionados en el reporte
		$cod_estado_factura		el nuevo estado para la(s) facturas
		===========================================================================*/
		function p_update_estado($reg_seleccionado,$cod_estado_factura){
			global $db;
			if(!$reg_seleccionado)return false;
			
			if($cod_estado_factura == 3) $anexo = ",fec_radicacion = now()";
			$cadena_facturas = implode(',',$reg_seleccionado);
			$query	="	update 	factura set 
								cod_estado_factura 	= $cod_estado_factura,
								fec_modificacion	= now()
								$anexo
						where 	cod_factura in ($cadena_facturas)";
			$db->consultar($query);
				
		}
		
		
		/*===== 20140102  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı============================>>>>
		DESCRIPCION: 	Retorna los datos de un registro por cod pk
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$reg_seleccionado		codigos de factura seleccionados en el reporte
		===========================================================================*/
		function f_get_cursor($reg_seleccionado){
			global $db;
			if(!$reg_seleccionado)return false;
			
			$cadena_facturas = implode(',',$reg_seleccionado);
			
			
			/*$query	="
				select 	f.*,
						concat(c.txt_nombre,' ',c.txt_apellido) as txt_cliente ,
						c.txt_direccion as txt_direccion_cliente,
						c.txt_telefono as txt_telefono_cliente,
						c.num_identificacion as num_identificacion_cliente,
						ef.txt_nombre as txt_estado_factura,
						if(val_negociado,val_negociado,val_total) as val_total
				from 	factura 			f,
						cliente				c,
						estado_factura 		ef,
						pedido				p
				where 	f.cod_factura in ($cadena_facturas)
				and		c.cod_cliente= f.cod_cliente
				and		ef.cod_estado_factura = f.cod_estado_factura
				and   	f.cod_factura = p.cod_factura
				group 	by cod_factura";*/
				
			$query=" 
					select 	f.*,
							if(c.txt_apellido,concat(c.txt_nombre,' ',c.txt_apellido),c.txt_nombre) as txt_cliente,
							c.txt_direccion as txt_direccion_cliente,
							c.txt_telefono as txt_telefono_cliente,
							c.num_identificacion as num_identificacion_cliente,
							ef.txt_nombre as txt_estado_factura,
							if(p.val_negociado,p.val_negociado,p.val_total) as val_total_factura,
							pd.cod_pedido_detalle			,
							pd.cantidad						,
							pd.val_precio_unitario			,
							pd.val_total as val_total_linea	,
							pr.cod_producto 				,
							pr.txt_nombre as txt_producto   ,
							fp.txt_nombre as txt_forma_pago	,
							fp.num_dias as num_dias_forma_pago
									 
							
						from 	factura 		f,
								cliente			c,
								estado_factura 	ef,
								pedido			p,
								pedido_detalle  pd,
								producto        pr,
								forma_pago		fp
						where 	p.cod_factura in ($cadena_facturas)
						and		c.cod_cliente			= f.cod_cliente
						and		ef.cod_estado_factura 	= f.cod_estado_factura
						and   	f.cod_factura 			= p.cod_factura
						and   	pd.cod_pedido 			= p.cod_pedido
						and   	pr.cod_producto 		= pd.cod_producto
						and 	p.cod_forma_pago 		= fp.cod_forma_pago
						order by p.cod_factura asc";
	
			$cursor	= $db->consultar($query);
			return $cursor;
			
		}
		
		
		/*===== 2013/12/28  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 		Retorna un indicador para dar aviso de que se llego al 
							limite del rango de facturacion
		AUTOR:				Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		===========================================================================*/
		function f_get_ind_limite(){
			global $db;
			$resolucion_dian = new resolucion_dian;
		
			$query="select * from factura where ind_bloqueado = 0 order by cod_factura desc limit 1";
			$row=$db->consultar_registro($query);
	
			//ultimo numero del consecutivo que lleva la facturacion
			$last_pk_factura = $row['cod_factura'];
	
			// informacion sobre la resolucion que da la dian para el rango de facturacion
			$row_resolucion_dian = $resolucion_dian->f_get_row_activa();
			$num_rango_final 	= $row_resolucion_dian['num_rango_final'];	
			
			// si el ultimo consecutivo es igual al rango activa indicador
			if($last_pk_factura == $num_rango_final){return true;}else{return false;}
			
			
	
			
		}
		
		
		/*===== 2013/12/28  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 	Retorna los datos de un registro por cod pk
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$cod_factura			cod pk del registro a retornar
		===========================================================================*/
		function f_get_row($cod_factura){
			global $db;
			if(!$cod_factura)return false;
			$query	="
				select * from factura where cod_factura = $cod_factura";
			$row	= $db->consultar_registro($query);
			return $row;
			
		}
		
		
		/*===== 2013/12/28  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 	Retorna los datos por codigo de factura seleccionado por el usuario 
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$reg_seleccionado		codigos de facturas seleccionado para la impresion
		$cod_estado_factura		nuevo estado de la factura
		===========================================================================*/
		function f_get_datos_factura($reg_seleccionado){
			global $db;
			if(!$reg_seleccionado)return false;
			$cod_factura_seleccionados = implode(',',$reg_seleccionado);
			$query	="
				select 	at.cod_factura, 
						ta.cod_tipo_atencion, 
						concat('CUPS ',ta.txt_cups,' ',ta.txt_nombre_cups) as txt_tipo_atencion, 
						count(at.cod_atencion) as cantidad, 
						sum(at.val_atencion) as val_atencion, 
						sum(at.val_copago) as val_copago,
						vdf.02valor_compartido as val_compartido,
						vdf.`02valor_descuento` as val_descuento,
						vdf.`02iva` as val_iva ,
						vdf.`08fec_registro` as fec_registro,
						vdf.cod_entidad
				from  	atencion at, 
						tipo_atencion ta,
						v_detalle_factura vdf 
				where 	ta.cod_tipo_atencion = at.cod_tipo_atencion 
				and 	at.cod_autorizacion is not null 
				and   	at.cod_factura = vdf.cod_factura
				and 	at.cod_factura in ($cod_factura_seleccionados) 
				group 	by at.cod_factura, 
						ta.cod_tipo_atencion, 
						ta.txt_nombre";
	
			$cursor = $db->consultar($query);
			return $cursor;
			
		}	
		
		
		/*===== 2013/12/28  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 	Actualiza el estado de la factura cuando el usuario pasa por el proceso de impresion 
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$reg_seleccionado		codigos de facturas seleccionado para la impresion
		$cod_estado_factura		nuevo estado de la factura
		===========================================================================*/
		function p_modificar_estado($reg_seleccionado,$cod_estado_factura){
			global $db;
			if(!$reg_seleccionado)return false;
			$codigos_factura = implode(',',$reg_seleccionado);
			$query	="update factura set cod_estado_factura = $cod_estado_factura where cod_factura in ($codigos_factura)";
			$db->consultar($query);
			
		}	
		
		/*===== 2013/12/27  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı========D E C K===>>>>
		DESCRIPCION: 	Genera facturas de manera masiva asignandoles codigos de 
						factura a las atenciones por entidad
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		===========================================================================*/
		function p_crear_factura_pk($cod_usuario,$cod_cliente,$fec_registro=NULL){
	
			global $db;
			$resolucion_dian 		= new resolucion_dian();
			$parametro_sistema		= new parametro_sistema();
			
			$row_parametro = $parametro_sistema->f_get_row(6);
			$ind_resolucion_dian_activa = $row_parametro['val_parametro'];
			
			// informacion de la entidad
			//$row_entidad = $entidad->f_get_row($cod_entidad);
			//$val_rete_entidad = $row_entidad['val_rete'];
			
			//if($val_rete_entidad == NULL || $val_rete_entidad == '')$val_rete_entidad = 'NULL';
			
			if($ind_resolucion_dian_activa == 1){
				// informacion sobre la resolucion que da la dian para el rango de facturacion
				$row_resolucion_dian 	= $resolucion_dian->f_get_row_activa();
		
				$cod_resolucion_dian	= $row_resolucion_dian['cod_resolucion_dian'];
	
				$num_rango_final 		= $row_resolucion_dian['num_rango_final'];
			
			}else{
				$cod_resolucion_dian	= 'NULL';
			}
			
	
			$query2="select * from factura where ind_bloqueado = 0 order by cod_factura desc limit 1";
			$row=$db->consultar_registro($query2);
			//ultimo numero del consecutivo que lleva la facturacion
			$last_pk_factura = $row['cod_factura'];
			
			if($last_pk_factura == $num_rango_final && $ind_resolucion_dian_activa == 1){ 
				
				// 	retorna false si la ultima factura ingresada anteriormente alcanzo el limite del rango
				//	y frena el ciclo de ser asi
				return false;
			
			}else{
	
				$query	="
				insert 	into factura
							(
							cod_cliente				,		
							cod_estado_factura		,
							cod_resolucion_dian		,
							fec_registro			,
							ind_reimpresa			,
							ind_anulada				,
							cod_usuario				,
							ind_bloqueado
							) values (
							$cod_cliente			,
							1						,
							$cod_resolucion_dian	,
							'$fec_registro'			,
							0						,
							0						,
							$cod_usuario			,
							0
							)";
	
				$db->consultar($query);
				$cod_pk	= $GLOBALS['fn_ultimo_registro'];
				
				return $cod_pk;	
				
			}
		}	
		
		/*===== 2013/12/27  ===lıllı ((((̲̅̅●̲̲̅̅̅̅=̲̲̅̅̅̅●̲̅̅)))) ıllı=========================>>>>
		DESCRIPCION: 	Genera facturas de manera masiva asignandoles codigos de 
						factura a los pedidos seleccionados
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		$cursor_pedido		pedidos seleccionados por el usuario
		$cod_usuario		usuario que ejecuta el proceso
		===========================================================================*/
		function p_genera_facturas($cursor_pedido,$cod_usuario){
			global $db;
			
			if(!$cod_usuario)return false;
			
			
			$resolucion_dian 	= new resolucion_dian();
			$parametro_sistema	= new parametro_sistema();
			$pedido				= new pedido();
			
			
			$row_parametro = $parametro_sistema->f_get_row(6); // para saber si el modulo de resolucion esta activo
			$ind_resolucion_dian_activo = $row_parametro['val_parametro'];
			
				
			
			//$entidad 	= new entidad;
			//$atencion 	= new atencion;
			
			//$num_entidades			=	$db->num_registros($cursor_autorizaciones);
			
			$num_pedidos = $db->num_registros($cursor_pedido); // numero de pedidos
			if($num_pedidos > 0){ // si existen pedidos
							
				while($row = $db->sacar_registro($cursor_pedido)){				
					$cod_pedido 	= $row['cod_pedido'];
					$cod_cliente	= $row['cod_cliente'];
					$fec_registro	= $row['fec_registro'];
					// crea codigo de factura para relacionarlo
					$cod_factura 	= $this->p_crear_factura_pk($cod_usuario,$cod_cliente,$fec_registro); 
					
	
					if(!$cod_factura) break; // si no hay codigo de factura frena
					$cod_pk				= $GLOBALS['fn_ultimo_registro']; 
					$pedido->p_update_cod_factura($cod_pedido,$cod_factura); // relaciona el codigo de pedido contra la factura generada
				}
			}
		}// fin funcion
		
	}// fin clase
}// fin  validacion clase if_exist
?>