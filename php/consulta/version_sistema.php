<?  
include_once('../principal/conecta_db.php');
$db = new conecta_db();


include('../librerias/parametro_sistema.php');
$parametro_sistema = new parametro_sistema();


$val_parametro = $parametro_sistema->f_get_row(8);
$val_version = $val_parametro['val_parametro'];



?>