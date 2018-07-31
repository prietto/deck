<? 
/*===== 2017/11/04 ==========================================>>>>
DESCRIPCION: 	Contiene diferentes funciones realcionadas la tabla tipo_tabla_autonoma
PROPIETARIO:	© Luis Prieto
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
HISTORIAL DE MODIFICACIONES
---------------------------------------------------------------------------					
FECHA	AUTOR		MODIFICACION
===========================================================================*/
if(class_exists('tipo_tabla_autonoma') != true){
	class tipo_tabla_autonoma{
		/*===== 2015/12/30 ======================================================>>>>
		DESCRIPCION: 		Metodo para retornar las informacion de un empleado en particular
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION
		---------------------------------------------------------------------------					
		HISTORIAL DE MODIFICACIONES
		---------------------------------------------------------------------------
		FECHA			AUTOR			MODIFICACION
		2015/12/30		Luis Prieto		Creacion de la funcion
		===========================================================================*/
		function f_get_all(){
			global $db;

			$query = "select * from tipo_tabla_autonoma";
			$cursor = $db->consultar($query);
			return $cursor;

		}
	}
}