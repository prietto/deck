<?
/*=====2012/08/08===================================D E C K===>>>>
DESCRIPCION: 	Contiene las atencions contra la guarda_impuesto
PROPIETARIO:	© D E C K
AUTOR:			Luis Prieto
===========================================================================*/
class guarda_impuesto{
	
	/*===== 20140109 =======	illili_d[^.^]b_ililli ========D E C K===>>>>
	DESCRIPCION: 	Guarda registro de de codigos de facturas en cadena y suis valores de impuestos
					para llevar un historial de movimientos
	AUTOR:			Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO			DESCRIPCION 
	$reg_seleccionado	facturas seleccionadas
	$var_request		donde vienen los valores de impuestos ingresados por el ususario
	===========================================================================*/
   	function p_guardar_impuestos($reg_seleccionado,$var_request){
		global $db;
		if(!$reg_seleccionado)return false;
		
		$cadena_facturas 	= implode(',',$reg_seleccionado);
		$val_iva_porc		= $var_request['val_iva_porc'];
		//$val_rete_porc		= $var_request['val_rete_porc'];
		$val_cree_porc		= $var_request['val_cree_porc'];
		$cod_usuario		= $var_request['cod_usuario'];
		
		if(!$val_iva_porc) 	$val_iva_porc 	= 'NULL';
		//if(!$val_rete_porc)	$val_rete_porc	= 'NULL';
		if(!$val_cree_porc)	$val_cree_porc	= 'NULL';
		
				
		$query1="select count(*) as num_registros from guarda_impuesto 
					where 	txt_facturas 	= 	'$cadena_facturas' 
					and 	val_iva_porc 	= 	$val_iva_porc
					and		val_cree_porc	=	$val_cree_porc";
		$row=$db->consultar_registro($query1);
		$num_registros = $row['num_registros'];
		if($num_registros < 1){
		
			$query="
				insert into	guarda_impuesto 
							(
							txt_facturas	,
							val_iva_porc	,
							val_cree_porc	,
							fec_registro	,
							cod_usuario
							
							)VALUES(
							
							'$cadena_facturas'	,
							$val_iva_porc		,
							$val_cree_porc		,
							now()				,
							$cod_usuario
							)";

			$db->consultar($query);
		}else{
			return false;
		
		}
	
	
	}
	

}

?>