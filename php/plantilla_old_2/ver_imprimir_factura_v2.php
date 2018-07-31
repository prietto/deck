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
		$pos_ciclo 				= 0; 
		$sumatoria_factura 		= 0; 
		$sumatoria_copago 		= 0;
		$sum_iva				= 0;
		$sum_val_compartido		= 0;
	 
	 $num_registros 	= $db->num_registros($cursor_datos);

	 	while($row=$db->sacar_registro($cursor_datos)){
						
			
			// ==== INFORMACION DEL DETALLE DE CADA FACTURA Y VALORES====
			$cod_factura 		= $row['cod_factura'];

			$num_cantidad		= $row['cantidad'];
			$txt_tipo_atencion	= $row['txt_tipo_atencion'];
			$val_total_atencion = $row['val_atencion'];
			$val_copago			= $row['val_copago'];
			$val_compartido		= $row['val_compartido'];
			$val_descuento		= $row['val_descuento'];
			$val_iva			= $row['val_iva'];
			$cod_entidad		= $row['cod_entidad'];
			
			$fec_regsitro_fact 		= $row['fec_registro'];
			
			// separa la fecha de registro
			$arr_fec_registro		= $sis_genericos->f_separa_fecha($fec_regsitro_fact);
			$year_fec_registro		= $arr_fec_registro[0];
			$mes_fec_registro		= $arr_fec_registro[1];
			$dia_fec_registro		= $arr_fec_registro[2];
			
 
			//===  informacion de la entidad
			$row_entidad 			= $entidad->f_get_row($cod_entidad);

			$txt_entidad			= $row_entidad['txt_nombre'];	
			$nit_entidad			= $row_entidad['txt_nit'];	
			$txt_direccion_entidad	= $row_entidad['txt_direccion'];	
			$txt_tel_entidad		= $row_entidad['txt_telefono'];
			$txt_email_entidad		= $row_entidad['txt_email'];
			$num_plazo_pago			= $row_entidad['num_plazo_pago'];
			
			// calcula la fecha de vencimiento
			$fecha2=date("Y-m-j",strtotime($fec_regsitro_fact));
			$fec_vencimiento 	= strtotime ( '+'.$num_plazo_pago.' day' , strtotime ( $fecha2 ) ) ;
			$fec_vencimiento	= date ( 'Y-m-j' , $fec_vencimiento);
			$fec_vencimiento    = $sis_genericos->f_separa_fecha($fec_vencimiento);
			$year_fec_venc		= $fec_vencimiento[0];
			$mes_fec_venc		= $fec_vencimiento[1];
			$dia_fec_venc		= $fec_vencimiento[2];
			
			
			
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
			
	
	 
	 

<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="138"><table width="100%" border="0" cellspacing="0" cellpadding="0">
     
    

     
      <tr>
            <td width="30%" align="center" class="titulo_tabla">
            <p><img src="../../imagenes/sistema/logo2.jpg" width="146" height="105" /></p>
            <p>INVERSIONES GARCIA MU&Ntilde;OZ IGM SAS<br /> 
              Nit: &nbsp;
            <?=$nit_prestadora?>-2</p></td>
            <td width="34%" align="center" nowrap="nowrap"><span class="contenido_tabla"><?=$txt_direccion_prestadora?><br />
              Cel. <?=$txt_celular_prestadora?> / Tel: <?=$txt_telefono_prestadora?><br />
             <?=$txt_email_prestadora?><br />
              Resolucion. DIAN <?=$num_resolucion?><br />
              Fecha: <?=$fec_resolucion?><br />
              Habilita desde el No. <?=$num_rango_inicial?> hasta el No. <?=$num_rango_final?><br />
            </span></td>
            <td width="36%" valign="middle">
            
            <table width="100%" border="0" cellspacing="2" cellpadding="0">
              <tr>
                <td width="51%" align="center" class="titulo_tabla2">Fecha Factura</td>
                <td align="center" class="titulo_tabla2">Fecha Vencimiento</td>
              </tr>
              <tr>
                <td>
                  
                  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000"  >
                    <tr>
                      <td width="33%" align="center" nowrap="nowrap" class="titulo_tabla"> 
                      	<span class="texto_informativo">DIA</span><BR /><?=$dia_fec_registro?></td>
                      <td width="33%" align="center" nowrap="nowrap" class="titulo_tabla">
                      	<span class="texto_informativo">MES</span><BR /><?=$mes_fec_registro?></td>
                      <td width="33%" align="center" nowrap="nowrap" class="titulo_tabla">
                      	<span class="texto_informativo">A&Ntilde;O</span><BR />  
                      	<?=$year_fec_registro?></td>
                      </tr>
                  </table></td>
                <td width="49%"><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
                  <tr>
                    <td align="center" nowrap="nowrap" class="titulo_tabla"><span class="texto_informativo">DIA</span><br />
                      <?=$dia_fec_venc?></td>
                    <td align="center" nowrap="nowrap" class="titulo_tabla"><span class="texto_informativo">MES</span><br />
                      <?=$mes_fec_venc?></td>
                    <td align="center" nowrap="nowrap" class="titulo_tabla"><span class="texto_informativo">A&Ntilde;O</span><br />
                      <?=$year_fec_venc?></td>
                  </tr>
                  </table></td>
              </tr>
              
            </table>
              <table width="100%" border="0" cellspacing="5" cellpadding="0">
                <tr>
                  <td align="center" class="titulo_tabla2">CONDICIONES DE PAGO</td>
                  <td align="center" class="titulo_tabla2">Factura de Venta</td>
                </tr>
                <tr>
                  <td width="48%"><table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#000000">
                    <tr>
                      <td align="center" nowrap="nowrap" class="titulo_ventana_emergente">&nbsp; <?php echo "$num_plazo_pago dias"; ?></td>
                    </tr>
                  </table></td>
                  <td width="52%"><table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#000000">
                    <tr>
                      <td align="center" nowrap="nowrap" class="titulo_ventana_emergente">Nro.
                        <?=$cod_factura?></td>
                    </tr>
                  </table></td>
                </tr>
              </table>
            <p>&nbsp;</p></td>
      	</tr>
    
      
    </table>
      <table width="100%" border="0" cellspacing="10" cellpadding="0">
        <tr>
          <td valign="top"><table width="100%" border="1" cellpadding="6" cellspacing="0" bordercolor="#000000">
            <tr>
              <td class="combo"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><strong>SE&Ntilde;OR(ES):</strong> <?=$txt_entidad?></td>
                  
                </tr>
              </table>                </td>
            </tr>
            <tr>
              <td class="combo"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="55%"><strong>CC/NIT:</strong>
                        <?=$nit_entidad?></td>
                      <td width="45%" align="left"><strong>TELEFONO :</strong></td>
                    </tr>
                  </table></td>
                 
                </tr>
              
              </table>
                <?=$txt_telefono_entidad?></td>
            </tr>
            <tr>
              <td class="combo"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                 <tr>
                  <td width="56%"><strong>DIRECCION: </strong><?=$txt_direccion_entidad?> </td>
                  <td width="44%" align="left"><strong>EMAIL:</strong><?=$txt_email_entidad?></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
          
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="10" cellpadding="0">
        <tr>
          <td align="center"><table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000">
            <tr>
              <td width="10%" align="center" class="combo_solicitud Estilo1">CANTIDAD</td>
              <td width="56%" align="center" class="combo_solicitud Estilo1">DESCRIPCION</td>
              <td width="20%" align="center" class="combo_solicitud Estilo1">VR. UNITARIO</td>
              <td align="center" class="combo_solicitud Estilo1">VR. TOTAL</td>
              </tr>
       <?php 
	   		$sumatoria_factura 		= 0 ;
			$sumatoria_copago 		= 0;
			$sum_iva				= 0;
			$sum_val_compartido		= 0;
	   
	   } // === HASTA AQUI EL ENCABEZADO    
	   
	   		$sumatoria_factura 			= $sumatoria_factura+$val_total_atencion;
			$sumatoria_copago			= $sumatoria_copago+$val_copago;
			$sum_iva					= $sum_iva+$val_iva;
			$sum_val_compartido			= $sum_val_compartido+$val_compartido;
			
			$sumatoria_factura_total	= (($sumatoria_factura - $sumatoria_copago) - $sum_val_compartido)+ $sum_iva;
			$sumatoria_factura_total	= $sis_genericos->formato_numero($sumatoria_factura_total);
			
			$sumatoria_factura			= $sis_genericos->formato_numero($sumatoria_factura);
			$val_unitario 				= $val_total_atencion / $num_cantidad;
	   ?>
            <tr>
              <td width="10%" align="center" class="combo_solicitud Estilo1"><?php echo $num_cantidad; ?></td>
              <td width="56%" align="left" class="menu_navegacion_paginas"><strong><?php echo $txt_tipo_atencion; ?></strong></td>
              <td width="20%" align="right" class="combo_solicitud Estilo1"><?php echo $val_unitario=$sis_genericos->formato_numero($val_unitario); ?></td>
              <td align="right" class="combo_solicitud Estilo1"><?php echo $val_total_atencion=$sis_genericos->formato_numero($val_total_atencion); ?></td>
            
              </tr>
            
             <?php
			if($contador!=$num_registros){
				$ind_encabezado=true;
?>
            
            <tr>
            
            
              <td colspan="2" rowspan="5" align="left" valign="top" class="combo_solicitud">OBSERVACIONES: </td>
              <td align="right" class="combo_solicitud Estilo1">SUB TOTAL:</td>
              <td width="14%" align="right" class="combo_solicitud Estilo1"><?=$val_total_atencion?></td>
            </tr>
            
            <tr>
              <td align="right" class="combo_solicitud Estilo1">IVA:</td>
              <td align="right" class="combo_solicitud Estilo1"><?php echo $sum_iva; ?></td>
            </tr>
            
            <?php if($sum_val_compartido > 0){ ?>
            <tr>
                <td align="right" class="combo_solicitud Estilo1">VALOR COMPARTIDO:</td>
              <td align="right" class="combo_solicitud Estilo1"><?php echo $sum_val_compartido; ?></td>
            </tr>
            
            <?php } ?>
            
            
            <tr>
                <td align="right" class="combo_solicitud Estilo1">COPAGO:</td>
              <td align="right" class="combo_solicitud Estilo1"><?php echo $sumatoria_copago; ?></td>
            </tr>
            <tr>
              <td align="right" class="titulo_ventana_emergente">TOTAL :</td>
              <td align="right" class="titulo_ventana_emergente"><?=$sumatoria_factura_total?></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center" class="texto_informativo" style="text-align:justify">Esta factura de venta se asimila en todos sus efectos legales a la letra de cambio segun articulo 774 del Codigo de Comercio, A partir del vencimiento de 
          esta factura se causaran intereses al &nbsp;&nbsp;&nbsp; % mazimo mensual autorizado por la ley, segun el articulo 884 del codigo de comercio y el articulo 13 de la ley 1122 de 2007</td>
        </tr>
        <tr>
          <td align="center"><table width="100%" border="0" cellpadding="10" cellspacing="0" bordercolor="#000000">
            <tr>
              <td width="50%" align="center">
              		<br />
                 	<br />
                  <hr />
                  <span class="titulo_tabla">FIRMA Y SELLO DEL CLIENTE </span></td>
              <td width="50%" align="center">
              		<BR />
                    <br />
                    <hr />
              	 <span class="titulo_tabla">ENTREGADO POR </span>
              </td>
            </tr>
          </table>
            <span class="menu_navegacion_paginas"><br />
Salud Fisica Integral - Cali Colombia<br />
<strong>Tecnolog&iacute;a D E C K</strong></span></td>
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
