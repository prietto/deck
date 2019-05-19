$(function(){

	// remueve la opcion seleccionada en el select
	$("#cod_producto").find('option').removeAttr("selected");
 	$("#cod_unidad_medida").find('option').removeAttr("selected");
	
	var value_seleccionado =	$("input[name=reg_seleccionado]").val();
	let productField = $('#cod_producto');
	setTimeout(function(){ $('#cod_producto').select2("readonly",true); }, 1);
	productField.val(value_seleccionado);

	// selecciona la opcion del select 
	//$('#cod_producto > option[value="'+value_seleccionado+'"]').prop('selected',true);
    //$('#cod_unidad_medida > option[value="1"]').prop('selected',true);
	

	$("#cod_producto").change(function(){
            alert('No es posible realizar esta accion');
		    $('#cod_producto > option[value="'+value_seleccionado+'"]').attr('selected', 'selected');
    });	
	
	// debe verificar si existe un codigo de proveedor en el input para cargar la informacion
	var val_proveedor 	= $('#cod_proveedor').val();
	var val_empleado	= $('#cod_empleado').val();
	
	// llama por defecto a la funcion si el campo tiene algun valor
	/*if(val_proveedor != ''){
		cargar_data($('#cod_proveedor'));
	}*/
	
	$("#cod_proveedor").on('blur',function(){
		//cargar_data($(this));
	});	

	$("#cod_proveedor").on('change',function(){
		cargar_data_sujeto($(this),24);
	});


	$("#cod_empleado").on('change',function(){
		cargar_data_sujeto($(this),18);
	});

	
	
	
});


