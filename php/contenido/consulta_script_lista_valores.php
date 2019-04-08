<div id="content_wrapper" class="border_shadow">
	<div class="div_list_result">
    	<ul>
			<?php 
			
			if($num_registros < 1){ ?>
				<li class="texto_resultado" ><span>No se encontraron resultados...</span></li>
            
            <? }

            while($row=$db->sacar_registro($cursor)){
                
                $cod_pk_result	= $row[0];
                $txt_resultado  = $row[1];
                
            
            
            ?>
    			<li class="list_result"  data-cod_pk="<?=$cod_pk_result?>" data-txt_pk="<?=$txt_resultado?>" ><span><?=$txt_resultado?></span></li>
        

		<? } 
		?>

        </ul>
    
    </div>

</div>


<script>
var id_campo_accionado 		= '<?=$id_obj?>';
var id_campo_padre			= $('#'+id_campo_accionado).data('input_padre');
var content_result			= 'content_result_<?=$cod_columna_tabla?>';

// condigo que se interpreta al cargar la pantalla o DOM
$(function(){
	var campo_padre 	= $('#'+id_campo_padre);
	var campo_txt 		= $('#'+id_campo_accionado);
	
	//$(campo).unbind(); // se comento esta linea pero no hay seguridad de para que servia
		
	// ejecuta condigo al realizar click sobre seleccion
	$('.list_result').on('click',function(evt){
		
		evt.preventDefault();	
		evt.stopImmediatePropagation();
		
		var val_cod_pk 		= $(this).data('cod_pk');
		var val_txt_cod_pk	= $(this).data('txt_pk');

		console.log('val_txt_cod_pk=> ',val_txt_cod_pk);
		$(campo_padre).val(val_cod_pk);
		$(campo_txt).val(val_txt_cod_pk);
		$(campo_txt).attr("readonly",true);
		
		$(campo_padre).change();
		$('#'+content_result).empty();
		$('#'+content_result).hide('fast');

		//$(campo).blur(); // simula un blur(clic fuera del input) al input de busqueda
		
		
	});
	
	
	
	/*$(campo).on('change',function(e){
		
		$('.list_result').on('click',function(evt){
			//evt.stopImmediatePropagation();
			//evt.preventDefault();	
			
			console.log('hey hey');
			
			var val_cod_pk 		= $(this).data('cod_pk');
			var val_txt_cod_pk	= $(this).data('txt_pk');
	
			$('#'+id_campo).val(val_cod_pk);
			$('#'+id_campo_txt).val(val_txt_cod_pk);
			$('#'+id_campo_txt).change();
			$('#'+content_result).empty();
			$('#'+content_result).hide('fast');
			
			
		});
		
		e.stopImmediatePropagation();
		e.preventDefault();	
		
		
		console.log('hola 2');
		
		return false;
				
		//$('body').on('keyup',funcion_teclas); // vuelve a poner en funionamiento la funcion de teclas del body
		
		
		
	});*/
	
	
	
})





function f_pintar_seleccion(val_cod_pk,val_txt_cod_pk){
	return false;

	// por aca no esta entrando


	// debe ejecutar primero la funcion para cambiar el dato y luego realizar el onblur
	//console.log('hola 2');
	
	$('#'+id_campo).val(val_cod_pk);
	$('#'+id_campo_txt).val(val_txt_cod_pk);
	$('#'+id_campo_txt).change();
	$('#'+content_result).empty();
	$('#'+content_result).hide('fast');
	
	/*timer = setTimeout(function () {
           //functionCall();
		   $('#'+id_campo).blur();
		   
    }, 1000);*/
	
	
	//$('#'+id_campo).bind('blur');
	$('#'+id_campo).blur();

	//$(campo).blur(); // simula un blur(clic fuera del input) al input de busqueda
	
	return false;
			
	//$('body').on('keyup',funcion_teclas); // vuelve a poner en funionamiento la funcion de teclas del body
}


$(function(){

	//$('#'+id_campo).unbind('blur'); // desactiva el manejador unblur
	
	// si hace click fuera de la lista entonces la esconde
	$('html').click(function(e) {
		//e.preventDefault();
		//e.stopPropagation();
		$('#'+content_result).empty();
		$('#'+content_result).hide('fast');
		//$('body').on('keyup',funcion_teclas); // vuelve a poner en funionamiento la funcion de teclas del body
	});


	$('#content_wrapper').click(function(e){
		e.stopPropagation();
	})


})



</script>