<?
/*=====2012/08/08===================================D E C K===>>>>
DESCRIPCION: 	Contiene las atencions contra la tabla atencion
PROPIETARIO:	© D E C K
AUTOR:			Cristian Arellano
===========================================================================*/
class resolucion_dian{
	
	/*===== 2013/12/30 =======	illili_d[^.^]b_ililli ========D E C K===>>>>
	DESCRIPCION: 	Busca y retorna si existe alguna resolucion activa en el sistema
	AUTOR:			Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO			DESCRIPCION 
	===========================================================================*/
   	function f_get_row_activa(){
		global $db;
				
		$query	="select * from resolucion_dian where ind_activo = 1";
		$row = $db->consultar_registro($query);
		return $row;
	}
	
	
	
	/*===== 2013/12/30 =======	illili_d[^.^]b_ililli ========D E C K===>>>>
	DESCRIPCION: 	Busca y retorna si existe alguna resolucion activa en el sistema
	AUTOR:			Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO			DESCRIPCION 
	===========================================================================*/
   	function f_get_row_activo(){
		global $db;
		$query	="select count(*) as cant from resolucion_dian where ind_activo = 1";
		$row = $db->consultar_registro($query);
		return $row['cant'];
	}
	
}



?>