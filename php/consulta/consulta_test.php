<? 
include('../principal/conecta_db.php');
global 	$conecta_db;

$db  = new conecta_db();
global $db;

//include('../librerias/columna_tabla_autonoma.php');
//$columna_tabla_autonoma = new columna_tabla_autonoma();

$cod_columna_tabla = $_GET['cod_columna_tabla'];
$getVar = trim($db->real_escape_string($_GET['term']));



//$txt_script = $columna_tabla_autonoma->f_get_script_cursor($cod_columna_tabla);

$query = "select txt_script_cursor from columna_tabla_autonoma where cod_columna_tabla = $cod_columna_tabla";
$row = $db->consultar_registro($query);
$txt_script = $row['txt_script_cursor'];

$txt_script = str_replace("cadena_busqueda","'%".$getVar."%'",$txt_script);

$query 	= $txt_script;

$cursor = $db->consultar($query);

$num_registros = $db->num_registros($cursor);

if($num_registros>0){
	while($row=$db->sacar_registro($cursor)) {
    	$answer[] = array("id"=>$row[0],"text"=>$row['txt_nombre']);
	}
}else{
	$answer[] = array("id"=>"0","text"=>"No Results Found..");
}



echo json_encode($answer);


?>