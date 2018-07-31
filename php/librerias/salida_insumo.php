<?php
/*===== 2016/04/11 =======================================D E C K===>>>>
DESCRIPCION: 	Contiene diferentes funciones realcionadas la tabla salida_insumo
PROPIETARIO:	© Luis Prieto
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
HISTORIAL DE MODIFICACIONES
---------------------------------------------------------------------------					
FECHA	AUTOR		MODIFICACION
===========================================================================*/
if(class_exists('salida_insumo') != true){

	class salida_insumo{

		var $cod_salida_insumo;
		var $cod_insumo;
		var $num_cantidad;
		var $num_peso = 0;
		var $txt_nota = NULL;
		var $ind_anulado = 0;
		var $cod_usuario;
		var $cod_usuario_modificacion;
		var $arr_msj = array();

		function __construct(){
			global $db;

			$this->cod_usuario 				= $GLOBALS['cod_usuario'];
	  		$this->cod_usuario_modificacion = $GLOBALS['cod_usuario'];

	  		// lista de errores
	  		$this->arr_msj[0]['code'] = 0;
	  		$this->arr_msj[0]['msj'] = 'PROCESO TERMINADO';

	  		$this->arr_msj[1]['code'] = 1;
	  		$this->arr_msj[1]['msj'] = 'No existe la cantidad necesaria en bodega para realizar el proceso';

			$this->arr_msj[2]['code'] = 2;
	  		$this->arr_msj[2]['msj'] = 'Ha ocurrido un error al ejecutar el proceso';

	  		//limpia el valor
	  		$this->num_cantidad = str_replace(',', '', $this->num_cantidad);
	  		$this->num_cantidad = $db->real_escape_string($this->num_cantidad);

		}

		/*===== 2016/04/19 ================================================>>>>
		DESCRIPCION: 		Metodo para devolver informacion de un registro puntual
		AUTOR:				Luis prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$cod_pk					codigo de primary key del registro
		===========================================================================*/
		function p_anular_salida_insumo($cod_salida_insumo){
			if(!$cod_salida_insumo)return false;
			global $db;


			// debe extraer la informacion sobre la salida
			$query = "select * from salida_insumo where cod_salida_insumo = ".$cod_salida_insumo;
			$row_salida = $db->consultar_registro($query);

			$this->cod_insumo 	= $row_salida['cod_insumo'];
			$this->num_cantidad = $row_salida['num_cantidad'];

			// query para actualizar el registro de salida_insumo
			$query = "update salida_insumo set 
						ind_anulado = 1 ,
						num_cantidad = 0
						where cod_salida_insumo = ".$cod_salida_insumo;
			$db->consultar($query);

			// consulta si es valido la actualizacion de stock del insumo involucrado
			if($this->f_valida_salida_entrada() == true){

				//DEBE RESTAR EL STOCK DEL INSUMO
	  			$query = "update 	insumo 
	  						set 	num_cantidad 	= num_cantidad + ".$this->num_cantidad." 
	  						where 	cod_insumo 		= ".$this->cod_insumo."";
	  			if(!$db->consultar($query)){

	  				// si existe un error en esta consulta debe eliminar la salida de insumo para evitar problema con integridad de datos
	  				$query = "update salida_insumo 
	  							set ind_anulado = 0, num_cantidad = ".$this->num_cantidad."
	  							where cod_salida_insumo = ".$cod_salida_insumo;
	  				$db->consultar($query);
					
					return $this->arr_msj[2];
	  			}else{

	  				// proceso terminado todo ok!!
	  				return $this->arr_msj[0];
	  			}


			}else{
				//==hay un problema para realiar el proceso>>
				// si existe un error en esta consulta debe eliminar la salida de insumo para evitar problema con integridad de datos
	  			$query = "update salida_insumo 
	  						set ind_anulado = 0, num_cantidad = ".$this->num_cantidad."
	  						where cod_salida_insumo = ".$cod_salida_insumo;
	  			$db->consultar($query);
					
				return $this->arr_msj[2];				
			}


		}

		/*===== 2016/04/19 ================================================>>>>
		DESCRIPCION: 		Metodo para devolver informacion de un registro puntual
		AUTOR:				Luis prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$cod_pk					codigo de primary key del registro
		===========================================================================*/
		function f_valida_salida_entrada(){
			global $db;

			// sumatoria de todas las entradas
	  		$query = "select 	sum(num_cantidad) as num 
	  					from 	entrada_insumo 
	  					where 	cod_insumo = ".$this->cod_insumo." 
	  					and 	(ind_anulado = 0 or ind_anulado is null)
	  					group 	by cod_insumo";
	  		
	  		$row_entrada = $db->consultar_registro($query);

	  		$sum_entrada = $row_entrada['num'];


	  		// INFORMACION DEL INSUMO INVOLUCRADO
	  		$query = "select num_cantida from insumo where cod_insumo = ".$this->cod_insumo;
	  		$row_insumo = $db->consultar_registro($query);
	  		$num_stock_insumo = $row_insumo['num_cantidad'];


	  		// sumatoria de todas las salidas
	  		$query = "	select 	sum(num_cantidad) as num 
	  					from 	salida_insumo 
	  					where 	cod_insumo = ".$this->cod_insumo." 
	  					and 	ind_anulado = 0
	  					group 	by cod_insumo";
	  		$row_salida = $db->consultar_registro($query);
	  		$sum_salida = $row_salida['num'];

	  		// valor que debe existir en stock
	  		$num_stock_ideal = $sum_entrada - $sum_salida;

	  		
	  		if($num_stock_insumo != $num_stock_ideal)return true;
	  		else return false;


		}

		/*===== 2016/04/19 ================================================>>>>
		DESCRIPCION: 		Metodo para devolver informacion de un registro puntual
		AUTOR:				Luis prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$cod_pk					codigo de primary key del registro
		===========================================================================*/
		function f_get_row($cod_pk){
			if(!$cod_pk)return false;
			global $db;

			$query = "select * from salida_insumo where cod_salida_insumo = ".$cod_pk;
			$row = $db->consultar_registro($query);

			return $row;

		}

		/*===== 2016/02/0 ================================================>>>>
		DESCRIPCION: 		Metodo para registrar la entrada de un insumo
		AUTOR:				Luis prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		$var_request		variables que llegan por post
		===========================================================================*/
	  	function p_guardar_registro(){
	  		global $db;

	  		$insumo = new insumo();
	  		$sis_genericos = new sis_genericos();

	  		// VALIDACIONES
	  		if(!$this->cod_insumo)return false;
			if(!$this->num_cantidad)$this->num_cantidad = 0;
			if(!$this->num_peso)$this->num_peso = 0;
			if(!$this->txt_nota)$this->txt_nota = 'NULL';

			//== valida que la cantidad sea un valor numerico>>
	  		if($sis_genericos->es_numero($this->num_cantidad)== false)return $this->arr_msj[2];


	  		// INFORMACION DEL INSUMO
	  		$row_insumo = $insumo->f_get_row($this->cod_insumo);
	  		$num_stock_insumo = $row_insumo['num_cantidad'];

	  		// SI LA CANTIDAD QUE EXISTE EN BODEGA ES MENOR A LA QUE SE PIENSA SACAR
	  		if($num_stock_insumo < $this->num_cantidad){
	  			return $this->arr_msj[1];
	  		}

	  		// consulta para ingreso de datos
	  		$query = "insert into salida_insumo
	  									(
	  										cod_insumo					,
	  										num_cantidad				,
	  										num_peso					,
	  										txt_nota					,
	  										ind_anulado					,
	  										fec_registro				,
	  										fec_modificacion				,
	  										cod_usuario_modificacion	,
	  										cod_usuario 				,
	  										ind_bloqueado
	  									)VALUES(
	  										".$this->cod_insumo."				,
	  										".$this->num_cantidad."				,
	  										".$this->num_peso."					,
	  										'".$this->txt_nota."'				,
	  										".$this->ind_anulado."				,
	  										now()								,
	  										now()								,
	  										".$this->cod_usuario_modificacion."	,
	  										".$this->cod_usuario_modificacion."	,
	  										0
	  									)";
	  		
	  		
	  		if(!$db->consultar($query))return $this->arr_msj[2];
	  		$cod_salida_insumo = $GLOBALS['fn_ultimo_registro'];

	  		// valida si es posible realizar el proceso de actualizacion de stock
	  		if($this->f_valida_salida_entrada()==true){
	  			//DEBE RESTAR EL STOCK DEL INSUMO
	  			$query = "update 	insumo 
	  					set 	num_cantidad = num_cantidad - ".$this->num_cantidad." 
	  					where 	cod_insumo = ".$this->cod_insumo."";
	  			if(!$db->consultar($query)){

	  				// si exizste un error en esta consulta debe eliminar la salida de insumo para evitar problema con integridad de datos
	  				$query = "delete from salida_insumo where cod_salida_insumo = ".$cod_salida_insumo;
					return $this->arr_msj[2];
	  			}

	  		}

	  		return $this->arr_msj[0];

	  	}// fin funcion

	} // fin clase
} // fin if
?>
