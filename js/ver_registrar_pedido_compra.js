var ind_enter_bloqueado = false; //permite bloquear el enter en procesos de carga de informacion en iframe
var ind_facturacion_automatica = false;



$(function(){

	// FUNCION AL CARGAR LA PAGINA SITUA BOTON AL FRENTE DEL CAMPO ""VAL ENTREGADO""
	var html = "<div><img src='../../imagenes/sistema/btn_totalizar.png'/></div>";
	var html = '<button id="btn_pagar">Totalizar</button>';

	$('input[name="val_pagado"]').after(html).show(function(){
		var btn_pagar 		= $('#btn_pagar');
		var val_total 		= $('input[name="val_real"]');
		var input_pagado	= $(this);

		// FUNCION AL DAR CLICK SOBRE EL BOTON DE TOTALIZAR
		$(btn_pagar).on('click',function(e){
			e.preventDefault();

			var val_total_pedido;

			val_total_pedido 	= $(val_total).val();
			val_total_pedido	= replaceAll(val_total_pedido,',',''); // limpiamos el valor de cualquier coma
			if(val_total_pedido == '' || val_total_pedido == null){val_total_pedido = 0;}

			// pintamos el valor 
			$(input_pagado).val(formato_numero(val_total_pedido));

			// simula digitacion en el campo
			$(input_pagado).keyup();


		})
	});



	// FIN FUNCION PARA EL BOTON DE TOTALIZAR CANTIDAD DE DINERO PAGADA



	// FUNCION PARA ACTIVAR EL ONBLUR
	$("#cod_proveedor").on('blur',function(e){
		e.preventDefault();
		//console.log($(this).val());
		//console.log('hola 1');
		cargar_data($(this));
		return false;
	});	


	// FUNCION PARA REALIZAR FOCUS AL CARGAR LA PAGINA SOBRE EL CAMPO PROVEEDOR
	$("#cod_proveedor").focus();
	
});





// funcion para cargar la informacion cuando se cambia o se carga un proveedor
function cargar_data(a){ 

	var cod_pk_prov	=	$(a).val();
	if(cod_pk_prov == '' )return false;
		
	
	//Añadimos la imagen de carga en el contenedor
    //$('.content_img').append('<img src="../../imagenes/sistema/loading.gif"/>');	
	
	
	// se debe crear el espacio para pintar lo que devuelve el servidor
	var box_content  = $('#resultado');
		

	var ajax_data = {
		"cod_pk_proveedor"   : cod_pk_prov
	};
	
	
		
 	$.ajax({
    	data:  ajax_data,
        url:   '../contenido/caja_entradas_proveedor.php',
        type:  'post',
		cache: false,
        /* beforeSend: function () {
        	$(".contenido_proveedor").html('<img src="../../imagenes/sistema/loading.png"/>');
		},*/
		success:  function (response) {
			//console.log(response);
			//$(box_content).html(response);
			return false;
        }
	});
	
	return false;
}




// == FUNCION PARA DESACTIVAR EL ENTER PARA SUBMIT DEL FORMULARIO
$(function(){
	$('#form1').on("keyup keypress", function(e) {
		var code = e.keyCode || e.which; 
		if (code  == 13) {               
			e.preventDefault();
			return false;
		}
	});	
})


// FUNCION
// Luis Prieto 
// funcion para mostrar la opcion de activar la funcion de facturacion automatica
/*$(function(){
	var cod_usuario = $('input[name="cod_usuario"]').val();
	var ajax = $.ajax({
            type	: "GET",
            url		: "../consulta/consultar_parametro_x_usuario.php",
            data	: {cod_usuario:cod_usuario,cod_parametro:9},
			async	: true,			
			beforeSend: function() {},
			success: function(data) { // devuelve la data del servidor
				
				var cookie_facturar = leer_cookie('ind_facturar_automatico');
				
				//alert(cookie_facturar);
					
				if(data == '1'){
					$('#ind_funcion_facturar').attr('checked',true);
				}else if(data == '0'){
					$('#ind_funcion_facturar').attr('checked',false);				
				}
			},
			error: function(objeto, que_paso, otro_obj){
				alert("Lo sentimos ha ocurrido un error en la consulta \n intenta nuevamente");
			}
		});

	var html = '<p ><label style="font-size:14px !important;" class="combo_solicitud" for="ind_funcion_facturar">Facturacion automatica: </label><input type="checkbox" value="1"  name="ind_funcion_facturar" id="ind_funcion_facturar" /></p>';
	
	$('#panel_izq_opciones').attr({align:'right',valign:'top'});
	$('#panel_izq_opciones').html(html);
	
	$('#ind_funcion_facturar').click(function(){

		 if($(this).is(':checked')) {  
			ind_facturacion_automatica = 1;
			// debe ir a la base de datos 
			
        } else {  
			ind_facturacion_automatica = 0;
        }  
	})
	
})*/



