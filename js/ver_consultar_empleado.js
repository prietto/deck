
/*===== 2016/02/07 ==========================================================>>>>
DESCRIPCION: 	Metodo mostrar detalle de un pago realizado a un empleado
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
$(function(){
	$('body').delegate('.print_recibo_pago','click',function(e){
		e.preventDefault();
		var cod_empleado_pago = $(this).data('pk');

		f_imprimir_recibo(cod_empleado_pago);

	})
})


/*===== 2016/02/07 ==========================================================>>>>
DESCRIPCION: 	Metodo para imprimir un recibo de pago para un empleado
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO			DESCRIPCION 
cod_empleado_pago	codigo pk del recibo para la impresion
===========================================================================*/
function f_imprimir_recibo(cod_empleado_pago){

	if(!cod_empleado_pago){
		alert('Ha ocurrido un error intentando procesar la solicitud');
		return false;
	}

	f					= document.form1;
	f.target 			= "_blank";
	add_input('cod_empleado_pago','hidden',cod_empleado_pago);		
	navegar(1082);				
	f.target 			= "_self";
	f.ind_buscar.value 	= 1;
}


/*===== 2016/02/07 ==========================================================>>>>
DESCRIPCION: 	Metodo mostrar detalle de un pago realizado a un empleado
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
$(function(){
	$('body').delegate('.ver_detalle_pago_empleado','click',function(e){
		e.preventDefault();

		var cod_empleado_pago = $(this).data('pk');


		navegar_ajax_variables(1083,$(this),'cod_empleado_pago',cod_empleado_pago);
	})

})



/*===== 2015/12/30 ==========================================================>>>>
DESCRIPCION: 	Metodo para consultar el historial de pagos registrados
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_ver_historial_pago(this_obj){
	var selected =	$('input[name="reg_seleccionado[]"]:checked').length;

	if(selected < 1){
		var data = "Por favor seleccione un empleado y a continuación intente nuevamente";
		
		$.ventana_proceso({
			data : data,
			accion: "open",
			//width: 300,
			//height:200,
			text_align: "center",
			font_size: 20
			
		})
		return false;
	}else{
		navegar_ajax(1081,this_obj); // no hay error y continua
	}
}


/*===== 2015/12/30 ==========================================================>>>>
DESCRIPCION: 	Metodo para registar el pago a un empleado por medio de ajax y ventana modal
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_pago_nomina(this_obj){
	var selected =	$('input[name="reg_seleccionado[]"]:checked').length;

	if(selected < 1){
		var data = "Por favor seleccione un empleado y a continuación intente nuevamente";
		//alert(data);
		
		$.ventana_proceso({
			data : data,
			accion: "open",
			//width: 300,
			//height:200,
			text_align: "center",
			font_size: 20
			
		})
		return false;
	}else{
		navegar_ajax(1079,this_obj); // no hay error y continua
	}
	
}


/*===== 2014/08/12 ========================================================>>>>
DESCRIPCION: 	Metodo para pintar o ejecutar funciones despues de respuesta del servidor
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_pinta_datos_salida(data,cod_navegacion,obj_accionado){
	if(cod_navegacion == 1079){ // pago a un empleado (ventana modal)
		


		$.ventana_proceso({ // levanta ventana y muestra la repsuesta del servidor
			data: data,
			font_size: 16,
			width: 500
		
		})
		
	
	}else if(cod_navegacion == 1080){
		
		// caotura el objeto JSON  que llega desde php
		var obj_json = $.parseJSON(data);
		
		var a = obj_json.data;
		var printer = obj_json.printer;

		if(a=='error'){
			alert('Ocurrio un problema, por favor intente nuevamente');
			return false;
		
		}else{ // todo ok!
			$.ventana_proceso({
				accion: 'close'
			});

			$.ventana_proceso({
				data: 'Guardado con exito!'
			});

			$('input[name="reg_seleccionado[]"]').attr('checked',false);
			
			// ==================================================================
			// si el usuario desea imprimir el recibo
			if(printer == 1){
				f_imprimir_recibo(a);
			};
			// ==============================================


			// frena la accion de dar click en el boton de consulta para permitir que el sistema
			// muestre ventana de impresion
			setTimeout(function(){ 				
				$('#enter').click();	
    		}, 1200);
			
		} // fin else
		
	}else if(cod_navegacion == 1081){
		//console.log(data);
		$.ventana_proceso({
			data : data,
			accion: "open",
			width: 'auto',
			//height:200,
			text_align: "center"
			//font_size: 20
			
		})
	}else if(cod_navegacion == 1083){

		// MUESTRA EL DETALLE DEL PAGO SELECCIONADO

		$.ventana_proceso({
			data : data,
			width: 'auto',
			//height:200,
			text_align: "center"
			//font_size: 20
			
		})


	}
}


/*===== 2014/08/12 ========================================================>>>>
DESCRIPCION: 	Metodo para pintar imagen de cargando antes de completar el procesos
				en el servidor esta funcion es por pantalla o por archivo
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_pinta_loading_salida(cod_navegacion,obj_acccionado,img_loading){
	
	if(cod_navegacion == 1079){
			
	}else if(cod_navegacion == 1080){
	
	}else if(cod_navegacion == 1081){
	
	}else if(cod_navegacion == 1083){

	}
	
}