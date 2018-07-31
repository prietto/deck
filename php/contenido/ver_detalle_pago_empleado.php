<style>
#reporte_pago_empleado{
	 border-collapse: collapse;
}
</style>

<h2>A continuacion se lista el detalle del pago seleccionado con anterioridad</h2>

<table width="100%" id="reporte_pago_empleado" border="1" style="border:1px solid grey;" class="tabla_reporte" cellpadding="5" cellspacing="5" >
	<tr>
		<td>No. Recibo: <?=$cod_empleado_pago;?></td>
		<td>Fec Registro: <?=$fec_registro?></td>
		<td>Usuario: <?=$row_empleado_pago['txt_usuario'];?></td>


	</tr>
</table>

<table width="100%" id="reporte_pago_empleado" border="1" style="border:1px solid grey;" class="tabla_reporte" cellpadding="5" cellspacing="5" >
  <tr class="titulo_tabla">
    <td>CONCEPTO</td>
    <td>VALOR</td>
  </tr>
  
  <? 
  	$val_sumatoria = NULL;
  	while($row=$db->sacar_registro($cursor_detalle_pago)){
  		$val_pago			= $row['num_valor'];
  		$txt_concepto		= $row['txt_concepto'];
		$cod_empleado_pago 	= $row['cod_empleado_pago'];

      	$val_sumatoria      = $val_sumatoria + $val_pago;
      
  ?>
  
  <tr>
    <td align="left" nowrap="nowrap"><?=$txt_concepto?></td>
    <td align="right" nowrap="nowrap"><?=$sis_genericos->formato_numero($val_pago);?></td>
    

  </tr>
  
  <? } ?>
  
   <tr>
    <td align="right" nowrap="nowrap" ><strong>SUMATORIA:</strong></td>
    <td align="right" nowrap="nowrap"><?=$sis_genericos->formato_numero($val_sumatoria);?></td>
    

  </tr>
</table>