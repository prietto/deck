<?
class conecta_db{
	var $datos;
	var $num_registros;
	var $num_registros_afectados;
	var $va_resultado;
	public $fn_ultimo_registro;
	public $nom_db_pk;

	//==2005/03/12====================================================================>>>
	//CONEXION EN EL SERVIDOR LOCAL
	function fn_conectarse(){
		global $nom_db_pk;
		global $dbhost;
		global $dbuser;
		global $dbpass;


		$nom_db_pk 	= 	'deck_db';
		$dbhost 	= 	'localhost';
		$dbuser		=	'root';
		$dbpass		=	'mysql';

		$this->va_resultado = mysqli_connect($dbhost,$dbuser,$dbpass,$nom_db_pk);

		

		/* check connection */
		if (mysqli_connect_errno()) {
		    printf("Connect failed: %s\n", mysqli_connect_error());
		    exit();
		}

		//if (!$prueba = mysql_select_db($nom_db_pk)) return false;	
		//mysqli_select_db($nom_db_pk)
		//or die("Seleccion de base de datos fallida " . mysqli_error());	

		//mysql_set_charset("utf8");
	}

	//==2014/10/28====================================================================>>>
	function real_escape_string($string){
		
		$mysqli = new mysqli("localhost", "root", "mysql", $nom_db_pk);
		$datos = $mysqli->real_escape_string($string);
		
		mysqli_close($mysqli);
		return $datos;
	}
	
	// === 2015/01/04 ================================= //
	function consulta_multiple($query){
		// divide el query por punto y coma
		$arr_query = explode(';',$query);
		$this->fn_conectarse();
		for($i=0;$i<count($arr_query);$i++){
			$query = $arr_query[$i];
			//$this->datos 	= mysql_query($query);  	
			$this->datos= mysqli_query($this->va_resultado,$query);
		}
		//mysql_close($this->va_resultado);
		mysqli_close($this->va_resultado);
		return $this->datos;
	}
	
	// === 2015/02/03 ==================== //
	function close_mysql(){
		mysql_close($this->va_resultado);
	}
	

//==2005/03/12====================================================================>>>
	function consultar($query){
		global $fn_ultimo_registro;
		$this->fn_conectarse();
		if($this->datos= mysqli_query($this->va_resultado,$query)){

			$fn_ultimo_registro				= mysqli_insert_id($this->va_resultado);
			$this->ultimo_registro			= mysqli_insert_id($this->va_resultado);
			//$this->num_registros 			= mysqli_num_rows($this->datos);
			//$this->num_registros_afectados	= mysqli_affected_rows($this->datos);
		}		

		mysqli_close($this->va_resultado);
		return $this->datos;
	}
//==2005/03/12====================================================================>>>
	function consultar_registro($query){
		$this->fn_conectarse();
		$this->datos 					= mysqli_query($this->va_resultado,$query);  
		//return $this->datos;		
		//$this->consultar($query);


		
		//$row = mysqli_fetch_row($this->datos);		
		//$row = $this->datos->fetch_array(MYSQLI_BOTH);
		$row = mysqli_fetch_array($this->datos,MYSQLI_BOTH);		
		mysqli_close($this->va_resultado);
		return $row;
	}
//==2005/03/12====================================================================>>>
	function sacar_registro($cursor,$pos=NULL){
		$this->fn_conectarse();
		$row = mysqli_fetch_array($cursor,MYSQLI_BOTH);		
		
		mysqli_close($this->va_resultado);
		return $row;
	}

//==2005/03/12====================================================================>>>
	function ultima_transaccion($cursor){
		$this->fn_conectarse();
		$row = @mysql_info($cursor);
		mysql_close($this->va_resultado);
		return $row;
	}
//==2005/03/12====================================================================>>>
     function num_registros($cursor){
	 	if(!$cursor) return false;
		$this->fn_conectarse();
		$row = mysqli_num_rows($cursor);
		mysqli_close($this->va_resultado);
		return $row;
	 }
//==2005/04/12====================================================================>>>
   /*function fn_ultimo_registro(){
	   $this->fn_conectarse();
	   $ultimo = mysql_insert_id();
	   mysql_close($this->va_resultado);
	   return $ultimo;
	}*/
	/*=====2008/12/23=======================================Arellano Company===>>>>
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
		 $cantidad  = mysqli_num_fields($cursor);
		 return $cantidad;
 	}	
	/*=====2005/05/23=======================================Arellano Company===>>>>
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
		
		//$columna = mysqli_fetch_field_direct($cursor,$num_registro);
		$columna = mysqli_fetch_field_direct($cursor,$num_registro);
		
		return $columna->name;
	}		
}
?>