$(function(){
	
	$('#enter').attr('type','submit'); // convierte el 
	$('#enter').attr('onclick','');
	
	// debe quitar los eventos onkeyup de los atributos del precio unitario
	$('input[name="val_precio_unitario[]"]').removeAttr('onkeyup');
	$('input[name="val_precio_unitario[]"]').removeAttr('onfocus');
	
	
	
	$('#form1').submit(function(){

		// captura el estado del pedido antes de guardar
		var cod_estado = $('#cod_estado_pedido_compra').val();

		// si el pedido esta en 'REGISTRADO'
		if(cod_estado == 1){
			confirm("¿Desea dar ingreso a bodega?", function (a) {
				if(a == "si"){ // la funcion callback devuelve un valor dependiendo del boton seleccionado
					add_input('ind_entrada_insumo','hidden',1);
					f_continuar_submit();			
				}else if(a == "no"){
					add_input('ind_entrada_insumo','hidden',0);
					f_continuar_submit();
				}
			});
		}else{
			f_continuar_submit();
		}
		return false;
	});

	// FUNCION QUE CONTINUA DESPUES DE SELECCIONAR
	var f_continuar_submit = function(){
		var f = document.form1;
		f.ind_guardar_datos_tabla_autonoma.value = 1;
		navegar(1084);
	 	 		
		return false;
	}
	
	
	
	
	//$(document).unbind('tooltip');
	$(document).tooltip("destroy" );
	/*$('input[name="cantidad[]"]').on('keydown',function(e){
		e.stopPropagation();
		var key = e.which;
		
		if(key == 18){ // el usuario presiono la tecla +
			var tr_padre = $(this).parent().parent();
			$(tr_padre).find()
		}
		alert(key);
	})*/
	
	// funcion 
	
	/*$('.select2').on('select2-close', function(e) {
							e.stopPropagation();
				          	setTimeout(function(){
								$('body').bind('keyup',funcion_teclas); // activa el funcionamiento de teclas del body 
								 $('.select2-container-active').removeClass('select2-container-active');
								
								 
								 //alert($(this).prop('tagName'));
								$(':focus').blur();
								$('input[name="cantidad[]"]').focus();
								
							},1000);

						  
			        })*/
})

