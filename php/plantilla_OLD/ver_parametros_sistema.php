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
<link href="../../estilos/ver_parametros_sistema.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
<meta http-equiv="Expires" content="0" /> 
<!--<meta http-equiv="Pragma" content="no-cache" />-->
<script type="text/javascript">
if(history.forward(1)){location.replace( history.forward(1) );}
</script>
<!-- InstanceBeginEditable name="head" -->
<link rel="stylesheet" href="../../estilos/bootstrap.min.css">
<script src="../../js/ver_parametros_sistema.js" ></script>
<script src="../../js/opera_numeros.js" ></script>
<script src="../../js/bootstrap-filestyle.js"></script>
<script>
  $(function(){
    
    $(":file").filestyle({
      buttonBefore: true,
      iconName: "glyphicon-picture",
      buttonName: "btn-primary"
    });
    
    
    /*
    
      $('#img_upload').on('change',function(e){
      if(file_input.get(0).files.length){
              var fileSize = (file_input.get(0).files[0].size); // in bytes
        fileSize = fileSize/1024; 
        
        if(fileSize>max_size){
                  
          var max_size_limite = max_size / 1024;
          
          $(this).filestyle('clear');
          
          //$fileupload = $(this);  
          //$fileupload.replaceWith($fileupload.clone(true));
          var msj = '<p>Tu imagen sobrepasa el limite de '+max_size_limite+' MegaByte</p> <p><img src="../../imagenes/sistema/resize.png" /></p>';
          
          $.ventana_proceso({
            data : msj
            
          });
                  return false;
        }else{
                 // alert('file size is correct- '+fileSize+' bytes');
           $('.clear_file').show('slow');
           return false;
           
        }
      }else{
         //  alert('choose file, please');
        return false;
      }
          
    });*/
    
  
  
  })
