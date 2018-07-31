/*=====2016/04/05 ==========================================================>>>>
DESCRIPCION: 	Metodo para anular una compra realizada
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_anula_pedido_compra($this){
	var selected =	$('input[name="reg_seleccionado[]"]:checked').length;
	var data;
	var error;

	if(selected < 1){
		data = 'Seleccione un registro';
		error++;
	}else if(selected > 1){
 	 	data = 'Seleccione solamente un registro';
 	 	error++;
	}

	$.ventana_proceso({
		data: data
	});

	if(error>0)return false;

	// continua si todo va bien
	// debe consultar si la compra se puede anular
	// si la cantidad comprada existe en bodega para retirarla
	navegar_ajax(1085,$this);
}

/*===== 2016/04/05 ==========================================================>>>>
DESCRIPCION: 	Metodo para dar ingreso a la mercancia(insumos) comprados a bodega
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_ingresar_compra($this){
	


}


/*===== 2014/08/12 ========================================================>>>>
DESCRIPCION: 	Metodo para pintar o ejecutar funciones despues de respuesta del servidor
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_pinta_datos_salida(data,cod_navegacion,obj_accionado){

	// navegacion para mostrar el detalle a anular
	if(cod_navegacion == 1085){
		$.ventana_proceso({
			data : data,
			width: 'auto',
			//height:200,
			text_align: "center"
			//font_size: 20
			
		})
	}
	// proceso para anular
	else if(cod_navegacion == 1086){
		console.log(data);
		// existen problemas para anular
		if(data == 0){
			var msj = 'No se puede completar el proceso, probablemente no existe la cantidad en bodega para continuar';
			$.ventana_proceso({
				data:msj,
				width:'auto',
				text_align:'center'
			})
		}else if(data == 1){
			var msj = '!Proceso exitoso¡';
			$.ventana_proceso({
				data:msj,
				width:'auto',
				text_align:'center'
			})

			// debe quitar los registros seleccionados
			$('input[name="reg_seleccionado[]"]').attr('checked',false);

			// refresca la pagina
			setTimeout(function() {
				f = document.form1;
				f.ind_buscar.value = 1;
				navegar(78);
			},1000);
		}

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
	if(cod_navegacion == 1085){

	}else if(cod_navegacion == 1086){

	}

	return false;

}