/*===== 2014/08/12 ========================================================>>>>
DESCRIPCION: 	Metodo para pintar o ejecutar funciones despues de respuesta del servidor
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_pinta_datos_salida(data,cod_navegacion,obj_accionado){
	if(cod_navegacion == 1071){ // cuando se selecciona el cliente en el registro de pedido
		
		
		if(data != 0){ // si existen facturas vencidas para el cliente
			$.ventana_proceso({
				data : data
			});
		}

	}else if(cod_navegacion == 1056){

		$('#ventana_cargador').removeClass('overlay');
		$('#ventana_cargador').empty();

		if(data != ''){ // si el servidor dvuelve algun dato
		
			obj_json = $.parseJSON(data); // convertimos en objeto la data que nos devuelve el servidor

			var msj_error 		= obj_json.mensaje; // capturamos los mensajes del objeto json
			var cod_pk_factura	= obj_json.cod_pk_factura; // capturamos los mensajes del objeto json
			
			// si el servidor devolvio mensajes de error
			if(msj_error != '' && msj_error != undefined){
				$('body').append(msj_error);
			}else{
				
				if(cod_pk_factura != ''){
					// si todo esta ok 
					var cod_forma_pago = $('#cod_forma_pago').val();
					if(cod_forma_pago != 1){ // si la forma de pago no es de contado
						// LLAMA A LA FUNCION CONFIRM  EJECTUTANDO UN CALLBACK PRIMERO Y DEVOLVIENDO UNA RESPUESTA
						confirm("¿Desea facturar el pedido con la factura No. <b>"+cod_pk_factura+"</b> ?", function (a) {
							if(a == "si"){ // la funcion callback devuelve un valor dependiendo del boton seleccionado
								add_input('ind_facturar_pedido','hidden',1);
								navegar(1074);
								return false;							
							}else if(a == "no"){
								add_input('ind_facturar_pedido','hidden',0);
								navegar(1074);
								return false;
							}
						});
						
					}
				}
				
				//alert('no hay error');
				// deba navegar al flujo que guarda el pedido
				//navegar(1074);
			}
		
		}else{
			// si todo esta ok 
			var cod_forma_pago = $('#cod_forma_pago').val();
			if(cod_forma_pago != 1){ // si la forma de pago no es de contado
				// LLAMA A LA FUNCION CONFIRM  EJECTUTANDO UN CALLBACK PRIMERO Y DEVOLVIENDO UNA RESPUESTA
				confirm("¿Desea facturar el pedido con la factura No. <b>FACTURA</b>?", function (a) {
					if(a == "si"){ // la funcion callback devuelve un valor dependiendo del boton seleccionado
						//add_input('ind_factura_pedido','');
						
						//navegar(1074);
						return false;							
					}else if(a == "no"){
						
						navegar(1074);
						return false;
					}
				});
				
			}
			
			
		}
		
	}// fin if 
}


function f_pinta_loading_salida(cod_navegacion,obj_acccionado,img_loading){
	if(cod_navegacion == 1056){
		var url_loading 	= "../../imagenes/sistema/loading.gif";
		var img_loading		= "<div id='img_loading'><img src='"+url_loading+"' title='Cargando...'  ></div>";
		
		
		if($('#ventana_cargador').length==0){
			var html = '<div id="ventana_cargador"></div>';
			$('#form1').append(html);
		}
		
		var obj_cargador = $('#ventana_cargador');

		$(obj_cargador).addClass('overlay');
		$(obj_cargador).html(img_loading);
		//$('#img_loading').css('width',80);
		$('#img_loading').css('position','relative');
		$('#img_loading').css('top','50%');
		$('#img_loading').css('margin-top','-8px');
		//$('#img_loading').css('height',80);
	}
}


$(function(){
	$('input[name="val_precio_unitario[]"]').attr('autocomplete','off');
	$('input[name="val_precio_unitario[]"]').on('click',function(){
		$(this).select();
	});
	
	
	
	
	// funcion para cuando el valor recibido esta en cero al hacer focus borre el cero
	$('input[name="val_pagado"]').on('focus',function(){
		if(this.value == 0){
			this.value = '';
		}
	})
	
	// funcion que pone cero en el campo si no hay nada
	$('input[name="val_pagado"]').on('blur',function(){
		if(this.value == ''){
			this.value = '0';
		}
	})
	
	
	// PARA CUANDO EXISTEN VALORES NEGATIVOS EN LOS CAMPOS
	$('body').delegate('input:text','change',function(){

		$('input:text').each(function(index,element) {  
			var value_obj = $(element).val();
			value_obj = replaceAll(value_obj,',','');
			if(value_obj < 0){
				$(element).css('border-color','red');
				$(element).css('color','red');
				
			}	
		});
	})
	
	
	$('body').delegate('#txt_cod_cliente','change', function(){

			var cod_cliente = $('#cod_cliente').val();
			if(cod_cliente == '' || cod_cliente == 'undefined')return false;
			navegar_ajax_variables(1071,$(this),'cod_cliente',cod_cliente,'cod_estado_factura',5);
	})  


	/* ==== FUNCION QUE SE ACTIVA AL CAMBIAR VALOR EN EL SELECT DE PRODUCTO */
    $('.tabla_detalle').delegate('.cod_producto','change',function() {

			
			// captura el tr donde esta el input o select
			var obj_tr  		= $(this).parent().parent();
			// averiguamos el id del tr 
			var id_tr 			= obj_tr.attr('id');			
			// averiguamos la posicion del tr
			//var pos_tr			=	$(".tabla_detalle tbody tr").index($('#'+id_tr)); 
			//var pos_tr			=   pos_tr - 1; // se le resta por que no se puede contar la cabecera de la tabla
			
			//var ultimo_row  	= $('.tabla_detalle tbody tr').last(); // ultimo tr de la tabla
			//var id_ultimo_row 	= ($(ultimo_row).attr('id')); // saca el id del ultimo tr de la tabla
			var arr_ultimo_row	= id_tr.split("_"); // divide convierte en array separado por "_"
			var pos_tr			= parseInt(arr_ultimo_row[arr_ultimo_row.length-1]); // saca la ultima posicion del vector donde esta el pos
			
			
			// valor del producto seleccionado en el combo box
			var value_select 		= $(this).val();
			/*value_select			= value_select.replace(',','');
			value_select			= parseInt(value_select);*/
			
			
			// inicializa variables de valores
			
			var obj_val_unitario 	= $('#val_precio_unitario_'+pos_tr); // input de valor unitario por fila
			var obj_cantidad		= $('#cantidad_'+pos_tr);  // input de cantidad por fila
			var value_cantidad		= obj_cantidad.val();   // valor del input cantidad
			var obj_val_total_fila	= $('#val_total_'+pos_tr);	// input de valor total de la fila  
			var value_val_real	 = $('input[name="val_real"]').val(); // captura el valor que tiene el valor final del pedido
			
			
			// recorreo los productos ingresados para saber si ya se ingreso
			var ind_existe =0;
			$('.cod_producto').each(function(index,element) {  
				
				if($(element).val() == value_select && value_select != '')ind_existe++; // si ya existe suma uno 
			});
			
			if(ind_existe > 1){ // el indicador es mayor a uno quiere decir que ya hay un producto registrado
				alert('Ya existe el producto registrado');
				
				$(this).val(''); // vuelve el valor del campo nulo
				//alert($(this).data('plugin'));
				// por si el campo tiene plugin de select2 (buscador de listbox tipo dato == 19)
				if($(this).data('plugin') == 'select2')$(this).select2("val","");
				$(obj_val_unitario).val('0'); // el precio unitario de la linea lo deja en cero
				$('input[name="cantidad[]"]').keyup(); // activa la funcion que se llama al cambiar la cantidad para realizar calculos
				return false;
			}
			

			if(value_cantidad == '' || value_cantidad == null){value_cantidad = 0;} 
			
			//$('input[name="cantidad[]"]').change();
			
			// utiliza ajax para saber elprecio unitario del producto
			var ajax_data = {
				'cod_navegacion' : 2001,
				'cod_producto'   : value_select
			}
			
			// AJAX PARA CONSULTAR EL VALOR UNITARIO DEL PRODUCTO
			$.ajax({
				type	: 'post',
				utl		: 'controlador.php',
				data	: ajax_data		,
				async	: true			,
				beforeSend: function(){
					//obj_val_unitario.val(data);
					$(obj_val_unitario).addClass('loading_gif');
				},
				success	: function(data){
					
					$(obj_val_unitario).removeClass('loading_gif');
					
					
					obj_val_unitario.val(data); // asigna el valor devuelto por el servidor al val unitario de la fila
					data			= replaceAll(data,',','');
					data			= parseInt(data);
					
					
					
					var new_value = parseInt(value_val_real) + parseInt(data);
					if(value_cantidad != 0){
						obj_val_total_fila.val(parseInt(value_cantidad) * parseInt(data));
					}
					
					
					//$('input[name="val_real"]').val(new_value);
					$('input[name="cantidad[]"]').keyup();
				}
	
			});
			
	});
	
	
	
	
	// ==============  FUNCION QUE SE ACTIVA AL CAMBIAR EL VALOR DE LA CANTIDAD PARA EL
	// PRODUCTO SELECCIONADO ====================================================
	$('.tabla_detalle').delegate('input[name="cantidad[]"],input[name="val_precio_unitario[]"]','keyup',function(e) {
		
		e.preventDefault();	
		
		var key = e.which;
		
		// si presiono la tecla tabulador para cambiar de casilla
		if(key == 9){return false;}
		
		// captura el tr donde esta el input o select
		var obj_tr  		= $(this).parent().parent();

		if(key == 107 || key == 187){ // el usuario presiono la tecla +
			var value_this = $(this).val();
			
			var nuevo_valor = value_this.substring(0,value_this.length-1);
			
			this.value = formato_numero(nuevo_valor);
			$(obj_tr).find('input[name="mas"]').click();
			return false;
		}
		
		// averiguamos el id del tr 
		var id_tr 			= obj_tr.attr('id');			

		// averiguamos la posicion del tr
		//var pos_tr			=	$(".tabla_detalle tbody tr").index($('#'+id_tr)); 
		//var pos_tr			=   pos_tr - 1; // se le resta por que no se puede contar la cabecera de la tabla	
		
		var arr_ultimo_row	= id_tr.split("_"); // divide convierte en array separado por "_"
		var pos_tr			= parseInt(arr_ultimo_row[arr_ultimo_row.length-1]); 
		// saca la ultima posicion del vector donde esta el pos
		
		// producto seleccionado en el combo box
		var cod_producto	= 	$('#cod_producto_'+pos_tr).val();
		var cod_pedido		= 	$('input[name="cod_pedido_compra"]').val();

		// cantidad ingresada por el usuario
		var id_obj_cantidad		= $('#cantidad_'+pos_tr).attr('id');
		var value_cantidad		= $('#cantidad_'+pos_tr).val();
		
		// =================================================
		// VALIDACION PARA EL TIPO DE DATO
		var patron = /^\d*$/;    // patron de solo numeros
		var value_this = $(this).val();
		if(value_this != ',')value_this = replaceAll(value_this,',',''); // limpiamos el valor de cualquier coma	
		if (!patron.test(value_this)){  
			alert('Caracter no valido');
			this.value = value_this.substring(0,value_this.length-1);
			return false;			
		}
		
		
		value_cantidad			= replaceAll(value_cantidad,',',''); // limpiamos el valor de cualquier coma
		if(value_cantidad == '' || value_cantidad == null){value_cantidad = 0;}

		var obj_val_total_fila		= $('#val_total_'+pos_tr);	
		var val_precio_unitario 	= $('#val_precio_unitario_'+pos_tr).val();
		if(val_precio_unitario == '' || val_precio_unitario == null)val_precio_unitario = 0;
		val_precio_unitario			= replaceAll(val_precio_unitario,',','');
		val_precio_unitario			= parseInt(val_precio_unitario);
		

		var name_this_obj			= $(this).attr('name'); // nombre del elemento accionado
		var id_this_obj				= $(this).attr('id'); // id del elemento accionado
		var value_this_obj			= $(this).val(); // valor del elemento accionado
		
		
		// da formato al valor del precio unitario
		if(name_this_obj == 'val_precio_unitario[]'){
			$(this).val(formato_numero(val_precio_unitario));
		}
		
		
		
		// navegacion mediante ajax para verificar la cantidad ingresada contra lo que hay en bodega
		var ajax_data = {
			'cod_navegacion' : 2002,
			'cod_producto'   : cod_producto,
			'cod_pedido'	 : cod_pedido
		}
		
		$.ajax({
			type	: 'post',
			utl		: 'controlador.php',
			data	: ajax_data		,
			async	: true			,
			beforeSend: function(){
				
			},
			success	: function(data){
					
				var num_cantidad_db = parseInt(data);

				
				if(value_cantidad > num_cantidad_db && name_this_obj == 'cantidad[]'){
					var msj = "La cantidad ingresada es mayor a la existente en bodega";
					$.ventana_proceso({
						data 		: msj	,
						font_size	: 20
						
					});
					
					
//					alert('La cantidad ingresada es mayor a la existente en bodega');
					$(obj_val_total_fila).val('0');
					$('#'+id_this_obj).val('');
					$('input[name="cantidad[]"]').keyup();		
					$('input[name="val_pagado"]').on('keyup');
					
					return false;
					
				}else if(name_this_obj == 'val_precio_unitario[]' ){
					if($('#'+id_this_obj).val() == '' || $('#'+id_this_obj).val() == null){
						$(obj_val_total_fila).val(0);
						$('#'+id_this_obj).val('');
						//$('input[name="cantidad[]"]').keyup();		
						$('input[name="val_pagado"]').on('keyup');	
						return false;
					
					}
				}
			}
		});
		
		
		var value_total_fila = parseInt(value_cantidad) * parseInt(val_precio_unitario); // multiplica la cantida por el valor
		if(value_total_fila == '' || value_total_fila == null)val_total_fila = 0;
	
		value_total_fila = formato_numero(value_total_fila); // formatea el numero para poner separador de miles
		obj_val_total_fila.val(value_total_fila); // asigna el calor al input final de la fila
		
		arr_val_total_fila = new Array();
		
		var total = 0;
		$('input[name="val_total[]"]').each(function(index,element) {  
			// ciclo para recorrer todos lo inputs con el nombre definido

			val_tmp = $(element).val(); // captura el valor de la posicion del elemento
			val_tmp = replaceAll(val_tmp,',','');

			if(val_tmp == '' || val_tmp == null)val_tmp = 0;
			total = total + eval(val_tmp);

		});

		if(total == 0)total = '';
		total = formato_numero(total); // funcion que formatea el valor para poner coma de miles

		$('input[name="val_real"]').val(total);	// asigna el valor total sumado de las filas del detalle
		$('input[name="val_pagado"]').keyup();


	});
	
	// ================== // =====================================
	// ======= FIN FUNCION =================================== //
	// ================== // =====================================
	
	
	
	
	/*  ====== FUNCION PARA CALCULAR EL VALOR DEL SALDO   ================  */
