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
<title>Impuestos - D E C K Systems</title>
<link href="../../estilos/estilos_calendario.css" rel="stylesheet" type="text/css" />
<link  href="../../estilos/hipervinculos.css" rel="stylesheet" type="text/css" />

<script src="../../js/formato_fecha.js"></script>
<script src="../../js/dhtml_calendario.js" ></script>
<script src="../../js/opera_numeros.js" ></script>
<script src="../../js/opera_combos.js"></script>
<script src="../../js/opera_cadenas.js"></script>

<script src="<?=$js_navegacion?>"></script>
<!-- InstanceEndEditable -->
<meta http-equiv="Expires" content="0" /> 
<!--<meta http-equiv="Pragma" content="no-cache" />-->
<script type="text/javascript">
if(history.forward(1)){location.replace( history.forward(1) );}
</script>
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
.titulo_principal1 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
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
                                    <?=$txt_url_logo_head_template?>
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
          <p>&nbsp;</p>
          <table width="100%" border="0" align="center" cellpadding="0">
        <tr>
          <td align="center" class="titulo_principal">GENERACION Y/O ASIGNACION DE IMPUESTO</td>
        </tr>
      </table>
          <br />
              <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td width="14%">&nbsp;</td>
          <td width="72%"><table width="100%" border="0" align="center">
            <tr>
              <td colspan="13" nowrap="nowrap" class="titulo_tabla"> Relacion de Facturas</td>
            </tr>
            <tr class="menu_navegacion_paginas"  >
             <td nowrap="nowrap" class="combo_solicitud"><input  type="checkbox" onclick="marcar(this);" checked="checked" /></td>
             <td nowrap="nowrap" class="combo_solicitud">Factura</td>
             <td colspan="2" nowrap="nowrap" class="combo_solicitud">Entidad</td>
             <td width="9%" nowrap="nowrap">Estado</td>
              <td width="13%" nowrap="nowrap">Fecha Generada</td>
              <td width="7%" nowrap="nowrap">IVA (%)</td>
              <td width="7%" nowrap="nowrap">IVA ($)</td>
              <td width="7%" nowrap="nowrap">RF. (%)</td>
              <td width="7%" nowrap="nowrap">RF ($)</td>
              <td width="7%" nowrap="nowrap">CREE (%)</td>
              <td width="8%" nowrap="nowrap">CREE ($)</td>
                <td width="14%" nowrap="nowrap">Valor Total</td>
            </tr>
            
            <?php while($row=$db->sacar_registro($cursor_facturas)){

						$cod_factura 			= $row['cod_factura'];
						$txt_entidad			= $row['txt_entidad'];
						$txt_estado_factura		= $row['txt_estado_factura'];
						$fec_registro			= $row['fec_registro'];
						$valor_total			= $row['valor_total'];
						$val_iva_porc			= $row['val_iva_porc'];
						$val_rete_porc			= $row['val_rete_porc'];
						$val_cree_porc			= $row['val_cree_porc'];
						$val_iva				= ($valor_total*$val_iva_porc)/100;
						$val_rete				= ($valor_total*$val_rete_porc)/100;
						$val_cree				= ($valor_total*$val_cree_porc)/100;
						
						if(!$val_iva_porc)$val_iva_porc 	= 0;
						if(!$val_rete_porc)$val_rete_porc 	= 0;
						if(!$val_cree_porc)$val_cree_porc	= 0;
						
						$valor_total			= $sis_genericos->formato_numero($valor_total);	
				
				 ?>
            
            <tr class="contenido">
            <td width="3%" nowrap="nowrap"><input name="reg_seleccionado[]" type="checkbox" value="<?=$cod_factura?>" checked /></td>
            <td width="5%" nowrap="nowrap"><?=$cod_factura?></td>
            <td colspan="2" nowrap="nowrap"><?=$txt_entidad?></td>
            <td nowrap="nowrap"><?=$txt_estado_factura?></td>
              <td nowrap="nowrap"><?=$fec_registro?></td>
              <td nowrap="nowrap"><?=$val_iva_porc?></td>
              <td nowrap="nowrap"><?=$val_iva?></td>
              <td nowrap="nowrap"><?=$val_rete_porc?></td>
              <td nowrap="nowrap"><?=$val_rete?></td>
              <td nowrap="nowrap"><?=$val_cree_porc?></td>
              <td nowrap="nowrap"><?=$val_cree?></td>
               <td nowrap="nowrap"><?=$valor_total?></td>
            </tr>
            
            <?php } ?>
            
            <tr>
              <td colspan="13" nowrap="nowrap" class="combo_solicitud">&nbsp;</td>
            </tr>
          
            <tr>
              <td colspan="3" nowrap="nowrap" class="combo_solicitud">Valor IVA (%): &nbsp;</td>
              <td colspan="10" align="left" nowrap="nowrap" class="combo_solicitud">
              <input 	type		='text' 
						class		='combo' 
						name		='val_iva_porc'  
						value		=''
						size		='14'
						title		='Si desea generar IVA para las facturas seleccionadas ingrese el valor, de lo contrario dejar en blanco'
						maxlength	='255'
						onkeyup		='comportamiento_combo_numerico(this,2,event)' 
						onblur		='comportamiento_combo_numerico(this,2,event);'
						onfocus		='comportamiento_combo_numerico(this,2,event)' /></td>
              </tr>
            <tr>
              <td colspan="3" nowrap="nowrap" class="combo_solicitud">Valor CREE (%): &nbsp;</td>
              <td colspan="10" align="left" nowrap="nowrap" class="combo_solicitud"><input 	type		='text' 
						class		='combo' 
						name		='val_cree_porc'  
						value		=''
						size		='14'
						title		='Si desea generar el impuesto CREE para las facturas seleccionadas ingrese el valor, de lo contrario dejar en blanco'
						maxlength	='255'
						onkeyup		='comportamiento_combo_numerico(this,2,event)' 
						onblur		='comportamiento_combo_numerico(this,2,event);'
						onfocus		='comportamiento_combo_numerico(this,2,event)' /></td>
              </tr>
            <tr>
              <td colspan="6" nowrap="nowrap" class="combo_solicitud">&nbsp;</td>
              </tr>
            <tr>
              <td colspan="13" nowrap="nowrap"><table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td align="left"><input type="button" name="esc" class="contenido" value="&lt;&lt; Atras" onclick="f_esc()"/></td>
                  <td align="center">&nbsp;</td>
                  <td align="right"><input name="enter" class="contenido" type="button" id="enter" onclick="f_enter()" value="Guardar&gt;&gt;" /></td>
                  </tr>
                </table></td>
            </tr>
          </table>
            <p>&nbsp;</p></td>
          <td width="14%" align="right" valign="bottom"><a href="javascript:f_eliminar_registro()">
            <? if($ind_mostrar_boton_eliminar){?>
            </a>
            <table width="10%" border="1" cellpadding="2" cellspacing="2" bordercolor="#999999">
              <tr>
                <td align="center" nowrap="nowrap" bgcolor="#E2F1FE"><a href="javascript:f_eliminar_registro()">Eliminar Registro</a></td>
              </tr>
            </table>
            <a href="javascript:f_eliminar_registro()"><? } ?>
            </a></td>
        </tr>
      </table>
      <input name="cod_pk" 								type="hidden" 		value="<?=$cod_pk?>" />
      <input name="ind_new_row" 						type="hidden" 		value="<?=$ind_new_row?>" />
      <input name="ind_guardar_datos_tabla_autonoma" 	type="hidden"/>
      <input name="nom_columna_con_foto" 			type="hidden"/>
      <input name="txt_nombre_columna_iframe"		type="hidden">	  
      <input name="txt_ruta_mp3"					type="hidden">	  	  
      <input name="cod_ventana_emergente"			type="hidden">
      <input name="ind_buscar"			type="hidden">	  
       <input name="array_request_reporte"			type="hidden" value="<?php echo $array_request_reporte; ?>">	
      	  
      <iframe  name="frame_oculto" width="1" marginwidth="0"  height="1"   frameborder="0" id="frame_oculto" ></iframe>
	  
      <p>
        <script>
function f_eliminar_registro(){
	confirmacion = confirm ("El registro sera eliminado completamente del sistema \n\n ?Desea Continuar?");
	if(confirmacion==true)	navegar(40)
}
      </script>
        <script>
f = document.form1;
function f_enter(){
	
	f.enter.disabled = true;
	//f.ind_guardar_datos_tabla_autonoma.value = 1;
	f.ind_buscar.value = 1;
	navegar(1038);

}
function f_esc(){
	f.esc.disabled = true;
	navegar_limpiando_variables(39);
}
      </script>
        
        </p>
          <p>&nbsp;</p>
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
        	<div>Sistema de informacion  | Todos los derechos reservados © 2019</div> |<div>Sistema de informacion  | Todos los derechos reservados © 2019</div>|<div>Sistema de informacion  | Todos los derechos reservados © 2019</div> |<div>Sistema de informacion  | Todos los derechos reservados © 2019</div>
            
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
