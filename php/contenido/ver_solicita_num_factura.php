<style>
#reporte_pago_empleado{
   border-collapse: collapse;
}
</style>

<h2>A continuacion ingrese el numero de factura</h2>

<table width="100%" id="reporte_pago_empleado" border="1" style="border:1px solid grey;" class="tabla_reporte" cellpadding="5" cellspacing="5" >
  <tr class="titulo_tabla">   
    <td>No. Factura</td>
  </tr>
  
  
  <tr>
    <td align="center" nowrap="nowrap">
      <input type="text" name="num_factura_manual" id="num_factura_manual" />
    </td>   
  </tr>
  
  
  
</table>

<div style="display: block; text-align: center; margin: 10px 0px;">  
  <input type="button"  
            class="pure-button"  
                value="Enviar" 
                name="enter_enviar" 
                id="enter_enviar" 
                style="background-color:green"
                
            />

</div>


<script>
  $(function(){

    // situa cursor sobre el campo de numero de factura
    $('#num_factura_manual').focus();


    // debe añadir comportamiento sobre el boton enter para enviar el numero de factura
    // despues de enviado y todo ok, situar cursor sobre el cliente para digitarlo
    // y que por medio del boton enter de continuidad en los pasos para generar pedido o factura
    $('#enter_enviar').on('click',function(e){      
      e.preventDefault();


      navegar_ajax_return(1099,function(a){

        console.log(a);

        var obj_json = $.parseJSON(a);
        var code_error = obj_json.code_error;


        if(code_error == 1){ // existe un error
          var msj_error = obj_json.msj_error;


        }else if(code_error == 0){
          var code_pk_factura = obj_json.code_pk_factura;
          var html = "<p>Factura Bloqueada: "+code_pk_factura+"<p>";

          $('#ind_facturacion_manual').append(html);

        }


        return false;

      });

    })
  })

</script>