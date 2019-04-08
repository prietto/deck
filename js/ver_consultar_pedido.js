

/*=====2008/06/02==================================================>>>>
DESCRIPCION: 	permite modificar un registro especifico
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function ver_registro(cod_pk){
	f= document.form1;
	f.target				= '_self';
	f.cod_pk.value			= cod_pk;
	navegar_limpiando_variables(1100);
}


// cambia la ruta por default para mostrar plantilla personalizada
$(function(){
	$('#enter2').removeAttr('onclick').click(function(){
		navegar_limpiando_variables(1100);
	});

})


/*===== 2014/10/17 ==========================================================>>>>
DESCRIPCION: 	Metodo  para generar tiquete de compra de los pedidos seleccionados en el reporte
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_genera_recibo_pago(){
	
	var seleccionados =	$('input[name="reg_seleccionado[]"]:checked').length;

	if(seleccionados < 1){
		var data = "Por favor seleccione un pedido y a continuacion intente nuevamente";

	}
	//else data = "<div style='margin:20px;'>Se ha enviado informacion a la impresora <br><br><br> <img src='../../imagenes/sistema/loading.gif' /></div>";
	
	/*$.ventana_proceso({
			data : data,
			accion: "open",
			width: 300,
			height:200,
			text_align: "center"
			
		})*/
		
	if(seleccionados < 1){
		return false;
	}
	
	f				= document.form1;
	f.target 		= '_blank';
	document.form1.cod_navegacion.value=1064;
	document.form1.action="../principal/controlador.php";
	document.form1.submit();
	f.ind_buscar.value = 1;
	f.target 		= '_self';
	
	setTimeout(function() {navegar(78);},1000);
	
	
}
/*
function f_genera_recibo_pago(){
	
	var seleccionados =	$('input[name="reg_seleccionado[]"]:checked').length;

	if(seleccionados < 1){
		var data = "Por favor seleccione un pedido y a continuacion intente nuevamente";

	}
	else data = "<div style='margin:20px;'>Se ha enviado informacion a la impresora <br><br><br> <img src='../../imagenes/sistema/loading.gif' /></div>";
	
	$.ventana_proceso({
			data : data,
			accion: "open",
			width: 300,
			height:200,
			text_align: "center"
			
		})
		
	if(seleccionados < 1){
		return false;
	}


	navegar_ajax(1060,null);		
	
}*/

/*=====2010/03/18==========================================================>>>>
DESCRIPCION: 	oculta un video especifico
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_generar_factura(){
	f				= document.form1;
	f.target 		= '_blank';
	document.form1.cod_navegacion.value=1026;
	document.form1.action="../principal/controlador.php";
	document.form1.submit();
	f.ind_buscar.value = 1;
	f.target 		= '_self';
	$('input[name="reg_seleccionado[]"]').attr('checked',false);
	
	setTimeout(function() {navegar(78);},1000);
}

/*===== 2014/08/12 ========================================================>>>>
DESCRIPCION: 	Metodo para anular un pedido
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_pagar_pedido(){
	f = document.form1;
	
	navegar(1058);
}

/*===== 2014/08/12 ========================================================>>>>
DESCRIPCION: 	Metodo para anular un pedido
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_anular_pedido(){
	

	// cuenta cuantos checkbox han sido seleccionados	
	var num_check = $("input[name='reg_seleccionado[]']:checked").length;
	
	if(num_check < 1){
		alert('Seleccione al menos un registro');
		return false;
	}else if(num_check > 1){
 	 	alert('Seleccione solamente un pedido');
		return false;
	}
	
	$("input[name='reg_seleccionado[]']:checked").each(function(index,element){
		
		var cod_pedido = $(element).val();		
		navegar_ajax_variables(1065,element,'cod_tabla',20,'cod_pk',cod_pedido);
		
	});
	
	
	
	
	

}




/*===== 2014/08/12 ========================================================>>>>
DESCRIPCION: 	Metodo para pintar o ejecutar funciones despues de respuesta del servidor
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_pinta_datos_salida(data,cod_navegacion,obj_accionado){
	
	if(cod_navegacion == 1057){ // cuando complete la anulacion de pedido navega sobre si mismo
	//alert(data);
	//$('#respuesta_servidor').append(data);
		if(data != ''){
			//alert(data);		
		}else{
			f = document.form1;
			f.ind_buscar.value = 1;
			navegar(78);
		}
	}
	
	else if(cod_navegacion == 1060){

		$.ventana_proceso({
			data : data
		})
		//alert(data);
	}else if(cod_navegacion == 1065){
		var data = JSON.parse(data); // parseamos el array json para ser manipulado 
		var cod_factura = data.cod_factura;

		if(cod_factura != null){
			$.ventana_proceso({
				accion: 'open',
				data : 'El pedido se encuentra facturado, debe anular primero la factura',
				height: 100,
				font_size: 20
			})
		}else{
			
			// LLAMA A LA FUNCION CONFIRM  EJECTUTANDO UN CALLBACK PRIMERO Y DEVOLVIENDO UNA RESPUESTA
			confirm("Esta segur@ que desea anular el/los pedido(s) seleccionado(s)? Este proceso no se puede revertir", function (a) {
				if(a == "si"){ // la funcion callback devuelve un valor dependiendo del boton seleccionado
					// navega para cambiar el estado del pedido y desvincular productos
					navegar_ajax(1057,null);
						
				}else if(a == "no"){
					return false;
				}
			});
		
		}
		
		
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
	
	if(cod_navegacion == 1060){
			
	}
	
}


