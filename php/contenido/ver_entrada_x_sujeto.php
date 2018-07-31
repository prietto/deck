<?php 
 ?>
<table width="49%" border="0" align="right" cellpadding="2" cellspacing="0">
	<tr>
       <td width="51%" colspan="5" align="center" valign="bottom" class="titulo_tabla_detalle">
       	<span>HISTORIAL DE ENTRADAS (Ultimos 10 Registros)</span>
       </td>
	</tr>
    <tr>
       <td width="51%" colspan="5" align="center" valign="bottom" class="titulo_tabla_detalle">
       	 <?=$txt_nombre_sujeto?> (<?=$txt_tipo_sujeto?>)
       </td>
	</tr>

       
	<tr>
        <td align="center" class="titulo_tabla_detalle">Fecha</td>
        <td align="center" class="titulo_tabla_detalle">Producto</td>
        <td align="center" class="titulo_tabla_detalle">Cantidad</td>
        <td align="center" class="titulo_tabla_detalle">Val Flete</td>
        <td align="center" class="titulo_tabla_detalle">Usuario</td>
        
          
    </tr>
        
    <tr>
        <td colspan="5" align="center" class="titulo_tabla_detalle"><div class="content_img"></div></td>
    </tr>



	 <?

	 if($num_registros == 0){
	 ?>
	 	<tr>
        	<td colspan="5" align="center" class="titulo_tabla_detalle">Ningun registro encontrado</td>
    	</tr>
	 <? }

		while($row_entr_1=$db->sacar_registro($cursor_entrada)){ 
			$fec_entrada 		= $row_entr_1['fec_registro'];
			$nom_proveedor		= $row_entr_1['txt_proveedor'];
			$val_flete_db		= $sis_genericos->formato_numero($row_entr_1['val_flete']);
			$num_cantidad_db	= $row_entr_1['num_cantidad'];
			$usuario_entrada_db = $row_entr_1['txt_usuario'];
			$unidad_medida_db	= $row_entr_1['txt_unidad_medida'];
			$txt_producto_db	= $row_entr_1['txt_producto'];
			
				
	?>
        
        
    <tr class="contenido">
         
		<td align="center" ><strong>(<?=$fec_entrada?>)</strong> </td>
		<td align="center" > <strong><?=$txt_producto_db?> </strong></td>
		<td align="center" > <strong><?=$num_cantidad_db?> (<?=$unidad_medida_db?>) </strong> </td>
		<td align="center" > <strong><?=$val_flete_db?></strong> </td>
        <td align="center"><strong><?=$usuario_entrada_db?></strong>    </td>
          
  	</tr>
       
        
    <? } ?>
        
        
</table>