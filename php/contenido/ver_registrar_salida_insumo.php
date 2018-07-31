<style>
#form_salida_insumo{
	 /*border-collapse: collapse;*/
   padding: 20px;
   border-radius: 5px;
}
#form_salida_insumo input[type='text']{
  width: 100%;

}

.nota_salida{
  font-size: 16px;
}

.nota_salida span{
  font-weight: bold;
}



</style>

<h2>Ingrese los datos para generar la salida del insumo</h2>

<div class="nota_salida">Cantidad en almacenamiento actual: <span><?=$row_insumo['num_cantidad']?></span></div>

<table width="1%" align="center" id="form_salida_insumo" 
    border="0" style="border:1px solid grey;" class="tabla_reporte" cellpadding="3" cellspacing="3" >
  <tr>
    <td align="left"  nowrap="nowrap">Insumo</td>
    <td align="center" nowrap="nowrap">:</td>
    <td align="left" nowrap="nowrap"><?=$row_insumo['txt_nombre']?></td>
  </tr>

  <tr>
    <td align="left"  nowrap="nowrap">Codigo</td>
    <td align="center" nowrap="nowrap">:</td>
    <td align="left" nowrap="nowrap"><?=$row_insumo['cod_insumo']?></td>
  </tr>
  
   <tr>
    <td align="left" nowrap="nowrap">Cantidad</td>
    <td align="center" nowrap="nowrap">:</td>
    <td align="left" nowrap="nowrap">
      <input name="num_cantidad" id="num_cantidad" type="number" value="" required="required" autocomplete="off"   >
    </td>
  </tr>

   <tr>
    <td align="left" nowrap="nowrap">Peso</td>
    <td align="center" nowrap="nowrap">:</td>
    <td align="left" nowrap="nowrap">
      <input name="num_peso" id="num_peso" type="number" value=""  autocomplete="off"   >
    </td>
  </tr>

   <tr>
    <td align="left" nowrap="nowrap">Nota</td>
    <td align="center" nowrap="nowrap">:</td>
    <td align="left" nowrap="nowrap">
      <textarea name='txt_nota' id="txt_nota" ></textarea>      
    </td>
  </tr>

  <tr>
    <td align="left" nowrap="nowrap">Fec Registro</td>
    <td align="center" nowrap="nowrap">:</td>
    <td align="left" nowrap="nowrap">
      <input  name    ='fec_salida_insumo'             
              type    ='text' 
              id      ='fec_salida_insumo' 
              class   = 'datepicker'
              value   ='<?=date('Y-m-d H:i:s')?>' 
              readonly              
              size    ='10' 
              required="requiresd"
        />
    </td>
  </tr>

  
  
</table>

<div style="display: block; text-align: center; margin: 10px 0px;">	

	<input type="button"  
        		class="pure-button"  
                value="Guardar" 
                name="enter_registrar" 
                id="enter_registrar" 
                style="background-color:#0C3"
                
            />


</div>

<input type="hidden" name="cod_insumo_seleccionado" required="required" value="<?=$reg_seleccionado?>" />


<script>
	$(function(){
		$('#enter_registrar').on('click',function(e){		

			e.preventDefault();
      var error = 0;

      var cod_insumo = $('input[name="cod_insumo_seleccionado"]').val();
      var form_salida_insumo = $('#form_salida_insumo');
      var inputs_required = $(form_salida_insumo).find(':input[required]',':textarea[required]');

      // valida los campos ingresados
      $(inputs_required).each(function(index,element){
        var val_element = $.trim($(element).val()); 

        //== si el valor es nulo>>
        if(!val_element){
          $(element).css({
            'border-color':'red'
          });
          
          error++;
        }else{
          $(element).css({
            'border-color':''
          });
        }
      
      })// fin each

      if(error == 0){
        navegar_ajax(1087,$(this));  
      }
			

		}) // fin funcion onclick


	}) // fin $(function(){})

$(function(){ 
  $('#fec_salida_insumo').datetimepicker({
    changeMonth: true, // Muestra comobobox para seleccionar el mes
    changeYear:  true, // Muestra comobobox para seleccionar el aÃ±o
    yearRange: 'c-100:c+10',
    //minDate: new Date(2010, 11, 20, 8, 30), // para poner un minimo de fecha
    //minDate: 0,
    //dateFormat: 'yy-mm-dd',
    defaultDate: new Date(),
    onSelect: function(){
      $('#val_saldo').focus();
    }
  });
})



// FUNCION PARA MOSTRAR INDICIO O SIMBOLO DE LOS CAMPOS QUE SON OBLIGATORIOS
$(function(){
  var form_salida_insumo = $('#form_salida_insumo');
  var inputs_required = $(form_salida_insumo).find(':input[required]',':textarea[required]');

  $(inputs_required).each(function(index,element){
    $(element).attr('placeholder','Campo Obligatorio');
  })



})

</script>