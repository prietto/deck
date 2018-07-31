<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../estilos/hipervinculos.css" rel="stylesheet" type="text/css" />
<link href="../../estilos/estilos_calendario.css" rel="stylesheet" type="text/css" />
    <link href="../../estilos/estilo_general.css" rel="stylesheet" type="text/css" />
<title>D E C K</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
</style>
</head>

<body >
<table width="1%" border="0" align="center" cellpadding="4" cellspacing="2" bgcolor="#33499E">
  <tr>
    <td align="left" nowrap="nowrap" bgcolor="#33499E" class="titulo_principal_claro">PANTALLA</td>
    <td align="right" nowrap="nowrap" bgcolor="#33499E" class="titulo_principal_claro">VISITAS</td>

  </tr>
  <?
$num_registros 	= 	$db->num_registros($cursor_estadistica);
for($i=0; $i<$num_registros; $i++){
	$row							= $db->sacar_registro($cursor_estadistica,$i);
	$txt_descripcion				= strtoupper($row['txt_descripcion']);
	$num_visitas					= $row['num_visitas'];
	$cod_navegacion_seleccionada	= $row['cod_navegacion'];	
?>
  <tr>
    <td align="left" nowrap="nowrap" bgcolor="#FFFFFF" class="contenido"><?=$txt_descripcion?></td>
    <td align="center" nowrap="nowrap" bgcolor="#FFFFFF" class="contenido"><?=$num_visitas?></td>
  </tr>
  <? } ?>
</table>
</body>
</html>
