<? 
$layout = "layout_1";
require('../../Templates/'.$layout.'/header.inc.php');
?>

<table width="100%" border="0" align="center" cellpadding="0">
  	<tr>
		<td align="center" class="titulo_principal">Creacion de Modulos (PK==> <?=$cod_pk?>)</td>
    </tr>
</table>
<br />

<table width="100%" border="0" cellspacing="0" cellpadding="2">
	<tr>
    	<td width="33%">&nbsp;</td>
      	<td width="33%">
			<table width="10%"  border="0" align="center" cellpadding="0" cellspacing="0">
		        <tr id="ver_foto" style="display:none" >
		          	<td align="center">
		            	<table width="100%" border="0" cellpadding="0" cellspacing="3" bgcolor="#1B2965">
		              		<tr>
		                		<td align="right">
		                  			<span class="sub_titulo">
		                    			<a href="javascript:f_ocultar_foto()" class="sub_titulo"> 
		                    				<img src="../../imagenes/sistema/close_over.gif" width="16" height="16" border="0" />
		                    			</a>
		                    		</span>
		                    	</td>
		              		</tr>
							<tr>
                				<td align="center">
                					<a href="javascript:f_ocultar_foto()">
                						<img src="" name="img_registro" border="0"  id="img_registro" /></a>
                				</td>
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
      		
      		<table width="10%" border="0" align="center">

		    	   
		      	<tr>
		        	<td nowrap="nowrap" class="combo_solicitud">Nombre</td>
          			<td class="combo_solicitud">:                </td>
          			<td nowrap="nowrap"><input type="text" name="txt_nombre" id="txt_nombre" value=""></td>
        		</tr>

        		<tr>
		        	<td nowrap="nowrap" class="combo_solicitud">Alias</td>
          			<td class="combo_solicitud">:                </td>
          			<td nowrap="nowrap"><input type="text" name="txt_alias" id="txt_alias" value=""></td>
          		</tr>

          		<tr>
		        	<td nowrap="nowrap" class="combo_solicitud">Num Orden</td>
          			<td class="combo_solicitud">:                </td>
          			<td nowrap="nowrap"><input type="text" name="num_orden" id="num_orden" value=""></td>
          		</tr>

          		<tr>
		        	<td nowrap="nowrap" class="combo_solicitud">Estado:</td>
          			<td class="combo_solicitud">:                </td>
          			<td nowrap="nowrap">
          				<select name='cod_estado_tabla' class="combo" title="Seleccione un estado para el modulo">
                     		<option value='-1' selected='selected'></option>
                     		<?php echo $cmb_estado_tabla; ?>
                    	</select>
          			</td>
          		</tr>

          		<tr>
		        	<td nowrap="nowrap" class="combo_solicitud">Tipo:</td>
          			<td class="combo_solicitud">:                </td>
          			<td nowrap="nowrap">
          				<select name='cod_tipo_tabla' class="combo" title="Seleccione un tipo de modulo ">
                     		<option value='-1' selected='selected'></option>
                     		<?php echo $cmb_tipo_tabla; ?>
                    	</select>
          			</td>
          		</tr>


      		
      	
      			<tr>
        			<td colspan="3" nowrap="nowrap">
        				<table width="100%" border="0" cellspacing="2" cellpadding="2">
          					<tr>
            					<td align="left">
            						<input type="button" name="esc" class="contenido" value="&lt;&lt; Atras" onclick="f_esc()"/>
            					</td>
                				<td align="center">&nbsp;</td>
                				<td align="right">
                				<? if($cod_pk){?>
                  					<input name="enter" class="contenido" type="button" id="enter" onclick="f_enter()" value="Guardar&gt;&gt;" />
                  				<? } ?>                     
                  				</td>
              				</tr>
          				</table>
          			</td>
        		</tr>
    		</table>
		</td>
  		<td width="33%" align="right" valign="bottom">
  			<a href="javascript:f_eliminar_registro()">
    			<? if($ind_mostrar_boton_eliminar){?>
    		</a>
    		<table width="10%" border="1" cellpadding="2" cellspacing="2" bordercolor="#999999">
      			<tr>
        			<td align="center" nowrap="nowrap" bgcolor="#E2F1FE">
        				<a href="javascript:f_eliminar_registro()">Eliminar Registro</a>
        			</td>
      			</tr>
    		</table>
    		<a href="javascript:f_eliminar_registro()"><? } ?></a>
    	</td>
	</tr>
</table>


<input name="cod_pk" 								type="hidden" 		value="<?=$cod_pk?>" />
<input name="ind_new_row" 						type="hidden" 		value="<?=$ind_new_row?>" />
<input name="ind_guardar_datos_tabla_autonoma" 	type="hidden"/>
<input name="nom_columna_con_foto" 			type="hidden"/>
<input name="txt_nombre_columna_iframe"		type="hidden">	  
<input name="txt_ruta_mp3"					type="hidden">	  	  
<input name="cod_ventana_emergente"			type="hidden">	 
<input name="array_request_reporte"					type="hidden" 		value="<?=$array_request_reporte?>">   	  
<iframe  name="frame_oculto" width="1" marginwidth="0"  height="1"   frameborder="0" id="frame_oculto" ></iframe>
	  

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
	navegar_limpiando_variables(39);
}
</script>        
<p>&nbsp;</p>

<? 
require('../../Templates/'.$layout.'/footer.inc.php');
?>