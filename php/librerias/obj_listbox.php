<?
/*=====2005/05/23=======================================D E C K===>>>>
DESCRIPCION: 	Contiene diferentes funciones realcionadas con el objeto ListBox
PROPIETARIO:	© D E C K
AUTOR:			Cristian Arellano
---------------------------------------------------------------------------					
HISTORIAL DE MODIFICACIONES
---------------------------------------------------------------------------					
FECHA	AUTOR		MODIFICACION
===========================================================================*/
class obj_listbox{

	/*=====2007/04/07===================================D E C K===>>>>
	DESCRIPCION: 	Construye un campo buscador a travez de ajax
	AUTOR:			Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA	AUTOR		MODIFICACION
	===========================================================================*/
  	function f_crear_buscador_ajax($txt_nombre_columna, $cod_columna_tabla,$value,$num_zise_input="element"){
  		if(!$txt_nombre_columna || !$cod_columna_tabla)return false;
  		global $db;

  		// debe consultar la columna para retornar la informacion de la misma
  		$query = "select txt_placeholder from columna_tabla_autonoma where cod_columna_tabla = ".$cod_columna_tabla;
  		$row = $db->consultar_registro($query);

  		$txt_placeholder = $row['txt_placeholder'];
  		if(!$txt_placeholder) $txt_placeholder = 'Escriba su busqueda...';

  		$input	=  "
			
						<input 	type='hidden' 
								id='".$txt_nombre_columna."' 
								name='".$txt_nombre_columna."' 
								class='' 
								value='".$value."' 
								$required
								data-plugin='select2'
								data-placeholder='".$txt_placeholder."'
								data-cod_columna_tabla='".$cod_columna_tabla."'
						>			
			 
						
						<script>

							$(function(){
								
								
								$('#".$txt_nombre_columna."').select2({
										minimumInputLength : 0	,
										allowClear: true		,
										addSelectedTitle: true	,
										width: '".$num_zise_input."'		,
										/*formatSelection: function(item) {
									        // Debugging -- open the developer console to see what you can access from the item object
											//alert(item.text);
											var text_this = item.text;
											alert($(this).find('.select2-chose').length);
											$(this).find('.select2-chose').attr('title',text_this);

									       return item.text;
									       // return '<strong>' + item.id + '</strong>';
									    },*/
										
																
										ajax: {
										  url: '../consulta/consulta_script_columna.php',
										  dataType: 'json',
										  data: function (term, page) {
											return {
											  term: term,
											  cod_columna_tabla: ".$cod_columna_tabla."
											};
										  },
										  results: function (data, page) {
										  	return { results: data.results };
										  }
										},
										initSelection: function(element, callback) {
											// revisa si el elemento tiene un valor inicial o por default y lo carga despues de cargar el plugin
											// element es el elemento del dom al que se le aplico el plugin select2 y callback la funcion a llamar despues de buscar el valor

											return $.getJSON('../consulta/consulta_script_columna.php?cod_columna_tabla=".$cod_columna_tabla."&id=' + (element.val()), null, function(data) {
													console.log(data);
													return callback(data);
								
											});
										}
									}).on('select2-open', function() {
									    	//alert('open');
											$('body').unbind('keyup',funcion_teclas); // frena el funcionamiento de teclas del body
											var a = $('#s2id_".$txt_nombre_columna."').find('.select2-chosen');
											$(a).tooltip().tooltip('close');

								     }).on('select2-selecting', function(e) {
								         //alert('selecting val=e.val choice=e.object.text');
										 //$(this).blur();
									});
									
									
								});
						
						</script>	";

		return $input;


  	}
	
	/*=====2007/04/07===================================D E C K===>>>>
	DESCRIPCION: 	Construye una lista de valor a partir de un cursor
	AUTOR:			Juan Fontecha M.
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	$cursor			cursor generado a partir de una consulta determinada
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA	AUTOR		MODIFICACION
	===========================================================================*/
  	function f_crear_lista_vector_multiple($vector, $vector_full) 	  
	{
		global $db;


		$cadena1="--";
		$cantidad_elementos = count($vector_full);
		for($i=0; $i<$cantidad_elementos; $i++){
			
			$dato1 = current($vector_full);
			$dato2 = current($vector);
	
			if($dato1 && $dato2){ 
				$selected = 'selected';

			}else{
				 $selected = '';
			}
			
			$dato1[1]	= strtolower($dato1[1]);
			$dato1[1]	= ucfirst($dato1[1]);

			$cadena = $cadena."<option value='".$dato1[0]."' $selected>".$dato1[1]."</option>";
			
			next($vector_full);
			next($vector);
		}
		return $cadena;
	}
	
