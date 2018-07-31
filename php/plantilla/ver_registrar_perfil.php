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
<title>MyScistem -  Registro de <?=$alias_tabla_autonoma?> Nro. <?=$cod_pk?></title>
<link 	href="../../estilos/estilos_calendario.css" rel="stylesheet" type="text/css" />
<link  	href="../../estilos/hipervinculos.css" rel="stylesheet" type="text/css" />

<link href="../../estilos/multiselect.css" rel="stylesheet" type="text/css" />
<link href="../../estilos/jquery-ui.css" rel="stylesheet" type="text/css"  />

<script src="../../js/formato_fecha.js"></script>
<script src="../../js/dhtml_calendario.js" ></script>
<script src="../../js/opera_numeros.js" ></script>
<script src="../../js/opera_combos.js"></script>
<script src="../../js/opera_cadenas.js"></script>
<script src="../../js/ver_registrar_perfil.js"></script>

<script src="../../js/jquery_multiselect.js" ></script>


<script type="text/javascript">


$(function(){
	$(".multiple_select").multiselect({
		selectedList: 4 // 0-based index
	});

	$('body').delegate('.modulo','change', function() {
	//$('.modulo').on('change', function() {
  		var value_this = this.value ;
  		var $this = $(this);
  		var parent = $this.parent().parent();
  	 	id = parent.attr('id');
		$("#"+id+" td.operaciones > select").attr("name", "cod_operacion_tabla["+value_this+"][]");
		//alert( this.value ); // or $(this).val()
	});
});


</script>

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
          <p>&nbsp;</p>
          <table width="100%" border="0" align="center" cellpadding="0">
        <tr>
          <td align="center" class="titulo_principal">REGISTRO DE
            <?=$alias_tabla_autonoma?>
            Nro.
            <?=$cod_pk?>          </td>
        </tr>
      </table>
          <br />
              <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td width="33%" rowspan="2">&nbsp;</td>
          <td width="33%" rowspan="2"><table width="10%"  border="0" align="center" cellpadding="0" cellspacing="0">
            <tr id="ver_foto" style="display:none" >
              <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="3" bgcolor="#1B2965">
                  <tr>
                    <td align="right"><span class="sub_titulo"><a href="javascript:f_ocultar_foto()" class="sub_titulo"> <img src="../../imagenes/sistema/close_over.gif" width="16" height="16" border="0" /></a></span></td>
                  </tr>
                  <tr>
                    <td align="center"><a href="javascript:f_ocultar_foto()"><img src="" name="img_registro" border="0"  id="img_registro" /></a></td>
                  </tr>
                </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><input type="button" name="eliminar_foto" value="Eliminar Foto"  class="contenido" onclick="f_eliminar_foto()" /></td>
                      <td align="right">&nbsp;</td>
                    </tr>
                </table></td>
            </tr>
          </table>
          <table width="100%" border="0" align="center">
              <?
