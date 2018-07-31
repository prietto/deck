<?
/*===== 20140102 ===================================D E C K===>>>>
DESCRIPCION: 	Contiene las tipo_consultas contra la tabla estado_factura
PROPIETARIO:	© D E C K
AUTOR:			Luis Prieto
===========================================================================*/
class estado_pedido{
	
	/*===== 2014/11/03 ========================================D E C K===>>>>
	DESCRIPCION: 	Actualiza los colores para los estados de los pedidos para los reportes
	AUTOR:			Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	===========================================================================*/
   	function p_update_color_vector($var_request){
		global $db;
		
		
		$arr_estados_pedido = $var_request['estado_pedido'];
		$error = 0;
		$arr_keys_estado_pedido = array_keys($arr_estados_pedido);
		for($i=0;$i<count($arr_keys_estado_pedido);$i++){
			
			$cod_estado_pedido = $arr_keys_estado_pedido[$i];
			$val_color			= $arr_estados_pedido[$cod_estado_pedido];
			if($val_color == '#ffffff')$val_color = '';
			
			$query = "update estado_pedido set txt_color = '$val_color' where cod_estado_pedido = $cod_estado_pedido";
			
			if(!$db->consultar($query))$error++;
		}
		
		if($error==0)return true;

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
		from	estado_pedido
		where	ind_activo = 1";
		$cursor		=	$db->consultar($query);
		return $cursor;
	}


}

?>