//	$('#tabla_maestro').delegate('input[name="val_pagado"]','keyup',function() {
	$('input[name="val_pagado"]').on('keyup',function() {


		var value 		= $(this).val(); // valor ingresado por el uisuario
		if(value == '' || value == null)value = 0;
		//if(value == '' || value == null)return false;
		
		value			= replaceAll(value,',',''); // reemplaza todas las comas que encuentre
		var value_final		= $('input[name="val_real"]').val();
		var val_pagado	= $('input[name="val_pagado"]').val();
		var	input_val_saldo = $('input[name="val_saldo"]');
		
		value_final = replaceAll(value_final,',',''); // reempplaza todas las comas que encuentre
		
		var val_saldo = parseInt(value_final) - parseInt(value);	
		
		if((value_final == 0 || value_final == '') && (val_pagado != ''  || val_pagado != 0 )){
			//alert('Por favor verifique que existe un valor en el campo "Valor Total"'); 
			//$(this).val('');
			$(input_val_saldo).val('');
			
			return false;
		}
		
		//if(value == '' || value == null)val_saldo = 0;
		if(val_saldo > 0){
			$(input_val_saldo).css({'border-color':'','color':''});
		}else if(val_saldo < 0){
			$(input_val_saldo).css({'border-color':'red','color':'red'});
		}
		
		
		val_saldo = formato_numero(val_saldo); // formatea el numero
		//console.log(val_saldo);
		$('input[name="val_saldo"]').val(val_saldo);				
		
	});
	
	
	
	
	
	
	
	// =====================================================================================
	// === FUNCION PARA RETORNAR EL ESTADO DEL PEDIDO Y QUITAR EL BOTON GUARDAR
	// =====================================================================================
	var estado_pedido 	= $('#cod_estado_pedido_compra').val();
	var value_txt		= $('#cod_estado_pedido_compra option:selected').text();

	
	if(estado_pedido != 1){ // si el estado es anulado
		$('#enter').remove();
		
		var msj = "El pedido se encuentra "+value_txt+", no es posible guardar cambios";
		
		$("#msj_servidor").css('color','red');
		$("#msj_servidor").html(msj);
		
		
	}



});






