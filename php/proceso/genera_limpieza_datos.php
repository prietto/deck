<? 

$info_system = $sis_genericos->detect_system();


$os = $info_system['os'];
$txt_browser = $info_system['browser'];
$txt_version_browser = $info_system['version'];

	

if($os == 'WIN'){
	$ruta_bat = "mackup.bat";
	//$ruta_bat = "mackup.lnk";
	//$output = exec("c:\\windows\\system32\\cmd.exe /c $ruta_bat");
	$output = system("c:\\windows\\system32\\cmd.exe /c $ruta_bat");

}else if($os == 'LINUX'){

	$nom_carpeta = 'backup';

	// comprueba si la carpeta de "backup" existe
	if(!file_exists($nom_carpeta)){
		mkdir($nom_carpeta,0777);
	}
	

	// variables
	$dbhost = $GLOBALS['dbhost'];
	$dbname = $GLOBALS['nom_db_pk'];
	$dbuser = $GLOBALS['dbuser'];
	$dbpass = $GLOBALS['dbpass'];
	 
	$backup_file = $nom_carpeta."/".$dbname."_".date("Y-m-d-H-i-s").'.gzip';
	$backup_file = $nom_carpeta."/".$dbname."_".date("Y-m-d-H-i-s").'.sql';
	 

	// comandos a ejecutar
	$command = "mysqldump --opt -h ".$dbhost." -u ".$dbuser." -p".$dbpass." ".$dbname." | gzip > $backup_file";
	$command = "mysqldump --opt -h ".$dbhost." -u ".$dbuser." -p".$dbpass." ".$dbname." > $backup_file";

	// ejecución y salida de éxito o errores
	system($command,$output);
	
	if($output>0){
		$error++;
		
		$msj = 'No es posible generar el proceso, comuniquese con el administrador';		
	}else{
		$error = 0;
		$msj = "Backup realizado con exito (".$backup_file.")";
	}


	
}else if($os == 'MAC'){


}

$array_result['error'] = $error;
$array_result['msj'] = $msj;

echo json_encode($array_result);

$sis_genericos->p_limpiar_sistema();

exit;

?>