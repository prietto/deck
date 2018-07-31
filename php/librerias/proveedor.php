<?
/*=====2014/07/23===================================================>>>>
DESCRIPCION: 	Contiene las tipo_consultas contra la tabla Proveedor
PROPIETARIO:	© Luis Prieto
AUTOR:			Luis Prieto
===========================================================================*/
class proveedor{
	/*=====2012/08/15========================================D E C K===>>>>
	DESCRIPCION: 	Obtiene la informacion de un registro puntual
	AUTOR:			Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	===========================================================================*/
	function f_get_row($cod_pk){
		if(!$cod_pk)return false;
		global $db;
		$query = "select * from proveedor where cod_proveedor = $cod_pk";

		$row = $db->consultar_registro($query);
		return $row;
	
	}	
}