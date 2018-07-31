<?php
/*===== 20140116 ===================================D E C K===>>>>
DESCRIPCION: 	Contiene las tipo_consultas contra la tabla facturas_anuladas
PROPIETARIO:	© D E C K
AUTOR:			Luis Prieto
===========================================================================*/
class facturas_anuladas{
	
	/*===== 20140116 ======= ıllılı_d[^.^]b_ılıllı =========D E C K===>>>>
	DESCRIPCION: 	Retorna en vector todas las atenciones pertenecientes a una factura
	AUTOR:			Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	===========================================================================*/
   	function p_guarda_registro($arr_facturas,$var_request){
		global $db;
		$atencion = new atencion;
		
		$cod_usuario = $var_request['cod_usuario'];
		
		// recorre cada factura y busca sus atenciones para relacionarlas
		for($i=0;$i<count($arr_facturas);$i++){
			
			$cod_factura = $arr_facturas[$i];
			//consulta las atenciones
			$arr_cod_atncn = $atencion->f_get_by_fact_arr($cod_factura); // retorna los codigos de atencion en vector
			//$string_cod_atncn = implode(',',$arr_cod_atncn);	// cadena de codigos de atencion separados por coma
			
			
			for($j=0;$j<count($arr_cod_atncn);$j++){
				$cod_atencion = $arr_cod_atncn[$j];
				// guarda y relaciona cada atencion con el codiigo de factura
				$query="insert into facturas_anuladas 
						(cod_atencion,cod_factura,fec_registro,cod_usuario) 
						values 
						($cod_atencion,$cod_factura,now(),$cod_usuario)";
				$db->consultar($query);
			}									
		}					
	}
	
	
	
	

}

?>