<!DOCTYPE HTML>
<html lang="es"><!-- InstanceBegin template="/Templates/contenido_interno.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8" />
<!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">-->
<link href="../../estilos/multiselect.css" rel="stylesheet" type="text/css" />
<link href="../../estilos/hover_master.css" rel="stylesheet" type="text/css" />
<link href="../../estilos/estilo_tabla.css" rel="stylesheet" type="text/css" />
<link href="../../estilos/buttons.css" rel="stylesheet" type="text/css" />
<link href="../../estilos/jquery-ui.css" rel="stylesheet" type="text/css"  />
<link href="../../estilos/select2.css" rel="stylesheet" type="text/css" />
<link href="../../estilos/timepicker.css" rel="stylesheet" type="text/css" />
<link href="../../estilos/estilo_general.css" rel="stylesheet" type="text/css" />
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--<script src="../js/modernizr-2.0.6.js" ></script>-->
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">-->
<!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
<!--<script src="../js/jquery-1.9.1.js"></script>-->
<script src="../../js/jquery-1.11.2.min.js"></script>
<!--<script src="../js/jquery.ui.core.js"></script>-->
<!--<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->
<script src="../../js/jquery-ui.js" ></script>
<script src="../../js/jquery.simplemodal.js" ></script>
<script src="../../js/timepicker.js"></script>
<script src="../../js/select2.js" ></script>
<script src="../../js/jquery_multiselect.js" ></script>
<script src="../../js/ajax_navegacion.js" ></script>
<script src="../../js/jquery.serializefullarray.js" ></script>
<script src="../../js/js_general.js"></script>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Parametros del sistema</title>
<link href="../../estilos/hipervinculos.css" rel="stylesheet" type="text/css" />
<link href="../../estilos/estilos_calendario.css" rel="stylesheet" type="text/css" />
<link href="../../estilos/hover_master.css" rel="stylesheet" type="text/css" />

<script src="../../js/formato_fecha.js"></script>
<script src="../../js/dhtml_calendario.js" ></script>
<style>


/* Grow Rotate */
.button_modulo{
  display: inline-block;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-property: transform;
  transition-property: transform;
  -webkit-transform: translateZ(0);
  transform: translateZ(0);
  box-shadow: 0 0 1px rgba(0, 0, 0, 0);
}
.button_modulo:hover, .button_modulo:focus, .button_modulo:active {
  -webkit-transform: scale(1.1) rotate(4deg);
  transform: scale(1.1) rotate(4deg);
}
</style>