	/*=====2014/01/20========================================D E C K===>>>>
	DESCRIPCION: 	Construye una lista de valor a partir de la consulta		
					obtenida por un cursor.
	AUTOR:			Juan Fontecha M.
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	$cursor			cursor generado a partir de una consulta determinada
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA	AUTOR		MODIFICACION
	===========================================================================*/
  	/*function f_crear_lista_multiple($cursor, $arr_select=NULL) 	  
	{
		global $db;
		$cadena1		=	"--";
		$num_registros 	= 	$db->num_registros($cursor);
		for($i=0; $i<$num_registros; $i++){
			$row =$db->sacar_registro($cursor,$i);
			$cod_select = $arr_select[$i];
			if($row[0] == $cod_select) $selected = 'selected';
			else  $selected = '';

			$row[1]		= ucfirst(strtolower($row[1]));
			$cadena = $cadena."<option value='$row[0]' $selected>$row[1]</option>";
		}
		return $cadena;
	 }*/	
	 
	 
	/*=====2005/04/09========================================D E C K===>>>>
	DESCRIPCION: 	Construye lista multiple select
	AUTOR:			Luis Prieto
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	$cursor			cursor generado a partir de una consulta determinada
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA	AUTOR		MODIFICACION
	===========================================================================*/
  	function f_crear_lista_multiple($cursor, $cod_select=NULL, $max_caracteres){
		global $db;
		$cadena1		=	"--";
		

		$num_registros 	= 	$db->num_registros($cursor);
		for($i=0; $i<$num_registros; $i++){
			$row 		=$db->sacar_registro($cursor,$i);
			$row[1] = utf8_encode(ucwords(strtolower(utf8_decode($row[1])))); // deja en minuscula

			if (is_array($cod_select)){  // para el tema de los selectores multiples
				$num_seleccion = count($cod_select);
				for($j=0;$j<$num_seleccion;$j++){
					$cod_seleccionado = $cod_select[$j];
					
					$row_cursor = $row[0];
				
					if($row[0] == $cod_seleccionado){
							$selected = 'selected';
							break;
					}else{
						$selected = '';
					}

				}
			}
			
			if(!is_array($cod_select)){
				if($row[0] == $cod_select){
					 $selected = 'selected';
				}else{
					$selected = '';							
				}
			}

			//== Evalua que el combo no quede muy largo
			$num_caracteres =strlen($row[1]);
			if($num_caracteres>$max_caracteres){
				$row[1] = substr($row[1],0,$max_caracteres)."...";
			} 
			
			$cadena = $cadena."<option value='$row[0]' $selected>$row[1]</option>";
			
		}
		return $cadena;
	}
	 
	/*=====2007/04/07========================================D E C K===>>>>
	DESCRIPCION: 	Metodo para crear un combo con los dias del mes
	AUTOR:			Cristian Arellano
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	$cursor			cursor generado a partir de una consulta determinada
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA	AUTOR		MODIFICACION
	===========================================================================*/
  	function f_crear_lista_dias($cod_select=NULL){
		$verctor= array();
		for($i=0;$i<31; $i++){
			if($i<9) $cero = "0"; else $cero = "";
			$verctor[$i][0]	= $cero.$i+1;
			$verctor[$i][1]	= $cero.$i+1;
		}
		$cadena	= $this->f_crear_lista_vector($verctor, $cod_select);
		return $cadena;
	}
	/*=====2007/04/07========================================D E C K===>>>>
	DESCRIPCION: 	Metodo para crear un combo con los meses del año
	AUTOR:			Cristian Arellano
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	$cursor			cursor generado a partir de una consulta determinada
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA	AUTOR		MODIFICACION
	===========================================================================*/
  	function f_crear_lista_mes($cod_select=NULL){
		$verctor= array();
		$verctor[0][0]	= "01";
		$verctor[0][1]	= "Ene";
		$verctor[1][0]	= "02";
		$verctor[1][1]	= "Feb";
		$verctor[2][0]	= "03";
		$verctor[2][1]	= "Mar";
		$verctor[3][0]	= "04";
		$verctor[3][1]	= "Abr";
		$verctor[4][0]	= "05";
		$verctor[4][1]	= "May";
		$verctor[5][0]	= "06";
		$verctor[5][1]	= "Jun";
		$verctor[6][0]	= "07";
		$verctor[6][1]	= "Jul";		
		$verctor[7][0]	= "08";
		$verctor[7][1]	= "Ago";				
		$verctor[8][0]	= "09";
		$verctor[8][1]	= "Sep";				
		$verctor[9][0]	= "10";
		$verctor[9][1]	= "Oct";
		$verctor[10][0]	= "11";
		$verctor[10][1]	= "Nov";
		$verctor[11][0]	= "12";
		$verctor[11][1]	= "Dic";
		$cadena	= $this->f_crear_lista_vector($verctor, $cod_select);
		return $cadena;
	}	
	/*=====2007/04/07========================================D E C K===>>>>
	DESCRIPCION: 	Metodo para crear un combo con los meses del año
	AUTOR:			Cristian Arellano
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	$cursor			cursor generado a partir de una consulta determinada
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA	AUTOR		MODIFICACION
	===========================================================================*/
  	function f_crear_lista_mes_largo($cod_select=NULL){
		$verctor= array();
		$verctor[0][0]	= "01";
		$verctor[0][1]	= "Enero";
		$verctor[1][0]	= "02";
		$verctor[1][1]	= "Febrero";
		$verctor[2][0]	= "03";
		$verctor[2][1]	= "Marzo";
		$verctor[3][0]	= "04";
		$verctor[3][1]	= "Abril";
		$verctor[4][0]	= "05";
		$verctor[4][1]	= "Mayo";
		$verctor[5][0]	= "06";
		$verctor[5][1]	= "Junio";
		$verctor[6][0]	= "07";
		$verctor[6][1]	= "Julio";		
		$verctor[7][0]	= "08";
		$verctor[7][1]	= "Agosto";				
		$verctor[8][0]	= "09";
		$verctor[8][1]	= "Septiembre";				
		$verctor[9][0]	= "10";
		$verctor[9][1]	= "Octubre";
		$verctor[10][0]	= "11";
		$verctor[10][1]	= "Noviembre";
		$verctor[11][0]	= "12";
		$verctor[11][1]	= "Diciembre";
		$cadena	= $this->f_crear_lista_vector($verctor, $cod_select);
		return $cadena;
	}	
	/*=====2007/04/07========================================D E C K===>>>>
	DESCRIPCION: 	Metodo para crear un combo con los meses del año
	AUTOR:			Cristian Arellano
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	$cursor			cursor generado a partir de una consulta determinada
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA	AUTOR		MODIFICACION
	===========================================================================*/
  	function f_crear_lista_year($year_inicial, $year_final, $cod_select=NULL){
		$verctor	= array();
		$contador	= 0;
		for($i=$year_inicial; $i<=$year_final;$i++){
			$verctor[$contador][0]	= $i;
			$verctor[$contador][1]	= $i;			
			$contador++;
		}
		$cadena	= $this->f_crear_lista_vector($verctor, $cod_select);
		return $cadena;
	}	
	
