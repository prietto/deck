// funcion para validar y/o consultar si ya se ejecuto la actualizacion de vencimiento de facturacion
$(function(){

	$.ajax({
            type	: "GET",
            url		: "../consulta/ver_consultar_factura.php",
            //data	: {},
			beforeSend: function() {},
			success: function(data) { // devuelve la data del servidor
				
				
				if(data == 1){ // si no se ha realizado la actualizacion el dia de hoy entonces ejecuta el siguiente codigo
					$.ajax({
				    	type	: "GET",
				        url		: "../proceso/actualizar_facturas.php",
				        //data	: {},
						beforeSend: function() {
							// muestra ventana de ejecucion
							var html = "<p>Un momento, se esta actualizando los datos de facturación</p><img src='../../imagenes/sistema/loading.gif' alt='Cargando' />";
							$.ventana_proceso({
								data:html,
								boton_cerrar:false,
								font_size:'18px'
							});

						},
						success: function(data) { // devuelve la data del servidor
							console.log(data);
							var html="<p>Se ha realizado la actualizacion, cierre esta ventana para continuar</p>";

							$.ventana_proceso({
								accion:'close'
							});


							$.ventana_proceso({
								data:html,
								font_size:'18px'
							});


							setTimeout(function(){
								$.ventana_proceso({
									accion:'close'
								});						        

								/*var cod_navegacion_actual = $('input[name="cod_navegacion"]').val();
								var url_actual = window.location.href;
								var a = url_actual.indexOf("controlador.php");
						
								if(a>0){ // la url tien impreso el controlador y se debe recargar la pagina o navegar hacia si mismo
									var cod_navegacion_actual = $('input[name="cod_navegacion"]:hidden').val();
									navegar(cod_navegacion_actual);				
								}else if(a < 0){ // no existe el controlador en la url y puede refrescarse
									window.location = window.location.href;				
								}*/
								location.reload();
								//navegar(cod_navegacion_actual);	                
						    }, 3000);
								
						}
					});
				
				}
			},
			error: function(objeto, que_paso, otro_obj){
				alert("Lo sentimos ha ocurrido un error en la consulta \n intenta nuevamente");
			}
	});

})



