<? if($ind_activo == 1){ ?>
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
	                    	style="resize:none;"></textarea>
	     	</td>
	    	<td align="right">&nbsp;</td>
	  	</tr>
	  
	  	<tr>
	  		<td  colspan="4" align="center" >
	  			<table  id='tabla_detalle_33' class='tabla_detalle' width='100%' border='0' cellspacing='0' cellpadding='5'>
	  				<tr class='titulo_tabla_detalle'>
	  					<td nowrap='nowrap' >Concepto</td>
	  					<td nowrap='nowrap' >Valor</td>
	  					<td></td>
	  				</tr>

	  				<tr valign='top'   id='tabla_detalle_23_row_0'>
	  					<td nowrap='nowrap' valign='middle'>
	  						<input 	name		='arr_txt_concepto[]' 
	  								class="combo"
	  								autocomplete="off"
	  								required 
									type		='text' 
									value		=''/>
						</td>

						<td nowrap='nowrap' valign='middle'>
							<input 	type		='text' 
									class		='combo' 
									required	='required'
									name		='arr_num_valor[]' 
									autocomplete='off'
									value		=''
									maxlength	='255'/>
						</td>

						<td nowrap='nowrap' align='right'>
							<input class='contenido' name='mas'  type='button' onclick="addRow(this,'tabla_detalle_33')" value='+' />
							<input class='contenido' name='menos' type='button' onclick="eliminar_fila(this,'tabla_detalle_33')" value='-' />
						</td>
					</tr>
				</table> 
	  		</td>
	  	</tr>

	  	<tr>
	  		<td colspan="4"><hr></td>
	  	</tr>

		<tr>
	  		<td colspan="2" align="right">Total:</td>
			<td colspan="2" align="center"><span id="val_total_detalle_pago"></span></td>
		</tr>

	  	<tr>
	  		<td colspan="4">&nbsp;</td>		
	  	</tr>

	  	
	  
	  	<tr>
	    	<td colspan="4" align="left" nowrap="nowrap">

	    		<input type="button"  
	        		class="pure-button enter_pago_empleado" 
	                value="Guardar" 
	                name="enter_val_pago" 
	                id="enter_val_pago" 
	                disabled="disabled"
	                onclick="navegar_ajax_simple(1080,this);"
	                
	            />
	    		<input type="button"  
	        		class="pure-button enter_pago_empleado" 
	                value="Guardar e imprimir" 
	                name="enter_val_pago_imp" 
	                id="enter_val_pago_imp" 
	                disabled="disabled"
	                onclick="ajax_all_vars(1080,this,'ind_imprimir',1);"
	                
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
	$(".tabla_detalle").find('input,select,textarea').first().focus();





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
		$('.tabla_detalle').delegate("input[name='arr_num_valor[]']",'keyup',function(e){

			e.preventDefault();
			
			// valor del input
			var value 		= $(this).val();
			
			// limpia el valor
			value = (this.value + '').replace(/[^0-9]/g, '');
			
			this.value = formato_numero(value); // formatea el numero dandole la forma de miles

			// si el input esta vacio
			if(value != '' && (Number(value)>0 && value.length > 0)){
				//value = (this.value + '').replace(/[^0-9]/g, '');

				$('.enter_pago_empleado').removeAttr('disabled'); // evalua si el input contiene datos para activar el boton de guardar
				//value = parseFloat(value.replace(/,/g, ''));
				
			}
			else{ 
				$('.enter_pago_empleado').attr('disabled','disabled'); // si no descativa el boton de guardado
			}
			

			//  realizamos el calculo total para pintarlo en pantalla de los detalle del pago al empleado
			// para facilitar la sumatoria
			var combos_val_pago = $("input[name='arr_num_valor[]");
			var val_total_pago = 0;
			$(combos_val_pago).each(function(index,element){
				// limpia el valor de comas
				var value_this = (element.value + '').replace(/[^0-9]/g, '');
				// realiza la sumatoria de los campos numericos
				val_total_pago = Number(val_total_pago) + Number(value_this);
			})
			
			// elemento donde se pinta el total
			$('#val_total_detalle_pago').text(formato_numero(val_total_pago));

		}) // fin funcion


		
		// inicio funcion
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
<? }else if($ind_activo == 0){ ?>
	<div>
		<p>El empleado seleccionado se encuentra inactivo en el sistema</p>
	</div>
<? } 
exit;
?>