<?php
/*===== 2014/05/06 =======================================D E C K===>>>>
DESCRIPCION: 	Contiene diferentes funciones realcionadas la tabla condicion_consulta
PROPIETARIO:	© D E C K
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
HISTORIAL DE MODIFICACIONES
---------------------------------------------------------------------------					
FECHA	AUTOR		MODIFICACION
===========================================================================*/
class condicion_consulta{
	
	
	
	/*===== 2014/05/06 =====================================D E C K===>>>>
	DESCRIPCION: 	Retorna cursor de tablas y permisos sobre la tabla
	AUTOR:			Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	$var_request	variables que llegan por post desde el form
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA	AUTOR		MODIFICACION
	===========================================================================*/
	function f_get_permisos_modulos($cod_perfil_pk){
		global $db;
		
		$query = "	select 	spta.*,
							cc.cod_entidad as cod_entidad_pk,
							cc.fec_consulta
					from 	seg_permiso_tabla_autonoma  spta left join condicion_consulta cc on (spta.cod_perfil = cc.cod_perfil)
					where 	spta.cod_perfil = $cod_perfil_pk 
					group 	by cod_tabla";

		$cursor = $db->consultar($query);		
		return $cursor;
			
	}
	
	/*===== 2014/05/06 ========================================D E C K===>>>>
	DESCRIPCION: 	Ob
	AUTOR:			Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA	AUTOR		MODIFICACION
	===========================================================================*/
  	function p_modificar_registro($var_request){
		global $db;
		
		$seg_perfil = new seg_perfil;
		
		$arr_modulo 		= $var_request['cod_modulo'];
		$arr_entidad		= $var_request['cod_entidad'];
		$arr_fecha			= $var_request['fec_consulta'];
		$cod_perfil_pk 		= $var_request['cod_pk'];
		
		$row_perfil			= $seg_perfil->f_get_row($cod_perfil_pk);
		$txt_perfil			= $row_perfil['txt_nombre'];
		$txt_nom_reporte 	= "Reporte ".$txt_perfil;
		
		for($i=0;$i<count($arr_modulo);$i++){
			
			$cod_tabla 		= $arr_modulo[$i];			
			$cod_entidad	= $arr_entidad[$i];
			$fec_consulta	= $arr_fecha[$i];	
			$fec_consulta	= '"'.$fec_consulta.'"';	
			
			if($cod_tabla != -1 && $cod_entidad != -1 && $fec_consulta != NULL){
				
				// debe consulta si existe el registro para saber si se actualiza o se ingresa
				$query = "
					select 	count(*) as cantidad,
							cod_condicion_consulta,
							cod_reporte_tabla 
					from 	condicion_consulta  
					where   cod_entidad = $cod_entidad 
					and     cod_perfil = $cod_perfil_pk 
					and     cod_tabla = $cod_tabla
					group 	by cod_condicion_consulta";
				$row = $db->consultar_registro($query);
				$num_registros 				= $row['cantidad'];
				$cod_condicion_consulta 	= $row['cod_condicion_consulta'];
				$cod_reporte_tabla			= $row['cod_reporte_tabla'];
				
				// arma el script para el reporte tabla
				$txt_script_consulta = '
					SELECT  t.cod_paciente,
							concat( t.txt_nombre," ",t.txt_apellido) as txt_nombre, 
							t.txt_identificacion, 
							t.txt_telefono, 
							t.txt_celular,
							e.txt_nombre as 01entidad_erp,
							e2.txt_nombre as 01entidad_eapb,
							t.txt_tramite_orden, 
							tv.txt_nombre as cod_tipo_vinculacion, 
							ep.txt_nombre as cod_estado_paciente 
					FROM    ((paciente t left join  tipo_vinculacion tv on(t.cod_tipo_vinculacion = tv.cod_tipo_vinculacion))
							left join entidad e on (e.cod_entidad = t.cod_entidad))
							left join entidad e2 on (e2.cod_entidad = t.cod_entidad_2), 
							estado_paciente ep       
							
					where   ep.cod_estado_paciente = t.cod_estado_paciente 
					and     t.ind_bloqueado=0  
					and		t.cod_entidad = '.$cod_entidad.'
					and		t.fec_registro >= '.$fec_consulta.'
					condiciones_script_consulta';
					
					$txt_script_consulta = "'".$txt_script_consulta."'";
				
				if($num_registros == 0){
				
					// se crea un reporte tabla especial
					$query = "
						insert into reporte_tabla (
						   txt_nombre
						  ,cod_tabla
						  ,txt_script
						  ,ind_activo
						  ,ind_default
						) VALUES (
						  '$txt_nom_reporte'
						  ,$cod_tabla
						  ,$txt_script_consulta
						  ,1
						  ,1
						)";
				
					$db->consultar($query);
					$cod_pk = $GLOBALS['fn_ultimo_registro'];
					
					
					//guarda el registro detalle en la tabla condicion_consulta
					$query = "
						insert into condicion_consulta (
						   cod_perfil
						  ,cod_tabla
						  ,cod_reporte_tabla
						  ,cod_entidad
						  ,fec_consulta
						) VALUES (
						   $cod_perfil_pk
						  ,$cod_tabla
						  ,$cod_pk
						  ,$cod_entidad
						  ,$fec_consulta
						)";

					$db->consultar($query);
					
				}else if($num_registros > 0){
					$query = "update reporte_tabla set	
										txt_script = $txt_script_consulta
								where cod_reporte_tabla = $cod_reporte_tabla";

					$db->consultar($query);
					
					
					$query = "update condicion_consulta set
									cod_entidad 	= $cod_entidad	,
									fec_consulta	= $fec_consulta
								where cod_condicion_consulta = $cod_condicion_consulta";
					
					$db->consultar($query);
				
				}
				
				
			
				// consulta si existe el registro
				$query = "select count(*) as num_registros from seg_perfil_reporte 
							where 	cod_reporte_tabla = $cod_reporte_tabla 
							and 	cod_perfil = $cod_perfil_pk";
				$row = $db->consultar_registro($query);
				$cantidad = $row['num_registros'];
				
				if($cantidad == 0){
					// se deben crear los permisos para el reporte
					$query = "
						insert into seg_perfil_reporte (
											cod_reporte_tabla	,
											cod_perfil
										) VALUES (
										   $cod_pk	  			,
										   $cod_perfil_pk
										)";				
					
					$db->consultar($query);
				}
			
			}
	
		}
	
	}
		
}
?>