/*===== 2014/11/16 ========================================================>>>>
DESCRIPCION: 	Metodo para ver la informacion de una factura
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_ver_menu_registro(cod_pk){

	f= document.form1;
	f.target				= '_self';
	f.cod_pk.value			= cod_pk;
	navegar(1070);	
}



/*=====2013/12/27==========================================================>>>>
DESCRIPCION: 	Muestra pantalla para asociar valores con tipos de atencion
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_imprime_factura(){
	f				= document.form1;
	f.target = "_blank";
	navegar(1025);
	f.target = "_self";
	f.ind_buscar.value = 1;
	
	// debe inhabilitar los checkbox selecionados
	var check_in = $('input[name="reg_seleccionado[]"]:checked');
	
	$(check_in).each(function(index, element) {
		var val_check = $(element).val();
        $(element).attr('checked',false);
		
		// se debe capturar el registro/linea horizontal para simular click de desseleccion
		var tr_row = $('#tr_reg_'+val_check);
		$(tr_row).click();
				
    });
	

	setTimeout(function() {navegar(39);},1000);
	return false;
}	


/*===== 2014/08/12 ========================================================>>>>
DESCRIPCION: 	Metodo para anular una factura
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_anular_factura(this_obj){	

	// cuenta cuantos checkbox han sido seleccionados	
	var num_check = $("input[name='reg_seleccionado[]']:checked").length;
	
	if(num_check < 1){
		alert('Seleccione al menos un registro');
		return false;
	}else if(num_check > 1){
 	 	alert('Por favor seleccione solo una factura');
		return false;
	}
	
	// LLAMA A LA FUNCION CONFIRM  EJECTUTANDO UN CALLBACK PRIMERO Y DEVOLVIENDO UNA RESPUESTA
	confirm("Esta segur@ que desea anular la factura seleccionada? Este proceso no se puede revertir", function (a) {
		if(a == 'si'){ // la funcion callback devuelve un valor dependiendo del boton seleccionado
			// navega para cambiar el estado del pedido y desvincular productos
			navegar_ajax(1067,null);
				
		}else if(a == "no"){
			return false;
		}
	});
}

/*===== 2014/08/12 ========================================================>>>>
DESCRIPCION: 	Metodo para pintar o ejecutar funciones despues de respuesta del servidor
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_pagar_factura(this_obj){
	// cuenta cuantos checkbox han sido seleccionados	
	var num_check = $("input[name='reg_seleccionado[]']:checked").length;
	
	var msj = '';
	
	if(num_check < 1){
		var msj = 'Seleccione al menos un registro';
		
	}else if(num_check > 1){
 	 	var msj = 'Por favor seleccione solo una factura';
	}
	
	$.ventana_proceso({
		data: msj,
		font_size: 20	
	});
	if(msj != '')return false;	 // hay error 
	else navegar_ajax(1068,this_obj); // no hay error y continua
	
}



/*===== 2014/08/12 ========================================================>>>>
DESCRIPCION: 	Metodo para pintar o ejecutar funciones despues de respuesta del servidor
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_pinta_datos_salida(data,cod_navegacion,obj_accionado){
	if(cod_navegacion == 1067){ // cuando complete la anulacion de pedido navega sobre si mismo
	//alert(data);
	//$('#respuesta_servidor').append(data);

		//data = parseInt(data);
		if(data == 0){ //error al intentar anular
			alert('Ocurrio un problema intentando anular la factura, intenta de nuevo');		
		}else if(data == 1){
			$('#enter').click();
		}else{
			$.ventana_proceso({
				data : data,
				height: 100,
				font_size: 20
			})
		
		}
		// MUESTRA VENTANA PARA EL PAGO DE LA FACTURA
	}else if(cod_navegacion == 1068){ 

		
		if(data == 0){ // la factura no tiene saldo que pagar y no deja continuar
			data = 'La factura no tiene saldo que pagarse o ya fue cancelada';
			
			$.ventana_proceso({ // levanta ventana y muestra la repsuesta del servidor
				data: data,
				font_size: 20				
			});
			
			return false;
		}else if(data == 1){
			data = 'La factura no posee pedidos asociados, no es posible continuar';
			
			$.ventana_proceso({ // levanta ventana y muestra la repsuesta del servidor
				data: data,
				font_size: 20				
			});
		
		}else{
			$.ventana_proceso({ // levanta ventana y muestra la repsuesta del servidor
				data: data,
				font_size: 16,
				width: 500
			
			})
		}
		
		
		
	}else if(cod_navegacion == 1069){ // respuesta del proceso de guardar el saldo pagado de la factura
		if(data == 1){ // todo ok!
			$.ventana_proceso({
				accion: 'close'
			});

			$.ventana_proceso({
				data: 'Guardado con exito!'
			});
			$('input[name="reg_seleccionado[]"]').attr('checked',false);
			$('#enter').click();	
		
		}else{
			alert('Ocurrio un problema, por favor intente nuevamente');
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
	
	if(cod_navegacion == 1067){
			
	}
	
}

/*=====2010/03/18====================================Arellano Company===>>>>
DESCRIPCION: 	Metodo para cambiar color de la celda
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
fila			todo el objeto de la fila
num_accion		1=over 2=out 3=click
===========================================================================*/
function f_color_fila(fila,num_accion){

	var color_original = $(fila).data('color');
	
	if(num_accion==3) {
		if($(fila).hasClass("fila_click") == true){ //si esta seleccionada la quita su seleccion
			$(fila).removeClass("fila_click"); //realizo otro click osea que quita la seleccion
			$(fila).css('background-color',color_original);
			elemento_fila = fila.getElementsByTagName('input');	
			//elemento_fila[0].setAttribute('checked',false);		
			elemento_fila[0].checked = false;
		}else{// si no esta seleccionada la selecciona
			$(fila).css('background-color','');
			$(fila).addClass("fila_click");		
			elemento_fila 	= fila.getElementsByTagName('input');				
			
			elemento_fila[0].checked = true;			
		}
	}
	if(fila.className != "fila_click"){ //si la fila no esta seleccionada
		if(num_accion==1){ // el foco esta sobre la fila
			$(fila).css('background-color','');
			$(fila).addClass("fila_over");
		}
		if(num_accion==2){ // sale de la fila pierde el foco
			 $(fila).removeClass("fila_over");	
			if($(fila).hasClass("fila_click") == false) $(fila).css('background-color',color_original);
		}
	}
}

