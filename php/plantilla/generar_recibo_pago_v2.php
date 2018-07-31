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

<style>
 div.saltopagina{ 
      display:block; 
      page-break-before:always;
   }
</style>

<script language="VBScript"> 
SUB Print() 
OLECMDID_PRINT = 6 
OLECMDEXECOPT_DONTPROMPTUSER = 2 
OLECMDEXECOPT_PROMPTUSER = 1 
'ACA en caso de usar frames, 
'enfocamos el frame a imprimir: 

'window.parent.frames.main.document.body.focus() 
window.document.body.focus() 

'Llamamos al comando de Impresión Print 

on error resume next 
call IEWB.ExecWB (OLECMDID_PRINT, -1) 

if err.number <> 0 then 
    alert "No se pudo imprimir" 
end if 

END SUB 
</script> 

<SCRIPT language="javascript">
function imprimir(){ 
	if((navigator.appName == "Netscape")){ 
		window.print() ;
	}else{ 

		var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
		document.body.insertAdjacentHTML('beforeEnd', WebBrowser); WebBrowser1.ExecWB(6, -1); WebBrowser1.outerHTML = "";
	}
}
</SCRIPT>

</head>

<body style="margin:0px;" onload="imprimir();">


 <?php 
	 $ind_encabezado 	= true;
	 $ind_pie_pagina	= true;
	 $ind_detalle		= true;
	 
	 	$cod_factura_anterior 	= ''; 
		$cod_pedido_anterior	= NULL;
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
			
			// ==== INFORMACION DEL DETALLE DE CADA PEDIDO Y VALORES====
			$cod_factura 			= $row['cod_factura']; // SI LO TIENE
			$cod_pedido				= $row['cod_pedido'];
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
			
			$txt_usuario		= $row['txt_usuario'];
			$fec_registro		= $row['fec_registro'];
			$fec_registro		= $sis_genericos->f_fecha_larga_con_hora($fec_registro);

			// consulta el numero de detalles que tiene la factura
			//$num_detalles 		= $factura->f_get_count_detalle($cod_factura);
			$num_detalles 		= $pedido->f_get_count_detalle($cod_pedido);
			

			
			// separa la fecha de registro
			$arr_fec_registro		= $sis_genericos->f_separa_fecha($fec_regsitro_fact);
			$year_fec_registro		= $arr_fec_registro[0];
			$mes_fec_registro		= $arr_fec_registro[1];
			$dia_fec_registro		= $arr_fec_registro[2];
			
			
			// ==== INFORMACION DEL CLIENTE === //
			$txt_cliente			= $row['txt_cliente'];	
			$num_identificacion		= $row['num_identificacion_cliente'];	
			$txt_tel_cliente		= $row['txt_telefono_cliente'];	
			$txt_direccion_cliente	= $row['txt_direccion_cliente'];	
									
 
			// calcula la fecha de vencimiento
			$txt_forma_pago			= $row['txt_forma_pago'];
			$num_dias_forma_pago	= $row['num_dias_forma_pago'];
			if($num_dias_forma_pago >0){
				$fecha2				= date("Y-m-j",strtotime($fec_regsitro_fact));
				
				$fec_vencimiento 	= strtotime ( '+'.$num_dias_forma_pago.' day' , strtotime ( $fecha2 ) ) ;
				$fec_vencimiento	= date ( 'Y-m-j' , $fec_vencimiento);
				$fec_vencimiento    = $sis_genericos->f_separa_fecha($fec_vencimiento);
				$year_fec_venc		= $fec_vencimiento[0];
				$mes_fec_venc		= $fec_vencimiento[1];
				$dia_fec_venc		= $fec_vencimiento[2];
			}else{
				$year_fec_venc		= "--";
				$mes_fec_venc		= "--";
				$dia_fec_venc		= "--";
			}
			
			
			
			
			
			$pos_ciclo++;
				
			 // === AQUI COMIENZA EL ENCABEZADO
			 // Si el codigo de factura es diferente a la anterior quiere decir que es otra factura
			 // y debe imprimir el encabezado
			//echo "$cod_factura != $cod_factura_anterior";
			if ($cod_pedido != $cod_pedido_anterior){ 
				$cod_pedido_anterior = $cod_pedido; 
				
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
			
	
	 
	 

<table width="300px" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="138">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
     
    

     
      <tr>
            <td align="center" class="titulo_tabla">
            
              <p class="contenido_tabla" style="font-size:11px;">
                JENNY BRAVO BOLA&Ntilde;OS<br />
                C.C. 1.144.141.006 REGIMEN SIMPLIFICADO<br />
                Venta de toda clase de papa por mayor y detal<br />
                CAVASA Bodega 8 local 19 y 20 <br />
              Tel: 448 40 11</p>
              
                  
            
            </td>
          </tr>
          <tr>
          	<td>
            	<hr />
            
            </td>
          </tr>
          
          <tr>
          	<td class="contenido_tabla_recibo">
            	Cliente: <?=$txt_cliente?> <br />
                No identificacion: <?=$num_identificacion?>
            
            </td>
          </tr>
          
          <tr>
          	<td>
            	<hr />
            
            </td>
          </tr>
    
      
    </table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center">
          <table width="100%" border="0" cellpadding="0" cellspacing="0"  >
            <tr>
              <td width="12%" align="left" class="titulo_tabla_recibo" >CANT</td>
              <td width="45%" align="left" class="titulo_tabla_recibo" >DESCRIPCION</td>
              <td width="24%" align="right" nowrap="nowrap" class="titulo_tabla_recibo" >V. UNIT</td>
              <td align="right" nowrap="nowrap" class="titulo_tabla_recibo"  >V. TOTAL</td>
              </tr>
            <?php 
	   		
			
			
	   
	   
	   		// === HASTA AQUI EL ENCABEZADO    
	   
	   
	   
	   		//$sumatoria_factura 			= $sumatoria_factura+$val_total_atencion;
			//$sumatoria_copago			= $sumatoria_copago+$val_copago;
			
			//$sumatoria_factura_total	= (($sumatoria_factura - $sumatoria_copago) - $sum_val_compartido)+ $sum_iva;
			//$sumatoria_factura_total	= $sis_genericos->formato_numero($sumatoria_factura_total);
			
			//$sumatoria_factura			= $sis_genericos->formato_numero($sumatoria_factura);
			//$val_unitario 				= $val_total_atencion / $num_cantidad;
	   }else if($cod_pedido == $cod_pedido_anterior)$ind_detalle = true;
	   
	   	// AQUI COMIENZA EL DETALLE
		
		if($ind_detalle == true){
			$val_subtotal				= $val_total_linea + $val_subtotal;
			$val_total_iva				= ($val_total_factura*$val_iva_porc)/100;
			$sum_val_total_factura		= $val_subtotal+$val_total_iva;
			
	   	?>
            
            
            <tr>
              <td width="12%" align="center" class="contenido_tabla_recibo"><?php echo $num_cantidad; ?></td>
              <td width="45%" align="left" class="contenido_tabla_recibo"><strong><?php echo $txt_producto; ?></strong></td>
              <td width="24%" align="right" class="contenido_tabla_recibo">
                <?php echo $val_unitario_string=$sis_genericos->formato_numero($val_unitario); ?></td>
              <td align="right" class="contenido_tabla_recibo">
                <?php echo $val_total_linea_string=$sis_genericos->formato_numero($val_total_linea); ?></td>
              
              </tr>
              
              
             
            
            <?php
		}
			 
			
			if($pos_ciclo==$num_detalles){
				
				$pos_ciclo 					= 0;

				
				$ind_encabezado=true;
			?>
            
             <tr>
              <td colspan="4" align="center" class="contenido_tabla_recibo"><hr /></td>
              </tr>
            
            <tr>
              
              
              <td colspan="2" rowspan="5" align="left" valign="top" class="titulo_tabla_recibo">&nbsp;</td>
              <td align="right" class="titulo_tabla_recibo">SUB TOTAL:</td>
              <td width="19%" align="right" class="titulo_tabla_recibo">
                <?php echo $val_subtotal_string=$sis_genericos->formato_numero($val_subtotal); ?>
                </td>
              </tr>
            
            <tr>
              <td align="right" class="titulo_tabla_recibo">IVA:</td>
              <td align="right" class="titulo_tabla_recibo">
                <?php echo $val_total_iva_string =$sis_genericos->formato_numero($val_total_iva); ?>
                </td>
              </tr>
            
            
            <tr>
              <td align="right" class="titulo_tabla_recibo">TOTAL :</td>
              <td align="right" class="titulo_tabla_recibo">
                <?php echo $val_total_factura_string=$sis_genericos->formato_numero($sum_val_total_factura); ?>
                
                </td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td align="center" class="titulo_tabla_recibo"><hr /></td>
        </tr>
        <tr>
          <td align="center" class="titulo_tabla_recibo">&gt;&gt; # de recibo: <?=$cod_pedido?> &lt;&lt;</td>
        </tr>
        <tr>
          <td align="center" class="titulo_tabla_recibo">Creado: <?=$fec_registro?></td>
        </tr>
        <tr>
          <td align="center" class="titulo_tabla_recibo">Por: <?=$txt_usuario?></td>
        </tr>
        <tr>
          <td align="center"><span class="menu_navegacion_paginas"><br />
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