/*=====2010/03/18====================================Arellano Company===>>>>
DESCRIPCION: 	Metodo para 
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
var ver_ultimos_movimientos = function($this){

	var selected =	$('input[name="reg_seleccionado[]"]:checked').length;
	var data;
	var error=0;

	if(selected < 1){
		data = 'Seleccione un registro';
		error++;
	}else if(selected > 1){
 	 	data = 'Seleccione solamente un registro';
 	 	error++;
	}

	if(error>0){
		modal_deck.open({
			data:data
			
		},function(){
			//modal_deck.close();

		});
		return false;
	}else{
		navegar_ajax_return(1094,function(a){
			modal_deck.open({
				data:a,
				width:'auto',
				height:'auto'
			},function(){
				// al terminar de abrir la ventana

			});
		});	

		
	}


}


/*=====2016/04/12 ==========================================================>>>>
DESCRIPCION: 	Metodo para anular una compra realizada
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_genera_salida($this){

	var selected =	$('input[name="reg_seleccionado[]"]:checked').length;
	var data;
	var error=0;

	if(selected < 1){
		data = 'Seleccione un registro';
		error++;
	}else if(selected > 1){
 	 	data = 'Seleccione solamente un registro';
 	 	error++;
	}

	/*$.ventana_proceso({
		data: data
	});*/

	

	if(error>0){
		modal_deck.open({
			data:data
			
		},function(){
			//modal_deck.close();

		});
		return false;
	}else{
		navegar_ajax(1088,$this);	
	}
} // fin funcion




/*===== 2014/08/12 ========================================================>>>>
DESCRIPCION: 	Metodo para pintar o ejecutar funciones despues de respuesta del servidor
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_pinta_datos_salida(data,cod_navegacion,obj_accionado){

	// retorno del proceso para guardar la salida del insumo
	if(cod_navegacion == 1087){
		
		// caotura el objeto JSON  que llega desde php
		var obj_json = $.parseJSON(data);

		var code = obj_json.code;
		var msj = obj_json.msj;

		//==abre ventana modal>>
		modal_deck.open({
			data:msj		,	
			width:'auto'	,	
			height:'auto'
		},function(){ //==callback despues de abrir>>
			if(code == 0){
				setTimeout(function(){ 				
					modal_deck.close(function(){ //==callback despues de cerrar la ventana
						$('input[name="reg_seleccionado[]"]').attr('checked',false);
						$('#enter').click();

					});
	    		}, 1200);
			}// fin if
		}) // fin funcion metodo
	} // fin if

	// MUESTRA VENTANA FORMULARIO SALIDA INSUMO !!!!!
	else if(cod_navegacion == 1088){
		modal_deck.open({
			data:data,
			width:'auto',
			height:'auto',
			font_size:14

		});

	}
	return false;
}


/*===== 2014/08/12 ========================================================>>>>
DESCRIPCION: 	Metodo para pintar imagen de cargando antes de completar el procesos
				en el servidor esta funcion es por pantalla o por archivo
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_pinta_loading_salida(cod_navegacion,obj_acccionado,img_loading){
	if(cod_navegacion == 1087){

	}else if(cod_navegacion==1088){

	}
}