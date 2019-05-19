<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FACTURAS - SCISTEM </title>
<link href="../../estilos/estilo_impresion.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo1 {color: #000000}
-->
</style>
<link href="../../estilos/estilos_calendario.css" rel="stylesheet" type="text/css" />

<script src="../../js/formato_fecha.js"></script>
<script src="../../js/dhtml_calendario.js" ></script>

<style>
body{
text-align:center;
margin:0 auto;
}

 div.saltopagina{ 
      display:block; 
      page-break-before:always;
   }
</style>

</head>

<body>
<form id="form1" name="form1" method="post" action="">

 <?php 
	 $ind_encabezado 		= true;
	 $ind_pie_pagina		= true;
	 $px_en_cm				= 0.026458333; // la euivalencia de 1 pixel a centimetros
	 $ancho_factura			= round((14 * 1) / $px_en_cm);
	 $ancho_tabla_detalle	= round((12 * 1) / $px_en_cm);;
	 
	 	$cod_factura_anterior 	= ''; 
		$pos_ciclo 				= 0; 
		$sumatoria_factura 		= 0; 
		$sumatoria_copago 		= 0;
		$sum_iva				= 0;
		$sum_val_compartido		= 0;
	 
	 $num_registros 	= $db->num_registros($cursor_datos);

	 	while($row=$db->sacar_registro($cursor_datos)){
			// ==== INFORMACION DEL DETALLE DE CADA FACTURA Y VALORES====
			$cod_factura 		= $row['cod_factura'];
			$cod_cliente		= $row['cod_cliente'];
			$val_iva_porc		= $row['val_iva_porc'];
			$fec_regsitro_fact 	= $row['fec_registro'];
			$val_total_fact		= $row['val_total'];
			
			// separa la fecha de registro
			$arr_fec_registro		= $sis_genericos->f_separa_fecha($fec_regsitro_fact);
			$year_fec_registro		= $arr_fec_registro[0];
			$mes_fec_registro		= $arr_fec_registro[1];
			$dia_fec_registro		= $arr_fec_registro[2];
			
 
			//===  informacion de la entidad
			$txt_cliente					= $row['txt_cliente'];
			$num_identificacion_cliente		= $row['num_identificacion_cliente'];
			$txt_tel_cliente				= $row['txt_telefono_cliente'];
			$txt_direccion_cliente			= $row['txt_direccion_cliente'];
			
			// calcula la fecha de vencimiento
			/*$fecha2=date("Y-m-j",strtotime($fec_regsitro_fact));
			$fec_vencimiento 	= strtotime ( '+'.$num_plazo_pago.' day' , strtotime ( $fecha2 ) ) ;
			$fec_vencimiento	= date ( 'Y-m-j' , $fec_vencimiento);
			$fec_vencimiento    = $sis_genericos->f_separa_fecha($fec_vencimiento);
			$year_fec_venc		= $fec_vencimiento[0];
			$mes_fec_venc		= $fec_vencimiento[1];
			$dia_fec_venc		= $fec_vencimiento[2];*/
			
			
			
			$pos_ciclo++;
				
	 
			if ($cod_factura != $cod_factura_anterior){ 
			$cod_factura_anterior = $cod_factura; 
			if($pos_ciclo>1){ ?>
			<!--<tr>
            
            
              <td colspan="2" rowspan="3" align="left" valign="top" class="combo_solicitud">OBSERVACIONES: </td>
              <td align="right" class="combo_solicitud">SUB TOTAL:</td>
              <td width="14%" align="right" class="combo"><?//=$val_total_atencion?></td>
            </tr>
            
            <tr>
              <td align="right" class="titulo_ventana_emergente">TOTAL :</td>
              <td align="right" class="titulo_ventana_emergente"><?//=$sumatoria_factura?></td>
            </tr>	-->
				
			<?php	}	?>
<table border="1" align="left" cellpadding="0" cellspacing="0" class="contenido_tabla"  style="width:<?=$ancho_factura?>px;">
    <tr style="">
    <td width="163" height="69" rowspan="4" align="center">
	  <img src="../../imagenes/sistema/logo_potato.png" width="80" /></td>
    <td width="347" align="center" class="titulo_ventana_emergente">JENNY BRAVO BOLA&Ntilde;OS</td>
    </tr>
    <tr>
      <td align="center"><span class="combo_solicitud">C.C. 1.144.141.006 R&Eacute;GIMEN SIMPLIFICADO</span></td>
    </tr>
    <tr>
      <td align="center"><span class="combo_solicitud">Venta de toda clase de papa por mayor y detal</span></td>
    </tr>
    <tr>
      <td height="18" align="center"><span class="combo_solicitud">CAVASA Bodega 8 local 19 y 20</span></td>
    </tr>
    <tr>
      <td height="22" colspan="2">
      	<table width="100%" border="0">
        <tr>
          <td width="44%" height="18" align="left">Fecha &nbsp; <?=$fec_regsitro_fact?></td>
          <td width="56%" align="left">Factura de venta &nbsp; <?=$cod_factura?></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="16" colspan="2" align="left">Se&ntilde;ores(es) &nbsp; <?=$txt_cliente?></td>
    </tr>
    <tr>
      <td height="22" colspan="2"><table width="100%" border="0">
        <tr>
          <td width="44%" align="left">Direcci&oacute;n &nbsp; <?=$txt_direccion_cliente?></td>
          <td width="56%" align="left">Debe $</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="138" colspan="2">
      
      <table width="90%"  border="1" align="center">
        <thead>
        <tr>
          <td align="center" bgcolor="#CCCCCC"   style="width:1.5cm;"><strong>CANT.</strong></td>
          <td align="center" bgcolor="#CCCCCC"  style="width:5.5cm;"><strong>DETALLE</strong></td>
          <td align="center" bgcolor="#CCCCCC" style="width:2.2cm;"><strong>V. UNIT.</strong></td>
          <td align="center" bgcolor="#CCCCCC" style="width:2.6cm;"><strong>TOTAL</strong></td>
        </tr>
        </thead>
        <tbody>
        
        
        
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        </tbody>
      </table>
      
      
      </td>
    </tr>
    <tr>
      <td height="16" colspan="2" align="right"><table width="100%" border="0">
        <tr>
          <td width="76%" align="right">VALOR TOTAL $</td>
          <td width="24%">_______________</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="49" colspan="2"><table width="100%" border="0">
        <tr>
          <td width="50%" rowspan="3" align="left">NOTA: Esta factura de venta se asimila en todos sus efectos legales a una letra de cambio segun el Art. 774 del c&oacute;digo de comercio</td>
          <td height="15%"  align="center">RECIBIDO Y ACEPTADO</td>
        </tr>
        <tr>
          <td height="50px" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td height="15%" align="center">FIRMA Y SELLO</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td  colspan="2">&nbsp;</td>
    </tr>
  </table>
 <?php 
				
				if($pos_ciclo<$num_registros){
			   	
					echo "<div class='saltopagina'></div> "; 
				}
		
		  } 
	  } ?>
<input type="hidden" name="cod_orden" value="<?=$cod_orden?>">
	<input type="hidden" name="cod_usuario" value="<?=$cod_usuario?>">
  <input type="hidden" name="cod_navegacion">
</form>

<script>
//window.print();
</script>

<script>
function navegar(cod_navegacion){
		document.form1.cod_navegacion.value=cod_navegacion;
		document.form1.action="../principal/controlador.php";
		document.form1.submit();
	}	
</script>

</body>
</html>
