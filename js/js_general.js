var ventana_emergente = null;


$.datepicker.regional['es'] = {
 closeText: 'Cerrar'	,
 prevText: '<Ant'		,
 nextText: 'Sig>'		,
 currentText: 'Hoy'		,
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
 weekHeader: 'Sm'			,
 dateFormat: 'yy/mm/dd'		,
 firstDay: 1				,
 isRTL: false				,
 showMonthAfterYear: false	,
 yearSuffix: ''
 };
 
 $.datepicker.setDefaults($.datepicker.regional['es']);

 



//==== INIT FUNCTION: for init sideBar show/hide by cookie ==> 
$(document).ready(function () {
	$('#sidebarCollapse').on('click', function (e) {
		e.preventDefault();

		$('#sidebar').toggleClass('active');	
		let x = $.cookie('sideBarMenu');
		let test = (x=="true")?false:true;
		$.cookie("sideBarMenu", test);
	});
});
         


/*=====2014/12/10 ==========================================================>>>>
DESCRIPCION: 	Metodo para validar los campos numericos
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
$(function(){
	var input_numerico = $('input[type="number"]');
})

/*=====2014/12/10 ==========================================================>>>>
DESCRIPCION: 	Metodo para mostrar imagen de cargando a nivel de toda la pantalla
				bloqueando posibles movimientos mientras se genera un proceso
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
var txt_id_overlay = "overlay";
var new_num_id_overlay = 0;
function f_crea_loading_pantalla(accion,id_overlay_close='overlay_0'){



	var url_loading 	= "../../imagenes/sistema/loading.gif";
	var img_loading		= "<img src='"+url_loading+"' title='Cargando...' >";
	var div_overlay = '<div class="overlay" id="overlay"></div>';

	// se debe validar si la ventana modal esta abierta, de ser asi se debe crear 
	// un diferente overlay ej. overlay_2


	
	if(accion == 'open'){
		// existe ventana modal activa ==>>
		if($('.overlay').length>0){

			var num_overlays 	= $('.overlay').length;
		
			new_num_id_overlay 	= new_num_id_overlay+1;
			
			var new_txt_id_overlay 	= txt_id_overlay+"_"+new_num_id_overlay;
			
		}else{
			// de lo contrario si no existe ventana abierta ==>
			var new_txt_id_overlay	= "overlay_0";
			new_num_id_overlay = 0;
			
		}

		// pinta pantalla de carga ===>
		$('body').append($('<div />',{'id':new_txt_id_overlay,'class':'overlay'})).children().last().each(function(){
			$('#overlay').css({'background-image':'url(../../imagenes/sistema/loading.gif)','background-repeat':'no-repeat','background-position':'center'});
			//$(this).append(img_loading);
		})
	

	}else if(accion == 'close'){
		
		// nuevo id para borrar
		var id_close = txt_id_overlay+"_"+new_num_id_overlay; 
		
		$('#'+id_close).remove();

	}

	



} 


/*=====2014/12/10 ==========================================================>>>>
DESCRIPCION: 	Metodo para leer las cookies
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
var leer_cookie = function(key){
    keyValue = document.cookie.match("(^|;) ?" + key + "=([^;]*)(;|$)");
	if (keyValue) {
        //console.log("getCookie: " + key + "=" + keyValue[2]);
        return keyValue[2];
    } else {
       // log("getCookie: " + key + "=" + "null");
        return null;
    }
}


/*=====2014/12/10 ==========================================================>>>>
DESCRIPCION: 	Metodo para crear cookie de javascript
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
var crear_cookie = function(name, value){
	eliminar_cookie(name);	
    document.cookie= name+"="+value+"; path=/";
	return false;
}

/*=====2014/12/10 ==========================================================>>>>
DESCRIPCION: 	Metodo para eliminar una cookie
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function eliminar_cookie(name){

	path = "/";
	document.cookie=name+"="+((path==null)?"":";path="+path)+";expires=Thu,01-Jan-70 00:00:01 GMT";
	return false;
}


function f_seleccionar_todos(chkbox){
	for (var i=0;i < document.forms[0].elements.length;i++){
		var elemento = document.forms[0].elements[i];
		if (elemento.type == "checkbox"){
			elemento.checked = chkbox.checked
		}
	}	
	$('.tabla_reporte tbody > tr').click();
}


var f_mostrar_todo = function(){
	add_input('ind_mostrar_todo','hidden',1);
	f_enter();
}


// funcion para situar el scroll siempre abajo en el iframe de backup
$(function(){
	

	//var altura = $('#conversacion').prop("scrollHeight");
	//$('#conversacion').scrollTop(altura);
	
});

var mover_scroll_iframe = function(){
//	var altura = $('#frame_oculto').prop("scrollHeight");
	var iframe = $('#frame_oculto');
	var myIframe = document.getElementById('frame_oculto');
	myIframe.contentWindow.scrollTo(0,10000);
	//var altura = $('#frame_oculto').height();
	
	//$('#frame_oculto').scrollTop(altura);
}


/*===== 2014/08/27 ==========================================================>>>>
DESCRIPCION: 	Metodo para generar un backup ejecutando un archivo .bat
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/	
function f_genera_backup($this){
	$("html, body").animate({ scrollTop: $('#frame_oculto').height() }, 1000);
	
	var myIframe = document.getElementById('frame_oculto');
	myIframe.onload = function(){
	    myIframe.contentWindow.scrollTo(0,100000);
		$.ventana_proceso({
			data:'Backup Terminado'
		});
		return false;
	};
	
	// carga la funcion una vez es cargada una conversacion
	//setInterval("mover_scroll_iframe()",800);
	$('#frame_oculto').show('slow');
	$('#frame_oculto').attr('src','../proceso/genera_backup.php');
	
	return false;
	f = document.form1;
	f.target = "frame_oculto";
	navegar(1073)	
	//navegar_ajax_variables(1073,$this);
	f.target = "_self";

}


/*===== 2014/08/27 ==========================================================>>>>
DESCRIPCION: 	Metodo para enviar accion de ordenamiento
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/	
function f_ordenar_por_V2(this_obj,ord_por){

	f=document.form1;
	
	var estado_ord = $(this_obj).data('estado');
	if(estado_ord == '' || estado_ord == null || estado_ord == "desc"){
		ord_por 	= ord_por+" asc";
		estado_ord	= "asc";
		// si esta vacio primero ordena ASC (ascendentemente)
		add_input('ord_por','hidden',ord_por);		
				
	}else if(estado_ord == "asc"){
		ord_por 	= ord_por+" desc";
		estado_ord	= "desc";
		add_input('ord_por','hidden',ord_por);		
		
	}
	add_input('estado_ord','hidden',estado_ord);		
	
	f_enter();
}


//FUNCION QUE SE EJECUTA CUANDO LA PAGINA HA SIDO CARGADA
/*$(function(){
	$(document).tooltip({
		show: { effect: "blind", duration: 200,delay:500 },
		tooltipClass: "custom-tooltip-styling",
		//position: {  my: "right bottom+50" }
		position: { my: "left+15 center", at: "right center" }
		
	});
})*/

