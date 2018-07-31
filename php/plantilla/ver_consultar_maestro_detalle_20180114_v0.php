<? require('../../Templates/layout_2/header.inc.php'); ?>
      
      <h1>CONSULTA DE <?=$alias_tabla_autonoma?></h1>
      <div id="msj_respuesta_servidor"></div>
      <div style="position:relative;">

      


   		<table  style="width:100%" border="0" align="center" id="tabla_filtros">
        <tr>
          <td width="100%">
            <table width="100%" border="0" align="center">
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
                <p><div id="respuesta_servidor"></div></p>
                
                </td>
              </tr>
          </table>
          	<div style="" id="procesos_adicionales">
            <? 
              $num_registros 	= 	$db->num_registros($cursor_procesos_adicionales);
              for($i=0; $i<$num_registros; $i++){
              	$row                =$db->sacar_registro($cursor_procesos_adicionales,$i);
              	$txt_desc           =$row['txt_descripcion'];
              	if($txt_desc)$attrib= "title='$txt_desc'";
              	$txt_nombre         =$row['txt_nombre'];
              	$txt_js             =$row['txt_js'];
              ?>
              
                <button type="button" class="btn btn-primary"  onclick="<?=$txt_js?>"   <?=$attrib?> ><?=$txt_nombre?></button>
            
              <? 
              } 
              ?>
          
            
            
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



<? require('../../Templates/layout_2/footer.inc.php'); ?>