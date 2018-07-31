<div id="content_wrapper" class="border_shadow">
	<div class="div_list_result">
    	<ul>
			<?php 
			
			if($num_registros < 1){
			 ?>
			<li class="texto_resultado" ><span>No se encontraron resultados...</span></li>
            
            <?php
			}
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
var id_campo 		= '<?=$id_obj?>';
var id_campo_txt	= 'txt_'+id_campo;
var content_result	= 'content_result_<?=$cod_columna_tabla?>';


// condigo que se interpreta al cargar la pantalla o DOM
$(function(){
	var campo = $('#'+id_campo);	
	//$(campo).unbind('blur');	
	
	
	$('.list_result').on('click',function(){
		
		/*$(campo).on('change',function(e){
			e.stopImmediatePropagation();
			e.preventDefault();	
		});*/
		
		
		
		
		var val_cod_pk 		= $(this).data('cod_pk');
		var val_txt_cod_pk	= $(this).data('txt_pk');
		
		// debe ejecutar primero la funcion para cambiar el dato y luego realizar el onblur
		console.log('hola 2');
		
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
		
		
		
		//console.log('hola -- ');
		return false;
				
		//$('body').on('keyup',funcion_teclas); // vuelve a poner en funionamiento la funcion de teclas del body
		
		
		
	});
	
	
	
})




function f_pintar_seleccion(val_cod_pk,val_txt_cod_pk){

	// debe ejecutar primero la funcion para cambiar el dato y luego realizar el onblur
	console.log('hola 2');
	
	$('#'+id_campo).val(val_cod_pk);
	$('#'+id_campo_txt).val(val_txt_cod_pk);
	$('#'+id_campo_txt).change();
	$('#'+content_result).empty();
	$('#'+content_result).hide('fast');
	
	/*timer = setTimeout(function () {
           //functionCall();
		   $('#'+id_campo).blur();
		   
    }, 1000);*/
	
	
	$('#'+id_campo).bind('blur');
	
	
	
	//console.log('hola -- ');
	return false;
			
	//$('body').on('keyup',funcion_teclas); // vuelve a poner en funionamiento la funcion de teclas del body
}

$(function(){
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