<? require('../proceso/fix_pagos_factura.php'); ?>


<div id="respuesta_servidor">
	<? //echo "<pre>";print_r($array_factura);echo "</pre>"; ?>
    <table width="100%" border="1" cellspacing="0" align="center" cellspadding="0" style="background:white;">
      <tr>
        <td>Factura</td>
        <td>Valor registrado como pagado</td>
        <td>Valor registrado como recibido</td>
        <td>Valor Total del pedido</td>
      </tr>
      
      
  <? for($i=0;$i<count($array_factura);$i++){  
      $cod_factura    = $array_factura[$i]['cod_factura'];
      $val_pagado     = $array_factura[$i]['val_pagado'];
      $val_recibido   = $array_factura[$i]['val_recibido'];
      $val_total     = $array_factura[$i]['val_total'];

      if(!$val_pagado)$val_pagado=0;
  ?>
      <tr>
        <td><?=$cod_factura?></td>
        <td><?=$sis_genericos->formato_numero($val_pagado);?></td>
        <td><?=$sis_genericos->formato_numero($val_recibido);?></td>
        <td><?=$sis_genericos->formato_numero($val_total);?></td>
      </tr>
      
  <? } ?>
      
    </table>
</div>