<?
class conecta_db{
	var $datos;
	var $num_registros;
	var $num_registros_afectados;
	
	//==2005/03/12====================================================================>>>
	//CONEXION EN EL SERVIDOR LOCAL
	function fn_conectarse(){
		$this->va_resultado = 	mysql_pconnect('localhost','root','mysql');
		
		//$this->va_resultado = 	mysql_pconnect('pruebasfi.db.9801270.hostedresource.com','pruebasfi','sfi193Hoy#');

		if (!$this->va_resultado) return false;
		//if (!$prueba = mysql_select_db("pruebasfi")) return false;
		if (!$prueba = mysql_select_db("scistem")) return false;
	}

//==2014/10/28====================================================================>>>
	function real_escape_string($string)
	{
		
		$mysqli = new mysqli("localhost", "root", "mysql", "scistem");
		$datos = $mysqli->real_escape_string($string);
		
		return $datos;
	}

//==2005/03/12====================================================================>>>
	function consultar($query)
	{
		$this->fn_conectarse();
		$this->datos 					= mysql_query($query);  
		$this->num_registros 			= @mysql_num_rows();
		$this->num_registros_afectados	= mysql_affected_rows();
		return $this->datos;
	}
//==2005/03/12====================================================================>>>
	function consultar_registro($query)
	{
		$this->consultar($query);
		$row = mysql_fetch_array($this->datos);
		return $row;
	}
//==2005/03/12====================================================================>>>
	function sacar_registro($cursor,$pos=NULL) //$POS=NULL es para compativilidad con postgres
	{
		$row = @mysql_fetch_array($cursor);

		return $row;
	}

//==2005/03/12====================================================================>>>
	function ultima_transaccion($cursor)
	{
		$row = @mysql_info($cursor);
		return $row;
	}
//==2005/03/12====================================================================>>>
     function num_registros($cursor)
	 {
	 	if(!$cursor) return false;
		$row = mysql_num_rows($cursor);
		return $row;
	 }
//==2005/04/12====================================================================>>>
   function fn_ultimo_registro()
    {
	   $ultimo = mysql_insert_id();
	   return $ultimo;
	}
	

	/*=====2008/12/23=======================================D E C K===>>>>
	DESCRIPCION: 	Retorna el numero de columnas de una consulta
	AUTOR:			Cristian Arellano
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	$cursor			Contiene los resultados de una consulta
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA	AUTOR		MODIFICACION
	===========================================================================*/
	function num_columnas($cursor){
		if(!$cursor) return -1;  //datos incompletos
		 $cantidad  = mysql_num_fields($cursor);
		 return $cantidad;
 	}	
	/*=====2005/05/23=======================================D E C K===>>>>
	DESCRIPCION: 	Retorna el nombre de una columna en una posicion especifica
	AUTOR:			Cristian Arellano
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	$cursor			grupo de registros
	$num_registro	numero de registros
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA	AUTOR		MODIFICACION
	===========================================================================*/
	function nom_columna($cursor,$num_registro){
		if(!$cursor) return -1;  //datos incompletos
		$columna = mysql_field_name($cursor,$num_registro);

		return $columna;
	}		
}
?>