/*=====2014/10/25========================================================>>>>
DESCRIPCION: 	Metodo para ejecutar plugin select2 sobre el campo de producto
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
$(function(){
		
       //$this.removeClass("hasDatepicker");
       //$this.datepicker();
	   /*$('.select2_cod_producto').select2( {
			allowClear: true,
			dropdownAutoWidth: true,
			closeOnSelect: true,
			width: 300

	  });*/
	  
	  
					
				
	   

})




/*=====2009/01/08========================================================>>>>
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

/*=====2009/01/08========================================================>>>>
DESCRIPCION: 	Metodo para eliminar una foto del sistema
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_eliminar_foto(){	
	
	confirmacion = confirm("Esta foto se eliminara del sistema ¿Desea Continuar?");
	
	if(confirmacion==true)		navegar(76);
			
}
/*=====2009/01/08========================================================>>>>
DESCRIPCION: 	Metodo para ocultar la foto
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_ocultar_foto(ruta){
	fila					=	document.getElementById('ver_foto');
	fila.style.display 		= 	'none';
}

/*=====2009/01/08========================================================>>>>
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

/*=====2010/06/02========================================================>>>>
DESCRIPCION: 	Si la ultima fila esta limpia la borra para no tener que hacer
				validaciones en php
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
node			boton seleccionado
id_tabla		id de la tabla 
===========================================================================*/
function eliminar_ultima_fila(){
	f				= document.form1;
	var t 			= document.getElementById('tabla_detalle_'+f.cod_tabla_detalle.value);
	var ultimo_tr	= t.rows[t.rows.length-1];
	var tb 			= t.getElementsByTagName('tbody')[0];

	//== Evalua si el codigo del producto es invalido>>>
	arr_imputs 					= ultimo_tr.getElementsByTagName('input');
	
	id_ultimo_tr				= ultimo_tr.id;				
	error = 0;
	
	$('#'+id_ultimo_tr+' select[required]').each(function(index,element){
		if($(element).val() == ''){
			error++;
		}
	});
	
	
	
	$('#'+id_ultimo_tr+' input[required]').each(function(index,element){
		var value_element = $(element).val();
		if(value_element == '' || value_element == 0){
			
			error++;
		}

	});
	
	var num_campos = $('#'+id_ultimo_tr+' input[required]').length + $('#'+id_ultimo_tr+' select[required]').length;
	
	
					
	
	/*if(		arr_imputs[1].value == ''	&&
		  	arr_imputs[2].value == ''	&&
		  	(arr_imputs[4].value == '' || arr_imputs[4].value == 0)){
		tb.removeChild(ultimo_tr);		
		
	}*/
	//alert(error+" -- "+num_campos);
	if(error ==  num_campos)tb.removeChild(ultimo_tr);			
}
/*=====2010/06/01========================================================>>>>
DESCRIPCION: 	Metodo que se encarga de eliminar las filas seleccionadas por el chekbox
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
node			boton seleccionado
id_tabla		id de la tabla 
===========================================================================*/
function eliminar_fila(node,id_tabla) {

	
	var t 			= document.getElementById(id_tabla);
	var tr 			= node.parentNode.parentNode;
	var arr_imputs 	= tr.getElementsByTagName('input');			
	var tb 			= t.getElementsByTagName('tbody')[0];
	
	num_tr = $('#'+id_tabla+' tbody > tr:not(.titulo_tabla_detalle)').length;

	if (num_tr==1){
		// busca todos los inputs y los vacia
		$('#'+id_tabla+' tbody > tr').find('input:text, select, textarea').val('');
		return false;
	}



	// LLAMA A LA FUNCION CONFIRM  EJECTUTANDO UN CALLBACK PRIMERO Y DEVOLVIENDO UNA RESPUESTA
	confirm("Se eliminara el registro seleccionados\n\n ¿Desea Continuar?", function (a) {
		if(a == "si"){ // la funcion callback devuelve un valor dependiendo del boton seleccionado
				
			
		
			// Evita que se quede sin filas la tabla....
			if (num_tr==1){
				arr_imputs[0].value = '';	
				arr_imputs[1].value = '';	
			}else{
				var tr_padre = $(node).parent().parent();
				$(tr_padre).remove();
				//alert($(tr_padre).attr('id'));
				//tb.removeChild(tr);	
			}
			//== Renumera los IDS de cada fila>>>	
			/*for(val_pos_i=0; val_pos_i<num_tr; val_pos_i++){
				tr		= t.rows[val_pos_i];
				tr.id	= id_tabla+"_row_"+val_pos_i;
			}*/
			tr			= t.rows[t.rows.length-1];	
			arr_imputs 	= tr.getElementsByTagName('input');			
			arr_imputs[1].focus();
			
				
		}else if(a == "no"){
			return false;
		}
	});
	
	
	
}

