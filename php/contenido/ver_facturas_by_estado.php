<table width="100%" border="0" cellpadding="5">
 
 <tr>
    <td colspan="3" style="color:red; font-weight:bold;" class="contenido">El cliente registra facturas vencidas</td>
  </tr>
 
  <tr class="titulo_tabla">
    <td>FACTURA</td>
    <td>FECHA</td>
    <td>SALDO</td>
  </tr>
 


<? 
while($row=$db->sacar_registro($cursor_factura)){
	
	$cod_factura 	= $row['cod_factura'];
	$fec_registro 	= $row['fec_registro'];
	$val_saldo		= $sis_genericos->formato_numero($row['val_saldo']);
	


?>


 <tr>
    <td ><?=$cod_factura?></td>
    <td><?=$fec_registro?></td>
    <td><?=$val_saldo?></td>
  </tr>
 
 <? } ?>
</table>