// ================================== ==>>
// =================================================================




var num_peticion = 0;

var funcion_teclas = function(e){
	


	num_peticion++;
	e.preventDefault();
	e.stopPropagation();
	tecla_presionada = e.which;
	
	//console.log(tecla_presionada+" -- "+num_peticion);
	//return false;
	
	if(tecla_presionada== 13 ){
		f_enter();
		//$('#form1').submit();
	}else	if(tecla_presionada == 27){
		f_esc();
	}
}


$(function(){
	/*$('body').on('keyup.body_tecla', function(e){
		tecla_presionada = e.which;
		if(tecla_presionada== 13 ){
			f_enter();
		}else	if(tecla_presionada == 27){
			f_esc();
		}	
	});*/
	$('body').bind('keyup',funcion_teclas);
})


function recibir_dato(data,nom_elemento_dom){
	// parsea el vector que llega para volverlo objeto json
	var 	element = $('input[name="'+nom_elemento_dom+'"]');
	
	$(element).val(data);
	$(element).blur();
	$(element).change();
	ver_valor_onblur(element);
}


function cerrar_sesion(){
	f=document.form1;
	f.ind_cierre_sesion.value = 1;
	//var txt_url = "../plantilla/ver_validad_usuario.php";
	window.location = "../proceso/logout.php";
	//navegar(1054);
}

