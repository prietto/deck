<? 
require('../principal/conecta_db.php');

$db = new conecta_db();
global $db;


$query  = "select * from pedido where val_recibido is not null and val_recibido > 0 and cod_factura is not null and cod_forma_pago not in (1)	";
$cursor = $db->consultar($query);

while($row=$db->sacar_registro($cursor)){
	
	
	
	$cod_pedido 	= $row['cod_pedido'];
	$val_recibido 	= $row['val_recibido'];
	$cod_factura	= $row['cod_factura'];
	$fec_registro	= $row['fec_registro'];
	$cod_usuario	= $row['cod_usuario'];
	$val_total		= $row['val_total'];
	
	
	$query = "select SUM(val_pago) as val_sum from factura_pago where cod_factura = $cod_factura group by cod_factura";
	$row = $db->consultar_registro($query);
	
	$val_pago = $row['val_sum']; // pago que se le ha realizado a la factura
	if(!$val_pago)$val_pago = 0; // si no existe registro es igual a cero
	
	$val_result = $val_total - $val_pago; // total del pedido - el valor pagado o ingresado por el usuario	
	
	if($val_result > 0){ // si la diferencia da mayor a cero quiere decir que aun existe un saldo por pagar
		echo $cod_factura.",".$val_pago." --- ".$val_result."  
		
		";
	
		$query = "insert into factura_pago (cod_factura,val_pago,fec_registro,cod_usuario,ind_bloqueado)
										VALUES
		
										($cod_factura,$val_result,'$fec_registro',$cod_usuario,0)";
		echo $query;
		//$db->consultar($query);
	
	}
	
	
	
	
}



?>