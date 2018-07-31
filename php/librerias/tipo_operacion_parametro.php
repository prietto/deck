<?
/*===== 2015/08/03 ===================================D E C K===>>>>
DESCRIPCION: 	Contiene las tipo_consultas contra la tabla tipo_operacion_parametro
PROPIETARIO:	© D E C K
AUTOR:			Luis Prieto
===========================================================================*/
class tipo_operacion_parametro{
	
	/*===== 2015/08/04 ========================================D E C K===>>>>
	DESCRIPCION: 	Consulta y retorna en cusror los registro marcados como activos
	AUTOR:			Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	===========================================================================*/
   	function f_get_all_activo(){
		global $db;
		
		$query = "select *  from tipo_operacion_parametro where ind_activo = 1";

		$cursor = $db->consultar($query);
		
		return $cursor;
		
	}
}
	