<!-- InstanceEndEditable -->
<meta http-equiv="Expires" content="0" /> 
<!--<meta http-equiv="Pragma" content="no-cache" />-->
<script type="text/javascript">
if(history.forward(1)){location.replace( history.forward(1) );}
</script>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body >
	<div id="ventana_general"></div>
		<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data"> 
	 		<div id="apDiv1" > 
            
			    <table width="100%" height="100%"  border="0" align="center"  cellpadding="0" cellspacing="0" class="tabla_principal">
                
                	<tr>
                    	<td  valign="top" class="td_header">
                    
                     
                            <table width="100%" height="1%"  border="0" align="left" cellpadding="0" cellspacing="0"  >
                               <tr>
                                
                                <td width="7%" align="center" valign="middle" nowrap>
                                    <img src="../../imagenes/sistema/logo_deck_small_2.png" onclick="navegar(36);"  width="100"
                                        style="cursor:pointer; width:5vw !important; margin:5px; " />
                                 </td>
                                 
                                 <td width="7%" align="center" valign="middle" nowrap>
                                    <?=$_COOKIE['logo_empresa']?>
                                 </td>
                                 
                                 <td>
                                 		<?php if($cod_navegacion != 36 && $ind_pantalla_menu == FALSE){  ?>            
                                    <table width="1%" border="0" align="center" cellpadding="7" cellspacing="0">
                                    <tr>
                                     
                                          <?php 
                                        
                                          
                                          while($row = $db->sacar_registro($cursor_permisos_template)){ 
                                                
                                                $cod_modulo = $row['cod_tabla'];				
                                         
                                          if($cod_modulo==15) { ?>
                                               <td><a href="javascript:f_ver_consultar_maetro_detalle(15,16)">
                                               <img class="float img_menu"  src="../../imagenes/sistema/b1.png" width="55"   border="0" /></a></td>
                                          <? } ?>
                                                 
                                          <? if($cod_modulo==18) { ?>
                                            <!--   <td>
                                               <a href="javascript:f_ver_consultar_tabla(18)">
                                               <img class="float" src="../imagenes/sistema/b3.png" width="55"  border="0" /></a>
                                               
                                        
                                               <img class="img_menu" src="../imagenes/sistema/b3.png" width="55" title="Modulo fuera de servicio" border="0" />
                                               </td> -->
                                          <? } ?>
                                        	
                                            <? if($cod_modulo==18) { ?>
                                                <td><a href="javascript:f_ver_consultar_tabla(18);">
                                                <img class="float img_menu" src="../../imagenes/sistema/b10.png" width="55"  border="0" /></a></td>
                                          	<? } ?>
                                        
                                          <? if($cod_modulo==19) { ?>
                                                <td><a href="javascript:f_ver_consultar_tabla(19)">
                                                <img class="float img_menu" src="../../imagenes/sistema/b4.png" width="55"  border="0" /></a></td>
                                          <? } ?>
                                                
                                        <? if($cod_modulo==20) { ?>
                                               <td><a href="javascript:f_ver_consultar_maetro_detalle(20,23)">
                                               <img class="float img_menu" src="../../imagenes/sistema/b6.png" width="55" border="0" /></a></td>
                                        <? } ?>
                                                
                                        <? if($cod_modulo==13) { ?>
                                             <td><a href="javascript:f_ver_consultar_tabla(13)">
                                                <img class="float img_menu" src="../../imagenes/sistema/b5.png" width="55"  border="0" /></a></td>
                                        <? } ?>
                                                
                                         <? if($cod_modulo==21) { ?>
                                              <td><a href="javascript:f_ver_consultar_tabla(21)">
                                              <img class="float img_menu" src="../../imagenes/sistema/b7.png" width="55" border="0" /></a></td>
                                          <? } ?>
                                          
                                          	<?  // compras
                                                if($cod_modulo==28) { ?>
                                                <td>
                                                    <a href="javascript:f_ver_consultar_maetro_detalle(28,29);">
                                                        <img class="float img_menu" src="../../imagenes/sistema/b9.png" width="55"  border="0" />
                                                    </a>
                                                </td>
                                            <? } ?>
                                            
                                             <?  // insumos
                                                if($cod_modulo==34) { ?>
                                                <td>
                                                    <a href="javascript:f_ver_consultar_tabla(34);">
                                                        <img class="float img_menu" src="../../imagenes/sistema/b11.png" width="55"  border="0" />
                                                    </a>
                                                </td>
                                            <? } ?>
                                                
                                                
                                                  
                                         <? } 
                                         
                                         ?>  
                                                        
                                                   <? if($cod_perfil == 1) { ?>
                                                      <td><a href="javascript:void()" onclick="navegar(1062);" >
                                                        <img class="float img_menu" src="../../imagenes/sistema/b2.png" width="55"  border="0" /></a></td>
                                                 <? } ?>  
                                                  <? if($cod_perfil == 1) { ?>
                                                      <td><a href="javascript:void()" onclick="navegar(200);" >
                                                        <img class="float img_menu" src="../../imagenes/sistema/b8.png" width="55"  border="0" /></a></td>
                                                 <? } ?>                         
                                      </tr>
                                   </table>
                                                    
                                         <?php } ?> 
                                 	
                                 
                                 </td>
                                 
                                 
                                 <td width="16%" align="center" valign="middle" nowrap>
                                		<div style="font-family:Arial, Helvetica, sans-serif;">
                                            <?php if($cod_usuario){ 
                                                $txt_login = $_SESSION['nom_user'];
                                            ?>
                                                Hola, <a href="javascript:void(0);" id="btn_opc_user" ><?=$txt_login;?></a> 
                                            <? } ?>	
                                        
                                        </div>
                                
                                </td>
                                 
                              </tr>
                            
                            </table>
                   	  </td>
                  </tr>
  
                 <tr>
                    <td align="center" valign="top"  class="td_contenido" >

					<!-- InstanceBeginEditable name="EditRegion3" -->
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%"  >
        <tr>
          <td align="center" class="contenido_azul_big">
          	<span style="padding:30px; display:block;">MODULOS DEL SISTEMA</span>
          </td>
        </tr>
        <tr>
          <td height="100%">
            
            <table width="1%" border="0" align="center" cellpadding="7" cellspacing="0">
              <tr>
                
                <? 
					while($row = $db->sacar_registro($cursor_permisos)){ 
 		
						$cod_modulo = $row['cod_tabla'];				
		 
						if($cod_modulo==15) { ?>
							<td>
								<a href="javascript:f_ver_consultar_maetro_detalle(15,16)">
								<img class="float" src="../../imagenes/sistema/b1.png"  width="85" height="110" border="0" /></a>
							</td>
						<? } ?>
						
						<? if($cod_modulo==18) { ?>
						<!--<td><a href="javascript:f_ver_consultar_tabla(18)">
						  <img class="float" src="../../imagenes/sistema/b3.png" width="85" height="110" border="0" /></a>
						  </td>-->
						<? } ?>
						
						
						<? // cliente	
							if($cod_modulo==19) { ?>
						
							<td>
								<a href="javascript:f_ver_consultar_tabla(19)">
									<img class="float" src="../../imagenes/sistema/b4.png" width="85" height="110" border="0" />
								</a>
							</td>
						<? } ?>
					   
						
						<? 
							// pedido
							if($cod_modulo==20) { ?>
							<td>
								<a href="javascript:f_ver_consultar_maetro_detalle(20,23)">
								<img class="float" src="../../imagenes/sistema/b6.png" width="85" height="110" border="0" /></a>
							</td>
						<? } ?>
						
						<?  // factura
							if($cod_modulo==13) { ?>
							<td>
								<a href="javascript:f_ver_consultar_tabla(13)">
									<img class="float" src="../../imagenes/sistema/b5.png" width="85" height="110" border="0" />
								 </a>
							</td>
						<? } ?>
						
						
						<?  // producto
							if($cod_modulo==21) { ?>
							<td>
								<a href="javascript:f_ver_consultar_tabla(21)">
								<img class="float" src="../../imagenes/sistema/b7.png" width="85" height="110" border="0" /></a>
							</td>
						<? } ?>
                        
                        <?  // compras
							if($cod_modulo==28) { ?>
							<td>
								<a href="javascript:f_ver_consultar_maetro_detalle(28,29);">
									<img class="float" src="../../imagenes/sistema/b9.png" width="85" height="110" border="0" />
								</a>
							</td>
						<? } ?>
                      
                       <?  // insumos
							if($cod_modulo==34) { ?>
							<td>
								<a href="javascript:f_ver_consultar_tabla(34);">
									<img class="float" src="../../imagenes/sistema/b11.png" width="85" height="110" border="0" />
								</a>
							</td>
						<? } ?>
                        
                       <?  // empleados
							if($cod_modulo==18) { ?>
							<td>
								<a href="javascript:f_ver_consultar_tabla(18);">
									<img class="float" src="../../imagenes/sistema/b10.png" width="85" height="110" border="0" />
								</a>
							</td>
						<? } ?>
                
                
				<? } // FIN WHILE ?>  
        
        
        
                
                <? if($cod_perfil == 1) { ?>
                <td><a href="javascript:void()" onclick="navegar(1062);">
                <img class="float" src="../../imagenes/sistema/b2.png" width="85" height="110" border="0" /></a></td>
                
                <td><a href="javascript:void()" onclick="navegar(200);">
                <img class="float" src="../../imagenes/sistema/b8.png" width="85" height="110" border="0" /></a></td>
                
                
                <? } ?>                         
                </tr>
              </table>
  
           
           </td>
        </tr>
       
      </table>
    
