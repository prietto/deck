/*===== 2015/03/10 ========================================================>>>>
DESCRIPCION: 	Metodo para eliminar un pago realizado por un usuario
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function p_eliminar_pago($this,evt){
	//evt.preventDefault();
	
	var cod_pago 	= $($this).data('pago');
	var value_pago	= $($this).data('valor');
	
	confirm("¿Esta segur@ que desea eliminar el pago, este proceso no tiene reversa?", function (a) {
		if(a == "si"){ // la funcion callback devuelve un valor dependiendo del boton seleccionado
			var ajax = $.ajax({
				type	: "GET",
				url		: "../proceso/eliminar_factura_pago.php",
				data	: {cod_factura_pago:cod_pago},
				beforeSend: function() {},
				success: function(data) { // devuelve la data del servidor
					console.log(data);
					if(data == 1){
						$('#row_pago_'+cod_pago).remove();
						
						// debe recalcular los valores
						var value = 0;
						$('.pago_factura').each(function(index,element){
							var value_element = $(element).text();
							var value_limpio = replace_all(value_element,',','');
							
							value += Number(value_limpio);
						});
						
						var val_saldo = replace_all($('#total_saldo').text(),',','');
						var new_saldo	= Number(val_saldo) + Number(value_pago);
						
						$('#total_saldo').text(formato_numero(new_saldo));
						
						$('#val_total_pagos').text(formato_numero(value));
						
						alert('Proceso completado correctamente');
						navegar(1070);
						return false;
						
						
					}else{
						alert('Ha ocurrido un problema');
					}
				},
				error: function(objeto, que_paso, otro_obj){
					alert("Lo sentimos ha ocurrido un error en la consulta \n intenta nuevamente");
				}
			});
			
		}else if(a == "no"){
			return false;
		}
	});
	
	
	
}