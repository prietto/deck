<style>
#reporte_pago_empleado{
	 border-collapse: collapse;
}
</style>

<h2>A continuacion se lista el detalle de la compra</h2>

<table width="100%" id="reporte_pago_empleado" border="1" style="border:1px solid grey;" class="tabla_reporte" cellpadding="5" cellspacing="5" >
  <tr class="titulo_tabla">
    <td>INSUMO</td>
    <td>CANTIDAD</td>
    <td>VR. UNITARIO</td>
    <td>VR. TOTAL</td>
    

  </tr>
  
  <? 
  	$val_sumatoria = NULL;
  	while($row=$db->sacar_registro($cursor_detalle_compra)){
  		$txt_insumo 			= $row['txt_insumo'];
  		$num_cantidad			= $row['cantidad'];
  		$val_precio_unitario	= $row['val_precio_unitario'];
  		$val_total				= $row['val_total'];

  		$val_sumatoria = $val_sumatoria+$val_total;
      
  ?>
  
  <tr>
    <td align="center" nowrap="nowrap"><?=$txt_insumo?></td>
    <td align="center" nowrap="nowrap"><?=$num_cantidad?></td>
    <td align="right" nowrap="nowrap"><?=$sis_genericos->formato_numero($val_precio_unitario);?></td>
    <td align="right" nowrap="nowrap"><?=$sis_genericos->formato_numero($val_total);?></td>
    

  </tr>
  
  <? } ?>
  
   <tr>
    <td align="right" colspan="3" nowrap="nowrap" ><strong>SUMATORIA:</strong></td>
    <td align="right" nowrap="nowrap"><?=$sis_genericos->formato_numero($val_sumatoria);?></td>
  </tr>
</table>

<div style="display: block; text-align: right; margin: 10px 0px;">	

	<input type="button"  
        		class="pure-button"  
                value="Anular" 
                name="enter_anular" 
                id="enter_anular" 
                style="background-color:orange"
                
            />


</div>


<script>
	$(function(){
		$('#enter_anular').on('click',function(e){			
			e.preventDefault();

			navegar_ajax(1086,$(this));

		})
	})

</script>