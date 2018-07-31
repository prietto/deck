<?
/*=====2008/09/07==================================D E C K===>>>>
DESCRIPCION: 	diferentes funciones de consulta relacionadas con los archivos
PROPIETARIO:	© D E C K
AUTOR:			Cristian arellano
---------------------------------------------------------------------------					
HISTORIAL DE MODIFICACIONES
---------------------------------------------------------------------------					
FECHA	AUTOR		MODIFICACION
===========================================================================*/
class c_file
{
	/*=====2008/09/07==================================D E C K===>>>>
	DESCRIPCION: 	Metodo para obtener el tipo de imagen que se esta manejando
	AUTOR:			Cristian Arellano
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA	AUTOR		MODIFICACION
	===========================================================================*/
	function f_get_tipo_imagen(
			$txt_type
	){
		if($txt_type == 'image/pjpeg') 					$extension = ".jpg";
		if($txt_type == 'image/jpeg') 					$extension = ".jpg";
		if($txt_type == 'image/x-png') 					$extension = ".png";
		if($txt_type == 'image/gif') 					$extension = ".gif";
		if($txt_type == 'application/octet-stream') 	$extension = ".psd";			
		if($txt_type == 'application/x-shockwave-flash')$extension = ".swf";
		return $extension;
	}	
}
?>