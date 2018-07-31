<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Impresion - Pago a empleado</title>
<link href="../../estilos/estilo_impresion.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo1 {color: #000000}
body{ 
	font-family:Arial, Helvetica, sans-serif; 
}
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
 	.tabla_wrap { 
    	border-collapse: collapse; 
		width:28cm;
	}
	.tabla_modulo{
		border-collapse:collapse;	 
	}
	.fila_data{border-bottom: 1pt solid black;}
	.titulo_punto{font-weight:bold;}
	
</style>

</head>

<body onLoad="printThis();">

	<table cellpadding="0" cellspacing="0" border="1" width="80%" align="center" class="tabla_wrap">
		 
	  <tr>
            <td width="26%" align="center" class="titulo_tabla">
            	<p><img src="../../imagenes/sistema/logo_elsa.png" width="150"  /></p>
           	</td>
            
            <td width="47%" align="center" nowrap="nowrap">
            	<p class="contenido_tabla">COMESTIBLES ELSA<br />
              NIT. 5.311.710-4 REGIMEN SIMPLIFICADO<br />
              Calle 34C No. 34C - 06<br />
              Tel: 371 32 96
              <p class="contenido_tabla">RECIBO DE PAGO A EMPLEADO                
          <p class="contenido_tabla">
          	</td>

            <td width="27%" valign="middle">
            
				<table width="100%" border="0" cellspacing="5" cellpadding="0">
	                <tr>
	                  <td align="center" class="titulo_tabla">&nbsp;</td>
                    </tr>
					<tr>
	                  	<td>
                      		<table width="100%" border="0" cellpadding="5" cellspacing="0" bordercolor="#000000">
                                <tr>
                                  <td align="center" nowrap="nowrap" class="titulo_ventana_emergente">
                                    <span style="display:block;">Nro. de recibo:</span>
                                    <span style="display:block;"><?=$cod_empleado_pago?></span>
                                    
                                    <span style="display:block;">Fecha de emision</span>
                                    <span style="display:block; " ><?=$fec_registro?></span>
                                    
                                    
                                  </td>
                                </tr>
                          	</table>
                        </td>
                    </tr>
              	</table>
            	<p>&nbsp;</p>
           </td>
      	</tr>
        
        <tr>
        	<td colspan="3">
            	<table width="100%"  align="center" cellpadding="5" cellspacing="5">
	        	  <tr>
    	    	    <td width="5%"  nowrap="nowrap" ><span class="titulo_punto">Trabajador</span></td>
                    <td width="1%" nowrap="nowrap">:</td>

        		    <td width="45%"><?=$txt_nombre_empleado?></td>
        		    <td width="11%" nowrap="nowrap"><span class="titulo_punto">Fecha de ingreso</span></td>
        		    <td width="1%" nowrap="nowrap">:</td>
        	    	<td width="38%"><?=$fec_ingreso_empleado?></td>
	      	    </tr>
                <tr>
    	    	    <td nowrap="nowrap" ><span class="titulo_punto">No. Identificacion</span></td>
                    <td width="1%" nowrap="nowrap">:</td>

        		    <td><?=" (".$txt_tipo_identificacion_corto.") ".$num_identificacion?></td>
        		    <td><span class="titulo_punto">Cargo</span></td>
        		    <td>:</td>
        	    	<td><?=$txt_cargo_empleado?></td>
	      	    </tr>
                <tr>
    	    	    <td nowrap="nowrap" ><span class="titulo_punto">Ciudad</span></td>
                    <td width="1%" nowrap="nowrap">:</td>

        		    <td><?=$txt_ciudad_empleado?></td>
        		    <td colspan="3">&nbsp;</td>

	      	    </tr>
    	  	  </table>
			</td>
        </tr>
        
        
        <tr>
        	<td colspan="3">
            	
           	  <table width="100%" border="1" frame="void" rules="all" cellpadding="3" cellspacing="0" bordercolor="#000000"  class="tabla_modulo"  >
            		<tr  class="fila_data">
             			<td colspan="3" align="center" class="titulo_punto">DESCRIPCION</td>
						<td align="center" class="titulo_punto">VR. TOTAL</td>
              		</tr>
                    
                     <? 
					$num_registros = $db->num_registros($cursor_detalle_pago);

					while($row=$db->sacar_registro($cursor_detalle_pago)){
						$txt_concepto 	= $row['txt_concepto'];
						$val_pago		= $row['num_valor'];
						
						$val_sumatoria	= $val_sumatoria+$val_pago; // sumatoria
						
					
				
					?>
     
       
       
            			<tr >              
              				<td  colspan="3" align="left" class=""><?=$txt_concepto?></td>
							<td align="right" class=""><?=$sis_genericos->formato_numero($val_pago)?></td>
              			</tr>
            
          			<? } ?>
            
            	
                <tr>
            		<td colspan="2" rowspan="4" align="left" valign="top" class="combo_solicitud">OBSERVACIONES: </td>
                    <td width="5%" align="right" nowrap="nowrap" class="combo_solicitud Estilo1">TOTAL :</td>
                    <td width="25%" align="right" class="">
					  	<?=$val_total_factura_string=$sis_genericos->formato_numero($val_sumatoria); ?>
        	       </td>
	            </tr>
          </table></td>
        </tr>
        
        <tr>
       	  <td colspan="5" align="right">
            	<div style="margin:1cm 0cm; padding:0cm 1cm;">Recibi Conforme ______________________________________</div>
            </td>
        </tr>
        


		
	</table>

	<br>
	<hr>
    
    
    <table cellpadding="0" cellspacing="0" border="1" width="80%" align="center" class="tabla_wrap">
		 
	  <tr>
            <td width="26%" align="center" class="titulo_tabla">
            	<p><img src="../../imagenes/sistema/logo_elsa.png" width="150"  /></p>
           	</td>
            
            <td width="47%" align="center" nowrap="nowrap">
            	<p class="contenido_tabla">COMESTIBLES ELSA<br />
              NIT. 5.311.710-4 REGIMEN SIMPLIFICADO<br />
              Calle 34C No. 34C - 06<br />
              Tel: 371 32 96
              <p class="contenido_tabla">RECIBO DE PAGO A EMPLEADO                
          <p class="contenido_tabla">
          	</td>

            <td width="27%" valign="middle">
            
				<table width="100%" border="0" cellspacing="5" cellpadding="0">
	                <tr>
	                  <td align="center" class="titulo_tabla">&nbsp;</td>
                    </tr>
					<tr>
	                  	<td>
                      		<table width="100%" border="0" cellpadding="5" cellspacing="0" bordercolor="#000000">
                                <tr>
                                  <td align="center" nowrap="nowrap" class="titulo_ventana_emergente">
                                    <span style="display:block;">Nro. de recibo:</span>
                                    <span style="display:block;"><?=$cod_empleado_pago?></span>
                                    
                                    <span style="display:block;">Fecha de emision</span>
                                    <span style="display:block; " ><?=$fec_registro?></span>
                                    
                                    
                                  </td>
                                </tr>
                          	</table>
                        </td>
                    </tr>
              	</table>
            	<p>&nbsp;</p>
           </td>
      	</tr>
        
        <tr>
        	<td colspan="3">
            	<table width="100%"  align="center" cellpadding="5" cellspacing="5">
	        	  <tr>
    	    	    <td width="5%"  nowrap="nowrap" ><span class="titulo_punto">Trabajador</span></td>
                    <td width="1%" nowrap="nowrap">:</td>

        		    <td width="45%"><?=$txt_nombre_empleado?></td>
        		    <td width="11%" nowrap="nowrap"><span class="titulo_punto">Fecha de ingreso</span></td>
        		    <td width="1%" nowrap="nowrap">:</td>
        	    	<td width="38%"><?=$fec_ingreso_empleado?></td>
	      	    </tr>
                <tr>
    	    	    <td nowrap="nowrap" ><span class="titulo_punto">No. Identificacion</span></td>
                    <td width="1%" nowrap="nowrap">:</td>

        		    <td><?=" (".$txt_tipo_identificacion_corto.") ".$num_identificacion?></td>
        		    <td><span class="titulo_punto">Cargo</span></td>
        		    <td>:</td>
        	    	<td><?=$txt_cargo_empleado?></td>
	      	    </tr>
                <tr>
    	    	    <td nowrap="nowrap" ><span class="titulo_punto">Ciudad</span></td>
                    <td width="1%" nowrap="nowrap">:</td>

        		    <td><?=$txt_ciudad_empleado?></td>
        		    <td colspan="3">&nbsp;</td>

	      	    </tr>
    	  	  </table>
			</td>
        </tr>
        
        
        <tr>
        	<td colspan="3">
            	
           	  <table width="100%" border="1" frame="void" rules="all" cellpadding="3" cellspacing="0" bordercolor="#000000"  class="tabla_modulo"  >
            		<tr  class="fila_data">
             			<td colspan="3" align="center" class="titulo_punto">DESCRIPCION</td>
						<td align="center" class="titulo_punto">VR. TOTAL</td>
              		</tr>
                    
                     <? 
					$num_registros = $db->num_registros($cursor_detalle_pago_2);

					while($row=$db->sacar_registro($cursor_detalle_pago)){
						$txt_concepto 	= $row['txt_concepto'];
						$val_pago		= $row['num_valor'];
						
						$val_sumatoria	= $val_sumatoria+$val_pago; // sumatoria
						
					
				
					?>
     
       
       
            			<tr >              
              				<td  colspan="3" align="left" class=""><?=$txt_concepto?></td>
							<td align="right" class=""><?=$sis_genericos->formato_numero($val_pago)?></td>
              			</tr>
            
          			<? } ?>
            
            	
                <tr>
            		<td colspan="2" rowspan="4" align="left" valign="top" class="combo_solicitud">OBSERVACIONES: </td>
                    <td width="5%" align="right" nowrap="nowrap" class="combo_solicitud Estilo1">TOTAL :</td>
                    <td width="25%" align="right" class="">
					  	<?=$val_total_factura_string=$sis_genericos->formato_numero($val_sumatoria); ?>
        	       </td>
	            </tr>
          </table></td>
        </tr>
        
        <tr>
       	  <td colspan="5" align="right">
            	<div style="margin:1cm 0cm; padding:0cm 1cm;">Recibi Conforme ______________________________________</div>
            </td>
        </tr>
        


		
	</table>



<form id="form1" name="form1" method="post" action="">

 <?php ?>
<input type="hidden" name="cod_orden" value="<?=$cod_orden?>">
	<input type="hidden" name="cod_usuario" value="<?=$cod_usuario?>">
  <input type="hidden" name="cod_navegacion">
</form>

<script>
//window.print();

function printThis() {
	return false;
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