</script>

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
		<div style="background-color:#d8d8d8; width:80%; padding:10px; margin:0 auto;  ">
			<table width="100%" border="0" cellpadding="3" align="center" >
              <tr>
                <td colspan="3" align="center" class="titulo_ventana_emergente">PARAMETROS DEL SISTEMA</td>
              </tr>

              <tr>
                <td colspan="3" align="center" class=" "><hr></td>
              </tr>

              <tr>
                <td colspan="3" align="center" class="">
                  <div id="box_info_empresa">
                    
                    <span class="titulo_ventana_emergente" id="titulo_modulo_empresa" >INFORMACION DE LA EMPRESA</span>


                    <table border="0" cellspacing="0" cellpadding="0" width="100%">                   

                      <tbody>
                        
                        <tr>
                          <td width="1%" nowrap="nowrap">Razon Social</td>
                          <td>:</td>
                          <td><input type="text" name="txt_razon_social" value="<?=$txt_razon_social?>"></td>
                        </tr>

                        <tr>
                          <td>Nombre Comercial</td>
                          <td>:</td>
                          <td><input type="text" name="txt_nombre_comercial" value="<?=$txt_nombre_comercial?>"></td>
                        </tr>

                        <tr>
                          <td nowrap="nowrap" width="1%">Tipo Identificacion</td>
                          <td>:</td>
                          <td>
                            
                            <select name="cod_tipo_identificacion">
                              <option value="0"></option>                            
                              <?=$cmb_tipo_identificacion?>
                            </select>

                            Numero: 
                            <input type="text" name="num_identificacion" value="<?=$num_identificacion?>">

                          </td>
                        </tr>

                        <tr>
                          <td>Codigo Ciiu</td>
                          <td>:</td>
                          <td><?=$cbm_ajax_ciiu?></td>
                        </tr>

                        <tr>
                          <td>Ciudad</td>
                          <td>:</td>
                          <td><?=$cmb_ajax_ciudad?></td>
                        </tr>

                        <tr>
                          <td>Direccion</td>
                          <td>:</td>
                          <td><input type="text" name="txt_direccion" value="<?=$txt_direccion?>"></td>
                        </tr>

                        <tr>
                          <td>Telefono</td>
                          <td>:</td>
                          <td><input type="text" name="txt_telefono" value="<?=$txt_telefono?>"></td>
                        </tr>

                        <tr>
                          <td>Genera Iva</td>
                          <td>:</td>
                          <td>
                            <select name="ind_genera_iva">
                              <option value="0"></option>                            
                              <?=$cmb_genera_iva?>
                            </select>

                            Valor iva:     
                            <input type="text" name="val_porcentaje_iva" value="<?=$val_porcentaje_iva?>">
                           </td>
                        </tr>

                        <tr>
                          <td valign="top">Logo</td>
                          <td valign="top">:</td>
                          <td>
                              <? $display_file = $txt_url_logo == NULL ? 'block' : 'none'; ?>
                                <div id="box_input_file" style="display:<?=$display_file?>">
                                  <input type="file" name="file_txt_url_logo" class="filestyle" id="img_upload" data-max_size='1024' onchange="p_subir_imagen_logo(this,event);" 
                                       data-buttonBefore="true" 
                                       data-buttonText="Carga una imagen" 
                                       data-placeholder="Tamaño Maximo 1024 Kbs" 
                                       data-iconName="glyphicon-picture"
                                       data-buttonName="btn-primary">
                                
                                </div>
                              

                              <output id="list-miniatura" style="padding:0px;"><? if($txt_url_logo)echo $txt_url_logo; ?></output>

                              <? if($txt_url_logo){ ?>
                                <div id="quitar_imagen_1" onClick="quitar_imagen_empresa(this,event);" 
                                  style="margin: 5px; padding: 0px; width: 100px; float:left; display:block;" 
                                  data-rel="img_upload" class="btn btn-danger">Quitar Imagen</div>

                              <? } ?>

                          </td>
                        </tr>

                        <tr>
                          <td nowrap="nowrap" width="1%">Fecha de Fundacion</td>
                          <td>:</td>
                          <td><?=$sis_genericos->f_crea_input_fecha('fec_fundacion',$fec_fundacion);?></td>
                        </tr>

                        <? /*<tr>
                          <td>Tipo formato factura</td>
                          <td>:</td>
                          <td>select con opciones de formatos</td>
                        </tr> */ ?>






                      </tbody>
                    </table>

                    
                    <button id="btn_info_empresa" class="btn btn-primary">Guardar</button>
                    


                  </div>
                </td>
              </tr>              



              <tr>
                <td colspan="3" align="center" class=" "><hr></td>
              </tr>
                
              <tr class="combo_solicitud">
              	<td colspan="3" nowrap="nowrap"><?=$mensaje_1?></td>
              </tr>
                
                
                <tr class="combo_solicitud">
                  	<td colspan="3" nowrap="nowrap">
                    	<div style="display:inline-block; width:100%;" class="box_parametros_1">
                            <div style="">
                                <table width="100%" border="0" cellpadding="3" align="center">
									<? 
                                    while($row=$db->sacar_registro($cursor_parametros)){
										
										$readonly = NULL;
										
                                        $txt_parametro 		= $row['txt_alias'];
                                        $txt_id_parametro 	= $row['txt_nombre'];
                                        $val_parametro		= $row['val_parametro'];
                                        $ind_readonly		= $row['ind_modificable_x_usuario'];
                                        $cod_tipo_dato		= $row['cod_tipo_dato_columna'];
                                        $cod_parametro		= $row['cod_parametro'];
										$cod_operacion		= $row['cod_tipo_operacion_parametro'];
										
										// crea select para mostrar el tipo de operacion para el parametro
										$cursor_tipo_operacion	= 	$tipo_operacion_parametro->f_get_all_activo();
										$cmb_tipo_operacion		=	$obj_listbox->f_crear_lista($cursor_tipo_operacion, $cod_operacion);
										
										$input_operacion		= 	'<select  name="operacion_parametro['.$cod_parametro.']"   id="operacion_parametro_'.$cod_parametro.'">
                             											<option value="-1" selected="selected"></option>
											                            '.$cmb_tipo_operacion.'                
												                     </select>';
                                        
										
										// verifica si el usuario puede modificar este parametro
                                        if($ind_readonly == 0)$readonly = "readonly='readonly'";
										
                                        
                                        if($cod_tipo_dato == 1){ // es un type text normal
                                            $input = '<input type="text" '.$readonly.' 
                                                            id="'.$txt_id_parametro.'"  name="val_parametro['.$cod_parametro.']" value="'.$val_parametro.'"  />';
                                        }else if($cod_tipo_dato == 20){ // es un select
                                            
                                            $input = '<select id="'.$txt_id_parametro.'" name="val_parametro['.$cod_parametro.']" >';
                                            if($val_parametro == 1)$input .= '<option value="1" selected="selected" >SI</option><option value="0">NO</option></select>';
                                            else if($val_parametro == 0)$input .= '<option value="1">SI</option><option value="0" selected="selected">NO</option></select>';
                                            
                                                        
                                                
                                        }
										
										//=== Evalua datos tipo NUMERIC CON FORMATO >>>
										else if($cod_tipo_dato == 2){
											
											$val_parametro	= str_replace(",","",$val_parametro);// quita las comas por si esta refrescando pantalla y luego le da nuevamente formato	
											//=== evalua con is_numeric para evitar que le ponga cero a un valor nulo >>>
											if(is_numeric($val_parametro))	$val_parametro	= $sis_genericos->formato_numero($val_parametro,2);
											 $input = '<input 	type="text" '.$readonly.' 
											 					onkeyup		="comportamiento_combo_numerico(this,2,event);" 
																onblur		="comportamiento_combo_numerico(this,2,event);"
																onfocus		="comportamiento_combo_numerico(this,2,event);" 
                                                            	id="'.$txt_id_parametro.'"  name="val_parametro['.$cod_parametro.']" value="'.$val_parametro.'"  />';
											
										}
                                    
                                    
                                    ?>
                                    
                                    
                                  <tr class="combo_solicitud">
                                    <td width="11%" nowrap="nowrap"><?=$txt_parametro?></td>
                                    <td width="2%">&nbsp;</td>
                                    <td width="11%"><?=$input?></td>
                                    <td width="76%"><?=$input_operacion?></td>
                                  </tr>
                                  
                                  <? 
                                  unset($input);
                                  unset($txt_parametro);
                                  unset($row);
                                  
                                  
                                  } //fin while 
                                  
                                  ?>
                                  
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
