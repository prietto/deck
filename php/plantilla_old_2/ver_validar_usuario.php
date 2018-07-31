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

require('../consulta/ver_validar_usuario.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../../estilos/estilo_general.css" rel="stylesheet" type="text/css" />
<link href="../../estilos/estilo_login.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Scistem - Login</title>
<meta http-equiv="Expires" content="0" /> 
<meta http-equiv="Pragma" content="no-cache" />
<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript">
if(history.forward(1)){location.replace( history.forward(1) );}
$(function(){
	// calcula el alto de la section input
	var h_section = $('#content_input').outerHeight(true);
console.log("height = "+h_section);
	var margin_top = (Number(h_section)/2) - Number(h_section);
console.log(margin_top);
	$('#content_input').css({
		"margin-top": margin_top
	});
})
</script>
</head>

<body onKeyPress="evalua_tecla_body(this,event)">
	<form id="form1" name="form1" method="post" action="">
    	<div id="wrap">
            <section id="content_input">
                <figure>
                    <img src="../../imagenes/sistema/logo_deck_small.png"  />	
                </figure>
                

    			<div style="display:inline-block;">
	    			<label for="login">Login:</label>
					<input name="txt_login" type="text" placeholder="Login:" class="contenido" id="login"  tabindex="0" value="<?=$login?>"/>
					
	        	 	<label for="password">Password:</label>				
                	<input name="txt_password" type="password" placeholder="Password" class="contenido" id="password" value="<?=$password?>" />
                
	                <input value="Ingresar" type="button" name="botones[cancelar]" onclick="navegar(36)" />
                </div>

                
                <? if($row_empresa){   ?>
	                <figure style="" id="logo_cliente">
	                    <img src="<?=$txt_url_img_empresa?>" width="50%" id="img_logo_cliente" />	                    
	                </figure>
	    
	                <div id="footer" >
	                	<span class="contenido">Copyright © Scistem 2015 - Sistema de informacion desarrollado para <?=$txt_nombre_empresa?>.</span>
	                </div>

                <? } ?>

	        </section>
        </div>



<script>
function  evalua_tecla_body(cuerpo ,evento){
	//======== evaluacion de las teclas ===========>>>>>
	var enter			= 13;
	var tecla_presionada= (window.Event) ? evento.which : evento.keyCode; //captura la tecla que fue precionada
	if(tecla_presionada== enter) navegar(36)
}


<? if($ind_inicia_sesion == 1){ ?>
	window.onload = function() {
		navegar(36);
	};
<? } ?> 
</script>

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