<script>
f		=	document.form1;
function f_ver_estadisicas (){
	//f.target = "_blank";
	ventana_emergente 	= window.open ('',	'SubWind','statusbar,scrollbars,resizable,height=600,width=780, top=100,Left=600');			
	f.target						= 'SubWind';
	navegar(1045);
	f.target = "_self";	
	
}
</script>		  
<script>
function f_ver_consultar_maetro_detalle(cod_tabla,	cod_tabla_detalle){
	f	=	document.form1;
	f.cod_tabla.value			=	cod_tabla;
	f.cod_tabla_detalle.value	=	cod_tabla_detalle;	
	f.ind_buscar.value	=	1;	
	
	navegar_limpiando_variables(78);
}
</script>		  
<script>
function f_ver_consultar_tabla(cod_tabla){
	f	=	document.form1;
	f.cod_tabla.value	=	cod_tabla;
	f.ind_buscar.value	=	1;	
	navegar(39);
}
          </script>
<script>
function f_sincronizar(){
	confirmacion = confirm("Su panel quedara suspendido mientras sincroniza los servidores \n ?Desea Continuar?");
	if(confirmacion) navegar (1020);
}
</script>
            <script>
function f_esc(){
	navegar_limpiando_variables(10)
}
          </script>
<input name="ind_buscar"			type="hidden" />

          <!-- InstanceEndEditable -->
                       
                        
                         <!-- modal content -->
                    <div id='click_confirm'></div>
                        <div id='confirm'>
                            <div class='header'><span>Mensaje de confirmacion</span></div>
                            <div class='message'></div>
                            <div class='buttons'>
                                <div class='no simplemodal-close'>No</div><div class='yes'>Si</div>
                            </div>
                        </div>
                       
                    <input type="hidden" 					name="cod_usuario" value="<?=$cod_usuario?>" />
                    <input name="cod_navegacion" 			type="hidden" id="cod_navegacion"  />
					<input name="cod_navegacion_anterior" 	type="hidden" id="cod_navegacion_anterior" value="<?=$cod_navegacion?>" />
                    <input type="hidden" 					name="ind_limpiar_variables" />
                    <input name="cod_tabla" 				type="hidden"	value="<?=$cod_tabla?>" />
                    <input name="cod_tabla_detalle"			value="<?=$cod_tabla_detalle?>" type="hidden" />
                    <input name="ind_cierre_sesion"			type="hidden" />
      
       </td>
      </tr>
  
      <tr>
        <td align="center"  valign="bottom"  class="td_footer"  >
          <? if($_COOKIE['cod_empresa']){ ?>
        	   <div>Sistema de informacion  | Todos los derechos reservados © 2019</div>desarrollado para <?=$_COOKIE['txt_seg_empresa']?> |<div>Sistema de informacion  | Todos los derechos reservados © 2019</div> |<div>Sistema de informacion  | Todos los derechos reservados © 2019</div>

          <? }else{ ?>
              <div>Todos los derechos reservados © 2015</div>


           <? } ?>
            
         </td>
      </tr>
      
      
   </table>
 </div>
</form>
<script>

window.onload=function(){
	var pos=window.name || 0;
	window.scrollTo(0,pos);
}
window.onunload=function(){
	window.name=self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
}

/*function  evalua_tecla_body(cuerpo ,evento){
	var tecla_presionada= (window.event) ? evento.which : evento.keyCode; //captura la tecla que fue precionada
	
	if(tecla_presionada== 13 ){
		f_enter();
	}
	else if(tecla_presionada== 27 ){
		f_esc();
	}
}*/

function f_navegar_menu(cod_navegacion,cod_tabla,cod_tabla_detalle){
	f=document.form1;
	f.cod_tabla.value			=	cod_tabla;
	f.cod_tabla_detalle.value	=	cod_tabla_detalle;	
	navegar_limpiando_variables(cod_navegacion);
}
</script>


</body>
<!-- InstanceEnd --></html>
