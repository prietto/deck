<? 

/*$ejem="mackup.exe";
$llamada = $ejem;
pclose(popen('start /b'.($llamada).'', 'r'));*/

//$response = shell_exec('mackup.lnk'); 
//echo $response;

//$command = 'mysqldump -h localhost -u root -pmysql --database "scistem" -r "C:\backup.sql"'; 
//system($command);


$ruta_bat = "mackup.bat";
//$ruta_bat = "mackup.lnk";
//$output = exec("c:\\windows\\system32\\cmd.exe /c $ruta_bat");
$output = system("c:\\windows\\system32\\cmd.exe /c $ruta_bat");



//system ( 'mackup.lnk' ); //o con exec
//system ( 'c:\AppServ\MySQL\bin\mysqldump.exe --host=localhost --user=root --password=mysql scistem > D:\backup\scistem_backup.sql' ); //o con exec
//exec ( 'mackup.lnk' ); //o con exec



?>