/*=====2014/11/13==========================================================>>>>
DESCRIPCION: 	Metodo para limpir un campo, se pasa el nombre del campo o id por parametro
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function limpiar_campos(id_combo){
	if($('#'+id_combo).length >0){ // si existe si lo borra
		$('#'+id_combo).val('');
		$this = $('#'+id_combo);
	}
}

/*=====2014/08/12==========================================================>>>>
DESCRIPCION: 	MEtodo para crear dinamicamente un input
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function add_input(name,type,value){

	var formulario 	= $('#form1');
	var div_pinta	= $('#new_inputs');
	
	if($('#name').length > 0)return false; // ya existe el campo o elemento
	
	var new_input = '<input type="'+type+'" name="'+name+'" id="'+name+'" value="'+value+'" >';
	$(formulario).append(new_input);
	return true;
}


/*=====2014/07/22==========================================================>>>>
DESCRIPCION: 	Metodo para ordenar la descarga del reporte actual en archivo plano de excel
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_exportar_excel(cod_navegacion_actual,e){
	e.preventDefault();
	
	if($('input[name="ind_exportar_escel"]').length < 1){ // no existe el input se crea
		add_input('ind_exportar_excel','hidden',1);
	}
	f = document.form1;
	//f.ind_buscar.value = 1;	
	f.target = "frame_oculto";
	navegar(cod_navegacion_actual);
	$('input[name="ind_exportar_excel"]').remove();
	f.target = "_self";
	return false;
}


/*=====2014/07/22==========================================================>>>>
DESCRIPCION: 	MEtodo para consulta dato de acuerdo al script en la columna tabla autonoma
				en tiempo real a traves de ajax
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function ver_valor_onblur(this_obj){
	
	var value_obj = $(this_obj).val();
	
	if(value_obj == ''){
		return false;	
	}

	f								= document.form1;
	//=== Combos donde se retornara la información >>>
	combo_codigo_emergente			= $(this_obj).attr('name');
	combo_texto_nombre_emergente	= $('input[name="txt_'+combo_codigo_emergente+'"]');
		
	if(value_obj == ''){
		$(combo_texto_nombre_emergente).val('');
		return false;
	}

	f.txt_nombre_columna_iframe.value	= combo_codigo_emergente;
	//f.target							= '_blank';
	f.target							= 'frame_oculto';
	navegar(42);
	f.target							= '_self';
	
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
function cargar_dato_emergente(){
	
	parametros							= cargar_dato_emergente.arguments;
	f									= document.form1;				//alias del formulario	
	//combo_codigo_emergente.value		= parametros[0];
	
	if(parametros[0] == ''){
		return false;
	}
	
	$(combo_texto_nombre_emergente).val(parametros[1]);
	$('input[name='+combo_codigo_emergente.id+']').val(parametros[0]);

	window.focus();
	if(ventana_emergente != undefined)ventana_emergente.close();

	//cargar_data("[id=cod_proveedor]");

}

/*=====2014/07/22==========================================================>>>>
DESCRIPCION: 	MEtodo para consulta dato de acuerdo al script en la columna tabla autonoma
				en tiempo real a traves de ajax
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function ver_valor_script_columna(this_obj,e){
	//e.preventDefault();



	var key = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode; 
	var cod_columna_tabla 	= $(this_obj).data('cod_columna');
	var content_result 		= $('#content_result_'+cod_columna_tabla);
	var value_obj 			= 	$(this_obj).val();		
	var nom_combo 			= $(this_obj).attr('id');
	var combo_txt 			= $('#txt_'+nom_combo); // selecciona el combo continuo
		
	if($.trim(value_obj).length < 1){ // si el valor del obj es vacio
		$(content_result).html('');
		$(content_result).empty();
		$(content_result).hide('fast');
		
		// debe vaciar el campo continuo para que no quede con datos si borro el dato primario	
		$(combo_txt).val(''); // vacia el combo/input
		
		return false;
	}

	
	// FUNCIONAMIENTO DE TELCAS  ========================================================
	// ========================
	if (key == 13 || key == 9) {  // tecla ENTER O TAB
		e.preventDefault();
		e.stopPropagation();

		//captura los inputs que cumplan la condicion
		var inputs = $(this_obj).closest('form').find('input, textarea,select').not(':input[type=button], :input[type=submit], :input[type=reset], :input[readonly]');

		// busca el siguiente input segun los indices
		var next_input = inputs.eq( inputs.index(this_obj)+ 1 );


		var obj_seleccionado  = $('.link_seleccionado');
		$(obj_seleccionado).click();
		$(this_obj).blur();

		

		// posiciona el focus sobre el elmeento siguiente
		$(next_input).focus();
		
		return false;
	}else if(key == 38){ // arriba
		if($('.link_seleccionado').length == 0){
			$('#content_wrapper .list_result').last().removeClass("list_result").addClass("link_seleccionado");
			//$('.list_result').first().addClass('link_seleccionado');
			var seleccionado = $('.link_seleccionado');	
			
			// escribe los que selecciona en el input
			$('#buscador_central').val($.trim($(seleccionado).find('div').text()));
		}else{

			//$('.link_contenedor').first().addClass('link_seleccionado');
			var seleccionado = $('.link_seleccionado');	
			
			
			var  anterior = $(".link_seleccionado").prevAll(".list_result").not(".head_line").first();
			
			if($(anterior).length==0){
				$(seleccionado).removeClass("link_seleccionado").addClass("list_result");	
				$('.list_result').last().removeClass("list_result").addClass("link_seleccionado");
				return false;
			}
			
			$(seleccionado).removeClass("link_seleccionado").addClass("list_result");
			$(anterior).removeClass("list_result").addClass("link_seleccionado");
			
			// escribe los que selecciona en el input
			//$('#buscador_central').val($.trim($(anterior).find('div').text()));
			
		}
		
		
		
		
	}else if(key == 40){ // abajo
		//var seleccionado = $('.link_seleccionado');
		//$('#buscador_central').blur();	
		
		if($('.link_seleccionado').length == 0){
			$('.list_result').first().removeClass("list_result").addClass("link_seleccionado");
			//$('.list_result').first().addClass('link_seleccionado');
			var seleccionado = $('.link_seleccionado');
			
			// escribe los que selecciona en el input
			//$('#buscador_central').val($.trim($(seleccionado).find('div').text()));
				
		}else{

			//$('.link_contenedor').first().addClass('link_seleccionado');
			var seleccionado = $('.link_seleccionado');	
			
			var  siguiente = $(".link_seleccionado ~ .list_result:first");
			
			
			/*if($(siguiente).length == 0){
				$('.link_contenedor').first().addClass('link_seleccionado');
				var seleccionado = $('.link_seleccionado');	
				return false;
			}*/
			if($(siguiente).length==0){
				$(seleccionado).removeClass("link_seleccionado").addClass("list_result");	
				$('.list_result').first().removeClass("list_result").addClass("link_seleccionado");
				return false;
			}
			
			$(seleccionado).removeClass("link_seleccionado").addClass("list_result");
			$(siguiente).removeClass("list_result").addClass("link_seleccionado");
			
			// escribe los que selecciona en el input
			//$('#buscador_central').val($.trim($(siguiente).find('div').text()));
			
		}
	}else{
		
		var timeout;
		
	   if(timeout) { clearTimeout(timeout); }
	    timeout = setTimeout(() => {
	    	console.log('hey you!!');
	    	var cod_columna_tabla	=	$(this_obj).data('cod_columna');
			var id_obj				= 	$(this_obj).attr('id');
			navegar_ajax_variables(	1061				,
									this_obj			,
									'cod_columna_tabla'	,
									cod_columna_tabla	,
									'val_campo'			,
									value_obj			,
									'id_obj'			,
									id_obj
									
								);
	    }, 600);
		
		
	
	}
	
	
	
	
}

