<? 
/*===== 2016/07/24 ==========================================>>>>
DESCRIPCION: 	Contiene diferentes funciones realcionadas la tabla ciudad
PROPIETARIO:	© Luis Prieto
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
HISTORIAL DE MODIFICACIONES
---------------------------------------------------------------------------					
FECHA	AUTOR		MODIFICACION
===========================================================================*/
if(class_exists('ciudad') != true){
	class ciudad{

		/*===== 2016/04/19 ================================================>>>>
		DESCRIPCION: 		Metodo para retornar los registros activos
		AUTOR:				Luis prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		===========================================================================*/
		function f_get_all_activos(){
			global $db;

			$query = "select cod_tipo_identificacion,txt_nombre from ciudad where ind_activo = 1";
			$cursor = $db->consultar($query);

			return $cursor;
		}

	} // fin class
} // fin IF