/*=====2010/06/01========================================================>>>>
DESCRIPCION: 	Clona una fila 
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
node			boton seleccionado
id_tabla		id de la tabla 
===========================================================================*/
var num_row = 0;
function addRow(node,id_tabla) {


	var t 			= document.getElementById(id_tabla);
	var tb 			= t.getElementsByTagName('tbody')[0];
	var tr 			= node.parentNode.parentNode;
	var ultimo_tr	= t.rows[t.rows.length-1];
	//== Evalua si es la ultima fila>>>
	if(tr!=ultimo_tr)return false;
	
	//== Evalua si el codigo del producto es invalido>>>
	var elementos_fila 			= ultimo_tr.getElementsByTagName('input');	
	var elementos_select		= ultimo_tr.getElementsByTagName('select');	
	var elementos_div			= ultimo_tr.getElementsByTagName('div');	
	


	//if(elementos_fila[2].value=='' ) return false;

	var myClone = ultimo_tr.cloneNode(true); // captura en variable el elemento que se va a copiar

	tb.appendChild(myClone);
	
	nuevo_id_fila		= tb.rows.length - 1;
	contador_fila		= parseInt(nuevo_id_fila)-1;

	
	var ultimo_row  	= $('#'+id_tabla+' tbody tr').last();
	var id_ultimo_row 	= ($(ultimo_row).attr('id'));
	var arr_ultimo_row	= id_ultimo_row.split("_");
	
	if(num_row == 0){ // quiere decir que es la primera vez que entra y debe contra cuantas filas hay
		num_row = t.rows.length-2;
	}else{
		num_row++; // si no incremente de uno en uno la cantida de filas sin chocarse
	}
	
	
	var next_id			= num_row;
	
	nuevo_id_fila		= id_tabla+"_row_"+next_id;

	myClone.setAttribute('id',nuevo_id_fila); //pone id a la fila
	var newInpt 	= myClone.getElementsByTagName('input');	
	var newSel 		= myClone.getElementsByTagName('select');
	var newTa 		= myClone.getElementsByTagName('textarea');
	var newdiv		= myClone.getElementsByTagName('div');


	//=== Evalua Imputs>>>
	for (i=0; i < newInpt.length; i++){
		if (newInpt[i].type == 'text' || newInpt[i].type == 'hidden' || newInpt[i].type == 'number'){
			var nameinput = newInpt[i].name; 
			var patron 	= '[]';
			var new_id	= nameinput.replace(patron,''); //quita las llaves

			var newid	= new_id+"_"+next_id;
			
			newInpt[i].setAttribute('id',newid);		
			newInpt[i].value = '';
		}
		
		var obj_select = $(newInpt[i]);
		// busca si hay un select con clase select2 para decirle "hasta la vista baby"
		if($(obj_select).data('plugin') == 'select2'){
			
			// codigo pk de la conlumna tabla autonoma
			var cod_columna_tabla = $(obj_select).data('cod_columna_tabla');
			
			$(obj_select).select2({
						minimumInputLength : 0,
						allowClear: true,
						width: 340,
												
						ajax: {
						  url: '../consulta/consulta_script_columna.php',
						  dataType: 'json',
						  data: function (term, page) {
							return {
							  term: term,
							  cod_columna_tabla: cod_columna_tabla
							};
						  },
						  results: function (data, page) {
							  
							return { results: data.results };
						  }
						},
						initSelection: function(element, callback) {
							return $.getJSON('../consulta/consulta_script_columna.php?cod_columna_tabla='+cod_columna_tabla+'&id=' + (element.val()), null, function(data) {
				
									return callback(data);
				
							});
						}
					}).on('select2-open', function() {
					    	//alert('open');
							$('body').unbind('keyup',funcion_teclas); // frena el funcionamiento de teclas del body
				     }).on('select2-close', function(e) {
							e.stopPropagation();
				          	setTimeout(function(){
								$('body').bind('keyup',funcion_teclas); // activa el funcionamiento de teclas del body 
								// $('.select2-container-active').removeClass('select2-container-active');
						        
								$(':focus').blur();
								$('input[name="cantidad[]"]').focus();
							},1000);

						  
			        }).on('select2-selecting', function(e) {
				        // alert('selecting val=e.val choice=e.object.text');
						 //$(this).blur();
						

        			});
		}
		
		if (newInpt[i].type == 'checkbox' || newInpt[i].type == 'radio') {
			if (tr.getElementsByTagName('input')[i].checked == true)
			newInpt[i].setAttribute('checked',true);
		}
	} // fin for
	
	//=== Evalua Text Areas>>>
	for (i=0; i < newTa.length; i++){
		newTa[i].setAttribute('value','');
	}
	
	
	//=== Evalua divs >>> 
	for (i=0; i < newdiv.length; i++){
		var newid 	= newdiv[i].id;		
		var obj_div = $(newdiv[i]);
		
		if(newid == $(elementos_div[i]).attr('id') && $(obj_div).hasClass('cod_insumo')){
			$(obj_div).remove();
		}
	} // fin for
	
	//=== Evalua Selects >>> 
	for (i=0; i < newSel.length; i++){
		
		//var newName = newSel[i].name.substring(0,newSel[i].name.search(/\d/)) + nameNum;
		var newName 	= newSel[i].name;
		var patron 		= '[]';
		var new_id		= newName.replace(patron,'');
		var newid		= new_id+"_"+next_id;
		newSel[i].setAttribute('name',newName);
		newSel[i].setAttribute('id',newid);
		newSel[i].setAttribute('value','');
		newSel[i].selectedIndex = 0;
		
		var obj_select = $(newSel[i]);
		
		
		
		// busca si hay un select con clase select2 para decirle "hasta la vista baby"
		if($(obj_select).data('plugin') == 'select2'){
			
			$(obj_select).select2({
				allowClear: true,
				dropdownAutoWidth: true,
				closeOnSelect: true,
				width: 340

		     //  $this.datepicker("show");
	   		});
				//$(obj_select).hide();
		}
		
		
		
	}
	
	newInpt[1].focus();
	//nameNum++;
}

