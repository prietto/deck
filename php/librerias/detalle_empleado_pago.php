<? 
/*===== 2016/01/19 ==========================================>>>>
DESCRIPCION: 	Contiene diferentes funciones realcionadas la tabla detalle_empleado_pago
PROPIETARIO:	© Luis Prieto
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
HISTORIAL DE MODIFICACIONES
---------------------------------------------------------------------------					
FECHA	AUTOR		MODIFICACION
===========================================================================*/
if(class_exists('detalle_empleado_pago') != true){
	class detalle_empleado_pago{
		/*===== 2016/01/21 ======================================================>>>>
		DESCRIPCION: 	Metodo para consultar registro detalle segun el pago a un empleado
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION
		$cod_empleado_pago	codigo pk 	que relaciona los detalles contra la tabla empleado_pago
		---------------------------------------------------------------------------					
		HISTORIAL DE MODIFICACIONES
		---------------------------------------------------------------------------
		FECHA			AUTOR			MODIFICACION
		2016/01/21		Luis Prieto		Creacion de la funcion
		===========================================================================*/
		function f_get_cursor($cod_empleado_pago){
			if(!$cod_empleado_pago)return false;
			global $db;
			
			$query = "	select 	cod_detalle_empleado_pago,
				 				cod_empleado_pago,
								txt_concepto,
								num_valor,
								fec_registro
						from 	detalle_empleado_pago 
						where 	cod_empleado_pago = ".$cod_empleado_pago."";

			$cursor = $db->consultar($query);
			
			
			return $cursor;
			
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
		function p_registrar_dato(	$cod_empleado_pago 		,
									$array_txt_concepto		,
									$array_num_valor 		,
									$cod_usuario			,
									$fec_registro	
								){
			if(!$cod_empleado_pago || !$cod_usuario || (count($array_txt_concepto)==0))return false;
			global $db;


			
			for($i=0;$i<count($array_txt_concepto);$i++){
				$txt_conceto	= $array_txt_concepto[$i];
				$num_valor 		= $array_num_valor[$i];
				
				$num_valor 		= str_replace(',', '', $num_valor);

				if($txt_conceto != NULL || $num_valor !== NULL){

					$query = "insert into detalle_empleado_pago (
					
											cod_empleado_pago	,
											txt_concepto		,
											num_valor			,
											fec_registro		,
											cod_usuario			,
											ind_bloqueado		
											)VALUES(
												".$cod_empleado_pago."	,
												'".$txt_conceto."'		,
												".$num_valor."			,												
												'".$fec_registro."'		,
												".$cod_usuario."		,
												0
											)";
					
					$db->consultar($query);

				} // FIN IF


			} // fin for

			
		} // fin funcion

	} // fin clase
} // fin validacion clase


?>