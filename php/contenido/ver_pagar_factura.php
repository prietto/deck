<table width="100%" border="0">
  <tr>
    <td colspan="3" align="left" nowrap><strong>PAGO / ABONO DE FACTURA</strong></td>
    <td align="left" nowrap><input type="button"  
        		class="pure-button"  
                value="Totalizar pago" 
                name="enter_val_saldo2" 
                id="enter_totalizar" 
                style="background-color:#0C3;"
                onclick="f_totalizar_pago(this);"
            /></td>
  </tr>
  <tr>
    <td align="left" nowrap>&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td colspan="2" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td width="7%" align="left" nowrap>Cliente</td>
    <td width="1%" align="left">:</td>
    <td colspan="2" align="left">
    <?=$row_pedido['txt_cliente'].'  ('.$row_pedido['txt_tipo_identificacion'].' '.$row_pedido['num_identificacion'].')'?></td>
  </tr>
  <tr>
    <td align="left" nowrap>Factura</td>
    <td align="left">: </td>
    <td colspan="2" align="left"><?=$cod_factura?>
		<input type="hidden" value="<?=$cod_factura?>" name="cod_factura_saldo" id="cod_factura_saldo"  />
        <input type="hidden" value="<?=$row_pedido['cod_pedido']?>" name="cod_pedido" id="cod_pedido"  />
    </td>
  </tr>
  <tr>
    <td align="left" nowrap>Total</td>
    <td align="left">: </td>
    <td colspan="2" align="left"><?=$val_total?>
    	
    
    </td>
  </tr>
  <tr>
    <td align="left" nowrap>Saldo</td>
    <td align="left">: </td>
    <td colspan="2" align="left"><?=$sis_genericos->formato_numero($val_saldo);?>
      
    </td>
  </tr>
  <tr>
    <td align="left" nowrap>Fecha pago</td>
    <td align="left">:</td>
    <td align="left">
        <input 	name		='fec_pago_factura'							
							type		='text' 
							id			='fec_pago_factura' 
							class		= 'datepicker'
							value		='<?=date('Y-m-d')?>' 
							readonly							
							size		='10' />
    </td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" nowrap>Nuevo pago</td>
    <td align="left">:</td>
    <td width="81%" align="left">
    	<input name="val_saldo" id="val_saldo" type="text" value="" data-saldo="<?=$val_saldo?>" 
        	onkeyup="comportamiento_combo_numerico(this,2,event); f_valida_saldo(this);" autocomplete="off"   >
        </td>
    <td width="11%" align="right">
    	<input type="button"  
        		class="pure-button" 
                value="Guardar Cambios" 
                name="enter_val_saldo" 
                id="enter_val_saldo" 
                disabled="disabled"
                onclick="navegar_ajax(1069,this)"
                
            />
            </td>
  </tr>
  <tr>
    <td colspan="4" align="center" >
    	<div id="msj_saldo"></div>
    </td>
  </tr>
</table>


<script>
$('#val_saldo').focus();

function f_valida_saldo(combo){
	var value 		= $(combo).val();
	var saldo_limite = $(combo).data('saldo')
	
	value = parseFloat(value.replace(/,/g, ''));
	$('#msj_saldo').html('');
	$('#enter_val_saldo').removeAttr('disabled');
	
	if(value > saldo_limite){
		var msj = 'El pago no puede ser mayor al saldo de la factura';
		$('#msj_saldo').css('color','red');
		$('#msj_saldo').html(msj);
		
		$('#enter_val_saldo').attr('disabled','disabled');
		
	}else if(value == saldo_limite){
		var msj = 'La factura se guardara como pagada';
		
		$('#msj_saldo').css('color','Green');
		$('#msj_saldo').html(msj);
		
	}else{
		$('#enter_val_saldo').removeAttr('disabled');
	}
}

function f_totalizar_pago($this){
	var saldo_limite = $('#val_saldo').data('saldo');
	$('#val_saldo').val(formato_numero(saldo_limite));
  
	// LLAMA A LA FUNCION CONFIRM  EJECTUTANDO UN CALLBACK PRIMERO Y DEVOLVIENDO UNA RESPUESTA
	confirm("Se guardaran los cambios ¿Desea continuar?", function (a) {
		if(a == "si"){ // la funcion callback devuelve un valor dependiendo del boton seleccionado
			navegar_ajax(1069,this);
			return false;		
		}else if(a == "no"){
			$('#val_saldo').val('');
			$('#val_saldo').focus();
			
			return false;
		}
	});
	return false;
}


$(function(){	
	$('#fec_pago_factura').datepicker({
		changeMonth: true, // Muestra comobobox para seleccionar el mes
		changeYear:  true, // Muestra comobobox para seleccionar el aÃ±o
		yearRange: 'c-100:c+10',
		//minDate: new Date(2010, 11, 20, 8, 30), // para poner un minimo de fecha
		//minDate: 0,
		dateFormat: 'yy-mm-dd',
		 defaultDate: new Date(),
		onSelect: function(){
			$('#val_saldo').focus();
		}
	});
})

</script>