function f_enter(){
	f = document.form1;
	f.enter.disabled = true;
	f.ind_guardar_datos_tabla_autonoma.value = 1;

	navegar(1063);
}

/*===== 2016/09/19 ==========================================================>>>>
DESCRIPCION: 	Funcion para mostrar modulo informacion de empresa
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO				DESCRIPCION 
===========================================================================*/
$(function(){	

	$('#titulo_modulo_empresa').on('click',function(){
		var menu_info_empresa = leer_cookie('menu_info_empresa');

		if(menu_info_empresa == null || !menu_info_empresa){
			crear_cookie('menu_info_empresa',1);			
		}else if(menu_info_empresa == 1){
			eliminar_cookie('menu_info_empresa');
		}		

		$('#box_info_empresa').toggle('slow');

	})

})

/*===== 2016/09/19 ==========================================================>>>>
DESCRIPCION: 	Funcion para generar backup de la base de datos y limpiar el sistema
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO				DESCRIPCION 
===========================================================================*/
$(function(){
	$('#btn_backup_clean').on('click',function(e){
		e.preventDefault();



		// llama a funcion ajax que devuelve datos
		navegar_ajax_login_return(1096,function(a){ // la variable "a" es el resutlado de la consulta
			
			
			modal_deck.open({ // funcion que abre ventana
				data:a,
				width:'auto',
				height:'auto'
			},function(){
				// al terminar de abrir la ventana modal
				
			});
		})

	})

})


/*===== 2015/05/30 ==========================================================>>>>
DESCRIPCION: 	Funcion para validar y guardar informacion de la empresa
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO				DESCRIPCION 
===========================================================================*/
$(function(){

	var div_inputs = $('#box_info_empresa');

	$('#btn_info_empresa').on('click',function(e){
		e.preventDefault();

		// == llama a funcion para simular un cargador mientras completa el proceso
		f_crea_loading_pantalla('open');

		
		navegar_ajax_div_return(1095,'box_info_empresa',function(data){
			console.log(data);
			var obj_json = $.parseJSON(data);

			var code = obj_json.code;
			var msj = obj_json.msj;

			// cierra el cargador
			f_crea_loading_pantalla('close');

			if(code == 0){ // proceso exitoso
				//alert('proceso existoso!!');

				location.reload();
				
			}

			
			

		});

	})

})



/*===== 2015/05/30 ==========================================================>>>>
DESCRIPCION: 	Funcion para listar las facturas que tienen conflicto de pago
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO				DESCRIPCION 
===========================================================================*/
function f_ver_facturas_conflicto(obj){
	
	var ind_actualizar = $(obj).data('actualizar');
	var html;
	
	// se invoca a ajax para mostrar el mensje de conformacion
	var ajax = $.ajax({
    	type	: "GET",
        url		: "../plantilla/ver_lista_factura_conflicto.php",
        data	: 	{	ind_actualizar:ind_actualizar	},
		async	: true,			
		beforeSend: function(){
			$('#respuesta_servidor').remove();
			html = '<div id="box_loading" style="text-align:center;display:block;"><img src="../../imagenes/sistema/loading.gif" alt="Cargando..." /></div>';
			$(obj).after(html);
		},
		success: function(data) { // devuelve la data del servidor
			$('#box_loading').remove();
			$('#respuesta_servidor').remove();
			$(obj).after(data);
			
		 },
	});
	return false;
}


