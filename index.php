<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title></title>
<style type="text/css">
<!--
.Estilo15 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 13px;
}
-->
</style>
</head>

<body topmargin="0" rightmargin="0" leftmargin="0">
<form name="form1" method="post" action="">
  <table width="100%"  border="0" cellspacing="0" cellpadding="10">
    <tr>
      <td align="center"><p class="Estilo15">&nbsp;</p>
        <p class="Estilo15">&nbsp;</p>
        <p class="Estilo15">&nbsp;</p>
        <p class="Estilo18"><span class="Estilo17">Cargando..... </span></p></td>
    </tr>
  </table>
    <input type="hidden" name="cod_navegacion">
</form>
<script>
cargar()
function cargar(){
		f						=	document.form1;
		f.action				=	"php/plantilla/ver_validar_usuario.php";
		f.submit();
}	
</script>
</body>
</html>
