<table width="100%" border="0">
  <tr>
    <td colspan="3" align="left" nowrap><strong>REGISTRO DE PAGO A EMPLEADO</strong></td>
    <td align="left" nowrap>
    	<input type="button"  
        		class="pure-button" 
                value="Agregar Nota" 
                name="btn_nota_pago" 
                id="btn_nota_pago" 
                />
     </td>
  </tr>
  <tr>
    <td align="left" nowrap>&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td colspan="2" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td width="7%" align="left" nowrap>Empleado</td>
    <td width="1%" align="left">:</td>
    <td colspan="2" align="left">
    <?=$row_empleado['txt_nombre'].' '.$row_empleado['txt_apellido'].'  ('.$row_empleado['txt_tipo_identificacion_corto'].'. '.$row_empleado['num_identificacion'].')'?></td>
  </tr>
  <tr>
    <td align="left" nowrap>Fecha pago</td>
    <td align="left">:</td>
    <td align="left">
			        <input type="hidden" value="<?=$row_empleado['cod_empleado']?>" name="cod_empleado_pago" id="cod_empleado_pago"  />
    				
                    <input 	name		='fec_pago_empleado'
							type		='text' 
							id			='fec_pago_empleado' 
							class		= 'datetimepicker'
							value		='<?=date('Y-m-d H:i:s')?>' 
							readonly
							
							size		='15' />
     </td>
    <td align="right">&nbsp;</td>
  </tr>
  
  <tr style="display:none;" id="bloque_nota">
    <td align="left" nowrap>Nota</td>
    <td align="left">:</td>
    <td align="left">
			        <textarea 	name		='txt_nota_pago'
							
							id			='txt_nota_pago' 
							class		= ''
                             style="resize:none;"
							></textarea>
     </td>
    <td align="right">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="left" nowrap>Nuevo pago</td>
    <td align="left">:</td>
    <td width="81%" align="left">
    	<input name="val_pago_empleado" id="val_pago_empleado" type="text" value=""    	 autocomplete="off"   >
    </td>
    <td width="11%" align="right">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="left" nowrap></td>
    <td align="left">&nbsp;</td>
    <td colspan="2" align="left" nowrap="nowrap"><input type="button"  
        		class="pure-button enter_pago_empleado" 
                value="Guardar" 
                name="enter_val_pago" 
                id="enter_val_pago" 
                disabled="disabled"
                onclick="navegar_ajax(1080,this);"
                
            />
    <input type="button"  
        		class="pure-button enter_pago_empleado" 
                value="Guardar e imprimir" 
                name="enter_val_pago_imp" 
                id="enter_val_pago_imp" 
                disabled="disabled"
                onclick="navegar_ajax_all_variables(1080,this,'ind_imprimir',1);"
                
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
$('#val_pago_empleado').focus();





$(function(){
		$('#fec_pago_empleado').datetimepicker({
			changeMonth: true, // Muestra comobobox para seleccionar el mes
			//changeYear:  true, // Muestra comobobox para seleccionar el año
			yearRange: 'c-100:c+10',
			//hourGrid: 4,
			//secondGrid: 10, 
			//minuteGrid: 10,
			//timeFormat: 'H:mm:ss',
			//timeFormat: 'hh:mm tt',
			showSecond: false,
			timeFormat: 'HH:mm:ss',
			controlType: 'select',
			dateFormat: 'yy-mm-dd',
			constrainInput: false,
			onSelect: function(){
				//alert('hola');	
					$(this).blur();
					//$(this).datetimepicker('hide');
				}
			}).on('changeDate', function (e) {
				$(this).blur();
				//alert();
				//$(this).datetimepicker('hide');
			});
	
	/*$('#fec_pago_empleado').datepicker({
		changeMonth: true, // Muestra comobobox para seleccionar el mes
		changeYear:  true, // Muestra comobobox para seleccionar el aÃ±o
		yearRange: 'c-100:c+10',
		//minDate: new Date(2010, 11, 20, 8, 30), // para poner un minimo de fecha
		//minDate: 0,
		dateFormat: 'yy-mm-dd',
		 defaultDate: new Date(),
		onSelect: function(){
			$('#val_pago_empleado').focus();
		}
	});*/
	
	
	// funcion que se ejecuta mientras se digita los valores en el input
	$('#val_pago_empleado').keyup(function(e){
		e.preventDefault();
		
		// valor del input
		var value 		= $(this).val();
		
		value = (this.value + '').replace(/[^0-9]/g, '');
		console.log(value+' -- ');	
		// si el input esta vacio
		if(value != '' && (Number(value)>0)){
			//value = (this.value + '').replace(/[^0-9]/g, '');

			$('.enter_pago_empleado').removeAttr('disabled'); // evalua si el input contiene datos para activar el boton de guardar
			//value = parseFloat(value.replace(/,/g, ''));
			this.value = formato_numero(value); // formatea el numero dandole la forma de miles
		}
		else{ 
			$('.enter_pago_empleado').attr('disabled','disabled'); // si no descativa el boton de guardado
		}
		
		
		//$('#msj_saldo').html('');
	}) // fin funcion
	

	$('#enter_val_pago').on('click',function(){
		

	
	}) // fin funcion
	
	
	// inicio funcion
	$('#btn_nota_pago').on('click',function(){
		/*$('#bloque_nota').toggle('fast',function(){
			// animacion completa
		})*/
		$('#bloque_nota').show('fast');
		
	});
	// fin funcion
	
})

</script>
