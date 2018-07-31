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
<title>Scistem - Factura No. <?=$cod_factura?></title>
<!-- InstanceEndEditable -->
<meta http-equiv="Expires" content="0" /> 
<!--<meta http-equiv="Pragma" content="no-cache" />-->
<script type="text/javascript">
if(history.forward(1)){location.replace( history.forward(1) );}
</script>
<!-- InstanceBeginEditable name="head" -->
<script src="../../js/opera_numeros.js" ></script>
<script src="../../js/ver_consultar_registro_factura.js"></script>
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
	
	  <table width="100%" border="0" align="center" cellpadding="0">
        <tr>
          <td align="center" class="titulo_principal"><?=$alias_tabla_autonoma?>
            Nro.
            <?=$cod_pk?>          </td>
        </tr>
      </table>
          <br />
              <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td width="8%">&nbsp;</td>
          <td width="83%"><table width="10%" border="0" align="center">
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
                    <td align="left">&nbsp;</td>
                        <td align="center"><input type="button" name="esc" class="pure-button" value="REGRESAR" onclick="f_esc()"/></td>
                        <td align="right">&nbsp;</td>
                      </tr>
                 
                
                  
                
                  </table></td>
                </tr>
          </table>
          <hr />
          
          	<div>
          		<table width="50	%" border="0" class="contenido">
                  <tr>
                    <td colspan="3" nowrap="nowrap" class="texto_impresion">INFORMACION DEL CLIENTE</td>
                  </tr>
                  <tr>
                    <td width="16%" nowrap="nowrap"><strong>CLIENTE</strong></td>
                    <td width="1%">:</td>
                    <td width="83%"><?=$txt_cliente." (".$txt_tipo_identificacion." ".$num_identificacion.")"?></td>
                  </tr>
                  <tr>
                    <td nowrap="nowrap"><strong>FORMA DE PAGO</strong></td>
                    <td>:</td>
                    <td><?=$txt_forma_pago?></td>
                  </tr>
                  <tr>
                    <td nowrap="nowrap"><strong>ESTADO DE LA FACTURA</strong></td>
                    <td>:</td>
                    <td><?=$txt_estado_factura?></td>
                  </tr>
                  <tr>
                    <td nowrap="nowrap"><strong>FECHA CREACION</strong></td>
                    <td>:</td>
                    <td><?=$fec_creacion?></td>
                  </tr>
                  <tr>
                    <td nowrap="nowrap"><strong>SALDO</strong></td>
                    <td>:</td>
                    <td style="color:red;"><strong>
                    	<span id="total_saldo"><?=$sis_genericos->formato_numero($val_saldo_fact)?></span></strong></td>
                  </tr>
                </table>
			</div>
            
           
            
            <table width="100%" >