/*===== 2014/08/27 ==========================================================>>>>
DESCRIPCION: 	Metodo para validar si existe un reporte de no existir muestra alerta
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/	
$(function(){
	
	if($('#cod_reporte_tabla').length == 0 || $('#cod_reporte_tabla option').length == 0){
		
		var msj = "No existe un reporte activo, por favor comuniquese con el administrador del sistema";
		$('#msj_respuesta_servidor').html(msj);		
	}else{ // existe reporte tabla
		
			
	}
	
	
	

})


/*=====2014/07/22==========================================================>>>>
DESCRIPCION: 	MEtodo para levantar ventana modal hecha por deck
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
/*var num_peticion = 0;
jQuery.ventana_proceso = function(opciones_user){
	
	var obj_activo = $(document.activeElement);
	
	


	num_peticion++;
	
	//if(num_peticion == 1){	
		//var tecla_presionada = $(document).keyup(function(evt){
		$(document).bind('keyup.ventana', function(evt){
			if(evt.which == 27){
				$.ventana_proceso({accion: "close"});
				$(document).unbind('keyup.ventana');
				evt.preventDefault();
				return false;
			}
		});
	//}

	
	opciones_default = ({
			width: 			400,
			height:			200,
			titulo:			'Ventana del sistema',
			color_fondo:	'white',
			align_h:		'center',
			align_v:		'center',
			position:		'absolute',
			text_align:		'center'
			
			
		});
	
	opciones = jQuery.extend(opciones_default , opciones_user);

	//var opciones = $.extend($.ventana_proceso.op_default , opciones_user);
	
	var width 		= opciones.width;
	var height		= opciones.height;
	var titulo		= opciones.titulo;
	var color_fondo	= opciones.color_fondo;
	var align_h		= opciones.align_h;
	var align_V		= opciones.align_v;
	var position	= opciones.position;
	var text_align	= opciones.text_align;
	var font_size	= opciones.font_size;
	
	var margin_left = (width/2) - width;
	var margin_top = (height/2) - height;
	var div_overlay = '<div class="overlay" id="overlay"></div>';
	var ventana_interna = "<div id='deck_vt_interna'><div id='block_contenido'></div> <span id='btn_close_vtn_1' style='position:relative; float:right; bottom:5px; right:10px; cursor:pointer;' >CERRAR</span> </div>";
	

	
	
	var data = opciones_user.data;
	if(data != '' && data != undefined){
		opciones_user.accion = 'open';
	}
	
	

	if(opciones_user.accion == 'open' || $('#overlay').length && opciones_user.accion != "close" ){

		$('body').unbind('keyup',funcion_teclas); // frena el funcionamiento de teclas del body

		
		if($('#overlay').length){ // si ya abrio la ventana
			$('#block_contenido').html(data);
			
		}else{

			$('#form1').append(div_overlay);
			var _obj_overlay	= $('#overlay'); // se seleecionan despues de ser pintador en el DOM
			$(_obj_overlay).append(ventana_interna);		
			var _obj_deck_vt_interna = $('#deck_vt_interna');
	
			// añadimos los estilos que estan como opcion
			$('#deck_vt_interna').css({
				"width" : width,
				"min-height" : height,
				"background-color" 	: color_fondo	,
				"position"			: position		,
				"left"				: "50%"			,
				"top"				: "50%"			,
				"margin-top"		: margin_top	,
				"margin-left"		: margin_left	,
				"text-align"		: text_align	



			});
		
		
			$('#deck_vt_interna').addClass('contenido');

			$('#block_contenido').append(data);
			$('#block_contenido').css('font-size',font_size);
			$('#block_contenido').css('min-height',height);			
			$('#block_contenido').css('padding',15);
			//$('#overlay').css('overflow','none');
			
			
			
			
			$('#btn_close_vtn_1').on('click',function(e){
			
				e.stopPropagation();
				$.ventana_proceso({'accion':'close'});
				$(obj_activo).focus();	
			});
		
		}

	}else if(opciones_user.accion == 'close'){
		$('#overlay').remove();	
			
		$('body').bind('keyup',funcion_teclas); // vuelve a poner en funionamiento la funcion de teclas del body
		$(obj_activo).focus();		
	}
	
}*/
/*===== 2017/01/26 ==========================================================>>>>
DESCRIPCION: 	Metodo/WIDGET para levantar ventana modal hecha por deck version 2.0
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
var num_peticion = 0;
var modal_deck = (function(){

	
	var method = {},
		ind_ventana_abierta;


	num_peticion++;	



	method.open = function (opciones_user,callback){
		opciones_default = ({
			width: 			400,
			height:			200,
			titulo:			'Ventana del sistema',
			color_fondo:	'white'		,
			align_h:		'center'	,
			align_v:		'center'	,
			position:		'absolute'	,
			text_align:		'center'	,
			boton_cerrar:	true		,
			appendTo:		'#form1'	,
			colorText:		'black'		,
			afterClose: 	function(result){result();}

			
		});
	
		opciones = jQuery.extend(opciones_default , opciones_user);

		//var opciones = $.extend($.ventana_proceso.op_default , opciones_user);
		
		var width 			= opciones.width;
		var height			= opciones.height;
		var titulo			= opciones.titulo;
		var color_fondo		= opciones.color_fondo;
		var align_h			= opciones.align_h;
		var align_V			= opciones.align_v;
		var position		= opciones.position;
		var text_align		= opciones.text_align;
		var font_size		= opciones.font_size;
		var boton_cerrar	= opciones.boton_cerrar;
		var breakWord		= opciones.breakWord;
		var appendTo		= opciones.appendTo;
		var colorText		= opciones.colorText;
		
		
		// valida si la accion de cerrar la ventana fue enviada
		if(boton_cerrar == true){

			$(document).bind('keyup.ventana', function(evt){
				//var key = evt.which;
				var key = evt.keyCode ? evt.keyCode : evt.which ? evt.which : evt.charCode; 
				
				if(evt.which == 27){ // pulso la tecla "esc"
					//$.ventana_proceso({accion: "close"});
					method.close(function(){
						
					});
					$(document).unbind('keyup.ventana');
					evt.preventDefault();
					return false;
				}
			});
		}else{
			// desactiva los botones de la ventana proceso
			$(document).unbind('keyup.ventana');
		}
		
		// === condiguracion para ubicacion de ventana (evitar sobrepaso de pantalla)
		var height_body 	= $(window).height()-20;
		var width_body		= $(window).width()-20;


		if(height>height_body && height != 'auto')height = height_body; // evitamos que la ventana crezca mas que la ventana
		if(width>width_body && width != 'auto')width = width_body;
		
		var margin_left = (width/2) - width;
		var margin_top = (height/2) - height;
		var div_overlay = '<div class="overlay" id="overlay"></div>';
		var ventana_interna = "<div id='deck_vt_interna'><div id='block_contenido'></div></div>";

		// valida si hay informacion que mostrar en la ventana para abrirla sin necesidad de pasar el parametro de open
		var data = opciones_user.data;
		if(data != '' && data != undefined){
			opciones_user.accion = 'open';
		}
		// frena el funcionamiento de teclas del body
		$('body').unbind('keyup',funcion_teclas); 

		// si la ventana proceso ya esta abierta
		if($('#overlay').length > 0){ 
			//$('#overlay').append(ventana_interna);		
			$('#block_contenido').html(data);

			ind_ventana_abierta = true;

			var _obj_overlay	= $('#overlay'); // se seleecionan despues de ser pintador en el DOM
			$(_obj_overlay).append(ventana_interna);		
			var _obj_deck_vt_interna = $('#deck_vt_interna');
		
		}else{
			ind_ventana_abierta = false;	
			// pinta el overlay en la pantalla
			$(appendTo).append(div_overlay); // AQUI SE ELIJE CUAL SERA EL PADRE DE LA VENTANA MODAL
			var _obj_overlay	= $('#overlay'); // se seleecionan despues de ser pintado en el DOM
			$(_obj_overlay).append(ventana_interna);		
			var _obj_deck_vt_interna = $('#deck_vt_interna'); // OBJETO VENTANA MODAL !!!!

			
			// añadimos los estilos que estan como opcion
			$('#deck_vt_interna').css({
				"width" : width,
				"min-height" : height,
				"background-color" 	: color_fondo	,
				"position"			: position		,
				"left"				: "50%"			,
				"top"				: "50%"			,
				"margin-top"		: margin_top	,
				"margin-left"		: margin_left	,
				"text-align"		: text_align	,
				"z-index"			: 100000000		,
				"color"				: colorText		
				
			});
			
			
			// si la opcion breakWord es true corta las palabras
			if(breakWord == true){
				$('#deck_vt_interna').css({
					"word-break" : "break-all"
				});
			}
			
			$('#deck_vt_interna').addClass('contenido');
			$('#block_contenido').append(data); // PINTA EL CONENIDO DE LA INFORMACION EN LA VENTANA

			$('#block_contenido').css('font-size',font_size);
			$('#block_contenido').css('min-height',height);			
			$('#block_contenido').css('padding',15);
			//$('#overlay').css('overflow','none');


			
		}
		
		
		// calcula el valor del ancho de la ventana y la centra acorde a la pantalla
		var width_auto 			= $(_obj_deck_vt_interna).outerWidth();
		var height_auto			= $(_obj_deck_vt_interna).outerHeight();

		//console.log("width: "+width_auto+" height:"+height_auto+" /// body--> height: "+height_body);
		if(height_auto > height_body){
			$('#deck_vt_interna').css({
				"overflow" : "auto"
			});
			height_auto = height_body;
		}else height_auto = 'auto';
		var margin_left_auto	= (Number(width_auto)/2)-Number(width_auto);
		var margin_top_auto		= (Number(height_auto)/2)-Number(height_auto);
		
		//console.log(width_auto);
		//alert(width_auto+" --> "+margin_left_auto);

		//console.log(margin_left_auto);
		
		$(_obj_deck_vt_interna).css({
			"height"		: 	height_auto,
			"margin-left" 	: 	margin_left_auto,
			"margin-top"	: 	margin_top_auto
		});
			

		
		// debe validar si la ventana ya estaba abierta 
		if(ind_ventana_abierta==false){
			if(boton_cerrar == true){
				txt_boton_cerrar = "<span id='btn_close_vtn_1' style='position:relative; float:right; bottom:5px; right:10px; cursor:pointer;' >CERRAR</span>";
				$('#deck_vt_interna').append(txt_boton_cerrar);
				$('#btn_close_vtn_1').on('click',function(e){
					e.preventDefault();
					
					method.close(function(){
						
					});

				});
			}else{
				$('btn_close_vtn_1').remove();
			}
		}else if(ind_ventana_abierta==true && boton_cerrar==false){
			$('btn_close_vtn_1').remove();
		}

		//valida que exista un callback
		if (callback && typeof(callback) == "function"){
			callback();
		}

		
	} // FIN METODO OPEN


	// INICIO METODO PARA CERRAR VENTANA
	method.close = function(callback2){
		//closeFunction();
		//alert(closeFunction);

		// ejecuta el codigo antes de cerrar la ventana
		opciones.afterClose(function(){

						
			// le da prioridad a la ejecucion de procesos en la llamada de la funcion
			// luego ejecuta el siguiente codigo para cerrar la ventana
			$('#overlay').remove();		
			$('body').bind('keyup',funcion_teclas); // vuelve a poner en funionamiento la funcion de teclas del body
			
			//valida que exista un callback
			if (callback2 && typeof(callback2) == "function"){
				callback2();
			}
		});
		
		
	}		

	return method;

	/*return this.each( function() {
    // Our plugin so far

    	if ( $.isFunction( opciones_user.complete ) ) {
        	opciones_user.complete.call( this );
    	}
	});*/
	
}()); // === FIN WIDGET VENTANA MODAL DECK
// ======================================================================

