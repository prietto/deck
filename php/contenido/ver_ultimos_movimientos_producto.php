<style>
#reporte_pago_empleado{
	 border-collapse: collapse;
}
</style>

<h2>A continuacion se listan los ultimos <?=$num_limit?> movimientos del producto</h2>
<h2>Producto: <strong><?=$row_producto['txt_nombre']?></strong></h2>


<table width="100%" id="reporte_pago_empleado" border="1" style="border:1px solid grey;" class="tabla_reporte" cellpadding="5" cellspacing="5" >
  <tr class="titulo_tabla">
    <td>CONCEPTO</td>
    <td>CANTIDAD</td>
    <td>FEC REGISTRO</td>
    <td>ESTADO</td>
    <td>ID CONCEPTO</td>
    

  </tr>
  
  <? 
  	$num_registros = $db->num_registros($cursor_producto);
    if($num_registros==0){
  ?>
      <tr>
        <td align="center" colspan="5" nowrap="nowrap">El producto aun no registra movimientos</td>
      </tr>
    
   <? 
 }
  	while($row=$db->sacar_registro($cursor_producto)){

  		$txt_concepto 			   = $row['txt_concepto'];
  		$num_cantidad			     = $row['num_cantidad'];
  		$fec_registro       	 = $row['fec_registro'];
  		$txt_estado				     = $row['txt_estado'];
      $id_concepto           = $row['id_concepto'];
  		
      
  ?>
  
  <tr>
    <td align="center" nowrap="nowrap"><?=$txt_concepto?></td>
    <td align="center" nowrap="nowrap"><?=$num_cantidad?></td>
    <td align="right" nowrap="nowrap"><?=$sis_genericos->f_fecha_con_hora_no_semana($fec_registro);?></td>
    <td align="right" nowrap="nowrap"><?=$txt_estado?></td>
    <td align="right" nowrap="nowrap"><?=$id_concepto?></td>
    

  </tr>
  
  <? } ?>
  
</table>

<? 
exit;
?>