/*=====2009/01/08========================================================>>>>
DESCRIPCION: 	Metodo para buscar un nombre a partir de un codigo sin listBox
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function ver_valor_iframe(combo,ind_registro_maestro_detalle){
	
	//=== Combos donde se retornara la información >>>
	combo_codigo_emergente			= document.getElementById(combo.name);
	combo_texto_nombre_emergente	= document.getElementById("txt_"+combo.name);
	
	if(combo.value == ''){
		combo_texto_nombre_emergente.value = '';
		return false;
	}
	/*
	f							=	document.form1;
	f.cod_tabla_iframe.value	= f.cod_tabla.value;//la tabla que tiene el script contra la base de datos
	f.val_campo.value			= combo.value;
	//=== Si la lista de valor es llamada desde un detalle debe guardar el codigo de la fila>>>
	if(ind_registro_maestro_detalle==1) {
		tr 						= combo.parentNode.parentNode; 	//captura la fila en la que esta el combo
		combo_ubicacion_tr		= tr.id;
		f.cod_tabla_iframe.value= f.cod_tabla_detalle.value;
	}	
	
	
	
	f.txt_nombre_columna_iframe.value	= combo.name;
	f.target							= 'frame_oculto';//Para ejecutar la consulta en el iframe
	navegar(42);
	f.target							= '_self';//Para la siguiente consulta hacerlo normal
	*/
}
/*=====2009/01/08========================================================>>>>
DESCRIPCION: 	Metodo que se encarga de levantar una lista de valores a partir 
				de un codigo de navegacion
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO						DESCRIPCION 
cod_ventana_emergente			Codigo de la tabla que debe abrir
txt_nombre_combo				nombre del combo que tiene el codigo principal
boton							boton desde el cual se hace click
ind_registro_maestro_detalle	Indica si la lista esta en un listado de maestro de detalle
===========================================================================*/
ventana_emergente_activa		=0;
combo_codigo_emergente			="";
combo_texto_nombre_emergente	="";
combo_ubicacion_tr				=""; //id de la fila a la que debe retornar lainformacion
cod_ventana_emergente_anterior	=0;
id_tabla_detalle				="";
function ver_lista_valor(cod_ventana_emergente,txt_nombre_combo, boton, ind_registro_maestro_detalle){
	f	=	document.form1;
	//=== Si la lista de valor es llamada desde un detalle debe guardar el codigo de la fila>>>
	if(ind_registro_maestro_detalle==1) {
		tr 						= boton.parentNode.parentNode; 	//captura la fila en la que esta el combo
		combo_ubicacion_tr		= tr.id;
	}
	
	

	//=== Combos donde se retornara la información >>>
	combo_codigo_emergente			= document.getElementById(txt_nombre_combo);
	combo_texto_nombre_emergente	= document.getElementById("txt_"+txt_nombre_combo);
	
	
	//=== hace que se refresque la ventana emergente >>>
	if(cod_ventana_emergente_anterior != cod_ventana_emergente){
		ventana_emergente_activa 		= 0; 	
		cod_ventana_emergente_anterior 	= cod_ventana_emergente;	
	}
	//=== hace que se refresque la ventana emergente >>>
	if(ventana_emergente_activa == 0 ){
		ventana_emergente 	= window.open ('',	'SubWind','statusbar,scrollbars,resizable,height=600,width=780, top=100,Left=200');			
		f.target						= 'SubWind';
		f.cod_ventana_emergente.value 	= cod_ventana_emergente;
		f.txt_nombre_columna_iframe.value 	= txt_nombre_combo;
		navegar(43);
		f.target						= '_self';
		ventana_emergente.focus();
		ventana_emergente_activa		=1;
	}else{
		ventana_emergente.focus();
	}

}