/*=====2014/01/20==========================================================>>>>
DESCRIPCION: 	Funcion para descargar archivo en .csv
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_dscga_rel_ntdad(cod_pk_reporte,cod_periodo_facturacion,cod_entidad){
	f								= document.form1;
	f.target 						= "_blank";
	//ventana_emergente 	= window.open ('',	'SubWind','statusbar,scrollbars,resizable,height=600,width=780, top=100,Left=200');			
	//f.target						= 'frame_oculto';
	f.cod_pk_reporte.value 			= cod_pk_reporte;
	if(cod_periodo_facturacion){f.cod_pk_periodo.value 	= cod_periodo_facturacion;}
	if(cod_entidad){f.cod_entidad_pk.value = cod_entidad;}
	navegar(1044);
	f.target = "_self";
}

/*=====2013/12/30==========================================================>>>>
DESCRIPCION: 	Muestra mensaje de alerta cuando el rango de facturacion ha llegado al tope
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_muestra_mensaje(cadena){
	//f	=	document.form1;	
	//f.ind_limite.value = 1;
	alert(cadena);
	//setTimeout("navegar_limpiando_varibales(39)", 2000);
	//navegar_refresh(39);
}	

/*=====2013/12/27==========================================================>>>>
DESCRIPCION: 	Muestra pantalla para asociar valores con tipos de atencion
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_genera_factura_v2(){
	f				= document.form1;
	f.target 		= '_self';
	navegar(1042);	

	//setTimeout("navegar_limpiando_varibales(39)", 2000);
	//navegar_refresh(39);
}	

/*=====2014/01/13==========================================================>>>>
DESCRIPCION: 	Funcion para descargar archivo en .txt  separado por lo que diga el usuario
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_descargar_txt(cod_pk_reporte,cod_periodo_facturacion,cod_separador,cod_entidad){
	f								= document.form1;
	//f.target 						= "_blank";
	f.target 						= "frame_oculto";
	f.cod_pk_reporte.value 			= cod_pk_reporte;
	f.cod_separador_txt.value 			= cod_separador;
	if(cod_periodo_facturacion){f.cod_pk_periodo.value 	= cod_periodo_facturacion;}
	if(cod_entidad){f.cod_entidad_pk.value 	= cod_entidad;}
	navegar(1041);
	f.target = "_self";
}


/*=====2014/01/10==========================================================>>>>
DESCRIPCION: 	Funcion para descargar archivo en .csv
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_descarga_reporte(cod_pk_reporte,cod_periodo_facturacion,cod_entidad){

	f								= document.form1;
	//f.target 						= "_blank";
	//ventana_emergente 	= window.open ('',	'SubWind','statusbar,scrollbars,resizable,height=600,width=780, top=100,Left=200');			
	f.target						= 'frame_oculto';
	f.cod_pk_reporte.value 			= cod_pk_reporte;
	if(cod_periodo_facturacion){f.cod_pk_periodo.value 	= cod_periodo_facturacion;}
	if(cod_entidad){f.cod_entidad_pk.value = cod_entidad;}
	
	navegar(1040);
	f.target = "_self";
	
}


/*=====2014/01/10==========================================================>>>>
DESCRIPCION: 	Muestra pantalla para asignar IVA a  la(s) factura(s)
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_genera_reportes(){
	f				= document.form1;
	f.target = "_self";
	navegar(1039);


}

/*=====2014/01/09==========================================================>>>>
DESCRIPCION: 	Muestra pantalla para asignar IVA a  la(s) factura(s)
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_genera_impuesto(){
	f				= document.form1;
	f.target = "_self";
	navegar(1037);

}


/*=====2014/01/07==========================================================>>>>
DESCRIPCION: 	Muestra pantalla para asignar descuentos a facturas
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_genera_descuento(){
	f				= document.form1;
	f.target = "_self";

	navegar(1035);

}

/*=====2013/12/31==========================================================>>>>
DESCRIPCION: 	Muestra pantalla para asociar valores con tipos de atencion
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_cambia_estado(){
	f				= document.form1;
	f.target = "_self";
	navegar(1032);

}

/*=====2013/12/31==========================================================>>>>
DESCRIPCION: 	Muestra pantalla para asociar valores con tipos de atencion
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function refresh_page(){
	f.target		= '_self';
	setTimeout("navegar_limpiando_varibales(39)", 2000);
	navegar_refresh(39);

}

/*=====2013/12/30==========================================================>>>>
DESCRIPCION: 	Muestra mensaje de alerta cuando el rango de facturacion ha llegado al tope
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_muestra_advertencia(cadena){
	f	=	document.form1;	
	f.ind_limite.value = 1;
	alert(cadena);
	setTimeout("navegar_limpiando_varibales(39)", 2000);
	navegar_refresh(39);
}	

/*=====2013/12/30==========================================================>>>>
DESCRIPCION: 	Muestra pantalla para asociar valores con tipos de atencion
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_resolucion_dian(){
	f	=	document.form1;
	f.cod_tabla.value	=	14;
	navegar(39);
}	





/*=====2013/12/31==========================================================>>>>
DESCRIPCION: 	Navega
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function navegar_refresh(cod_navegacion){
		document.form1.target="_self"
//		document.form1.ind_limpiar_variables.value = 1;
		document.form1.ind_buscar.value = 1; // para que el sistema sepa que debe borrar la posible basura
		navegar(cod_navegacion)
}	


/*=====2013/12/27==========================================================>>>>
DESCRIPCION: 	Muestra pantalla para asociar valores con tipos de atencion
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_genera_factura(){
	f				= document.form1;
	//f.target 		= '_blank';
	f.target 		= 'frame_oculto';
	navegar(1026);	
	f.target		= '_self';
	//setTimeout("navegar_limpiando_varibales(39)", 2000);
	//navegar_refresh(39);
}	

/*=====2013/12/19==========================================================>>>>
DESCRIPCION: 	Muestra pantalla para asociar valores con tipos de atencion
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_asignar_valores(){
	f			= document.form1;
	f.cod_tabla_detalle.value = 11;
	f.cod_tabla.value = 1;
	navegar_limpiando_variables(1022);	

}	




/*=====2010/03/18==========================================================>>>>
DESCRIPCION: 	oculta un video especifico
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_close_video(cod_track){
	document.getElementById("video"+cod_track).style.display 				= 'none';	
	document.getElementById("b_ocultar_video_"+cod_track).style.display 	= 'none';	
	document.getElementById("b_ver_video_"+cod_track).style.display 		= 'block';
}

/*=====2010/03/18==========================================================>>>>
DESCRIPCION: 	Muestra un video especifico
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_ver_video(cod_track){
	document.getElementById("video"+cod_track).style.display 				= 'block';	
	document.getElementById("b_ocultar_video_"+cod_track).style.display 	= 'block';	
	document.getElementById("b_ver_video_"+cod_track).style.display 		= 'none';
}
/*=====2010/03/18==========================================================>>>>
DESCRIPCION: 	Metodo para hacer sonar un archivo mp3
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
ind_stop_mp3		= 	0;
id_boton_anterior	=	null;
function f_escuchar_mp3(txt_ruta_mp3, boton_id){
	f							= document.form1;
	boton_sonido				= document.getElementById(boton_id);
	if(boton_id != id_boton_anterior && id_boton_anterior!=null){
		document.getElementById(id_boton_anterior).src = '../../imagenes/sistema/stop_sound.png';
		ind_stop_mp3									= 0;
	}
	if(ind_stop_mp3==1){
		txt_ruta_mp3 			= "";
		ind_stop_mp3			= 0;
		boton_sonido.src		= '../../imagenes/sistema/stop_sound.png';
	}else{
		boton_sonido.src		= '../../imagenes/sistema/sound.png';
		ind_stop_mp3	= 1;
	}

	f.txt_ruta_mp3.value	= txt_ruta_mp3;
	f.target				= 'frame_oculto';
	navegar(77);
	f.target				= '_self';
	id_boton_anterior 		= boton_id;
	//boton_sonido.style.display 	= 'none';
	
//	boton_stop			= document.getElementById("ocultar_boton_mp3");
//	boton_stop.style.display 	= 'block';	
}
/*=====2010/03/18==========================================================>>>>
DESCRIPCION: 	Metodo para mostrar una foto especifica
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function ver_foto(ruta,nom_columna_con_foto){
	f						=	document.form1;
	imagen					= 	document.getElementById("img_registro");
	imagen.src				=	ruta;
	fila					=	document.getElementById('ver_foto');
	fila.style.display 		= 	'block';
	document.form1.eliminar_foto.focus();
	f.nom_columna_con_foto.value=	nom_columna_con_foto;
}
/*=====2010/03/18==========================================================>>>>
DESCRIPCION: 	Metodo para eliminar una foto del sistema
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_eliminar_foto(){
	confirmacion = confirm("Esta foto se eliminara del sistema ¿Desea Continuar?");
	if(confirmacion==true)		navegar(76);
}
/*=====2010/03/18==========================================================>>>>
DESCRIPCION: 	Metodo para ocultar la foto
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_ocultar_foto(ruta){
	fila					=	document.getElementById('ver_foto');
	fila.style.display 		= 	'none';
}

/*=====2010/03/18==========================================================>>>>
DESCRIPCION: 	Metodo para buscar un nombre a partir de un codigo sin listBox
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function ver_valor_iframe(combo){
	
	f									= document.form1;
	//=== Combos donde se retornara la información >>>
	combo_codigo_emergente			= document.getElementById(combo.name);
	combo_texto_nombre_emergente	= document.getElementById("txt_"+combo.name);
	
	if(combo.value == ''){
		combo_texto_nombre_emergente.value = '';
		return false;
	}
	
	/*f.txt_nombre_columna_iframe.value	= combo.name;
	f.target							= 'frame_oculto';
	navegar(42);
	f.target							= '_self';*/
}
/*=====2010/03/18==========================================================>>>>
DESCRIPCION: 	Metodo que se encarga de levantar una lista de valores a partir 
				de un codigo de navegacion
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
ventana_emergente_activa		=0;
combo_codigo_emergente			="";
combo_texto_nombre_emergente	="";
cod_ventana_emergente_anterior	=0;
function ver_lista_valor(cod_ventana_emergente,txt_nombre_combo){
	f	=	document.form1;
	//=== Combos donde se retornara la información >>>
	combo_codigo_emergente			= document.getElementById(txt_nombre_combo);
	combo_texto_nombre_emergente	= document.getElementById("txt_"+txt_nombre_combo);
	
	//=== hace que se refresque la ventana emergente >>>
	if(cod_ventana_emergente_anterior != cod_ventana_emergente){
		ventana_emergente_activa 		= 0; 	
		cod_ventana_emergente_anterior 	= cod_ventana_emergente;	
	}
	//=== hace que se refresque la ventana emergente >>>
	if(ventana_emergente_activa == 0){
		ventana_emergente 	= window.open ('',	'SubWind','statusbar,scrollbars,resizable,height=600,width=780, top=100,Left=200');			
		f.target						= 'SubWind';
		f.cod_ventana_emergente.value 	= cod_ventana_emergente;
		add_input('ind_limpiar_ord','hidden',1);
		navegar(43);
		f.target						= '_self';
		ventana_emergente.focus();
		ventana_emergente_activa		=1;
	}else{
		ventana_emergente.focus();
	}

}

/*=====2008/06/01==========================================================>>>>
DESCRIPCION: 	Metodo que sera llamado desde una lista de valores para vajar
				el registro seleccionado
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
valor			cadena separada por comas que contiene todo un registro resultado
				de una consulta
===========================================================================*/
function cargar_reg_emergente(){
	parametros							= cargar_reg_emergente.arguments;
	f									= document.form1;				//alias del formulario	
	combo_codigo_emergente.value		= parametros[0];
	combo_texto_nombre_emergente.value	= parametros[1];	
	window.focus();
	ventana_emergente.close();
}
/*=====2005/05/26========================================================>>>>
DESCRIPCION: 	se encarga de indicar que la ventana emergente sigue abierta
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function cerrar_venana_emergente(){
	ventana_emergente_activa = 0;
}
/*=====2005/05/26========================================================>>>>
DESCRIPCION: 	se encarga de indicar que la ventana emergente sigue abierta
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function activar_ventana_emergente(){
	ventana_emergente_activa = 1;
}
function f_ordenar_por(ord_por){
	f=document.form1;
	f.ord_por.value = ord_por;
	f_enter();
}
f = document.form1;

function f_enter(){

	f					= document.form1;
	f.ind_buscar.value 	=	1;
	if(f.ind_imprimir_reporte.checked == true){
		f.target = "_blank";
		navegar(41);
		f.target = "_self";
	}else{
		f.enter.disabled = true;
		navegar(39);
	}
}

function f_esc_autorizacion(){
	f				= document.form1;
	f.esc.disabled 	= true;
	f.ind_buscar.value = 1;
	f.cod_tabla.value = 8;
	f.cod_tabla_detalle.value = 12;
	navegar(78);
}

function f_esc(){
	f				= document.form1;
	f.esc.disabled 	= true;
	navegar_limpiando_variables(36);
}
/*=====2008/06/02==================================================>>>>
DESCRIPCION: 	cambia a la pagina seleccionada
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function seleccionar_pagina(num_pagina){
	f= document.form1;
	f.target				= '_self';
	f.num_pagina.value		= num_pagina;
	f_enter()
}
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
	navegar_limpiando_variables(1031);
}

/*
function  evalua_tecla_body(cuerpo ,evento){
	alert();
	//======== evaluacion de las teclas ===========>>>>>
	var enter			= 13;
	var tecla_presionada= (window.Event) ? evento.which : evento.keyCode; //captura la tecla que fue precionada
	if(tecla_presionada== enter) navegar(13)
}
*/
/*=====2008/06/02==================================================>>>>
DESCRIPCION: 	Salta a la pagina para la creacion de un nuevo registro
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_nuevo_registo(){
	navegar_limpiando_variables(37);
}// JavaScript Document