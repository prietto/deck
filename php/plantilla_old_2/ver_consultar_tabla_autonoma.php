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
<title>Consulta de <?=$alias_tabla_autonoma?></title>
<link href="../../estilos/estilos_calendario.css" rel="stylesheet" type="text/css" />
<link href="../../estilos/hipervinculos.css" rel="stylesheet" type="text/css" />
<link href="../../estilos/multiselect.css" rel="stylesheet" type="text/css" />
<link href="../../estilos/jquery-ui.css" rel="stylesheet" type="text/css"  />
<script src="../../js/formato_fecha.js"></script>
<script src="../../js/opera_numeros.js"></script>
<script src="../../js/dhtml_calendario.js" ></script>
<?=$js_navegacion?>
<?=$js_extra?>
<script src="../../js/jquery_multiselect.js" ></script>
<style>
div .display_div{
    height              : 90px;
    transition-property : height , width;  /* collapse sequence */
    transition-duration : 0.5s   , 0.5s;
    transition-delay    : 0.0s   , 0.5s;   /* delay 2nd transition */
}
</style>
<script>
$(function(){$(".multiple_select").multiselect({});});
$(document).ready(function(){$(".link_display").click(function(){$(".display_div").fadeToggle("fast");});});
</script>
<script>
					
				
				</script>
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
                                    <img src="../../imagenes/sistema/logo_elsa.png" width="100" style="width:7vw !important; margin:5px; " />
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
       <div id="msj_respuesta_servidor"></div>
      <table width="100%" border="0" cellspacing="0" cellpadding="4">
        <tr>
          <td valign="top">
          <div style="position:relative;">
             <table width="100%" align="center" cellpadding="5">
               <tr>
                 <td align="center" >
                 	<span class="titulo_principal">CONSULTA DE  <?=$alias_tabla_autonoma?>   </span></td>
               
               </tr>
               <tr>
               
                 <td align="right">
                   
                   <table width="60%" border="0" align="center" >
                     <?
for($i=0; $i<$num_columnas; $i++){
	$row_columna		= array_pop($row_imputs);
	$txt_alias			= $row_columna['txt_alias'];
	$input				= $row_columna['input'];	
	$i++;
	$row_columna		= array_pop($row_imputs);
	$txt_alias2			= $row_columna['txt_alias'];
	$input2				= $row_columna['input'];	
	
	$txt_alias			= ucwords(strtolower($txt_alias));
	$txt_alias			= str_replace("_"," ",$txt_alias);
	$txt_alias2			= ucwords(strtolower($txt_alias2));
	$txt_alias2			= str_replace("_"," ",$txt_alias2);

	if(!$txt_alias)		$dos_puntos = "";
	else				$dos_puntos = ":";
	if(!$txt_alias2)	$dos_puntos2 = "";
	else				$dos_puntos2 = ":";
	
	
?>
                     <tr>
                       <td nowrap="nowrap" class="combo_solicitud"><?=$txt_alias?></td>
                       <td width="1%" nowrap="nowrap" class="combo_solicitud"><?=$dos_puntos?></td>
                       <td nowrap="nowrap" class="contenido"><?=$input?></td>
                       <td nowrap="nowrap" class="combo_solicitud">&nbsp;</td>
                       <td nowrap="nowrap" class="combo_solicitud"><?=$txt_alias2?></td>
                       <td width="1%" nowrap="nowrap" class="combo_solicitud"><?=$dos_puntos2?></td>
                       <td nowrap="nowrap" class="contenido"><?=$input2?></td>
                       </tr>
                     <? } ?>
                     <tr>
                       <td colspan="7" nowrap="nowrap"><table width="100%" border="0" cellspacing="2" cellpadding="2">
                         <tr>
                           <td width="22%" align="left">
                             <?php if($_REQUEST['ind_pagina_autorizacion'] == 1){ 
                               echo '<input type="button" class="contenido" name="esc" value="&lt;&lt; Atras" onclick="f_esc_autorizacion()"/>'; ?>
                             <?php }else{ ?>
                             
                             <input type="button" class="pure-button" name="esc" value="&lt;&lt; Atras" onclick="f_esc()"/>
                             <?php } ?>
                             
                             </td>
                           <td width="46%" align="center"><span class="combo_solicitud">
                             <? if($ind_tiene_permiso_insert && $cod_tabla != 13){?>
                             </span>
                             <input name="enter2" class="pure-button" type="button" id="enter2" onclick="f_nuevo_registo()" value="Nuevo Registro" />
                             <span class="combo_solicitud">
                               <? } ?>
                               </span></td>
                           <td align="center" nowrap="nowrap">
                           <input class="pure-button" name="enter"  id="enter" onclick="f_enter()"  type="button" value="Consultar &gt;&gt;" /></td>
                           </tr>
                         
                         <tr>
                           <td align="left">&nbsp;</td>
                           <td align="center">&nbsp;</td>
                           <td align="center" nowrap="nowrap" class="contenido">
                           
                           <input name="ind_imprimir_reporte"  style="visibility:hidden" type="checkbox" id="ind_imprimir_reporte" value="1" />
                    <a href="javascript:void(0);" onclick="f_imprimir_reporte();">Imprimir</a>
                    &nbsp;&nbsp;
                    <a href="javascript:void(0)" onclick="f_exportar_excel(<?=$cod_navegacion?>,event);">Exportar Excel</a>
                           
                           </td>
                           </tr>
                         </table></td>
                       </tr>
                   </table>
                   <div style="position:absolute; right:0; top:0;" id="procesos_adicionales">
                   <table width="20%" border="0" align="center" cellpadding="0" cellspacing="10">
									   <? 
                    $num_registros 	= 	$db->num_registros($cursor_procesos_adicionales);
                    for($i=0; $i<$num_registros; $i++){
                        $row 					=$db->sacar_registro($cursor_procesos_adicionales,$i);
                        $txt_desc				=$row['txt_descripcion'];
                        if($txt_desc)$attrib = "title='$txt_desc'";
                        $txt_nombre				=$row['txt_nombre'];
                        $txt_js					=$row['txt_js'];
                    ?>
                   <tr>
                     
                     <td nowrap="nowrap" valign="middle">
                       <img src="../../imagenes/sistema/sound.png" width="11" valign="center" />
                       </td>
                     <td nowrap="nowrap"><a href="javascript:<?=$txt_js?>"  <?=$attrib?>>
                       <?=$txt_nombre?>
                       </a></td>
                     </tr>
                   <? } ?>
                 </table>
                   
                   </div>
                   </td>
                 </tr>
             </table>
             
             </div>
             <br />
          
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
              <tr bgcolor="#FFFFFF">
                <td><span class="combo_solicitud">
                  <?=$tabla_resultado?>
                  </span></td>
                </tr>
              <tr>
                <td align="center" >
                
                <table width="10%"  border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="center" nowrap="nowrap"> &nbsp; <?=$tabla_paginas?></td>
                    </tr>
                  </table>
                  
                  
                  </td>
                </tr>
              </table>
            <iframe  name="frame_oculto" marginwidth="0"  width="0" height="0"   frameborder="0" id="frame_oculto" ></iframe></td>
          </tr>
          
          <tr>
          <td>
         
          <table width="40%" border="0" cellspacing="0" cellpadding="0" style="display:none">
            <tr>
              <td><div id="div_procesos_registro"> 
                <table width="14%" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                  
                    <?php 