<tr class="titulo_tabla_detalle">
                  		<td width="5%" nowrap="nowrap">Pedido</td>
                   		<td width="3%" nowrap="nowrap">P. Detalle</td>
                   		<td width="51%">Producto</td>
                        <td width="6%" nowrap="nowrap">Cantidad</td>
                        <td width="12%" nowrap="nowrap">Unidad Medida</td>
                        <td width="13%" nowrap="nowrap">Valor Unitario</td>
                        <td width="10%" nowrap="nowrap">Valor Total</td>                  
	             </tr>
                   <?php 
				   $sumatoria_val_compartido = 0;
				  
				   $total_val_atencion 	= 0;
				   $total_val_copago	= 0;
				   
				 while($row=$db->sacar_registro($cursor_pedido_detalle)){
						
						$cod_pedido					= $row['cod_pedido'];
						$cod_pedido_detalle			= $row['cod_pedido_detalle'];
						$cod_factura				= $row['cod_factura'];
						
						$txt_producto				= $row['txt_producto'];
						$cantidad					= $row['cantidad'];
						$val_unitatio				= $row['val_precio_unitario'];
						$val_unitario_formato		= $sis_genericos->formato_numero($row['val_precio_unitario']);
						$val_total_fila				= $row['val_total'];
						$val_total_fila_formato		= $sis_genericos->formato_numero($row['val_total']);
						$txt_usuario				= $row['txt_usuario'];
						$txt_forma_pago				= $row['txt_forma_pago'];
						$txt_estado_pedido			= $row['txt_estado_pedido'];
						$fec_registro				= $row['fec_registro'];
						$txt_unidad_medida			= $row['txt_unidad_medida'];
						
						$val_iva_porc	= 0;
						$val_rete_porc	= 0;
						$val_descuento	= 0;
						
						
						// INFORMACION DE LA FACTURA
						$row_factura 	= $factura->f_get_row($cod_factura);
						$val_iva_porc	= $row_factura['val_iva_porc'];
						$val_descuento	= $row_factura['val_descuento'];
						
						if(!$val_iva_porc)$val_iva_porc 	= 0;
						if(!$val_descuento)$val_descuento	= 0;
						
						
	
						
						
				 ?>
                   <tr class="contenido" style="font-size:15px;">
                   		<td nowrap="nowrap"><?php echo $cod_pedido; ?></td>
                   		<td nowrap="nowrap"><?php echo $cod_pedido_detalle; ?></td>
                        <td nowrap="nowrap"><?php echo $txt_producto; ?></td>
                        <td nowrap="nowrap"><?php echo $cantidad; ?></td>                        
                        <td nowrap="nowrap"><?php echo $txt_unidad_medida; ?></td>
                       
                     
                        <td align="right" nowrap="nowrap"><?php echo $val_unitario_formato; ?></td>
                        <td align="right" nowrap="nowrap"><?php echo $val_total_fila_formato; ?></td>                  
	             </tr>
                 
                 
                 
                 <? 
				 	$total_val_unitario 	= $total_val_unitario 	+ $val_unitatio;
					$total_fila 			= $total_fila 	+ $val_total_fila;
				 
				 } 
				 
				 $sumatoria_val_unitario 		= $sis_genericos->formato_numero($total_val_unitario);
				 $sumatoria_total				= $sis_genericos->formato_numero($total_fila);
				 
				 ?>
                 
                 <hr />
                 
                <tr class="contenido">
                   		<td nowrap="nowrap">&nbsp;</td>
                   		<td nowrap="nowrap">&nbsp;</td>
                        <td nowrap="nowrap">&nbsp;</td>
                        <td nowrap="nowrap">&nbsp;</td>                        
                        
                        <td nowrap="nowrap" class="menu_navegacion_paginas">SUMATORIAS:</td>
                     
                        <td align="right" nowrap="nowrap" class="menu_navegacion_paginas"><?php //echo $sumatoria_val_unitario; ?></td>
                        <td align="right" nowrap="nowrap" class="menu_navegacion_paginas" style="font-size:15px;">
							<?php echo $sumatoria_total; ?></td>                  
	             </tr>
                 
               
                  <tr class="contenido">
                    <td height="17" nowrap="nowrap">&nbsp;</td>
                    <td nowrap="nowrap">&nbsp;</td>
                    <td nowrap="nowrap">&nbsp;</td>
                    <td nowrap="nowrap">&nbsp;</td>
                   
                    <td nowrap="nowrap" class="contenido">&nbsp;</td>
                    <td nowrap="nowrap" class="contenido">&nbsp;</td>
                    <td nowrap="nowrap" class="contenido">&nbsp;</td>
                  </tr>
                  
       
                  <tr class="contenido" style="font-size:15px !important; ">
                     <td height="17" nowrap="nowrap">&nbsp;</td>
                     <td nowrap="nowrap">&nbsp;</td>
                     <td nowrap="nowrap">&nbsp;</td>
                     <td nowrap="nowrap">&nbsp;</td>
                    
                     <td nowrap="nowrap" class="menu_navegacion_paginas">&nbsp;</td>
                     <td nowrap="nowrap" class="menu_navegacion_paginas">SUBTOTAL:</td>
                     <td align="right" nowrap="nowrap" class="menu_navegacion_paginas" style="font-size:15px;">
					 <?php $subtotal = $total_fila;
					 		$subtotal_coma = $sis_genericos->formato_numero($subtotal);
					 		echo $subtotal_coma;
					 
					 
					  ?></td>
                  </tr>
                  
                  
                  
                  <tr class="contenido">
                    <td height="17" nowrap="nowrap">&nbsp;</td>
                    <td nowrap="nowrap">&nbsp;</td>
                    <td nowrap="nowrap">&nbsp;</td>
                    <td nowrap="nowrap">&nbsp;</td>
                    
                    <td nowrap="nowrap" class="menu_navegacion_paginas">&nbsp;</td>
                    <td nowrap="nowrap" class="menu_navegacion_paginas">DESCUENTO:</td>
                    <td align="right" nowrap="nowrap" class="menu_navegacion_paginas" style="font-size:15px;" ><?php 
						$val_descuento_coma = $sis_genericos->formato_numero($val_descuento);
						echo " <span style='color:#FF0000'>( - )</span> ".$val_descuento_coma; ?></td>
                  </tr>
                 
                  
                 
				 
                  <tr class="contenido">
                    <td height="17" nowrap="nowrap">&nbsp;</td>
                    <td nowrap="nowrap">&nbsp;</td>
                    <td nowrap="nowrap">&nbsp;</td>
                    <td nowrap="nowrap">&nbsp;</td>
                    
                    <td nowrap="nowrap" class="menu_navegacion_paginas">&nbsp;</td>
                    <td nowrap="nowrap" class="menu_navegacion_paginas">IVA:</td>
                    <td align="right" nowrap="nowrap" class="menu_navegacion_paginas" style="font-size:15px;"><?php 
					
					$val_iva_pesos = ($subtotal-$val_descuento)*$val_iva_porc/100;
					
					echo "(%) $val_iva_porc"; ?></td>
                  </tr>
                 
                  
                  
                  
                  
                
                  
                  <tr class="contenido">
                    <td height="17" nowrap="nowrap">&nbsp;</td>
                    <td nowrap="nowrap">&nbsp;</td>
                    <td nowrap="nowrap">&nbsp;</td>
                    <td nowrap="nowrap">&nbsp;</td>
                   
                    <td nowrap="nowrap" class="menu_navegacion_paginas">&nbsp;</td>
                    <td nowrap="nowrap" class="menu_navegacion_paginas">VALOR IVA:</td>
                    <td align="right" nowrap="nowrap" class="menu_navegacion_paginas" style="font-size:15px;"><?php 
						$val_iva_pesos_coma = $sis_genericos->formato_numero($val_iva_pesos);
						echo "(+) ".$val_iva_pesos_coma;  ?></td>
                  </tr>
                  
                  
                  
				  
				  
                  
                  
                  
                  
                  <tr class="contenido">
                    <td height="17" nowrap="nowrap">&nbsp;</td>
                    <td nowrap="nowrap">&nbsp;</td>
                    <td nowrap="nowrap">&nbsp;</td>
                    <td nowrap="nowrap">&nbsp;</td>
                    
                    <td nowrap="nowrap" class="menu_navegacion_paginas">&nbsp;</td>
                    <td nowrap="nowrap" class="menu_navegacion_paginas">TOTAL FACTURA:</td>
                    <td align="right" nowrap="nowrap" class="menu_navegacion_paginas" style="font-size:15px;"><?php 
						$total_factura = (($subtotal-$val_descuento)+$val_iva_pesos);
						$total_factura_coma = $sis_genericos->formato_numero($total_factura);
						echo $total_factura_coma;
					
					 ?></td>
                  </tr>
                  <tr class="contenido">
                   		<td height="17" nowrap="nowrap">&nbsp;</td>
                   		<td nowrap="nowrap">&nbsp;</td>
                        <td nowrap="nowrap">&nbsp;</td>
                        <td nowrap="nowrap">&nbsp;</td>                        
                    
                        <td nowrap="nowrap" class="contenido">&nbsp;</td>
                     
                        <td nowrap="nowrap" class="contenido">&nbsp;</td>
                        <td nowrap="nowrap" class="contenido">&nbsp;</td>                  
	             </tr>
                 
            </table>

            <hr />
            
            <table width="100%" border="0" class="contenido">
              <tr>
                <td colspan="4" class="texto_impresion">HISTORIAL DE PAGOS / ABONOS</td>
                </tr>
                
                 <tr class="titulo_tabla">
                <td width="21%">FECHA PAGO</td>
                <td width="20%">VALOR PAGO</td>
                <td colspan="2">USUARIO (INGRESO)</td>
                </tr>
                <? 
				while($row = $db->sacar_registro($cursor_pagos_factura)){
					//echo "<pre>";print_r($row);echo "</pre>";
					$val_pago		 	= $row['val_pago'];
					$val_pago_formato 	= $row['val_pago'];
					$fec_pago			= $row['fec_registro'];
					$txt_usuario		= $row['txt_usuario'];
					$cod_factura_pago	= $row['cod_factura_pago'];
				
				
				?>
                
              <tr id="row_pago_<?=$cod_factura_pago?>">
                <td><?=$sis_genericos->f_fecha_con_hora_no_semana($fec_pago);?></td>
                <td><span class="pago_factura"><?=$sis_genericos->formato_numero($val_pago_formato);?></span></td>
                <td width="3%" nowrap><?=$txt_usuario?></td>
                <td width="56%">
                	<img src="../../imagenes/sistema/delete.png" 
                    	data-pago="<?=$cod_factura_pago?>" style="cursor:pointer;"  data-valor="<?=$val_pago_formato?>"
                        onClick="p_eliminar_pago(this,event);" border="0" width="18" height="18">
                </td>
              </tr>
              
              
              <? 
				
				$sumatoria_val_pago = $sumatoria_val_pago +  $val_pago;
				
				  
			  } 
				
			?>
              <tr>
                <td>&nbsp;</td>
                <td><hr /></td>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><span id="val_total_pagos"><?=$sis_genericos->formato_numero($sumatoria_val_pago)?></span></td>
                <td colspan="2">&nbsp;</td>
              </tr>
            </table>

            
            </td>
          <td width="9%" align="right" valign="bottom"><a href="javascript:f_eliminar_registro()">
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
function f_enter(){
	f.enter.disabled = true;
	f.ind_guardar_datos_tabla_autonoma.value = 1;
	navegar(38);
}
function f_esc(){
	f.esc.disabled = true;
	f.ind_buscar.value = 1;
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
