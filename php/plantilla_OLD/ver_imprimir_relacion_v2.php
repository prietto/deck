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

 <?php 
	 $ind_encabezado 	= true;
	 $ind_pie_pagina	= true;
	 
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
			
			//===  informacion de la entidad
			$row_entidad 			= $entidad->f_get_row($row_factura['cod_entidad']);
			$txt_entidad			= $row_entidad['txt_nombre'];	
			$txt_entidad			= $sis_genericos->f_formato_texto($txt_entidad,'mayuscula');
			
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
				
			<?php	}?>
			
	
	 
	 

<table width="820" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="138" align="center" class="combo_solicitud">
    RELACION DE PACIENTES DE <?=$txt_entidad?> ATENDIDOS POR EL SERVICIO DE <?=$txt_servicio?> DE INVERSIONES GARCIA MU&Ntilde;OZ - SALUD FISICA INTEGRAL -
      
      <table width="100%" border="0" cellspacing="10" cellpadding="0">
        <tr>
          <td align="center"><table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000">
            <tr>
              <td width="14%" height="25" align="center" class="combo_solicitud Estilo1">IDENTIFICACI&Oacute;N</td>
              <td width="30%" align="center" class="combo_solicitud Estilo1">NOMBRE</td>
              <td width="13%" align="center" class="combo_solicitud Estilo1">AUTORIZACI&Oacute;N</td>
              <td width="8%" align="center" nowrap="nowrap" class="combo_solicitud Estilo1">CANT.</td>
              <td width="9%" align="center" nowrap="nowrap" class="combo_solicitud Estilo1">VR. UNIT.</td>
              <td width="9%" align="center" nowrap="nowrap" class="combo_solicitud Estilo1">COPAGO</td>
              <td align="center" class="combo_solicitud Estilo1">TOTAL</td>
              </tr>
       <?php 
	   		$sumatoria_factura 		= 0 ;
			$sumatoria_copago 		= 0;
			$sum_iva				= 0;
			$sum_val_compartido		= 0;
			$sumatoria_subtotal		= 0;
	   
	   } // === HASTA AQUI EL ENCABEZADO    
	   
	   		//$sumatoria_factura 			= $sumatoria_factura+$val_total_atencion;
			$sumatoria_copago			= $sumatoria_copago+$val_copago;
			$sumatoria_subtotal			= $sumatoria_subtotal+$val_total;
			$sumatoria_factura_total	= $sumatoria_subtotal - $sumatoria_copago;
			
			//$sum_iva					= $sum_iva+$val_iva;
			//$sum_val_compartido			= $sum_val_compartido+$val_compartido;
			
			
			//$sumatoria_factura_total	= $sis_genericos->formato_numero($sumatoria_factura_total);
			
			//$sumatoria_factura			= $sis_genericos->formato_numero($sumatoria_factura);
			//$val_unitario 				= $val_total_atencion / $num_cantidad;
	   ?>
            <tr>
           
              <td width="14%" align="center" class="combo_solicitud Estilo1"><?php echo $txt_identificacion; ?></td>
              <td width="30%" align="left" class="combo_solicitud Estilo1"><?php echo $nom_paciente; ?></td>
              <td width="13%" align="right" class="combo_solicitud Estilo1"><?php echo $autorizacion; ?></td>
              <td align="right" class="combo_solicitud Estilo1"><?php echo $cant_servicios; ?></td>
              <td align="right" class="combo_solicitud Estilo1"><?php echo $val_uni_atencion; ?></td>
              <td align="right" class="combo_solicitud Estilo1"><?php echo $val_copago; ?></td>
              <td align="right" class="combo_solicitud Estilo1"><?php echo $val_total; ?></td>
            
              </tr>
            
             <?php
//			if($contador!=$num_registros){
	
			
			if($cod_tipo_atencion!=$cod_tipo_atencion_anterior){
				$cod_tipo_atencion_anterior = $cod_tipo_atencion;
				
				$ind_encabezado=true;
?>
            
             <tr>
               <td  rowspan="7" align="left" valign="top" class="combo_solicitud">&nbsp;</td>
               <td   align="left" valign="top" class="combo_solicitud Estilo1">&nbsp;</td>
               
               
               
               <td colspan="4" align="right" class="combo_solicitud Estilo1">&nbsp;</td>
               <td align="right" class="combo_solicitud Estilo1">&nbsp;</td>
             </tr>
             <tr>
               <td align="right" class="combo_solicitud Estilo1">&nbsp;</td>
               <td colspan="4" align="right" class="combo_solicitud Estilo1">&nbsp;</td>
               <td align="right" class="combo_solicitud Estilo1">&nbsp;</td>
             </tr>
             <tr>
            	               <td align="right" class="combo_solicitud Estilo1">NUMERO FACTURA</td>
              <td align="right" class="combo_solicitud Estilo1"><?php echo $cod_factura;?></td>
              <td colspan="3" align="right" class="combo_solicitud Estilo1">SUB TOTAL:</td>
              <td width="17%" align="right" class="combo_solicitud Estilo1"><?=$sumatoria_subtotal?></td>
            </tr>
            
          
            
           
            
            
            <tr>
                  <td  align="right" class="combo_solicitud Estilo1">FECHA EXPEDICION</td>
                <td  align="right" class="combo_solicitud Estilo1"><?=$fec_expedicion?></td>
                
                <td colspan="3" align="right" class="combo_solicitud Estilo1">TOTAL COPAGO:</td>
                <td align="right" class="combo_solicitud Estilo1"><?=$sumatoria_copago?></td>
            </tr>
            <tr>
             <td  align="right" class="combo_solicitud Estilo1">&nbsp;</td>
                            <td  align="right" class="combo_solicitud Estilo1">&nbsp;</td>
              <td colspan="3" align="right" class="titulo_ventana_emergente">TOTAL :</td>
              <td align="right" class="titulo_ventana_emergente"><?=$sumatoria_factura_total?></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center" class="texto_informativo">&nbsp;</td>
        </tr>
     
        
    </table>    </td>
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
