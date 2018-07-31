<style>
#reporte_pago_empleado{
	 border-collapse: collapse;
}
</style>

<h2>A continuacion se listan los 10 ultimos pagos realizados para el empleado</h2>

<table width="100%" id="reporte_pago_empleado" border="1" style="border:1px solid grey;" class="tabla_reporte" cellpadding="5" cellspacing="5" >
  <tr class="titulo_tabla">
    <td>NO. RECIBO</td>
    <td>FECHA</td>
    <td>VALOR TOTAL</td>
    <td>USUARIO</td>
    <td>&nbsp;</td>

  </tr>
  
  <? 
  	$val_sumatoria = NULL;
  	while($row=$db->sacar_registro($cursor_historial)){
  		$fec_registro 	   = $sis_genericos->f_nombre_fecha_con_hora($row['fec_registro']);
		  $val_pago		       = $row['val_total'];
		  $txt_usuario	     = $row['txt_usuario'];
      $cod_empleado_pago = $row['cod_empleado_pago'];
		
		  $val_sumatoria      = $val_sumatoria + $val_pago;
      
  ?>
  
  <tr>
    <td align="center" nowrap="nowrap"><?=$cod_empleado_pago?></td>
    <td align="left" nowrap="nowrap"><?=$fec_registro?></td>
    <td align="right" nowrap="nowrap"><?=$sis_genericos->formato_numero($val_pago);?></td>
    <td align="center" nowrap="nowrap"><?=$txt_usuario?></td>
    <td align="center" nowrap="nowrap">
      <a href="javascript:void(0);" class="ver_detalle_pago_empleado" data-pk='<?=$cod_empleado_pago?>'><img src="../../imagenes/sistema/ver_detalle.png"  title="Ver detalle" /></a>
      <a href="javascript:void(0);" class="print_recibo_pago" data-pk='<?=$cod_empleado_pago?>'><img src="../../imagenes/sistema/imprimir.png"  title="Imprimir Recibo" /></a>
    </td>

  </tr>
  
  <? } ?>
  
   <tr>
    <td align="center" nowrap="nowrap">&nbsp;</td>
    <td align="right" nowrap="nowrap" ><strong>SUMATORIA:</strong></td>
    <td align="right" nowrap="nowrap"><?=$sis_genericos->formato_numero($val_sumatoria);?></td>
    <td align="center" nowrap="nowrap">&nbsp;</td>
    <td align="center" nowrap="nowrap">&nbsp;</td>
    

  </tr>
</table>