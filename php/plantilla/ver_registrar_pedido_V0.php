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
<link href="../../estilos/select2.css" rel="stylesheet" type="text/css"  />
<link href="../../estilos/select2-bootstrap.css" rel="stylesheet" type="text/css"  />
<link href="../../estilos/timepicker.css" rel="stylesheet" type="text/css" />
<link href="../../estilos/estilo_general.css" rel="stylesheet" type="text/css" />
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<script src="../../js/jquery-1.11.2.min.js"></script>
<script src="../../js/jquery-ui.js" ></script>

<!-- CDN BOOTSTRAP -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="../../js/jquery.simplemodal.js" ></script>
<script src="../../js/timepicker.js"></script>
<script src="../../js/select2.js"></script>
<script src="../../js/jquery_multiselect.js" ></script>
<script src="../../js/ajax_navegacion.js" ></script>
<script src="../../js/jquery.serializefullarray.js" ></script>
<script src="../../js/js_general.js"></script>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Registro de <?=$alias_tabla_autonoma?> Nro. <?=$cod_pk?> </title>

<script src="../../js/formato_fecha.js"></script>
<script src="../../js/dhtml_calendario.js" ></script>
<script src="../../js/opera_numeros.js" ></script>
<script src="../../js/opera_combos.js"></script>
<script src="../../js/opera_cadenas.js"></script>
<script src="<?=$js_navegacion?>"></script>   
<?=$js_extra?>
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
		<form id="form1" name="form1" role="form" data-toggle="validator" method="post" class="form-horizontal" action="" enctype="multipart/form-data"> 
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

                    <div  class="col-sm-6">
          <h3>Left Tabs</h3>
          <hr/>
          <div class="col-xs-3"> <!-- required for floating -->
            <!-- Nav tabs -->
            <ul class="nav nav-tabs tabs-left">
              <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
              <li><a href="#profile" data-toggle="tab">Profile</a></li>
              <li><a href="#messages" data-toggle="tab">Messages</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
          </div>

          <div class="col-xs-9">
            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane active" id="home">Home Tab.</div>
              <div class="tab-pane" id="profile">Profile Tab.</div>
              <div class="tab-pane" id="messages">Messages Tab.</div>
              <div class="tab-pane" id="settings">Settings Tab.</div>
            </div>
          </div>
          </div>

					<!-- InstanceBeginEditable name="EditRegion3" -->
          <table width="100%" border="0" align="center" cellpadding="0">
        <tr>
          <td align="center" >
            <span class="text-capitalize"><?=$alias_tabla_detalle?> DE <?=$alias_tabla_autonoma?> Nro. <?=$cod_pk?></span>
            
            <div id="msj_servidor"></div>
            
            </td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <!--<td width="33%" align="right" valign="top" id="panel_izq_opciones">&nbsp;</td>-->
          <td width="100%">

            <table width="10%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr id="ver_foto" style="display:none" >
                <td align="center">

                  <table width="100%" border="0" cellpadding="0" cellspacing="3" bgcolor="#1B2965">
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
                  </table>
                </td>
              </tr>
            </table>
          
            <div  class="container" id="tabla_maestro">

              <div class="row">
                
                 
                <?=$row_imputs['cod_pedido']['input']?>
                
                <div class=" col-md-6" style='margin-bottom:20px;'>
                  <label for="<?=$row_imputs['cod_cliente']['txt_nombre']?>" class="control-label"><?=ucwords(strtolower($row_imputs['cod_cliente']['txt_alias']))?></label>
                  <?=$row_imputs['cod_cliente']['input']?>
                </div>

                 <div class=" col-md-6" style='margin-bottom:20px;'>
                  <label for="<?=$row_imputs['cod_forma_pago']['txt_nombre']?>" class="control-label"><?=ucwords(strtolower($row_imputs['cod_forma_pago']['txt_alias']))?></label>
                  <?=$row_imputs['cod_forma_pago']['input']?>
                </div>
              </div>

              <div class="row">
                <div class=" col-md-6" style='margin-bottom:20px;'>
                  <label for="<?=$row_imputs['cod_empleado']['txt_nombre']?>" class="control-label"><?=ucwords(strtolower($row_imputs['cod_empleado']['txt_alias']))?></label>
                  <?=$row_imputs['cod_empleado']['input']?>
                </div>

                 <div class=" col-md-6" style='margin-bottom:20px;'>
                  <label for="<?=$row_imputs['txt_observacion']['txt_nombre']?>" class="control-label"><?=ucwords(strtolower($row_imputs['txt_observacion']['txt_alias']))?></label>
                  <?=$row_imputs['txt_observacion']['input']?>
                </div>


              </div>
              <?=$tabla_imputs_detalle?>
              <div class="row">
                <div class="col-md-8" style="background-color:#D9EDF7;border:1px solid">
                  <div class="col-md-6">
                    <label for="<?=$row_imputs['val_recibido']['txt_nombre']?>" class="control-label"><?=ucwords(strtolower($row_imputs['val_recibido']['txt_alias']))?></label>
                    <?=$row_imputs['val_recibido']['input']?>

                    <div class="row">
                      <div class="col-md-6" style='margin-bottom:20px;'>
                        <label for="<?=$row_imputs['fec_registro']['txt_nombre']?>" class="control-label"><?=ucwords(strtolower($row_imputs['fec_registro']['txt_alias']))?></label>
                        <?=$row_imputs['fec_registro']['input']?>
                      </div>

                      <div class="col-md-6" style='margin-bottom:20px;'>
                        <label for="<?=$row_imputs['cod_estado_pedido']['txt_nombre']?>" class="control-label"><?=ucwords(strtolower($row_imputs['cod_estado_pedido']['txt_alias']))?></label>
                        <?=$row_imputs['cod_estado_pedido']['input']?>
                      </div>
                    </div>

                  </div>
                </div>

                <div class="col-md-4">
                  <div class="col-md-12">
                    <div class="row">
                      <div class=" col-md-12">
                        <label for="<?=$row_imputs['val_real']['txt_nombre']?>" class="control-label"><?=ucwords(strtolower($row_imputs['val_real']['txt_alias']))?></label>
                        <?=$row_imputs['val_real']['input']?>  
                      </div>
                    </div>
                    

                    <div class="row">
                      <div class=" col-md-12" >
                        <label for="<?=$row_imputs['val_saldo']['txt_nombre']?>" class="control-label"><?=ucwords(strtolower($row_imputs['val_saldo']['txt_alias']))?></label>
                        <?=$row_imputs['val_saldo']['input']?>
                      </div>   
                    </div>
                  </div>
                </div>
              </div>


              <br>

              <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td align="left"><input type="button" class="btn" name="esc" value="&lt;&lt; Atras" onclick="f_esc()"/></td>
                  <td align="center">&nbsp;</td>
                  <td align="right"><? if($ind_mostrar_boton_guardar){?>
                    <input name="enter"  type="button" class="pure-button" 
                      id="enter" onclick="f_enter()" value="Guardar &gt;&gt;" />
                    <? } ?></td>
                </tr>
              </table>


      			</div>
            
            
          
          
          
          

          
          </td>
          <?/*<td width="33%" align="center" valign="bottom">
            <a href="javascript:f_eliminar_registro()">
              <? if($ind_mostrar_boton_eliminar){?>
              Eliminar Registro
              <? } ?>
            </a>
          </td>*/?>
        </tr>
      </table>
      <div id="resultado"></div>
      <input name="cod_pk" 								type="hidden" 		value="<?=$cod_pk?>" />
      <input name="txt_ruta_mp3" 						type="hidden" />	  
      <input name="ind_new_row" 						type="hidden" 		value="<?=$ind_new_row?>" />
      <input name="cod_tabla_iframe" 					type="hidden" 		value="<?=$cod_tabla_iframe?>" />
      <input name="ind_guardar_datos_tabla_autonoma" 	type="hidden"/>
      <input name="txt_nombre_columna_iframe"			type="hidden"    />
      <input name="nom_columna_con_foto" 				type="hidden"/>	   
      <input name="cod_ventana_emergente"				type="hidden">	  	  
      <input name="val_campo"							type="hidden">	  
      <input name="ind_buscar"							type="hidden">	
      <input name="array_request_reporte"				type="hidden" 		value="<?=$array_request_reporte?>">    	  	  
      <iframe  name="frame_oculto" width="1" marginwidth="0"  height="1"   frameborder="0" id="frame_oculto" ></iframe>
   
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
