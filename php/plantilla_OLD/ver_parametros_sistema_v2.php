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
<title>Scistem</title>
<!-- InstanceEndEditable -->
<meta http-equiv="Expires" content="0" /> 
<!--<meta http-equiv="Pragma" content="no-cache" />-->
<script type="text/javascript">
if(history.forward(1)){location.replace( history.forward(1) );}
</script>
<!-- InstanceBeginEditable name="head" -->
<script src="../../js/ver_parametros_sistema.js" ></script>

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
		<div style="background-color:#d8d8d8; width:80%; padding:10px; margin:0 auto;  ">
			<table width="100%" border="0" cellpadding="3" align="center" >
              <tr>
                <td colspan="3" align="center" class="titulo_ventana_emergente">PARAMETROS DEL SISTEMA</td>
                </tr>
                
                <tr class="combo_solicitud">
                	<td colspan="3" nowrap="nowrap"><?=$mensaje_1?></td>
                </tr>
                
                
                <tr class="combo_solicitud">
                  	<td colspan="3" nowrap="nowrap">
                    	<div style="display:inline-block; width:100%;" class="box_parametros_1">
                            <div style="background:green;">
                                <p>Ventas</p>
                                
                                <table width="100%" border="0" cellpadding="3" align="center">
									<? 
                                    while($row=$db->sacar_registro($cursor_parametros)){
                                        
                                        $txt_parametro 		= $row['txt_alias'];
                                        $txt_id_parametro 	= $row['txt_nombre'];
                                        $val_parametro		= $row['val_parametro'];
                                        $ind_readonly		= $row['ind_modificable_x_usuario'];
                                        $cod_tipo_dato		= $row['cod_tipo_dato_columna'];
                                        $cod_parametro		= $row['cod_parametro'];
                                        
                                        if($ind_readonly == 0)$readonly = "readonly='readonly'";
                                        
                                        if($cod_tipo_dato == 1){ // es un type text normal
                                            $input = '<input type="text" '.$readonly.' 
                                                            id="'.$txt_id_parametro.'"  name="val_parametro['.$cod_parametro.']" value="'.$val_parametro.'"  />';
                                        }else if($cod_tipo_dato == 20){ // es un select
                                            
                                            $input = '<select id="'.$txt_id_parametro.'" name="val_parametro['.$cod_parametro.']" >';
                                            if($val_parametro == 1)$input .= '<option value="1" selected="selected" >SI</option><option value="0">NO</option></select>';
                                            else if($val_parametro == 0)$input .= '<option value="1">SI</option><option value="0" selected="selected">NO</option></select>';
                                            
                                                        
                                                
                                        }
                                    
                                    
                                    ?>
                                    
                                    
                                  <tr class="combo_solicitud">
                                    <td width="20%" nowrap="nowrap"><?=$txt_parametro?></td>
                                    <td width="4%">&nbsp;</td>
                                    <td width="76%"><?=$input?></td>
                                  </tr>
                                  
                                  <? 
                                  unset($input);
                                  unset($txt_parametro);
                                  unset($row);
                                  
                                  
                                  } //fin while 
                                  
                                  ?>
                                  
                               </table>
                  
    
                            </div>
                            
                            <div style="background:red;">
                                <p>Compras</p>
                                <table width="100%" border="0" cellpadding="3" align="center">
                                	<tr>
                                    	<td>Precio por Bulto de descargue</td>
                                    </tr>
                                </table>
                                
                                
                            </div>
                        
                        </div>
                  
                  	</td>
                </tr>
                
                
    
    
				
              
               <tr class="combo_solicitud">
                    <td colspan="3" nowrap="nowrap">
                        <a href="javascript:void(0);" onClick="f_ver_facturas_conflicto(this);" data-actualizar="0" >Listar facturas con conflictos</a>
                    </td>
                </tr>
  
  
  
              <tr class="combo_solicitud">
                <td colspan="3" nowrap="nowrap"><hr /></td>
                </tr>
    
    
    <tr class="combo_solicitud">
      <td colspan="3" align="center" valign="top" nowrap="nowrap"><table width="80%" border="0" align="center">

        <tr>
          <td colspan="3" align="center" class="titulo_tabla_detalle">SELECCION DE COLORES PARA IDENTIFICACION DE LOS ESTADOS</td>
          </tr>
        <tr>
          <td colspan="2" align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td width="50%" colspan="2" align="center" class="titulo_tabla_detalle">ESTADOS DE FACTURACION</td>
          <td width="50%" align="center" class="titulo_tabla">ESTADO DE PEDIDOS</td>
        </tr>
        
        <tr>
          <td colspan="2" align="center"><?=$mensaje_2?></td>
          <td align="center" valign="top"><?=$mensaje_3?></td>
        </tr>
        <tr>
           <td colspan="2" align="center">
           
           <table width="80%" border="0" align="center">
           
             <? 
	while($row=$db->sacar_registro($cursor_estado_factura)){
		$val_color				= NULL;
		$txt_estado 			= $row['txt_nombre'];
		$cod_estado_factura		= $row['cod_estado_factura'];
		$val_color				= $row['txt_color'];
		if($val_color == NULL)$val_color = '#FFFFFF';					
		
	
	?>
        
         
         <tr>
          <td><?=$txt_estado?></td>
          <td><input type="color" name="estado_factura[<?=$cod_estado_factura?>]" value="<?=$val_color?>" /></td>
          </tr>
        
        <? } ?>
             
             
           </table>
           
           
           </td>
           <td align="center" valign="top">
           
           <table width="80%" border="0" align="center">
           
           <? 
		   unset($row);
		   while($row=$db->sacar_registro($cursor_estado_pedido)){ 
		   			
					$val_color			= NULL;
					$txt_estado 		= $row['txt_nombre'];
					$cod_estado_pedido 	= $row['cod_estado_pedido'];
					$val_color			= $row['txt_color'];
					
					if($val_color == NULL)$val_color = '#FFFFFF';					
		   
		   ?>
             <tr>
               <td><?=$txt_estado?></td>
               <td><input type="color" name="estado_pedido[<?=$cod_estado_pedido?>]" value="<?=$val_color?>" /></td>
             </tr>
             
             <? } ?>
             
           </table>
           
           
           
           
           </td>
           </tr>
        
       
        
      </table>
      
      </td>
      </tr>
    
   
    
    
    <tr class="combo_solicitud">
  	 	 <td width="20%" nowrap="nowrap">&nbsp;</td>
        <td width="4%">&nbsp;</td>
  	 	 <td width="76%">&nbsp;</td>
   </tr>
  
  
  
    </table>

			<table width="80%" border="0">
	  <tr>
	    <td align="center">
		<? if($ind_mostrar_boton_guardar){?>
        	<input name="enter"  class="contenido" type="button" id="enter" onclick="f_enter()" value="Guardar Cambios" />
        <? } ?> </td>
	    </tr>
	  </table>
      
      </div>
	
    
    <hr />
    <p>&nbsp;</p>
    

    
  	<div  onclick="f_genera_backup(this);return false;" id="boton_backup">GENERAR BACKUP</div>
    <br />
	<iframe src="" id="frame_oculto" scrolling="yes" name="frame_oculto" style="width:80%; display:none; overflow: auto;" >El navegador no soporte los Iframes por favor actualiza a la ultima version</iframe>
    
    
    
	
	<input name="ind_buscar" type="hidden" />
    <input name="ind_guardar_datos_tabla_autonoma" type="hidden" value="" />
	
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
