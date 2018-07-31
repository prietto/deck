<?
/*===== 20140102 ===================================D E C K===>>>>
DESCRIPCION: 	Contiene las tipo_consultas contra la tabla estado_factura
PROPIETARIO:	© D E C K
AUTOR:			Luis Prieto
===========================================================================*/
class estado_factura{
	
	/*===== 2014/11/03 ========================================D E C K===>>>>
	DESCRIPCION: 	Actualiza los colores para los estados de la factura
	AUTOR:			Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	===========================================================================*/
   	function p_update_color_vector($var_request){
		global $db;
		
		
		$arr_estados_factura = $var_request['estado_factura'];
		$error = 0;
		$arr_keys_estado_factura = array_keys($arr_estados_factura);
		for($i=0;$i<count($arr_keys_estado_factura);$i++){
			
			$cod_estado_factura = $arr_keys_estado_factura[$i];
			$val_color			= $arr_estados_factura[$cod_estado_factura];
			if($val_color == '#ffffff')$val_color = '';
			
			$query = "update estado_factura set txt_color = '$val_color' where cod_estado_factura = $cod_estado_factura";
			if(!$db->consultar($query))$error++;
		}
		
		if($error==0)return true;
		

	}
	
	/*===== 20140103 ========================================D E C K===>>>>
	DESCRIPCION: 	Obtiene los estado de factura que estan activos y que se puedan cambiar
	AUTOR:			Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	===========================================================================*/
   	function f_get_x_update(){
		global $db;
		
		$query	=	"	
		select	*
		from	estado_factura
		where	ind_activo = 1
		and		cod_estado_factura in (3,4,8)";
		$cursor		=	$db->consultar($query);
		return $cursor;
	}
	
	/*===== 20140102 ========================================D E C K===>>>>
	DESCRIPCION: 	Obtiene los estado de factura que estan activos
	AUTOR:			Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	===========================================================================*/
   	function f_get_all(){
		global $db;
		
		$query	=	"	
		select	*
		from	estado_factura
		where	ind_activo = 1";
		$cursor		=	$db->consultar($query);
		return $cursor;
	}
}
?>