<? 
include('../librerias/entrada_producto.php');
include('../librerias/proveedor.php');
include('../librerias/empleado.php');
include('../librerias/sis_genericos.php');


$entrada_producto 	= new entrada_producto();
$proveedor			= new proveedor();
$empleado			= new empleado();
$sis_genericos		= new sis_genericos();


// == DEBE VALIDAR QUE TABLA LLEGA PARA SABER SI SE TRATA DE UN EMPLEADO O PROVEEDOR SELECCIONADO
if($cod_tabla_sujeto == 18){ // EMPLEADO
	
	//retorna cursor con las entradas de bodega por proveedor
	$cursor_entrada = $entrada_producto->f_get_x_empleado($cod_empleado,10);	

	// informacion del empleado
	$row_sujeto = $empleado->f_get_row($cod_empleado);

}else if($cod_tabla_sujeto == 24){ // PROVEEDOR
	//retorna cursor con las entradas de bodega por proveedor
	$cursor_entrada = $entrada_producto->f_get_x_proveedor($cod_proveedor,10);	

	// informacion del proveedor
	$row_sujeto = $proveedor->f_get_row($cod_proveedor);
	
}



$txt_tipo_sujeto = ($cod_tabla_sujeto==18) ? "Empleado" : "Proveedor";

// nombre del sujeto que genera la accion (empleado o proveedor)
$txt_nombre_sujeto = $row_sujeto['txt_nombre']." ".$row_sujeto['txt_apellido'];

// numero de registros de la entrada
$num_registros = $db->num_registros($cursor_entrada);



?>