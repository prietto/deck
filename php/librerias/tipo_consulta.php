<?
/*=====2012/08/08===================================D E C K===>>>>
DESCRIPCION: 	Contiene las tipo_consultas contra la tabla tipo_consulta
PROPIETARIO:	© D E C K
AUTOR:			Cristian Arellano
===========================================================================*/
class tipo_consulta{
	/*=====2012/08/15========================================D E C K===>>>>
	DESCRIPCION: 	Obtiene los tipos de consulta que estan activos
	AUTOR:			Cristian Arellano
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	===========================================================================*/
   	function f_get_activos(){
		global $db;
		
		//=== Quita la asignacion de usuario para evitar problemas con un codigo que se quede eternamente sin usar >>>
		$query	=	"	
		select	*
		from	tipo_consulta
		where	ind_activo = 1";
		$cursor		=	$db->consultar($query);
		return $cursor;
	}
}
?>