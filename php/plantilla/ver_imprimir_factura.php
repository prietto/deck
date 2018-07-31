<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Facturas (IMPRESION) - Scistem </title>
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

<body onLoad="printThis();">
<form id="form1" name="form1" method="post" action="">

 <?php 
	 $ind_encabezado 	= true;
	 $ind_pie_pagina	= true;
	 $ind_detalle		= true;
	 
	 	$cod_factura_anterior 	= ''; 
		$pos_ciclo 				= 0; 
		$sumatoria_factura 		= 0; 
		$sumatoria_copago 		= 0;
		$sum_iva				= 0;
		$sum_val_compartido		= 0;
		
		$val_subtotal				= 0;
		$val_total_iva				= 0;
		$sum_val_total_factura		= 0;
	 
		$num_registros 	= $db->num_registros($cursor_datos);
		$contador = 0;

	 	while($row=$db->sacar_registro($cursor_datos)){
			$contador++;
			
			// ==== INFORMACION DEL DETALLE DE CADA FACTURA Y VALORES====
			$cod_factura 		= $row['cod_factura'];

			$num_cantidad			= $row['cantidad'];
			$cod_producto			= $row['cod_producto'];
			$txt_producto			= $row['txt_producto'];
			$val_unitario			= $row['val_precio_unitario'];
			$val_total_linea		= $row['val_total_linea'];			
			$val_total_factura		= $row['val_total_factura'];
			
			$val_descuento		= $row['val_descuento'];
			$val_iva_porc		= $row['val_iva_porc'];
			$val_rete_porc		= $row['val_rete_porc'];
			$val_cree_porc		= $row['val_cree_porc'];
			$fec_regsitro_fact 	= $row['fec_registro'];
			$fec_vencimiento	= $row['fec_vencimiento'];
			
			

			// consulta el numero de detalles que tiene la factura
			$num_detalles 		= $factura->f_get_count_detalle($cod_factura);
			

			
			// separa la fecha de registro
			$arr_fec_registro		= $sis_genericos->f_separa_fecha($fec_regsitro_fact);
			$year_fec_registro		= $arr_fec_registro[0];
			$mes_fec_registro		= $arr_fec_registro[1];
			$dia_fec_registro		= $arr_fec_registro[2];
			
			
			// ==== INFORMACION DEL CLIENTE === //
			$txt_cliente				= $row['txt_cliente'];	
			$num_identificacion_cliente	= $row['num_identificacion_cliente'];	
			$txt_tel_cliente			= $row['txt_telefono_cliente'];	
			$txt_direccion_cliente		= $row['txt_direccion_cliente'];	
									
 
			// calcula la fecha de vencimiento
			$txt_forma_pago			= $row['txt_forma_pago'];
			$num_dias_forma_pago	= $row['num_dias_forma_pago'];
			if($fec_vencimiento){
				$fec_vencimiento    = $sis_genericos->f_separa_fecha($fec_vencimiento);
				$year_fec_venc		= $fec_vencimiento[0];
				$mes_fec_venc		= $fec_vencimiento[1];
				$dia_fec_venc		= $fec_vencimiento[2];
			}else{
				$year_fec_venc		= "--";
				$mes_fec_venc		= "--";
				$dia_fec_venc		= "--";
			}
			
			/*if($num_dias_forma_pago >0){
				$fecha2				= date("Y-m-j",strtotime($fec_regsitro_fact));
				
				$fec_vencimiento 	= strtotime ( '+'.$num_dias_forma_pago.' day' , strtotime ( $fecha2 ) ) ;
				$fec_vencimiento	= date ( 'Y-m-j' , $fec_vencimiento);
				
			}*/
			
			
			
			
			
			$pos_ciclo++;
				
			 // === AQUI COMIENZA EL ENCABEZADO
			 // Si el codigo de factura es diferente a la anterior quiere decir que es otra factura
			 // y debe imprimir el encabezado
			//echo "$cod_factura != $cod_factura_anterior";
			if ($cod_factura != $cod_factura_anterior){ 
				$cod_factura_anterior = $cod_factura; 
				
				$ind_encabezado = false;
				$ind_detalle = true;
			
				if($pos_ciclo>1){ 
					//$cod_factura_anterior = $cod_factura;
				
				?>
                	
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
            <td width="26%" align="center" class="titulo_tabla">
            	<p><?=$txt_url_logo?></p>
            </td>
            <td width="39%" align="center" nowrap="nowrap"><p class="contenido_tabla">
              <?=$txt_razon_social?><br />
              <?=$num_identificacion?><br />
              <?=$txt_direccion?><br />
              Tel: <?=$txt_telefono?></p>

            </p></td>
            <td width="35%" valign="middle">
            
            <table width="100%" border="0" cellspacing="5" cellpadding="0">
                <tr>
                  <td align="center" class="titulo_tabla">Forma de pago</td>
                  <td align="center" class="titulo_tabla">Factura de Venta</td>
                </tr>
                <tr>
                  <td width="48%">
                  
                  <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#000000" height="35px">
                    <tr>
                      <td align="center"  class="titulo_ventana_emergente" style="font-size:12px;">&nbsp; <?=$txt_forma_pago?></td>
                    </tr>
                  </table>
                  
                  </td>
                  <td width="52%"><table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#000000">
                    <tr>
                      <td align="center" nowrap="nowrap" class="titulo_ventana_emergente">Nro.
                        <?=$cod_factura?></td>
                    </tr>
                  </table></td>
                </tr>
              </table>
            
            <table width="100%" border="0" cellspacing="2" cellpadding="0">
              <tr>
                <td width="51%" align="center" class="titulo_tabla">Fecha Factura</td>
                <td align="center" class="titulo_tabla">Fecha Vencimiento</td>
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
              
            <p>&nbsp;</p></td>
      	</tr>
    
      
    </table>
      <table width="100%" border="0" cellspacing="10" cellpadding="0">
        
        
        <tr>
          <td valign="top">
          <table width="100%" border="1" cellpadding="6" cellspacing="0" bordercolor="#000000">
                        
            <tr>
              <td class="combo">
              	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><strong>SE&Ntilde;OR(ES):</strong> <?=$txt_cliente?></td>
                  
                </tr>
              </table>                
              </td>
            </tr>
            
            
            <tr>
              <td class="combo"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="55%"><strong>CC/NIT:</strong>
                        <?=$num_identificacion_cliente?></td>
                      <td width="45%" align="left"><strong>TELEFONO :
                        <?=$txt_tel_cliente?>
                      </strong></td>
                    </tr>
                  </table></td>
                 
                </tr>
              
              </table></td>
            </tr>
            <tr>
              <td class="combo"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                 <tr>
                  <td width="56%"><strong>DIRECCION: </strong><?=$txt_direccion_cliente?> </td>
                  <td width="44%" align="left"></td>
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
	   		
			
			
	   
	   
	   		// === HASTA AQUI EL ENCABEZADO    
	   
	   
	   
	   		//$sumatoria_factura 			= $sumatoria_factura+$val_total_atencion;
			//$sumatoria_copago			= $sumatoria_copago+$val_copago;
			
			//$sumatoria_factura_total	= (($sumatoria_factura - $sumatoria_copago) - $sum_val_compartido)+ $sum_iva;
			//$sumatoria_factura_total	= $sis_genericos->formato_numero($sumatoria_factura_total);
			
			//$sumatoria_factura			= $sis_genericos->formato_numero($sumatoria_factura);
			//$val_unitario 				= $val_total_atencion / $num_cantidad;
	   }else if($cod_factura == $cod_factura_anterior)$ind_detalle = true;
	   
	   	// AQUI COMIENZA EL DETALLE
		
		if($ind_detalle == true){
			$val_subtotal				= $val_total_linea + $val_subtotal;
			$val_total_iva				= ($val_total_factura*$val_iva_porc)/100;
			$sum_val_total_factura		= $val_subtotal+$val_total_iva;
			
	   	?>
       
       
            <tr>
              <td width="10%" align="center" class="combo_solicitud Estilo1"><?php echo $num_cantidad; ?></td>
              <td width="56%" align="left" class="menu_navegacion_paginas"><strong><?php echo $txt_producto; ?></strong></td>
              <td width="20%" align="right" class="combo_solicitud Estilo1">
			  <?php echo $val_unitario_string=$sis_genericos->formato_numero($val_unitario); ?></td>
              <td align="right" class="combo_solicitud Estilo1">
			  <?php echo $val_total_linea_string=$sis_genericos->formato_numero($val_total_linea); ?></td>
            
              </tr>
            
             <?php
		}
			 
			
			if($pos_ciclo==$num_detalles){
				
				$pos_ciclo 					= 0;

				
				$ind_encabezado=true;
			?>
            
            <tr>
            
            
              <td colspan="2" rowspan="5" align="left" valign="top" class="combo_solicitud">OBSERVACIONES: </td>
              <td align="right" class="combo_solicitud Estilo1">SUB TOTAL:</td>
              <td width="14%" align="right" class="combo_solicitud Estilo1">
			  	<?php echo $val_subtotal_string=$sis_genericos->formato_numero($val_subtotal); ?>
              </td>
            </tr>
            
            <tr>
              <td align="right" class="combo_solicitud Estilo1">IVA:</td>
              <td align="right" class="combo_solicitud Estilo1">
			  	<?php echo $val_total_iva_string =$sis_genericos->formato_numero($val_total_iva); ?>
              </td>
            </tr>
            
           
            <tr>
              <td align="right" class="titulo_ventana_emergente">TOTAL :</td>
              <td align="right" class="titulo_ventana_emergente">
			  	<?php echo $val_total_factura_string=$sis_genericos->formato_numero($sum_val_total_factura); ?>
				
               </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center" class="texto_informativo" style="text-align:justify">Esta factura de venta se asimila en todos sus efectos legales a la letra de cambio segun articulo 774 del Codigo de Comercio, A partir del vencimiento de 
          esta factura se causaran intereses al % mazimo mensual autorizado por la ley, segun el articulo 884 del codigo de comercio y el articulo 13 de la ley 1122 de 2007</td>
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
Cali Colombia<br />
            </span></td>
        </tr>
        
      </table>    </td>
  </tr>
</table>
		 <?php 
				
			if($contador<$num_registros){
	
			echo "<div class='saltopagina'></div> "; 
			}
		
			// reinicia valores  
		  	$val_subtotal 				= 0;
			$val_total_iva				= 0;
			$sum_val_total_factura		= 0;
			
		 } // cierra pie de pagina 
		  
		
		  
	  }  // fin ciclo
	  
	  ?>
<input type="hidden" name="cod_orden" value="<?=$cod_orden?>">
	<input type="hidden" name="cod_usuario" value="<?=$cod_usuario?>">
  <input type="hidden" name="cod_navegacion">
</form>

<script>
//window.print();

function printThis() {
	
	var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
	//alert(is_chrome);
	
	if(is_chrome == true){
		window.print();
		setTimeout("window.close()", 100);
	}
	
	//if (window.print) { window.print(); window.close(); } 
//	window.print();
	//self.close();
	
	
}

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