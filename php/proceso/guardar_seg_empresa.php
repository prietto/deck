<? 
require('../librerias/seg_empresa.php');
require('../librerias/columna_tabla_autonoma.php');
require('../librerias/tabla_autonoma.php');
require('../librerias/c_file.php');
require('../librerias/obj_listbox.php');
require('../librerias/sis_genericos.php');



$seg_empresa = new seg_empresa();

$var_request 	= $_REQUEST;
$var_files 		= $_FILES;


$result = $seg_empresa->p_guardar_registro($var_request,$var_files);

echo json_encode($result);


?>