/*=====2014/07/22==========================================================>>>>
DESCRIPCION: 	MEtodo para levantar ventana modal hecha por deck
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
var num_peticion = 0;
jQuery.ventana_proceso = function(opciones_user){
	
	var ind_ventana_abierta;


	num_peticion++;
	


	opciones_default = ({
			width: 			400,
			height:			200,
			titulo:			'Ventana del sistema',
			color_fondo:	'white'		,
			align_h:		'center'	,
			align_v:		'center'	,
			position:		'absolute'	,
			text_align:		'center'	,
			boton_cerrar:	true		,
			appendTo:		'#form1'	,
			colorText:		'black'
			
		});
	
	opciones = jQuery.extend(opciones_default , opciones_user);

	//var opciones = $.extend($.ventana_proceso.op_default , opciones_user);
	
	var width 		= opciones.width;
	var height		= opciones.height;
	var titulo		= opciones.titulo;
	var color_fondo	= opciones.color_fondo;
	var align_h			= opciones.align_h;
	var align_V			= opciones.align_v;
	var position		= opciones.position;
	var text_align		= opciones.text_align;
	var font_size		= opciones.font_size;
	var boton_cerrar	= opciones.boton_cerrar;
	var breakWord		= opciones.breakWord;
	var appendTo		= opciones.appendTo;
	var colorText		= opciones.colorText;
	
	/*var function_close = opciones.after_close(function(){
		alert('que mas?')
	});*/
	
	// valida si la accion de cerrar la ventana fue enviada
	if(boton_cerrar == true){
		$(document).bind('keyup.ventana', function(evt){
			if(evt.which == 27){ // pulso la tecla "esc"
				$.ventana_proceso({accion: "close"});
				$(document).unbind('keyup.ventana');
				evt.preventDefault();
				return false;
			}
		});
	}else{
		// desactiva los botones de la ventana proceso
		$(document).unbind('keyup.ventana');
	}
	
	
	var margin_left = (width/2) - width;
	var margin_top = (height/2) - height;
	var div_overlay = '<div class="overlay" id="overlay"></div>';
	var ventana_interna = "<div id='deck_vt_interna'><div id='block_contenido'></div></div>";

	// valida si hay informacion que mostrar en la ventana para abrirla sin necesidad de pasar el parametro de open
	var data = opciones_user.data;
	if(data != '' && data != undefined){
		opciones_user.accion = 'open';
	}
	
		
	// si existe la opcion de abrir o si existe la capa overlay y la accion es diferente a la de cerrar
	if(opciones_user.accion == 'open' || ($('#overlay').length > 0 && opciones_user.accion != "close") ){

		// frena el funcionamiento de teclas del body
		$('body').unbind('keyup',funcion_teclas); 

		// si la ventana proceso ya esta abierta
		if($('#overlay').length > 0){ 
			//$('#overlay').append(ventana_interna);		
			$('#block_contenido').html(data);

			ind_ventana_abierta = true;

			var _obj_overlay	= $('#overlay'); // se seleecionan despues de ser pintador en el DOM
			$(_obj_overlay).append(ventana_interna);		
			var _obj_deck_vt_interna = $('#deck_vt_interna');
		
		}else{
			ind_ventana_abierta = false;	
			// pinta el overlay en la pantalla
			$(appendTo).append(div_overlay); // AQUI SE ELIJE CUAL SERA EL PADRE DE LA VENTANA MODAL
			var _obj_overlay	= $('#overlay'); // se seleecionan despues de ser pintador en el DOM
			$(_obj_overlay).append(ventana_interna);		
			var _obj_deck_vt_interna = $('#deck_vt_interna');

			
			// añadimos los estilos que estan como opcion
			$('#deck_vt_interna').css({
				"width" : width,
				"min-height" : height,
				"background-color" 	: color_fondo	,
				"position"			: position		,
				"left"				: "50%"			,
				"top"				: "50%"			,
				"margin-top"		: margin_top	,
				"margin-left"		: margin_left	,
				"text-align"		: text_align	,
				"z-index"			: 100000000		,
				"color"				: colorText
			});
			
			
			// si la opcion breakWord es true corta las palabras
			if(breakWord == true){
				$('#deck_vt_interna').css({
					"word-break" : "break-all"
				});
			}
			
			$('#deck_vt_interna').addClass('contenido');
			$('#block_contenido').append(data);
			$('#block_contenido').css('font-size',font_size);
			$('#block_contenido').css('min-height',height);			
			$('#block_contenido').css('padding',15);
			//$('#overlay').css('overflow','none');
			
		}
		
		
		// calcula el valor del ancho de la ventana y la centra acorde a la pantalla
		var width_auto 			= $(_obj_deck_vt_interna).width();
		var margin_left_auto	= (Number(width_auto)/2)-Number(width_auto);
		
		console.log(margin_left_auto);
		$('#deck_vt_interna').css({
			"margin-left" : margin_left_auto,
		});
			

		
		// debe validar si la ventana ya estaba abierta 
		if(ind_ventana_abierta==false){
			if(boton_cerrar == true){
				txt_boton_cerrar = "<span id='btn_close_vtn_1' style='position:relative; float:right; bottom:5px; right:10px; cursor:pointer;' >CERRAR</span>";
				$('#deck_vt_interna').append(txt_boton_cerrar);
				$('#btn_close_vtn_1').on('click',function(e){
					e.preventDefault();
					$.ventana_proceso({accion:'close'});
				});
			}else{
				$('btn_close_vtn_1').remove();
			}
		}else if(ind_ventana_abierta==true && boton_cerrar==false)$('btn_close_vtn_1').remove();

	}else if(opciones_user.accion == 'close'){

		$('#overlay').remove();		
		$('body').bind('keyup',funcion_teclas); // vuelve a poner en funionamiento la funcion de teclas del body
	}
	
}