/*=====2010/06/01========================================================>>>>
DESCRIPCION: 	Metodo que sera llamado desde una lista de valores para vajar
				el registro seleccionado
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
valor			cadena separada por comas que contiene todo un registro resultado
				de una consulta
===========================================================================*/
/*function cargar_reg_emergente(){
	parametros							= cargar_reg_emergente.arguments;
	//alert(combo_ubicacion_tr);
	f									= document.form1;				//alias del formulario	
	window.focus();
	if(combo_ubicacion_tr != ""){
		tr				= document.getElementById(combo_ubicacion_tr);
		arr_imputs 		= tr.getElementsByTagName('input');	 //obtiene todos los imput contenidos en la fila
		num_imputs		= arr_imputs.length;
		for(j=0; j<num_imputs; j++){
			if		(arr_imputs[j].name == combo_codigo_emergente.name		 &&	parametros[0])		arr_imputs[j].value = parametros[0];
			else if	(arr_imputs[j].name == combo_texto_nombre_emergente.name && parametros[1])		arr_imputs[j].value = parametros[1];
		} 
		addRow(arr_imputs[j-1],'tabla_detalle_'+f.cod_tabla_detalle.value);//evalua si debe añadir un nuevo registro
		combo_ubicacion_tr ="";
	}else{
		combo_codigo_emergente.value		= parametros[0];
		combo_texto_nombre_emergente.value	= parametros[1];	
	}
	ventana_emergente.close();
}*/
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

/*=====2005/05/26================================================>>>>
DESCRIPCION: 	se encarga de indicar que la ventana emergente sigue abierta
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function cerrar_venana_emergente(){
	ventana_emergente_activa = 0;
}
/*=====2005/05/26================================================>>>>
DESCRIPCION: 	se encarga de indicar que la ventana emergente sigue abierta
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function activar_ventana_emergente(){
	ventana_emergente_activa = 1;
}
function f_ordenar_por(ord_por){
	f.ord_por.value = ord_por;
	f_enter();
}
f = document.form1;

function f_enter(){
	$('#form1').submit();
	
}

function f_esc(){
	f				= document.form1;
	f.esc.disabled 	= true;
	navegar_limpiando_variables(78);
}
/*=====2010/06/02==================================================>>>>
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
/*=====2010/06/02==================================================>>>>
DESCRIPCION: 	permite modificar un registro especifico
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function ver_registro(cod_pk){
	f= document.form1;
	f.target				= '_self';
	f.cod_pk.value			= cod_pk;
	navegar_limpiando_variables(37);
}


function  evalua_tecla_body(cuerpo ,evento){
	//======== evaluacion de las teclas ===========>>>>>
	var enter			= 13;
	var tecla_presionada= (window.Event) ? evento.which : evento.keyCode; //captura la tecla que fue precionada
	if(tecla_presionada== enter) navegar(13)
}

/*=====2010/06/02==================================================>>>>
DESCRIPCION: 	Salta a la pagina para la creacion de un nuevo registro
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_nuevo_registo(){
	navegar_limpiando_variables(37);
}

/*=====2010/06/02==================================================>>>>
DESCRIPCION: 	Elimina un registro especifico
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function f_eliminar_registro(){
	confirmacion = confirm ("El registro sera eliminado completamente del sistema \n\n ¿Desea Continuar?");
	if(confirmacion==true)	navegar(46)
}




/*=====2010/06/02====================================================>>>>
DESCRIPCION: 	Mascara para formato hora
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function mi_mascara(obj, masque) {
	var ch = obj.value
	var tmp = ""
	var j = 0
	ch.toString()
	if ((window.event.type == "keydown" || window.event.type == "keyup" ) && window.event.keyCode != 8) {
		for (i=0; i<ch.length; i++) {
			if (!isNaN(ch.charAt(i)) && ch.charAt(i) != " ") { tmp += ch.charAt(i) }
		}
		ch = ""
		for (i=0; i<masque.length; i++) {
			if (masque.charAt(i) == "0") { 
				if (tmp.charAt(j) != "" ) {
					ch += tmp.charAt(j)
					j++
				}
				else { ch += " " }
			}
			else { ch += masque.charAt(i) }
		}
	}
	obj.value = ch
}
/*=====2010/06/02====================================================>>>>
DESCRIPCION: 	Mascara para formato hora
AUTOR:			
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function mi_mascara2(obj, masque) {
	var ch = obj.value
	var tmp = ""
	var j = 0
	ch.toString()
	if (window.event.keyCode != 37 && window.event.keyCode != 39 && window.event.type != "keydown" && window.event.keyCode != 8 && window.event.keyCode != 46) {
		if (window.event.type == "keyup") {
			for (i=0; i<ch.length; i++) {
				if (!isNaN(ch.charAt(i)) && ch.charAt(i) != " ") { tmp += ch.charAt(i) }
			}
			ch = ""
			for (i=0; i<masque.length; i++) {
				if (masque.charAt(i) == "0") { 
					if (tmp.charAt(j) != "" ) {
						ch += tmp.charAt(j)
						j++
					}
					else { ch += " " }
				}
				else { ch += masque.charAt(i) }
			}
		}
		obj.value = ch
	}
}

