<?php 
include("../librerias/producto.php");

$producto 	= 	new producto();


$producto->p_update_fec_user($cod_pk,$_REQUEST['cod_usuario']);



?>