function goToModule(cod_tabla,cod_tabla_detalle){

	if(cod_tabla && cod_tabla_detalle){
		f_ver_consultar_maetro_detalle(cod_tabla,	cod_tabla_detalle);

	}else if(cod_tabla && !cod_tabla_detalle){
		f_ver_consultar_tabla(cod_tabla);		
	}

}





function f_ver_consultar_maetro_detalle(cod_tabla,	cod_tabla_detalle){

	f	=	document.form1;
	f.cod_tabla.value			=	cod_tabla;
	f.cod_tabla_detalle.value	=	cod_tabla_detalle;	
	add_input('ind_buscar','hidden',1);
	//f.ind_buscar.value			= 	1;
	navegar_limpiando_variables(78);
}

function f_ver_consultar_tabla(cod_tabla){

	
	f	=	document.form1;
	/*var cod_navegacion_old = $('input[name="cod_navegacion"]').val();
	var new_input = "<input name='cod_navegacion_old' id='cod_navegacion_old' value='"+cod_navegacion_old+"' >";
	var new_input_2 = "<input name='cod_tabla_old' id='cod_tabla_old' value='"+cod_navegacion_old+"' >";

	$('#form1').append(new_input);*/
	
	f.cod_tabla.value		=	cod_tabla;
	add_input('ind_buscar','hidden',1);
	//f.ind_buscar.value		= 	1;
	navegar_limpiando_variables(39);
}




