<?
/*=====2006/06/01============================================>>>>
DESCRIPCION: 	Contiene las consultas contra la tabla seg_usuario
---------------------------------------------------------------------------					
HISTORIAL DE MODIFICACIONES
---------------------------------------------------------------------------					
FECHA	AUTOR		MODIFICACION
===========================================================================*/
if(class_exists('seg_usuario') != true){
	class seg_usuario{

		/*=====20080817======================================================>>>>
		DESCRIPCION: 	Modifica el txt_password de un seg_usuario
		---------------------------------------------------------------------------					
		PARAMETRO		DESCRIPCION 
		---------------------------------------------------------------------------					
		HISTORIAL DE MODIFICACIONES
		---------------------------------------------------------------------------					
		FECHA	AUTOR		MODIFICACION
		===========================================================================*/
		function f_valida_password($cod_usuario,$str_pass){
			if(!$cod_usuario)return false;
			global $db;

			// limpia la cadena para evitar inyeccion sql
			$str_pass = $db->real_escape_string($str_pass);
			
			
			$query = "select 	count(*) num_registros 
						from 	seg_usuario 
						where	cod_usuario_pk = $cod_usuario
						and		txt_password = password(SHA('$str_pass'))";
	
			$row = $db->consultar_registro($query);
			
			$num_registros = $row['num_registros'];

			
			return $num_registros;
		
		}
		
		
		/*=====20080817======================================================>>>>
		DESCRIPCION: 	Modifica el txt_password de un seg_usuario
		---------------------------------------------------------------------------					
		PARAMETRO		DESCRIPCION 
		---------------------------------------------------------------------------					
		HISTORIAL DE MODIFICACIONES
		---------------------------------------------------------------------------					
		FECHA	AUTOR		MODIFICACION
		===========================================================================*/
		function p_modificar_txt_password(
				$txt_password					,
				$cod_usuario				
		){
			global $db;
			$query ="
			update	seg_usuario
			set		txt_password  	= password(SHA('$txt_password'))
			where	cod_usuario_pk		='$cod_usuario'";
			$db->consultar($query);	
		}
		/*=====20080601======================================================>>>>
		DESCRIPCION: 	Obtiene todos los clientes de acuerdo a un filtro
		---------------------------------------------------------------------------					
		PARAMETRO		DESCRIPCION 
		---------------------------------------------------------------------------					
		HISTORIAL DE MODIFICACIONES
		---------------------------------------------------------------------------					
		FECHA	AUTOR		MODIFICACION
		===========================================================================*/
		function f_get_seg_usuario(
				$cod_usuario
		){
			global $db;
			$query ="
			select 	*
			from	seg_usuario
			where	cod_usuario_pk='$cod_usuario'";
			$row = $db->consultar_registro($query);	
			return $row;
		}
		/*=====20080601======================================================>>>>
		DESCRIPCION: 	Valida los datos del seg_usuario
		---------------------------------------------------------------------------					
		PARAMETRO		DESCRIPCION 
		---------------------------------------------------------------------------					
		HISTORIAL DE MODIFICACIONES
		---------------------------------------------------------------------------					
		FECHA	AUTOR		MODIFICACION
		===========================================================================*/
		function f_get_seg_usuario_password(
				$txt_login,
				$txt_password		
		){
			global $db;
			$query ="
			select 	*
			from	seg_usuario
			where	txt_password	=	password(SHA('$txt_password'))
			and		txt_login		=	'$txt_login'";
			$row = $db->consultar_registro($query);	
			return $row;
		}
		/*=====20080601======================================================>>>>
		DESCRIPCION: 	Valida los datos del seg_usuario
		---------------------------------------------------------------------------					
		PARAMETRO		DESCRIPCION 
		---------------------------------------------------------------------------					
		HISTORIAL DE MODIFICACIONES
		---------------------------------------------------------------------------					
		FECHA	AUTOR		MODIFICACION
		===========================================================================*/
		function p_crear_usuario(
				$cod_usuario					,
				$txt_login						,
				$txt_password
		){
			global $db;
			$query ="
			insert into	seg_usuario(
			txt_login		,
			cod_usuario		,
			ind_bloqueado	,
			txt_password
			)values(
			'$txt_login'	,
			'$cod_usuario'	,
			0				,
			'$txt_password'
			)";
			$db->consultar($query);	
			$cod_pk	= $GLOBALS['fn_ultimo_registro'];
			return $cod_pk;
		}
		/*=====20100606========================================================>>>>
		DESCRIPCION: 	Valida los datos del seg_usuario
		---------------------------------------------------------------------------					
		PARAMETRO			DESCRIPCION 
		$cod_usuario_pk		Codigo principal del usuario
		$cod_usuario		Usuario que registra el dato
		$txt_login			Login que normalmente es un email
		$txt_password		password
		===========================================================================*/
		function p_update_row(
				$cod_usuario_pk	,
				$cod_usuario	,
				$txt_login		,
				$txt_password
		){
			global $db;
			$query ="
			update 	seg_usuario set
					txt_login		= '$txt_login'		,
					txt_password	= password(SHA('$txt_password')),
					cod_usuario		= '$cod_usuario'
			where	cod_usuario_pk	= $cod_usuario_pk";
			$db->consultar($query);	
		}
		
		
	} // fin clase
}// fin if
?>