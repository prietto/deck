<? require('../../Templates/layout_2/header.inc.php'); ?>
          <table width="100%" border="0" align="center" cellpadding="0">
        <tr>
          <td align="center" class="titulo_principal"><?=$alias_tabla_detalle?> 
            DE
            <?=$alias_tabla_autonoma?>
            Nro.
            <?=$cod_pk?>          
            
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

              
            <?=$fields_box?>
                        
      			</div>
            
            
          <?=$tabla_imputs_detalle?>
          
          
          <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
              <td align="left"><input type="button" class="pure-button" name="esc" value="&lt;&lt; Atras" onclick="f_esc()"/></td>
              <td align="center">&nbsp;</td>
              <td align="right"><? if($ind_mostrar_boton_guardar){?>
                <input name="enter"  type="button" class="pure-button" 
                	id="enter" onclick="f_enter()" value="Guardar &gt;&gt;" />
                <? } ?></td>
            </tr>
          </table>

          
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

<? require('../../Templates/layout_2/footer.inc.php'); ?>