function confirm(message, callback) {

	$('#confirm').modal({
		closeHTML: "<a href='#' title='Cerrar' class='modal-close'>X</a>",
		position: ["20%",],
		overlayId: 'confirm-overlay',
		containerId: 'confirm-container', 
		onShow: function (dialog) {		

			var modal = this;

			$('.message', dialog.data[0]).append(message);

			// if the user clicks "yes"
			$('.yes', dialog.data[0]).click(function () {
				// call the callback
				if ($.isFunction(callback)) {
					callback.apply(null,["si"]);
				}
				// close the dialog
				modal.close(); // or $.modal.close();
			});
			
			// if the user clicks "yes"
			$('.no', dialog.data[0]).click(function () {
				// call the callback
				if ($.isFunction(callback)) {
					callback.apply(null,["no"]);
				}
				// close the dialog
				modal.close(); // or $.modal.close();
			});
		}
	});
}

/*$(function(){
	
	if($(".multiple_select").length > 0){
		$(".multiple_select").multiselect({});
	}
	
});*/


/*=====2014/07/22==========================================================>>>>
DESCRIPCION: 	MEtodo para pintar datos enviados por el servidor
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_pinta_datos(data,cod_navegacion,obj_accionado){
	
	if(cod_navegacion == 1061){
		
		
		// codigo pk de la columna_tabla_autonoma de la db
		var cod_columna_tabla = $(obj_accionado).data('cod_columna');
		var content_result = $('#content_result_'+cod_columna_tabla);
		
		
		if(data != ''){
			$(content_result).show('fast');
			$(content_result).html(data);
			return false;
		}else{
			
			
		}
		return false;
		
		
	
	
	
	}else if(cod_navegacion == 1078){
		
		$('#form1').append(data);
		
		

		
		
	}else{
	
		// funcion para navegaciones que no son generales si no especiales de cada pantalla
		// si no encuentra ningun codigo de navegacion va a buscarlo al archivo de salida
		f_pinta_datos_salida(data,cod_navegacion,obj_accionado);
	}

}



/*===== 2014/08/20 ==================================================>>>>
DESCRIPCION: 	Funcion de confirmacion personalizada
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 

===========================================================================*/
function  f_pinta_loading(cod_navegacion,obj_acccionado){
	
	var url_loading 	= "../../imagenes/sistema/loading.gif";
	var img_loading		= "<img src='"+url_loading+"' title='Cargando...' >";
	
	
	if(cod_navegacion == 1078){
	
	}else f_pinta_loading_salida(cod_navegacion,obj_acccionado,img_loading);

}


