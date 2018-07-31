<?php
/*===== 2014/05/07 ===================================D E C K===>>>>
DESCRIPCION: 	Contiene las consultas contra la tabla proceso_navegacion
PROPIETARIO:	© D E C K
AUTOR:			Luis Prieto
===========================================================================*/
class proceso_navegacion{
	
	/*=====2014/05/07 ===================================D E C K===>>>>
	DESCRIPCION: 	Metodo para obtener los antecedentes de un paciente y los retorna
					en forma de cadena
	AUTOR:			Luis prieto
	---------------------------------------------------------------------------					
	PARAMETRO					DESCRIPCION 
	===========================================================================*/
	function f_get_by_codigos($string_codigos,$cod_perfil){
		global $db;
	
		$query = "select cod_navegacion from proceso_navegacion 
					where cod_proceso in ($string_codigos) group by cod_navegacion ";
		$cursor = $db->consultar($query);
		
		$arr_navegacion = array();
		while($row=$db->sacar_registro($cursor)){
			$cod_navegacion = $row['cod_navegacion'];		
			
			$query ="select count(*) as cantidad from seg_perfil_navegacion where cod_navegacion = $cod_navegacion and cod_perfil = $cod_perfil";

			$row = $db->consultar_registro($query);
			
			$num_registros = $row['cantidad'];
			if($num_registros == 0){			
			
				array_push($arr_navegacion,$cod_navegacion);
			}
		}
		
		$cadena = implode(',',$arr_navegacion);
		
		return $arr_navegacion;
	}
	
	/*=====2014/05/07 ===================================D E C K===>>>>
	DESCRIPCION: 	Metodo para obtener los antecedentes de un paciente y los retorna
					en forma de cadena
	AUTOR:			Luis prieto
	---------------------------------------------------------------------------					
	PARAMETRO					DESCRIPCION 
	===========================================================================*/
	function f_get_registros(){
		global $db;
		
		$query = "select * from proceso_navegacion order by txt_nombre";
		$cursor = $db->consultar($query);
		return $cursor;
	
	
	}	
	
}