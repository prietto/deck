<?
/*===== 2016/02/10 =======================================D E C K===>>>>
DESCRIPCION: 	Contiene diferentes funciones realcionadas la tabla insumo
PROPIETARIO:	© Luis Prieto
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
HISTORIAL DE MODIFICACIONES
---------------------------------------------------------------------------					
FECHA	AUTOR		MODIFICACION
===========================================================================*/
if(class_exists('insumo') != true){

	class insumo{
	
		var $cod_insumo;
		var $cod_usuario;
		var $cod_usuario_modificacion;

		function __construct(){
			$this->cod_usuario 				= $GLOBALS['cod_usuario'];
	  		$this->cod_usuario_modificacion = $GLOBALS['cod_usuario'];
		}

		/*===== 2014/10/13 =========================================>>>>
		DESCRIPCION: 		Metodo para retornar los ultimos movimientos del insumo
		AUTOR:				Luis Prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		===========================================================================*/
		function f_get_ultimos_movimientos($num_limit=10){
			global $db;

			$query = "
						
						(
							select 	ei.cod_insumo, 
									ei.num_cantidad,
									ei.fec_registro,
									'Entrada Insumo' as txt_concepto,
									if(ei.ind_anulado=1,'ANULADO','REGISTRADO') AS txt_estado,	
									ei.cod_entrada_insumo as id_concepto
							from 	entrada_insumo ei					
							where 	ei.cod_insumo = ".$this->cod_insumo."
							and	ei.ind_bloqueado = 0
							

						)union all(
							select 	si.cod_insumo,
									si.num_cantidad,
									si.fec_registro,
									'Salida Insumo' as txt_concepto,
									if(si.ind_anulado=1,'ANULADO','REGISTRADO') AS txt_estado,	
									si.cod_salida_insumo as id_concepto
							from 	salida_insumo si
									
							where 	si.cod_insumo = ".$this->cod_insumo."
							and	si.ind_bloqueado = 0						
							
						)
							order by fec_registro desc limit 0,".$num_limit."

							";
					
			$cursor = $db->consultar($query);

			return $cursor;

		}

		/*===== 2016/02/10 =======================================D E C K===>>>>
		DESCRIPCION: 	Retorna informacion de un registro especifico
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		HISTORIAL DE MODIFICACIONES
		---------------------------------------------------------------------------					
		FECHA			AUTOR			MODIFICACION
		2016/10/02		Luis Prieto		Creacion de la fuincion
		===========================================================================*/
		function f_get_info(){
			if(!$this->cod_insumo)return false;
			global $db;

			$query = "select * from insumo where cod_insumo = ".$this->cod_insumo;
			$row=$db->consultar_registro($query);
			return $row;

		}



		/*===== 2016/02/10 =======================================D E C K===>>>>
		DESCRIPCION: 	Retorna informacion de un registro especifico
		AUTOR:			Luis Prieto
		---------------------------------------------------------------------------					
		HISTORIAL DE MODIFICACIONES
		---------------------------------------------------------------------------					
		FECHA			AUTOR			MODIFICACION
		2016/10/02		Luis Prieto		Creacion de la fuincion
		===========================================================================*/
		function f_get_row($cod_insumo){
			if(!$cod_insumo)return false;
			global $db;
			
			$query = "select * from insumo where cod_insumo  = $cod_insumo";

			$row = $db->consultar_registro($query);
			
			return $row;
		} // fin funcion



	} // fin clase
} // fin validacion