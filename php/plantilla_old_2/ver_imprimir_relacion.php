<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Salud Fisica Integral - Factura </title>
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
 div.saltopagina{ 
      display:block; 
      page-break-before:always;
   }
</style>

</head>

<body>
<form id="form1" name="form1" method="post" action="">

  <p>
<table width="820" align="center" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000">
<?php 
$ind_encabezado 	= true;
$ind_pie_pagina	= false;
$cod_factura_anterior 	= ''; 
$cod_tipo_atencion_anterior = '';
$pos_ciclo 				= 0; 
$sumatoria_factura 		= 0; 
$sumatoria_subtotal		= 0; 
$sumatoria_copago 		= 0;
$sum_iva				= 0;
$sum_val_compartido		= 0;
$num_registros 	= $db->num_registros($cursor_datos);
while($row=$db->sacar_registro($cursor_datos)){
	// ==== INFORMACION DEL DETALLE DE CADA FACTURA Y VALORES====
	$cod_factura 		= $row['numero_factura'];
	$txt_identificacion = $row['identificacion'];
	$nom_paciente		= $row['nombre'];
	$autorizacion		= $row['autorizacion'];
	$cant_servicios		= $row['cant'];
	$val_uni_atencion	= $row['vr_unit'];
	$val_copago			= $row['copago'];
	$val_total			= $row['total'];
	$txt_servicio		= $row['servicio'];
	$cod_tipo_atencion	= $row['cod_tipo_atencion'];
	$fec_expedicion		= $row['fec_expedicion'];
	$fec_expedicion		= $sis_genericos->f_nombre_fecha($fec_expedicion);
	
	
	// informacion de la factura
	$row_factura 			= $factura->f_get_row($cod_factura);
	$fec_regsitro_fact 		= $row_factura['fec_registro'];
	
	//===  informacion de la entidad QUITARLO <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	$row_entidad = $entidad->f_get_row($row_factura['cod_entidad']);
	$txt_entidad= $row_entidad['txt_nombre'];	
	$txt_entidad= $sis_genericos->f_formato_texto($txt_entidad,'mayuscula');
	$pos_ciclo++;
		
	if ($cod_factura != $cod_factura_anterior){ 
		if($pos_ciclo>1){ 
			$ind_pie_pagina 		= true;
			$pie_subtotal	 		= $sumatoria_subtotal;
			$pie_cod_factura		= $cod_factura_anterior; 
			$pie_fecha_factura		= $fec_expedicion_anterior; 
			$pie_total				= $sumatoria_factura_total;
			$pie_copago				= $sumatoria_copago;	
	   		$sumatoria_factura 		= 0 ;
			$sumatoria_copago 		= 0;
			$sum_iva				= 0;
			$sum_val_compartido		= 0;
			$sumatoria_subtotal		= 0;
			
		}
		$cod_factura_anterior 			= $cod_factura; 
		$fec_expedicion_anterior		= $fec_expedicion;
		$ind_encabezado					= true;
	}
	$sumatoria_copago			= $sumatoria_copago+$val_copago;
	$sumatoria_subtotal			= $sumatoria_subtotal+$val_total;
	$sumatoria_factura_total	= $sumatoria_subtotal - $sumatoria_copago;

	if($ind_pie_pagina) {
?>
      <tr >
        <td align="right" class="combo_solicitud Estilo1" colspan="7">&nbsp;</td>
      </tr>
      <tr >
        <td width="27%" align="right" class="combo_solicitud Estilo1" colspan="2">NUMERO FACTURA</td>
        <td width="16%" align="right" class="combo_solicitud Estilo1" ><?php echo $pie_cod_factura;?></td>
        <td width="26%" colspan="3" align="right" class="combo_solicitud Estilo1">SUB TOTAL:</td>
        <td width="17%" align="right" class="combo_solicitud Estilo1"><?=$pie_subtotal?></td>
      </tr>
      <tr>
        <td  align="right" class="combo_solicitud Estilo1" colspan="2">FECHA EXPEDICION</td>
        <td  align="right" class="combo_solicitud Estilo1"><?=$pie_fecha_factura?></td>
        <td colspan="3" align="right" class="combo_solicitud Estilo1">TOTAL COPAGO:</td>
        <td align="right" class="combo_solicitud Estilo1"><?=$pie_copago?></td>
      </tr>
      <tr>
        <td colspan="6"  align="right" class="titulo_ventana_emergente">TOTAL :</td>
        <td align="right" class="titulo_ventana_emergente"><?=$pie_total?></td>
      </tr>
<?php  
	$ind_pie_pagina = false;
	echo "</table>
	<table width='820' align='center' border='1' cellpadding='3' cellspacing='0' bordercolor='#000000'>
	<br><br><br><div class='saltopagina'></div> "; 
	
	}
	if($ind_encabezado){
 ?>
  <tr>
    <td height="80" align="center" class="combo_solicitud" colspan="7">
    <br />RELACION DE PACIENTES DE <?=$txt_entidad?> ATENDIDOS POR EL SERVICIO DE <?=$txt_servicio?> DE INVERSIONES GARCIA MU&Ntilde;OZ - SALUD FISICA INTEGRAL -
    </td>
   </tr>
    <tr>
      <td width="27%" height="25" align="center" class="combo_solicitud Estilo1">IDENTIFICACI&Oacute;N</td>
              <td width="80%" align="center" class="combo_solicitud Estilo1">NOMBRE</td>
              <td width="16%" align="center" class="combo_solicitud Estilo1">AUTORIZACI&Oacute;N</td>
              <td width="2%" align="center" nowrap="nowrap" class="combo_solicitud Estilo1">CANT.</td>
              <td width="9%" align="center" nowrap="nowrap" class="combo_solicitud Estilo1">VR. UNIT.</td>
              <td width="9%" align="center" nowrap="nowrap" class="combo_solicitud Estilo1">COPAGO</td>
              <td width="17%" align="center" class="combo_solicitud Estilo1">TOTAL</td>
    </tr>
<?php 
$ind_encabezado=false;
} // === HASTA AQUI EL ENCABEZADO   ---- INICIA DETALLE  
 ?>
            <tr>
              <td width="27%" align="center" class="combo_solicitud Estilo1"><?php echo $txt_identificacion; ?></td>
              <td width="27%" align="left" class="combo_solicitud Estilo1"><?php echo $nom_paciente; ?></td>
              <td width="16%" align="right" class="combo_solicitud Estilo1"><?php echo $autorizacion; ?></td>
              <td align="right" class="combo_solicitud Estilo1"><?php echo $cant_servicios; ?></td>
              <td align="right" class="combo_solicitud Estilo1"><?php echo $val_uni_atencion; ?></td>
              <td align="right" class="combo_solicitud Estilo1"><?php echo $val_copago; ?></td>
              <td align="right" class="combo_solicitud Estilo1"><?php echo $val_total; ?></td>
            </tr>
<?php 
} 
?>
<?php if(1==2){ ?>
</table>
<table width="820" align="center" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000">
<? } ?>
      <tr >
        <td align="right" class="combo_solicitud Estilo1" colspan="7">&nbsp;</td>
      </tr>
      <tr >
        <td width="27%" align="right" class="combo_solicitud Estilo1" colspan="2">NUMERO FACTURA</td>
        <td width="16%" align="right" class="combo_solicitud Estilo1" ><?php echo $cod_factura;?></td>
        <td width="26%" colspan="3" align="right" class="combo_solicitud Estilo1">SUB TOTAL:</td>
        <td width="17%" align="right" class="combo_solicitud Estilo1"><?=$sumatoria_subtotal?></td>
      </tr>
      <tr>
        <td  align="right" class="combo_solicitud Estilo1" colspan="2">FECHA EXPEDICION</td>
        <td  align="right" class="combo_solicitud Estilo1"><?=$fec_expedicion?></td>
        <td colspan="3" align="right" class="combo_solicitud Estilo1">TOTAL COPAGO:</td>
        <td align="right" class="combo_solicitud Estilo1"><?=$sumatoria_copago?></td>
      </tr>
      <tr>
        <td colspan="6"  align="right" class="titulo_ventana_emergente">TOTAL :</td>
        <td align="right" class="titulo_ventana_emergente"><?=$sumatoria_factura_total?></td>
      </tr>
</table>


<input type="hidden" name="cod_orden" value="<?=$cod_orden?>">
	<input type="hidden" name="cod_usuario" value="<?=$cod_usuario?>">
  <input type="hidden" name="cod_navegacion">
</form>

<script>
window.print();
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