	/*=====2005/04/09========================================D E C K===>>>>
	DESCRIPCION: 	Construye una lista de valor a partir de la consulta		
					obtenida por un cursor.
	AUTOR:			Juan Fontecha M.
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	$cursor			cursor generado a partir de una consulta determinada
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA	AUTOR		MODIFICACION
	===========================================================================*/
  	function f_crear_lista($cursor, $cod_select=NULL) 	  
	{
		global $db;
		$cadena1		=	"--";
		$num_registros 	= 	$db->num_registros($cursor);
	
		for($i=0; $i<$num_registros; $i++){
			$row =$db->sacar_registro($cursor,$i);
			if($row[0] == $cod_select) $selected = 'selected';
			else  $selected = '';
			$row[1]		= ucfirst(strtolower($row[1]));
			$cadena = $cadena."<option value='$row[0]' $selected>$row[1]</option>";
		}
		return $cadena;
	  }
	/*=====2007/04/07===================================D E C K===>>>>
	DESCRIPCION: 	Construye una lista de valor a partir de un cursor
	AUTOR:			Juan Fontecha M.
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	$cursor			cursor generado a partir de una consulta determinada
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA	AUTOR		MODIFICACION
	===========================================================================*/
  	function f_crear_lista_vector($vector, $cod_select=NULL) 	  
	{
		global $db;
		$cadena1="--";
		$cantidad_elementos = count($vector);
		for($i=0; $i<$cantidad_elementos; $i++){
			
			if($vector[$i][0] == $cod_select){ 
				$selected = 'selected';

			}else{
				 $selected = '';
			}
			$row[1]		= ucfirst(strtolower($row[1]));
			$cadena = $cadena."<option value='".$vector[$i][0]."' $selected>".$vector[$i][1]."</option>";
		}
		return $cadena;
	}
	/*=====2005/04/09========================================D E C K===>>>>
	DESCRIPCION: 	Construye una lista a partir de un cursor pero la cantidad de letras
					no puede execer un tamaño especifico
	AUTOR:			Cristian Arellano
	---------------------------------------------------------------------------					
	PARAMETRO		DESCRIPCION 
	$cursor			cursor generado a partir de una consulta determinada
	---------------------------------------------------------------------------					
	HISTORIAL DE MODIFICACIONES
	---------------------------------------------------------------------------					
	FECHA	AUTOR		MODIFICACION
	===========================================================================*/
  	function f_crear_lista_limite_caracteres($cursor, $cod_select=NULL, $max_caracteres){
		global $db;
		$cadena1		=	"--";
		$num_registros 	= 	$db->num_registros($cursor);
		if(!$max_caracteres){$max_caracteres = 35;}
		
		for($i=0; $i<$num_registros; $i++){
			$row 		=$db->sacar_registro($cursor,$i);
			$title 		=NULL;			
			$row[1] = ucfirst(strtolower($row[1])); // deja en minuscula

			if($row[0] == $cod_select) $selected = 'selected';
			else  $selected = '';
			//== Evalua que el combo no quede muy largo
			$num_caracteres =strlen($row[1]);
			if($num_caracteres>$max_caracteres){
				$cadena_completa = $row[1];
				$row[1] = substr($row[1],0,$max_caracteres)."...";
				$title = 'title="'.$cadena_completa.'"';
				
			} 
			$cadena = $cadena."<option value='".$row[0]."' ".$title." ".$selected.">".$row[1]."</option>";
		}
		

		return $cadena;
	}
}
?>