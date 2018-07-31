<? 
require_once('../librerias/sis_genericos.php');
$sis_genericos = new sis_genericos();
// debe validar que el usuario sea correcto para generar el proceso
//print_r($_REQUEST);


$error = 0;
$array_result = array();

if($cod_usuario != 1 || !$cod_usuario){
	$error++;

	$array_result['error'] = $error;
	$array_result['msj'] = 'Usuario no autorizado';

	echo json_encode($array_result);

	exit;

}

?>