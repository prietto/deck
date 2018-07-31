<? 
require('../principal/conecta_db.php');
include_once('../librerias/parametro_x_usuario.php');

$db = new conecta_db();
global $db;

$parametro_x_usuario = new parametro_x_usuario();
$row_parametro = $parametro_x_usuario->f_get_row_usuario($cod_usuario,$cod_parametro);
$val_parametro = $row_parametro['val_parametro'];

if(!$val_parametro)$val_parametro = 0;
echo $val_parametro;
?>