<? require('../../Templates/layout_2/header.inc.php'); ?>
<table width="100%" border="0" align="center" cellpadding="0">
    <tr>
        <td align="center" class="titulo_principal">REGISTRO DE
            <?=$alias_tabla_autonoma?>
            Nro.
            <?=$cod_pk?>
        </td>
    </tr>
</table>

<?=$fields_box?>

      <br />
  
<table width="100%" border="0" cellspacing="2" cellpadding="2">
    <tr>
        <td align="left">
          <input
            type="button"
            name="esc"
            class="contenido btn btn-primary"
            value="&lt;&lt; Atras"
            onclick="f_esc()"/></td>
        <td align="center">&nbsp;</td>
        <td align="right"><? if($ind_mostrar_boton_guardar && $cod_pk){?>
            <input
                name="enter"
                class="contenido btn btn-primary"
                type="button"
                id="enter"
                onclick="f_enter()"
                value="Guardar&gt;&gt;"/>
            <? } ?>
        </td>
    </tr>
</table>

<br>
<hr>
      
<table width="48%" border="1" align="left" cellpadding="2" cellspacing="0" style="border:1px #333 solid;">
  <tr>
    <td colspan="7" align="center" class="titulo_tabla_detalle">HISTORIAL X PRODUCTO (Ultimos 10 registros)</td>
  </tr>
  
  <tr>
    <td align="center" class="titulo_tabla_detalle">Fecha</td>
    <td align="center" class="titulo_tabla_detalle">Suministra</td>
    <td align="center" class="titulo_tabla_detalle">Cantidad</td>
    <td align="center" class="titulo_tabla_detalle">Val Flete</td>
    <td align="center" class="titulo_tabla_detalle">Usuario</td>
    <td align="center" class="titulo_tabla_detalle">Estado</td>
    <td align="center" class="titulo_tabla_detalle">&nbsp;</td>
  </tr>
  
  <?php 
  while($row_entr_1=$db->sacar_registro($cursor_ntrdas_prdcto)){ 
    $fec_entrada 			= $row_entr_1['fec_registro'];
    $nom_proveedor			= $row_entr_1['txt_proveedor'];
    $val_flete_db			= $sis_genericos->formato_numero($row_entr_1['val_flete']);
    $num_cantidad_db		= $row_entr_1['num_cantidad'];
    $usuario_entrada_db 	= $row_entr_1['txt_usuario'];
    $unidad_medida_db		= $row_entr_1['txt_unidad_medida'];
    $cod_entrada_pk			= $row_entr_1['cod_entrada_producto'];
    $cod_estado_entrada		= $row_entr_1['cod_estado_entrada_producto'];
    $txt_estado_entrada		= $row_entr_1['txt_estado_entrada_producto'];
    
    $background = NULL;
    
    if($cod_estado_entrada == 2)$background = "background-color:red;";
  ?>
  
  
  <tr class="contenido" id="registro_entrada_<?=$cod_entrada_pk?>" style="<?=$background?>">
    
    <td align="center" ><strong>(<?=$fec_entrada?>)</strong> </td>
    <td align="center" > <strong><?=$nom_proveedor?> </strong></td>
    <td align="center" > <strong><?=$num_cantidad_db?> (<?=$unidad_medida_db?>) </strong> </td>
    <td align="right" > <strong><?=$val_flete_db?></strong> </td>
    <td align="center"><strong><?=$usuario_entrada_db?></strong>    </td>
    <td align="center"><strong><span class="estado_entrada"><?=$txt_estado_entrada?></span></strong>    </td>
    <td align="center" valign="middle">
      <? if($cod_estado_entrada == 1){ ?>
        <img src="../../imagenes/sistema/delete.png" title="Anular"  
            class="link_imagen" onclick="f_anular_entrada(this,event);return false;" data-cod_pk="<?=$cod_entrada_pk?>" />
          <? } ?>
      </td>
  </tr>
  
  
  <?php } ?>
</table>
      

     
<div class="box_historial_actor" > 
    <table width="49%" border="0" align="right" cellpadding="2" cellspacing="0">
        <tr>
          <td width="51%" colspan="5" align="center" valign="bottom" class="titulo_tabla_detalle">HISTORIAL DE ENTRADAS</td>
        </tr> 
          <tr>
          <td width="51%" colspan="5" align="center" valign="bottom" ><div class="content_img"></div></td>
        </tr> 
    </table>
</div>
      
       
      
<input name="cod_pk" 								type="hidden" 		value="<?=$cod_pk?>" />
<input name="ind_new_row" 						type="hidden" 		value="<?=$ind_new_row?>" />
<input name="ind_guardar_datos_tabla_autonoma" 	type="hidden"/>
<input name="nom_columna_con_foto" 			type="hidden"/>
<input name="txt_nombre_columna_iframe"		type="hidden">	  
<input name="txt_ruta_mp3"					type="hidden">	  	  
<input name="cod_ventana_emergente"			type="hidden">	 
<input name="array_request_reporte"			type="hidden" 		value="<?=$array_request_reporte?>">   
<input name="reg_seleccionado"			type="hidden" value="<?php echo $reg_seleccionado[0]; ?>">	 
<iframe  name="frame_oculto" width="1" marginwidth="0"  height="1"   frameborder="0" id="frame_oculto" ></iframe>
	  
    
<script>
  function f_eliminar_registro(){
    confirmacion = confirm ("El registro sera eliminado completamente del sistema \n\n ?Desea Continuar?");
    if(confirmacion==true)	navegar(40)
  }

  f = document.form1;
  function f_enter(){
    f.enter.disabled = true;
    f.ind_guardar_datos_tabla_autonoma.value = 1;
    navegar(1077);
  }

  function recibir_dato(cod_pk){
    input_proveedor 		= f.cod_proveedor;
    input_proveedor.value 	= cod_pk;
    obj = document.getElementById('cod_proveedor');
    ver_valor_iframe(obj);
  }

</script>
        
<? require('../../Templates/layout_2/footer.inc.php'); ?>