/*===== 2015/01/05 ==========================================================>>>>
DESCRIPCION: 	Funcion para cargar una imagen a un comentario
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
var index_img = 0; // pra saber que numero de peticion aplica sobre la funcion

function p_subir_imagen_logo($this,evt){

	var file_input = $($this);
	var max_size = file_input.data('max_size');

	index_img++; // numero de peticion o numero de entrada a la funcion

	// == ID DEL CAMPO ACCCIONADO = //
	var id_input_file = $($this).attr('id');

	var files_a = $($this).prop("files");
	
	var names = $.map(files_a, function(val){ 
					return val.name; 
				});

	
	var files = evt.target.files; // FileList object
		 
    for (var i=0, f; f = files[i]; i++) {
 
      // solo se procesaran imagenes si no es asi no continua
      if (!f.type.match('image.*')){
        continue;
      }
 
      var reader = new FileReader(); // creamos el objeto que lee los archivos
 
      // Closure to capture the file information.
      reader.onload = (function(theFile){

      	var fileSize = (theFile.size); // in bytes
      	
      	fileSize = fileSize/1024; // se divide en 1024 para convertirlo a KB
        
        if(fileSize>max_size){ // si el peso de la imagen supera el limite
                  
          	var max_size_limite = max_size / 1024;
          
          	$($this).filestyle('clear');
          
          	//$fileupload = $(this);  
          	//$fileupload.replaceWith($fileupload.clone(true));
          	var msj = '<p>Tu imagen sobrepasa el limite de '+Math.ceil(fileSize)+' KiloBytes</p> <p><img src="../../imagenes/sistema/error.png" /></p>';
          	modal_deck.open({
				data:msj
			});
          
          return false;
        }

        return function(e){
          // Render thumbnail.
          var span = document.createElement('div');
		  $(span).css('font-size',12);
		  $(span).css('float','left');
		  
          //span.innerHTML = ['Nombre: ', escape(theFile.name), ' || Tamanio: ', escape(theFile.size), ' bytes || type: ', escape(theFile.type), '<br /><img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/><br />'].join('');
		 // span.innerHTML = ['TamaÃ±o: ', escape(theFile.size), ' bytes <br>type: ', escape(theFile.type), '<br /><img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/><br />'].join('');
		  var src = e.target.result;
		  span.innerHTML = ['<img style="max-width:250px; max-height:250px;" src="', src,'" />'].join('');
		  $('#list-miniatura').hide().html(span).show('slow',function(){
		  		// == cuando la animacion se complete muestra el boton == //

		  		// == pinta en pantalla el boton para quitar la imagen seleccionada
		  		var html_btn_quitar = '<div id="quitar_imagen_'+index_img+'" style="margin: 5px; padding: 0px; width: 100px; float:left; display:block;" data-rel="'+id_input_file+'" class="btn btn-danger">Quitar Imagen</div>';

		  		// cuando se muestre el botond e quitar imagen activa la funcion de onclick sobre el mismo
		  		$('#list-miniatura').append(html_btn_quitar).show('slow',function(){
		  			

		  			$('#quitar_imagen_'+index_img).on('click',function(e){
		  				e.preventDefault();

		  				/*$fileupload = $('#img_upload');  
						$fileupload.replaceWith($fileupload.clone(true)); 
						
						$(this).hide('slow');
						$('#list-miniatura').fadeOut().delay(1000).empty();*/
						//quitar_imagen_publicacion(this,e);

						var id_rel = $(this).data('rel');
					    $('#'+id_rel).filestyle('clear');
					    $('#list-miniatura').fadeOut().delay(1500).empty();
						$(this).hide('slow');

		  			});
		  			



		  		});

		  });

		  



		  
          //document.getElementById('list-miniatura').insertBefore(span, null);
        };
      })(f);
 
      
      reader.readAsDataURL(f);
    }
	
	
	
	
	
}



/*===== 2015/01/05 ==========================================================>>>>
DESCRIPCION: 	Funcion para quitar o cancelar la carga de la imagen en la publicacion
AUTOR:			Luis Prieto
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
===========================================================================*/
function quitar_imagen_empresa($this,evt){
	//evt.preventDefault();
	
	$fileupload = $('#img_upload');  
	$fileupload.replaceWith($fileupload.clone(true)); 
	
	$($this).hide('slow');
	$('#list-miniatura').fadeOut().delay(1000).empty();

	// muestra el input file
	$('#box_input_file').show();

	//container.fadeOut().delay(1000).empty();
	return false;
}



function f_pinta_loading_salida(data,obj_accionado,img_loading){
	if(cod_navegacion==1096){

	}
};


function f_pinta_datos_salida(data,cod_navegacion,obj_accionado){
	if(cod_navegacion == 1096){
		console.log(data);
	}

}