/*===== 2016/05/04========================================================>>>>
DESCRIPCION: 	Metodo para bloquear el campo de empleado y proveedor, y paso soguiente genera un evento sobre ellos
				para activar al que se le de click y deshabilitar el otro
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
var on_off_inputs_div = function($div,_ind,callback){

	if(!_ind)_ind = 'false';

	// debe buscar inputs dentro del div
	var inputs = $($div).find("select, textarea, input");

	$(inputs).each(function(index,element){
		//console.log($(element).attr('name'));
		if(_ind == 'false'){
			//console.log($(element).attr('name'));
			$(element).removeAttr('disabled');
		}else if(_ind == 'true')$(element).attr('disabled',true);


	});

	// llama a funcion o codigo despues de ejecutar el anterior codigo
	//valida que exista un callback
	if (callback && typeof(callback) == "function"){
		callback();
	}

}


$(function(){

	

	var box_input_empleado 		= $('#box_input_cod_empleado');
	var box_input_proveedor		= $('#box_input_cod_proveedor');

	// DEBE VALIDAR QUE CAMPO ESTA ACTIVO (EMPLEADO O PROVEEDOR)
	var input_empleado 	= $('#cod_empleado');
	var input_proveedor = $('#cod_proveedor');

	// MEDIDAS DE LA CAJA INPUT EMPLEADO
	var w_box_empleado = $(box_input_empleado).width();
	var h_box_empleado = $(box_input_empleado).height();

	// MEDIDAS DE LA CAJA INPUT EMPLEADO
	var w_box_proveedor = $(box_input_proveedor).width();
	var h_box_proveedor = $(box_input_proveedor).height();


	var capa_empleado = $('<div />',{
		id:'capa_bloqueo_empleado',
		//text:'lo que sea'
		css:{
			position:'absolute',
			width:w_box_empleado,
			height:h_box_empleado,
			background:'rgba(255,255,255,0.8)',
			'z-index':10
		},
		click: function(){

			// quita la capa div que bloquea el conjunto
			$(this).css({
				display:'none'
			});

			

			// desoculta la capa que bloquea el campo
			$('#capa_bloqueo_proveedor').css({
				display:''
			});
			
			on_off_inputs_div(box_input_empleado,'false',function(){
				on_off_inputs_div(box_input_proveedor,'true',function(){
					// situa el focus sobre el primer input de la caja
					$(box_input_empleado).find('input[type="text"]').first().focus();
				});	
			});

			// al activar el campo debe cargar informacion si existe algun dato en el
			if($(input_empleado).val())cargar_data_sujeto($(input_empleado),18);			

		}
	});

	var capa_proveedor = $('<div />',{
		id:'capa_bloqueo_proveedor',
		//text:'lo que sea'
		css:{
			position:'absolute',
			width:w_box_empleado,
			height:h_box_empleado,
			background:'rgba(255,255,255,0.8)',
			'z-index':10
		},
		click: function(){

			// quita la capa que bloquea
			$(this).css({
				display:'none'
			});

			// deshabilita el campo de empleado
			$('#capa_bloqueo_empleado').css({
				display:''
			});


			on_off_inputs_div(box_input_proveedor,'false',function(){
				on_off_inputs_div(box_input_empleado,'true',function(){
					// situa el focus sobre el primer input de la caja
					$(box_input_proveedor).find('input[type="text"]').first().focus();
				});	
			});

			// al activar el campo debe cargar informacion si existe algun dato en el
			if($(input_proveedor).val())cargar_data_sujeto($(input_proveedor),24);

		}
	});


	if($(input_empleado).is(':disabled')){
		// el campo proveedor es el activo
		cargar_data_sujeto($('#cod_proveedor'),24);

	}else if($(input_proveedor).is(':disabled')){
		//el campo empleado esta activo
		cargar_data_sujeto($('#cod_empleado'),18);
	}


	// pinta las capas que simulan bloqueao de input
	$(box_input_empleado).before(capa_empleado); // PINTA CAPA PARA EMPLEADO
	$(box_input_proveedor).before(capa_proveedor); // PINTA CAPA PARA PROVEEDOR


	if($(input_empleado).val()){
		// quita la capa que bloquea
		$('#capa_bloqueo_empleado').css({
			display:'none'
		});

		// deshabilita el conjunto proveedor
		on_off_inputs_div(box_input_proveedor,'true',null);
		
	}

	if($(input_proveedor).val()){
		// quita la capa que bloquea
		$('#capa_bloqueo_proveedor').css({
			display:'none'
		});	

		// deshabilita el conjunto empleado
		on_off_inputs_div(box_input_empleado,'true',null);
		
	}


	



})




/*=====2010/06/01========================================================>>>>
DESCRIPCION: 	Metodo para anular una entrada a travez de ajax
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
$this			Boton accionado
e				Evento
===========================================================================*/
function f_anular_entrada($this,e){

	e.preventDefault();
	
	var cod_entrada_producto = $($this).data('cod_pk');


	// LLAMA A LA FUNCION CONFIRM  EJECTUTANDO UN CALLBACK PRIMERO Y DEVOLVIENDO UNA RESPUESTA
	confirm("Esta segur@ que desea anular la entrada seleccionada? Este proceso no se puede revertir", function (a) {
		if(a == "si"){ // la funcion callback devuelve un valor dependiendo del boton seleccionado
			// navega para anular una entrada y revertir la cantidad de la entrada
			navegar_ajax_variables(1072,$this,'cod_entrada_producto',cod_entrada_producto);
			return false;
				
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
function f_pinta_datos_salida(data,cod_navegacion,obj_accionado){
	
	if(cod_navegacion == 1072){ // Flujo de navegacion para anular una entrada de producto
		
		if(data == 0){ // error por que la cantidad en bodega es inferior a la cantidad que se desea anular
			
			$.ventana_proceso({
				data: "No se puede anular, la cantidad en bodega en inferior a la cantidad de la entrada de almacen"			
			});
		
		}else if(data == 1){ // todo ok!!
			
			var tr_row = $(obj_accionado).parent().parent();
			$(tr_row).css('background-color','red');			
			$(tr_row).find('.estado_entrada').text('ANULADA');
			$(obj_accionado).remove();
			
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
	
	if(cod_navegacion == 1072){
			
	}
	
}


/*===== 2016/05/05 ========================================================>>>>
DESCRIPCION: 	funcion para cargar la informacion cuando se cambia o se carga un proveedor
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function cargar_data_sujeto(a,cod_tabla){ 

	var cod_pk = $(a).val();
	if(cod_pk == '' )return false;
	
	//console.log(cod_pk);	
	
	//Añadimos la imagen de carga en el contenedor
    $('.content_img').append('<img src="../../imagenes/sistema/loading.gif"/>');	

    // agrega input con el valor de la tabla (empleado o proveedor)
	add_input('cod_tabla_sujeto','hidden',cod_tabla);

    navegar_ajax_return(1092,function(result){
    	//console.log(result);
    	$(".box_historial_actor").html(result);

    });	

}


// funcion para cargar la informacion cuando se cambia o se carga un proveedor
function cargar_data(a){ 
	return false;

	var cod_pk_prov=$(a).val();
	if(cod_pk_prov == '' )return false;
		
	//var dataString = 'id='+ id;
	
	//Añadimos la imagen de carga en el contenedor
    $('.content_img').append('<img src="../../imagenes/sistema/loading.gif"/>');		

	var ajax_data = {
		"cod_navegacion"     : 2000,
		"cod_pk_proveedor"   : cod_pk_prov
	};
		
 	$.ajax({
    	data:  ajax_data,
        url:   'controlador.php',
        type:  'post',
		cache: false,
        /* beforeSend: function () {
        	$(".contenido_proveedor").html('<img src="../../imagenes/sistema/loading.png"/>');
		},*/
		success:  function (response) {
			//console.log(response);
			$(".contenido_proveedor").html(response);
        }
	});
}
	
	



$.fn.background = function(_background){
	$(this).css({background: _background});
}

$(function(){
	obj = $('#cod_producto');	
	var parent = obj.parent();
	//parent.background("black");
});

/*=====2010/06/01========================================================>>>>
DESCRIPCION: 	Metodo que se encarga de eliminar las filas seleccionadas por el chekbox
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
node			boton seleccionado
id_tabla		id de la tabla 
===========================================================================*/
function eliminar_fila(node,id_tabla) {
	confirmacion = confirm("Se eliminara el registro seleccionados\n\n ¿Desea Continuar?");
	if(confirmacion==false) return false;
	var t 			= document.getElementById(id_tabla);
	var tr 			= node.parentNode.parentNode;
	var arr_imputs 	= tr.getElementsByTagName('input');			
	var tb 			= t.getElementsByTagName('tbody')[0];

	// Evita que se quede sin filas la tabla....
	if (t.rows.length==1){
		arr_imputs[0].value = '';	
		arr_imputs[1].value = '';	
	}else{
		tb.removeChild(tr);	
	}
	//== Renumera los IDS de cada fila>>>	
	for(val_pos_i=0; val_pos_i<t.rows.length; val_pos_i++){
		tr		= t.rows[val_pos_i];
		tr.id	= id_tabla+"_row_"+val_pos_i;
	}
	tr			= t.rows[t.rows.length-1];	
	arr_imputs 	= tr.getElementsByTagName('input');			
	arr_imputs[1].focus();
	calcular_precio_orden();
}


/*=====2010/06/01========================================================>>>>
DESCRIPCION: 	Clona una fila 
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
node			boton seleccionado
id_tabla		id de la tabla 
===========================================================================*/
function addRow(node,id_tabla) {
	var t 			= document.getElementById(id_tabla);
	var tb 			= t.getElementsByTagName('tbody')[0];
	var tr 			= node.parentNode.parentNode;
	var ultimo_tr	= t.rows[t.rows.length-1];
	

	//== Evalua si es la ultima fila>>>
	if(tr!=ultimo_tr)return false;
	
	//== Evalua si el codigo del producto es invalido>>>
	var elementos_select		= ultimo_tr.getElementsByTagName('select');	
	var elementos_fila 			= ultimo_tr.getElementsByTagName('input');	

	old_dato = elementos_select[0].value;

	if(elementos_fila[1].value=='') return false;
	var myClone = ultimo_tr.cloneNode(true);	

	tb.appendChild(myClone);
	nuevo_id_fila		= t.rows.length-1
	nuevo_id_fila		= id_tabla+"_row_"+nuevo_id_fila;
	myClone.setAttribute('id',nuevo_id_fila); //pone id a la fila
	var newInpt 	= myClone.getElementsByTagName('input');	
	var newSel 		= myClone.getElementsByTagName('select');
	var newTa 		= myClone.getElementsByTagName('textarea');
	
	newSel[0].value = old_dato;

	//=== Evalua Imputs>>>
	for (i=0; i < newInpt.length; i++){
		if (newInpt[i].type == 'text' || newInpt[i].type == 'hidden') newInpt[i].value = '';
		if (newInpt[i].type == 'checkbox' || newInpt[i].type == 'radio') {
			if (tr.getElementsByTagName('input')[i].checked == true)
			newInpt[i].setAttribute('checked',true);
		}
	}
	//=== Evalua Text Areas>>>
	for (i=0; i < newTa.length; i++){
		newTa[i].setAttribute('value','');
	}
	//=== Evalua Selects >>> 
	for (i=0; i < newSel.length; i++){
		var newName = newSel[i].name.substring(0,newSel[i].name.search(/\d/)) + nameNum;
		newSel[i].setAttribute('name',newName);
		newSel[i].setAttribute('value','');
		newSel[i].selectedIndex = 1;
	}
	//return true;
	newInpt[1].focus();
	//nameNum++;
}




/*=====2010/03/18====================================Arellano Company===>>>>
DESCRIPCION: 	Metodo para cambiar color de la celda
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
fila			todo el objeto de la fila
num_accion		1=over 2=out 3=click
===========================================================================*/
var cod_registro_anterior = "";
/*function f_ver_menu_registro(cod_registro){

	//==== Obtiene los botones autorizados >>>
	obj_contenedor			= 	document.getElementById("div_procesos_registro");
	html_contenido_actual	= 	obj_contenedor.innerHTML; //guarda los botones en memoria
	obj_contenedor			= 	document.getElementById("div_reg_"+cod_registro); //obtiene el div del registro seleccionado
//	obj_contenedor.setAttribute('class','display_div');
	obj_contenedor.innerHTML= 	html_contenido_actual;//coloca la informacion almacenada temporalmente


	//=== Muestra el menu>>>
	tr_menu_nuevo 			= cod_registro;
	var variable			= "tr_menu_reg_"+cod_registro;
	tr_menu					= document.getElementById(variable);
	tr_menu.setAttribute('name',variable);
	tr_menu.style.display	= "table-row";
	
	var tr_registro 		= document.getElementById("tr_reg_"+cod_registro);
	tr_menu.style.backgroundColor = '#CCCCCC';
	tr_registro.style.backgroundColor = '#CCCCCC';

	
	//== Oculta el menu anterior>>>
	if(cod_registro_anterior!="" ){
		tr_menu					= document.getElementById("tr_menu_reg_"+cod_registro_anterior);
		tr_menu.style.display	= "none";
		tr_menu.style.backgroundColor = '';
		tr_registro.style.backgroundColor = '';
	}
	if(cod_registro_anterior == cod_registro)	cod_registro_anterior	= "";
	else										cod_registro_anterior	= cod_registro;	


	//=== Espera un momento para quitar la seleccion del registro	
	setTimeout(function(){
		tr_link					= document.getElementById("tr_reg_"+cod_registro);	
		tr_link.className = "contenido"; //realizo otro click osea que quita la seleccion
		elemento_fila = tr_link.getElementsByTagName('input');	
		elemento_fila[0].checked = false;
		},10);
}*/

function f_ver_menu_registro(cod_registro){
	f = document.form1;
	if(f.num_procesos_adicionales.value==0){
		cod_registro_anterior	= cod_registro;	
		ver_registro();
	}else{
	
		//==== Obtiene los botones autorizados >>>
		obj_contenedor			= 	document.getElementById("div_procesos_registro");
		html_contenido_actual	= 	obj_contenedor.innerHTML; //guarda los botones en memoria
		obj_contenedor			= 	document.getElementById("div_reg_"+cod_registro); //obtiene el div del registro seleccionado
		obj_contenedor.innerHTML= 	html_contenido_actual;//coloca la informacion almacenada temporalmente
	
	
		//=== Muestra el menu>>>
		tr_menu_nuevo 			= cod_registro;
		tr_menu					= document.getElementById("tr_menu_reg_"+cod_registro);
		tr_menu.style.display	= "table-row";
	
		
		//== Oculta el menu anterior>>>
		if(cod_registro_anterior!="" ){
			tr_menu					= document.getElementById("tr_menu_reg_"+cod_registro_anterior);
			tr_menu.style.display	= "none";
		}
		if(cod_registro_anterior == cod_registro)	cod_registro_anterior	= "";
		else										cod_registro_anterior	= cod_registro;	
	
	
		//=== Espera un momento para quitar la seleccion del registro	
		setTimeout(function(){
			tr_link					= document.getElementById("tr_reg_"+cod_registro);	
			tr_link.className = "contenido"; //realizo otro click osea que quita la seleccion
			elemento_fila = tr_link.getElementsByTagName('input');	
			elemento_fila[0].checked = false;
			},10);
	}
}



/*=====2014/01/16 ==========================================================>>>>
DESCRIPCION: 	Selecciona todos los checkbox
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function marcar(combo){
   checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
   for(i=0;i<checkboxes.length;i++){ //recoremos todos los controles
      if(checkboxes[i].type == "checkbox"){ //solo si es un checkbox entramos
       checkboxes[i].checked=combo.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
      }
   }
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

/*=====2013/12/27==========================================================>>>>
DESCRIPCION: 	Muestra pantalla para asociar valores con tipos de atencion
AUTOR:			Luis prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_imprime_factura(){
	f				= document.form1;
	f.target = "_blank";
	navegar(1028);
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
	f.target							= '_self';
	*/
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
		f.txt_nombre_columna_iframe.value = txt_nombre_combo;
		f.cod_ventana_emergente.value 	= cod_ventana_emergente;
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
	//combo_codigo_emergente.value		= parametros[0];
	
	if(parametros[0] == ''){
		return false;
	}
	
	$(combo_texto_nombre_emergente).val(parametros[1]);
	$('input[name='+combo_codigo_emergente.id+']').val(parametros[0]);

	window.focus();
	ventana_emergente.close();
	
	var combo_proveedor = $("#cod_proveedor");
	cargar_data(combo_proveedor);

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
	console.log('entreeee');
	return false;
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

function f_esc(){
	f				= document.form1;
	f.esc.disabled 	= true;
	f.cod_tabla.value = 21;
	navegar_limpiando_variables(39);
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
function ver_registro(){
	f= document.form1;
	f.target				= '_self';
	f.cod_pk.value			= cod_registro_anterior;	
	navegar_limpiando_variables(37);
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
}