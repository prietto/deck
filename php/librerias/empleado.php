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
if(class_exists('empleado') != true){
	class empleado{
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
		function f_get_row($cod_pk){
			if(!$cod_pk)return false;
			global $db;
			
			$query = "select * from empleado where cod_empleado = $cod_pk";
			$row = $db->consultar_registro($query);
			
			return $row;
			
		
		}
		
		
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
		function f_get_row_detallado($cod_pk){
			if(!$cod_pk)return false;
			global $db;
			
			$query = "	select 	e.*,
								ti.txt_nombre as txt_tipo_identificacion,
								ti.txt_nombre_corto as txt_tipo_identificacion_corto,
								c.txt_nombre as txt_ciudad,
								tce.txt_nombre as txt_tipo_cargo
						from 	empleado e,
								tipo_identificacion ti,
								ciudad c,
								tipo_cargo_empleado tce
						where 	e.cod_empleado = $cod_pk
						and		e.cod_tipo_identificacion = ti.cod_tipo_identificacion
						and 	e.cod_ciudad = c.cod_ciudad
						and		e.cod_tipo_cargo_empleado = tce.cod_tipo_cargo_empleado";
			$row = $db->consultar_registro($query);
			
			return $row;
			
		
		}

	}
}
?>