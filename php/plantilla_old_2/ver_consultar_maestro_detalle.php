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
<link href="../../estilos/hipervinculos.css" rel="stylesheet" type="text/css" />
<script src="../../js/formato_fecha.js"></script>
<script src="../../js/dhtml_calendario.js" ></script>
<?=$js_navegacion?>
<?=$js_extra?>
<!--<script type="text/javascript" src="../../js/jquery.js"></script> -->
<!-- <script type="text/javascript" src="../../js/jquery-ui.min.js"></script>-->
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
                    <div style="position:relative;">
   			   <table  style="width:100%" border="0" align="center" id="tabla_filtros">
        <tr>
          <td align="center"><span class="titulo_principal">CONSULTA DE
              <?=$alias_tabla_autonoma?>
          </span></td>
       
        </tr>
        <tr>
          <td width="80%">
          <table width="50%" border="0" align="center">
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
                  <td align="left"><input type="button" class="pure-button" name="esc" value="&lt;&lt; Atras" onclick="f_esc()"/></td>
                  <td align="center"><span class="combo_solicitud">
                    <? if($ind_tiene_permiso_insert){?>
                    </span>
                    <input name="enter2" class="pure-button" type="button" id="enter2" 
                    	onclick="f_nuevo_registo();$(this).attr('disabled',true);" 	value="Nuevo Registro" />
                    <span class="combo_solicitud">
                      <? } ?>
                      </span></td>
                  <td align="right" nowrap="nowrap">
                  <input class="pure-button" name="enter"  id="enter" onclick="f_enter()"  type="button" value="Consultar &gt;&gt;" /></td>
                  <? /*  <td align="right" nowrap="nowrap" class="contenido">
                  <input name="ind_consulta_2"  <? if($ind_consulta_2){?>checked="checked" <? } ?> type="checkbox" id="ind_consolidado" value="1" />
                    Rapido</td>  */ ?>
                  </tr>
                <tr>
                  <td colspan="3" align="right" class="contenido">
                    <input name="ind_imprimir_reporte"  
                    	style="visibility:hidden" type="checkbox" id="ind_imprimir_reporte" value="1" />
                        
                    <a  href="javascript:void(0);" onclick="f_imprimir_reporte();">Imprimir</a>
                    &nbsp;&nbsp;
                    <a href="javascript:void(0)" onclick="f_exportar_excel(<?=$cod_navegacion?>,event);">Exportar Excel</a>
                    
                    
                    </td>
                  <!-- <td align="right" nowrap="nowrap" class="contenido">&nbsp;</td>-->
                  </tr>
                </table>
                <p><pre><div id="respuesta_servidor"></div></pre></p>
                
                </td>
              </tr>
          </table>
          	<div style="position:absolute; right:0; top:0;" id="procesos_adicionales">
            
            <table width="10%" border="0" align="left" cellpadding="5" cellspacing="10">
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
                <img src="../../imagenes/sistema/sound.png" width="11" />
                </td>
              
              <td nowrap="nowrap" valign="middle">
                <a href="javascript:<?=$txt_js?>"  <?=$attrib?>> <?=$txt_nombre?>  </a>
                </td>
              
              
              
              </tr>
            
            <? } ?>
          </table>
            
            
    	    	    </div>
          
	    	      </td>
        	  </tr>
    	</table>
    
		</div>
		
		<?=$tabla_resultado?>

		<?=$tabla_paginas?>
                  
         

      <input name="cod_pk" 						type="hidden">
      <input name="ind_buscar" 					type="hidden">
      <input name="num_pagina"					type="hidden" />
      <input name="ord_por" 					type="hidden" 	value="<?=$ord_por?>"/>
      <input name="txt_nombre_columna_iframe"	type="hidden">	  
      <input name="cod_ventana_emergente"		type="hidden">
      <input name="cod_atenciones"				type="hidden">
      <input name="ind_limpiar_ord"				type="hidden">
   	  <input name="cod_autorizacion_pk"				type="hidden">
	  <input name="cod_paciente_pk"				type="hidden">
            <input name="num_procesos_adicionales"	type="hidden"	value="<?php echo $num_procesos_adicionales?>">

      <iframe  name="frame_oculto" marginwidth="0"  width="0" height="0"   frameborder="0" id="frame_oculto" ></iframe>
      
<script language="javascript">



// MANTIENE LA POSICION DEL SCROLL AL RECARGAR LA PAGINA
window.onload=function(){
	var pos=window.name || 0;
	window.scrollTo(0,pos);
}
window.onunload=function(){
	window.name=self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
}

document.getElementById('tabla_filtros').width = screen.width;

</script>
<script>
function f_imprimir_reporte(){
	f			= document.form1;
	f.ind_buscar.value 	=	1;
	f.ind_imprimir_reporte.checked=true;
	f.target 	= "_blank";
	navegar(41);
	f.submit();
	f.target 	= "_self";
	f.ind_imprimir_reporte.checked=false;	  
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
        <div>Sistema de informacion  | Todos los derechos reservados © 2019</div>
            
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