for($i=0; $i<$num_columnas; $i++){
	$row_columna		= array_pop($row_imputs);
	$txt_alias			= $row_columna['txt_alias'];
	$input				= $row_columna['input'];
	$txt_alias			= ucwords(strtolower($txt_alias));
	$txt_alias			= str_replace("_"," ",$txt_alias);
	if(!$txt_alias)		$dos_puntos = "";
	else				$dos_puntos = ":";
?>
              <tr>
                <td nowrap="nowrap" class="combo_solicitud"><?=$txt_alias?>                </td>
                  <td class="combo_solicitud"><?=$dos_puntos?>                </td>
                  <td nowrap="nowrap"><?=$input?>                </td>
                </tr>
              <? } ?>
              <tr>
                <td colspan="3" nowrap="nowrap"><table width="100%" border="0" cellspacing="2" cellpadding="2">
                  <tr>
                    <td align="left"><input type="button" name="esc" class="contenido" value="&lt;&lt; Atras" onclick="f_esc()"/></td>
                        <td align="center">&nbsp;</td>
                        <td align="right"><? if($ind_mostrar_boton_guardar && $cod_pk){?>
                          <input name="enter" class="contenido" type="button" id="enter" onclick="f_enter()" value="Guardar&gt;&gt;" />
                          <? } ?>                      </td>
                      </tr>
                  </table></td>
                </tr>
            </table>
            <br />
            


            
          <table  id='tabla_detalle_16' width='100%' border='0' cellspacing='5' cellpadding='5'>
            <tr class='titulo_tabla_detalle'>
              <td nowrap='nowrap' >MODULO</td>
              <td nowrap='nowrap' >PERMISO</td>
              <td></td>
            </tr>
           
         
           
          
          <?php 
		  
 $num_permisos = $db->num_registros($cursor_permisos);
		  
 $contador = 0;
 while($row = $db->sacar_registro($cursor_permisos)){ 
           	

			$cod_modulo				= $row['cod_tabla'];
			$cod_operacion			= $row['cod_operacion'];
            
			$arr_permisos = $cursor_permisos_vector[$cod_modulo];
			
		if($cod_modulo != $cod_modulo_anterior){
			$cod_modulo_anterior = $cod_modulo;

			// ==== combo de modulos en el detalle
			$cursor_modulo_ciclo			= 	$tabla_autonoma->f_get_activo();
			$cmb_tablas_autonomas_ciclo		=	$obj_listbox->f_crear_lista($cursor_modulo_ciclo, $cod_modulo);

			$cursor_operacion_ciclo			=	$seg_operacion_tabla->f_get_all();
			$cmb_operacion_tabla_ciclo		=	$obj_listbox->f_crear_lista_vector_multiple($arr_permisos, $arr_permisos_full);
			
			
			

		?>
           	
           
            <tr valign='top'   id='tabla_16_row_<?php echo $contador; ?>'>
              <td valign="bottom" nowrap='nowrap'>                            
                <select class="combo modulo" name='cod_modulo[]'  id="cod_modulo_<?=$contador?>">
                  <option value='-1' selected='selected'></option>
                <?php echo $cmb_tablas_autonomas_ciclo; ?>                
                </select>
                
                </td>
              <td valign="middle" nowrap='nowrap'>
              
              <select name='cod_operacion_tabla[<?php echo $cod_modulo; ?>][]' id="cod_operacion_tabla_<?=$contador?>"  
              	multiple='multiple' class='multiple_select' style="width:300px" >
               <?php echo $cmb_operacion_tabla_ciclo; ?>
              </select>
              
              </td>
              <td align='right' valign="middle" nowrap='nowrap'>
              <input class='contenido' name='mas'  type='button' onclick="addRow(this,'tabla_detalle_16')" value='+' />
                <input class='contenido' name='menos' type='button' onclick="eliminar_fila(this,'tabla_detalle_16')" value='-' /></td>
            </tr>
            
          <?php 
		  	$cod_modulo 		= NULL;
		  	$cod_operacion 	= NULL; 
			
					$contador++;
		  
		}
		

		  
 }   
		  
		  ?>       
          
          
          <?php $new_contador = $contador; ?>
          
          <tr valign='top'   id='tabla_16_row_<?php echo $new_contador; ?>' >
              <td valign="middle" nowrap='nowrap'  >                            
                <select class="combo modulo" name='cod_modulo[]' id="cod_modulo_<?=$new_contador?>" 
                	onchange="javascript:f_validar_repetido(this)" data-name='cod_modulo' >
                  <option value='-1' selected='selected'></option>
                <?php echo $cmb_tablas_autonomas; ?>                
                </select>
            </td>
                
           <td valign="middle" nowrap='nowrap' class='operaciones'>
              <select class="multiple_select"  multiple="multiple" id="cod_operacion_tabla_<?=$new_contador?>"	
              	name='cod_operacion_tabla[][]' style="width:300px" data-name='cod_operacion_tabla' >
                 <?php echo $cmb_operacion_tabla; ?>
              </select>
          </td>
              <td align='right' valign="middle" nowrap='nowrap'>
              <input class='contenido' name='mas'  type='button' id="prueba" onclick="addRow(this,'tabla_detalle_16')" value='+' />
                <input class='contenido' name='menos' type='button' onclick="eliminar_fila(this,'tabla_detalle_16')" value='-' /></td>
            </tr>
          
          
          
          
          
          </table>
          
          <table width="100%">
          
          <tr>
                    <td align="left"><input type="button" name="esc" class="contenido" value="&lt;&lt; Atras" onclick="f_esc()"/></td>
                        <td align="center">&nbsp;</td>
                        <td align="right"><? if($ind_mostrar_boton_guardar && $cod_pk){?>
                          <input name="enter" class="contenido" type="button" id="enter" onclick="f_enter()" value="Guardar&gt;&gt;" />
                          <? } ?>                      </td>
                      </tr>
          
          </table>
          <p>&nbsp;</p></td>
          <td width="33%" align="right" valign="top"><a href="javascript:f_eliminar_registro()">
            </a>
            <table width="50%" border="0" align="center">
              <tr class="contenido_azul" >
                <td align="right" valign="middle"><a href="javascript:f_condicion_especial()" >
                	 <img src="../../imagenes/sistema/sound.png" width="10"  /> &nbsp; Condiciones Especiales </a></td>
              </tr>
            </table>
            <a href="javascript:f_eliminar_registro()">            </a></td>
        </tr>
        <tr>
          <td align="right" valign="bottom"><table width="100%" border="0">
            <tr>
              <td align="right"><a href="javascript:f_eliminar_registro()">
                <? if($ind_mostrar_boton_eliminar){?>
                </a>
                <table width="10%" border="1" cellpadding="2" cellspacing="2" bordercolor="#999999">
                  <tr>
                    <td align="center" nowrap="nowrap" bgcolor="#E2F1FE"><a href="javascript:f_eliminar_registro()">Eliminar Registro</a></td>
                  </tr>
                </table>
                <a href="javascript:f_eliminar_registro()">
                  <? } ?>
                </a></td>
            </tr>
          </table></td>
        </tr>
            </table>
      <input name="cod_pk" 								type="hidden" 		value="<?=$cod_pk?>" />
      <input name="ind_new_row" 						type="hidden" 		value="<?=$ind_new_row?>" />
      <input name="ind_guardar_datos_tabla_autonoma" 	type="hidden"/>
      <input name="nom_columna_con_foto" 			type="hidden"/>
      <input name="txt_nombre_columna_iframe"		type="hidden">	  
      <input name="txt_ruta_mp3"					type="hidden">	  	  
      <input name="cod_ventana_emergente"			type="hidden">	 
      <input name="ind_guardar_dato"			type="hidden">	 
      <input name="ind_buscar"			type="hidden">	 
      <input name="array_request_reporte"					type="hidden" 		value="<?=$array_request_reporte?>">   	  
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

function f_esc(){
	f.esc.disabled = true;
	navegar(39);
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
        	<div>Sistema de informacion desarrollado por Luis Prieto para Comestibles Elsa | Todos los derechos reservados © 2015</div>
            
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