function navegar(cod_navegacion){
	document.form1.cod_navegacion.value=cod_navegacion;
	document.form1.action="../principal/controlador.php";
	document.form1.submit();
}

function navegar_limpiando_variables(cod_navegacion){
		document.form1.target="_self"
		document.form1.ind_limpiar_variables.value = 1; // para que el sistema sepa que debe borrar la posible basura
		navegar(cod_navegacion)
}	


/*===== 2014/08/27 ==========================================================>>>>
DESCRIPCION: 	Metodo para remplazar todos los elementos que lleguen por parametro 
				de la cadena que tambien llega por parametro
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
text			Cadena sobre la cual se trabajara
busca			Busca el elemento en la cadena
reemplaza		Elemento por el cual se quiere remplazar
===========================================================================*/	
function replace_all(text,busca,reemplaza){
  while (text.toString().indexOf(busca) != -1)
      text = text.toString().replace(busca,reemplaza);
  return text;
}


/*===== 2015/10/12 ==========================================================>>>>
DESCRIPCION: 	Metodo para mostrar ventanita de opciones (cerrar sesion etc)
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/	
$(function(){
	
	
	$('#btn_opc_user').on('click',function(e){
		
		e.preventDefault();
		
		if($('.info').length){
			$('.info').slideUp("normal", function() { $(this).remove(); } );
		}else{
			navegar_ajax_simple(1078,this);
		}
	})
	
	
	
	
	
	
	/*$('#btn_opc_user').toggle(
		function(){
			alert();
		}, function(){
			alert();
		}
	);*/
	
	
	/*$('#btn_opc_user').toggle(function(){
		//e.preventDefault();
		navegar_ajax_simple(1078,this);
		
	})*/
	//$('#btn_opc_user').click();
	
})