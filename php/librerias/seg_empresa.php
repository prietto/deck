<? 
/*===== 2016/07/22 ==========================================>>>>
DESCRIPCION: 	Contiene diferentes funciones realcionadas la tabla seg_empresa
PROPIETARIO:	© Luis Prieto
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
HISTORIAL DE MODIFICACIONES
---------------------------------------------------------------------------					
FECHA	AUTOR		MODIFICACION
===========================================================================*/
if(class_exists('seg_empresa') != true){
	class seg_empresa{

		var $cod_empresa;
		var $cod_usuario;
		var $cod_usuario_modificacion;
		var $arr_msj = array();


		function __construct(){
			$this->cod_usuario 				= $GLOBALS['cod_usuario'];
	  		$this->cod_usuario_modificacion = $GLOBALS['cod_usuario'];

	  		// lista de errores
	  		$this->arr_msj[0]['code'] = 0;
	  		$this->arr_msj[0]['msj'] = 'PROCESO TERMINADO';

	  		$this->arr_msj[2]['code'] = 2;
	  		$this->arr_msj[2]['msj'] = 'Ha ocurrido un error al ejecutar el proceso';


		}


		/*===== 2016/07/29 ================================================>>>>
		DESCRIPCION: 		Metodo para guardar/registrar la empresa que operara el sistema
		AUTOR:				Luis prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		===========================================================================*/
		function p_guardar_registro($var_request,$var_files){
			global $db;

			$columna_tabla_autonoma = new columna_tabla_autonoma();

			$txt_razon_social 			= $var_request['txt_razon_social'];
			$txt_nombre_comercial		= $var_request['txt_nombre_comercial'];
			$cod_ciiu					= $var_request['cod_ciiu'];
			$cod_tipo_identificacion	= $var_request['cod_tipo_identificacion'];
			$num_identificacion			= $var_request['num_identificacion'];
			$cod_ciudad					= $var_request['cod_ciudad'];
			$txt_direccion				= $var_request['txt_direccion'];
			$txt_telefono				= $var_request['txt_telefono'];
			$ind_genera_iva				= $var_request['ind_genera_iva'] == NULL ? 'NULL' :  $var_request['ind_genera_iva'];
			$val_porcentaje_iva			= $var_request['val_porcentaje_iva'] == NULL ? 'NULL' :  $var_request['val_porcentaje_iva'];
			$fec_fundacion				= $var_request['fec_fundacion'];
			$fec_modificacion			= date('Y/m/d');
			$txt_url_logo				= NULL;
			
			/*$query = "truncate seg_empresa";
			$db->consultar($query);*/

			// primero debe validar si existe inforamcion de la empresa y codigo ya creado
			$this->cod_empresa = $this->f_get_cod_empresa();
			
			// informacion de la columna tabla autonoma de la tabla empresa para el campo logo
			$query = "select * from columna_tabla_autonoma where cod_columna_tabla = 349";
			$row_info_columna = $db->consultar_registro($query);



			// si no esta registrada la empresa

			if(!$this->cod_empresa){

			
				$fec_registro = date('Y/m/d H:i:s');
				

				$query = "insert into seg_empresa 	(
													txt_razon_social		,
													txt_nombre_comercial	,
													cod_ciiu				,
													cod_tipo_identificacion	,
													num_identificacion		,
													cod_ciudad				,
													txt_direccion			,
													txt_telefono			,
													ind_iva					,
													val_porcentaje_iva		,
													fec_fundacion			,
													fec_registro			,
													fec_modificacion		,
													cod_usuario				,
													ind_bloqueado

												)values(
													'".$txt_razon_social."'			,
													'".$txt_nombre_comercial."'		,
													".$cod_ciiu."					,	
													".$cod_tipo_identificacion."	,
													".$num_identificacion."			,
													".$cod_ciudad."					,
													'".$txt_direccion."'			,
													'".$txt_telefono."'				,
													".$ind_genera_iva."				,
													".$val_porcentaje_iva."			,
													'".$fec_fundacion."'			,
													'".$fec_registro."'				,
													'".$fec_modificacion."'			,
													".$this->cod_usuario."			,
													0
												)";
				
				if(!$db->consultar($query))return $this->arr_msj[2];
				$this->cod_empresa = $GLOBALS['fn_ultimo_registro'];

			}else{ // si ya existe un registro de empresa

				$query = "update seg_empresa set 
												txt_razon_social 		= 	'".$txt_razon_social."'			,
												txt_nombre_comercial 	=  	'".$txt_nombre_comercial."'		,
												cod_ciiu				=	".$cod_ciiu."					,
												cod_tipo_identificacion	=	".$cod_tipo_identificacion."	,
												num_identificacion		=	".$num_identificacion."			,
												cod_ciudad				=	".$cod_ciudad."					,
												txt_direccion			=	'".$txt_direccion."'			,
												txt_telefono			=	'".$txt_telefono."'				,
												ind_iva					=	".$ind_genera_iva."				,
												val_porcentaje_iva		= 	".$val_porcentaje_iva."			,
												fec_fundacion			=	'".$fec_fundacion."'			,
												fec_modificacion		=	'".$fec_modificacion."'			
							where cod_empresa = ".$this->cod_empresa;
				
				if(!$db->consultar($query))return $this->arr_msj[2]; 

			} // fin else

			


			if(count($var_files)>0){
				// === funcion para guardar el archivo seleccionado como logo == //
				$txt_url_logo = $columna_tabla_autonoma->p_guardar_archivo($var_files,$cod_empresa,$row_info_columna);

				//== debe actualizar la url del logo ==//
				$query = "update seg_empresa set txt_url_logo = '".$txt_url_logo."' where cod_empresa =  ".$this->cod_empresa;
				if(!$db->consultar($query))return $this->arr_msj[2]; 
			}


			return $this->arr_msj[0]; // == proceso exitoso

		} // == fin function == //



		/*===== 2016/04/19 ================================================>>>>
		DESCRIPCION: 		Metodo para validar que existe una empresa registrada y devolver el codigo
		AUTOR:				Luis prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		===========================================================================*/
		function f_get_cod_empresa(){
			global $db;

			$query = "select count(*) as num, cod_empresa from seg_empresa group by cod_empresa";
			
			$row = $db->consultar_registro($query);

			$num_registros = $row['num'];

			if($num_registros>0){
				return $row['cod_empresa'];
			}else return false;
		}


		/*===== 2016/04/19 ================================================>>>>
		DESCRIPCION: 		Metodo para devolver informacion de un registro puntual
		AUTOR:				Luis prieto
		---------------------------------------------------------------------------					
		PARAMETRO				DESCRIPCION 
		===========================================================================*/
		function f_get_row(){
			global $db;
			if(!$this->cod_empresa)return false;

			$query = "select * from seg_empresa where cod_empresa = ".$this->cod_empresa;
			$row = $db->consultar_registro($query);
			

			return $row;

		}
	} // == fin class
} // fin if
?>