$num_imagen_adicional		=	0;
$num_procesos_adicionales 	= 	$db->num_registros($cursor_procesos_por_registro);
for($i=0; $i<$num_procesos_adicionales; $i++){
	$row 					=$db->sacar_registro($cursor_procesos_por_registro,$i);
	$txt_nombre				=$row['txt_nombre'];
	$txt_js					=$row['txt_js'];
	$num_imagen_adicional++;
	if($num_imagen_adicional>6)$num_imagen_adicional=1; //imagen_estandar de los botones
?>
                    <td nowrap="nowrap">
                    
                    <table width="100%" border="0" cellspacing="2" cellpadding="0">
                      <tr>
                        <td align="center">
                        <a href="javascript:<?php echo $txt_js?>">
                        <img src="../../imagenes/sistema/p_<?php echo $num_imagen_adicional?>.png" alt="" border="0" /></a>
                        </td>
                        <td align="center">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center" nowrap="nowrap">
                        	<a href="javascript:<?php echo $txt_js?>"> <?php echo $txt_nombre?> </a></td>
                        <td align="center" nowrap="nowrap">&nbsp;</td>
                      </tr>
                    </table></td>
                    <?php } ?>
                  </tr>
                </table>
              </div></td>
            </tr>
          </table></td>
          </tr>
          
    </table>
      <input name="cod_pk" 						type="hidden">
      <input name="ind_buscar" 					type="hidden">
      <input name="num_pagina"					type="hidden">
      <input name="ord_por" 					type="hidden" 	value="<?=$ord_por?>"/>
      <input name="txt_nombre_columna_iframe"	type="hidden">	  
      <input name="cod_ventana_emergente"		type="hidden">
      <input name="ind_limite"					type="hidden">
      <input name="num_procesos_adicionales"	type="hidden"	value="<?php echo $num_procesos_adicionales?>">
      
      		
      
	<iframe  name="frame_oculto" marginwidth="0"  width="0" height="0"   frameborder="0" id="frame_oculto" ></iframe>
      <script>
function f_seleccionar_todos(chkbox){

	for (var i=0;i < document.forms[0].elements.length;i++){
		var elemento = document.forms[0].elements[i];
		if (elemento.type == "checkbox"){
			elemento.checked = chkbox.checked
		}
	}
}
      </script>
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
        <div>Sistema de informacion  | Todos los derechos reservados © 2019</div>|<div>Sistema de informacion  | Todos los derechos reservados © 2019</div>
            
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
