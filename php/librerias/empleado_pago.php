<? 
/*===== 2015/12/30 ==========================================>>>>
DESCRIPCION: 	Contiene diferentes funciones realcionadas la tabla entrada_producto
PROPIETARIO:	© Luis Prieto
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
HISTORIAL DE MODIFICACIONES
---------------------------------------------------------------------------					
FECHA	AUTOR		MODIFICACION
===========================================================================*/
if(class_exists('empleado_pago') != true){
	class empleado_pago{

		/*===== 2016/01/06 ======================================================>>>>
		DESCRIPCION: 	Metodo para consultar un registro de manera detallada con sus relaciones
						a otras tablas
		---------------------------------------------------------------------------					
		PARAMETRO		DESCRIPCION
		---------------------------------------------------------------------------					
		HISTORIAL DE MODIFICACIONES
		---------------------------------------------------------------------------
		FECHA			AUTOR			MODIFICACION
		2016/01/06		Luis Prieto		Creacion de la funcion
		===========================================================================*/
		function f_get_row_detallado($cod_empleado_pago){
			if(!$cod_empleado_pago)return false;
			global $db;

			$query = "	select 	ep.cod_empleado	,
								ep.txt_nota		,
								ep.fec_registro	,
								ep.cod_usuario ,
								su.txt_nombre as txt_usuario
						from 	empleado_pago ep,
								seg_usuario su 
						where 	ep.cod_empleado_pago = ".$cod_empleado_pago."
						and 	ep.cod_usuario = su.cod_usuario_pk";


			$row = $db->consultar_registro($query);

			return $row;
		}

		/*===== 2016/01/06 ======================================================>>>>
		DESCRIPCION: 	Metodo para registrar un dato
		---------------------------------------------------------------------------					
		PARAMETRO		DESCRIPCION
		---------------------------------------------------------------------------					
		HISTORIAL DE MODIFICACIONES
		---------------------------------------------------------------------------
		FECHA			AUTOR			MODIFICACION
		2016/01/06		Luis Prieto		Creacion de la funcion
		===========================================================================*/
		function f_get_row($cod_empleado_pago){
			if(!$cod_empleado_pago)return false;
			global $db;

			$query = "	select 	cod_empleado	,
								txt_nota		,
								fec_registro	,
								cod_usuario 
						from 	empleado_pago 
						where 	cod_empleado_pago = ".$cod_empleado_pago;

			$row = $db->consultar_registro($query);

			return $row;
		}

		/*===== 2016/01/06 ======================================================>>>>
		DESCRIPCION: 	Metodo para registrar un dato
		---------------------------------------------------------------------------					
		PARAMETRO		DESCRIPCION
		---------------------------------------------------------------------------					
		HISTORIAL DE MODIFICACIONES
		---------------------------------------------------------------------------
		FECHA			AUTOR			MODIFICACION
		2016/01/06		Luis Prieto		Creacion de la funcion
		===========================================================================*/
		function f_get_by_condicion($cod_empleado,$fec_ini=NULL,$fec_fin=NULL,$num_limit=10){
			if(!$cod_empleado)return false;
			global $db;
			
			// default 10 registro para primer pantallazo
			if(!$num_limit)$num_limit = 10;
			
			// si existen fechas condicionales 
			if($fec_ini != NULL && $fec_fin != NULL){
				$query = "	select 	ep.*,
									su.txt_nombre as txt_usuario
							from 	empleado_pago ep,
									seg_usuario su
							where 	cod_empleado = $cod_empleado 
							AND 	(fec_registro between '".$fec_ini."' and '".$fec_fin."') 
							and		ep.cod_usuario = su.cod_usuario_pk
							order by fec_registro desc limit ".$num_limit;
			}else{
				$query = "select 	ep.*,
                      				SUM(dep.num_valor) as val_total,
							    	su.txt_nombre as txt_usuario
							from 	empleado_pago ep,
                      				detalle_empleado_pago dep,
									seg_usuario su
							where 	ep.cod_empleado = ".$cod_empleado."
							AND	  	ep.cod_usuario = su.cod_usuario_pk
              				and     ep.cod_empleado_pago = dep.cod_empleado_pago
              				group by dep.cod_empleado_pago
							order 	by fec_registro desc limit ".$num_limit;

			}
			

			$cursor = $db->consultar($query);

			return $cursor;
			
		}
		
		/*===== 2016/01/06 ======================================================>>>>
		DESCRIPCION: 	Metodo para registrar un dato
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION
		$cod_empleado   	Codigo unico de empleado al que se le realizara el pago
		$fec_registro		Fecha en la que se hara efectivo el pago
		$cod_usuario 		codigo unico de usuario que realiza el procedimiento
		$txt_nota			nota_general del pago
		$array_num_valor	array de los valores que registro el usuario
		$array_txt_concepto	array de los conceptos por los cuales se realiza el pago 
		---------------------------------------------------------------------------					
		HISTORIAL DE MODIFICACIONES
		---------------------------------------------------------------------------
		FECHA			AUTOR			MODIFICACION
		2016/01/06		Luis Prieto		Creacion de la funcion
		===========================================================================*/
		function p_registrar_pago(	$cod_empleado 				,
									$fec_registro 				,
									$cod_usuario 				,
									$txt_nota			=NULL 	,
									$array_txt_concepto	=NULL 	,
									$array_num_valor	=NULL
									
								){
			if(!$cod_empleado || !$cod_usuario)return false;
			global $db;

			$detalle_empleado_pago = new detalle_empleado_pago();
			
			// si no hay fecha de registro por algun motivo por default sera en dia de hoy
			if(!$fec_registro)$fec_registro = 'now()';
			
			// debemos limpiar el valor de posibles comas
			//$val_pago = str_replace(',','',$val_pago);
			
			// limpia los datos para evitar inyeccion
			$txt_nota = mysql_real_escape_string($txt_nota);			
			
			
			$query = "insert into empleado_pago (
												   cod_empleado
												  ,txt_nota
												  ,fec_registro
												  ,cod_usuario
												  ,ind_bloqueado
												) VALUES (
												   ".$cod_empleado."  
												  ,'".$txt_nota."'  
												  ,'".$fec_registro."'  
												  ,".$cod_usuario."   
												  ,0   
												)";
			if($db->consultar($query) == true){
				$cod_empleado_pago	= $GLOBALS['fn_ultimo_registro'];

				// llama a la funcion para registrar el detalle del pago para el empleado
				$detalle_empleado_pago->p_registrar_dato($cod_empleado_pago,$array_txt_concepto,$array_num_valor,$cod_usuario,$fec_registro);

				// retorna el codigo del recibo
				return $cod_empleado_pago;


			}else return 'error';
		
		}
	
	}
}
?>