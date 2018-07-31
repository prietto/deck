<? $cod_usuario = NULL; 
session_cache_limiter('private, must-revalidate');
session_start();
/*print_r($_COOKIE);
print_r($_SESSION);
$CookieInfo = session_get_cookie_params();
print_r($CookieInfo);
exit;*/
if(isset($_SESSION['cod_pk_usuario'])){
	$ind_inicia_sesion = 1;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../../estilos/estilo_general.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Scistem - Login</title>
<meta http-equiv="Expires" content="0" /> 
<meta http-equiv="Pragma" content="no-cache" />
<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript">
if(history.forward(1)){location.replace( history.forward(1) );}
</script>
<style type="text/css">
  #footer {
	position : absolute;
	bottom : 0;
	height : 40px;
	margin-top : 40px;
	text-align:center;
	width:100%;
  }
</style>
<style type="text/css">


<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #FFF;
	height:100%;
}
-->
</style>
</head>

<body onKeyPress="evalua_tecla_body(this,event)">
	<form id="form1" name="form1" method="post" action="">
		<section>
        	<figure>
            	
            </figure>
        
        </section>

<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0"  >
  <tr >
    <td   valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><p>&nbsp;</p>
          <p><br />
            <br />
            <img src="../../imagenes/sistema/logo_deck_small.png"  /></p>
          <table width="10" align="center">
            
            <tr>
              <td width="50%" align="right" class="combo_solicitud">Login: </td>
              <td align="left"><input name="txt_login" type="text" class="contenido" id="login"  tabindex="0" value="<?=$login?>"/></td>
              </tr>
            <tr>
              <td align="right" class="combo_solicitud"> password: </td>
              <td align="left" nowrap="nowrap"><input name="txt_password" type="password" class="contenido" id="password" value="<?=$password?>" /></td>
              </tr>
            <tr>
              <td align="left">&nbsp;</td>
              <td align="right"><input class="contenido" value="Validar" type="button" name="botones[cancelar]" onclick="navegar(36)" /></td>
              </tr>
            <tr align="right" valign="middle" class="contenido">
              <td><strong> </strong> </td>
              <td nowrap="nowrap">
                <!--<label for="ind_mantener_sesion">Mantener Sesion
                <input name="ind_mantener_sesion" type="checkbox" id="ind_mantener_sesion" checked="checked" />
              </label> -->
                </td>
              </tr>
            </table>
          <p>&nbsp;</p>
          </td>
        </tr>
    </table>

<script>
function  evalua_tecla_body(cuerpo ,evento){
	//======== evaluacion de las teclas ===========>>>>>
	var enter			= 13;
	var tecla_presionada= (window.Event) ? evento.which : evento.keyCode; //captura la tecla que fue precionada
	if(tecla_presionada== enter) navegar(36)
}

</script>		
<?php if($ind_inicia_sesion == 1){ ?>
<script>
window.onload = function() {
	navegar(36);
};

</script><?php } ?>    </td>              
  </tr>
    
  
</table>

<div id="footer" ><span class="contenido">Copyright © Scistem 2015 - Sistema de informacion desarrollado para Comestibles Elsa.</span></div>

<input type="hidden" name="cod_navegacion">
<input type="hidden" name="cod_usuario" value="<?=$cod_usuario?>">
<input type="hidden" name="ind_limpiar_variables" />
<input name="cod_tabla" type="hidden"	value="<?=$cod_tabla?>" />
<input name="cod_tabla_detalle"			value="<?=$cod_tabla_detalle?>" type="hidden">	  	  
</form>
<script>
function navegar(cod_navegacion){
		document.form1.cod_navegacion.value=cod_navegacion;
		document.form1.action="../principal/controlador.php";
		document.form1.submit();
	}	
</script>
<script>
function navegar_limpiando_variables(cod_navegacion){
		document.form1.target="_self"
		document.form1.ind_limpiar_variables.value = 1; // para que el sistema sepa que debe borrar la posible basura
		navegar(cod_navegacion)
}	
</script>
<script>
function f_navegar_menu(cod_navegacion,cod_tabla,cod_tabla_detalle){
	f=document.form1;
	f.cod_tabla.value			=	cod_tabla;
	f.cod_tabla_detalle.value	=	cod_tabla_detalle;	
	navegar_limpiando_variables(cod_navegacion);
}
</script>

</body>
</html>