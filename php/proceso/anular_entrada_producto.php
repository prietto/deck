<? 
include_once('../librerias/entrada_producto.php');
include_once('../librerias/producto.php');


$entrada_producto = new entrada_producto();

$result = $entrada_producto->p_anula_entrada($cod_entrada_producto,$cod_usuario);

echo $result;


?>