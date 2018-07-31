/*=====2016/04/12 ==========================================================>>>>
DESCRIPCION: 	Metodo para anular una compra realizada
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
var f_anular_salida = function($this){

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

	// si existe algun error
	if(error>0){
		modal_deck.open({
			data:data,
			font_size:18			
		},function(){ 
			//==callback()>>
		});
		return false;
	}else{

		// LLAMA A LA FUNCION CONFIRM  EJECTUTANDO UN CALLBACK PRIMERO Y DEVOLVIENDO UNA RESPUESTA
		confirm("Esta segur@ que desea anular la Salida de Insumo? Este proceso no se puede revertir", function (a) {
			if(a == "si"){ // la funcion callback devuelve un valor dependiendo del boton seleccionado
				// si no hay error ejecuta proceso
				navegar_ajax_login(1089,$this);	
					
			}else if(a == "no"){
				return false;
			}
		});

		
	}
	

}



/*===== 2014/08/12 ========================================================>>>>
DESCRIPCION: 	Metodo para pintar o ejecutar funciones despues de respuesta del servidor
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_pinta_datos_salida(data,cod_navegacion,obj_accionado){

	// retorno del proceso para guardar la salida del insumo
	if(cod_navegacion == 1089){
		
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
	if(cod_navegacion == 1089){

	}
	return false;
}