<? require('../../Templates/layout_2/header.inc.php'); ?>
      
      <h1>CONSULTA DE <?=$alias_tabla_autonoma?></h1>
      <div id="msj_respuesta_servidor"></div>
      <div style="position:relative;">

        
        <div id="tabla_filtros">
          <?=$panelFiltros?>
        </div>
        <hr />

        <div id="actionsBtn" class="col-md-12 input-group text-center">
          <button name="enter2" class="btn btn-primary" type="button" id="enter2" onclick="f_nuevo_registo();$(this).attr('disabled',true);">Nuevo Registro</button>  
          <button class="btn btn-primary" name="enter" id="enter" onclick="f_enter()" type="button">Consultar</button>
          <input name="ind_imprimir_reporte" style="visibility:hidden" type="checkbox" id="ind_imprimir_reporte" value="1" />                      
          <a  href="javascript:void(0);" onclick="f_imprimir_reporte();">Imprimir</a>

          &nbsp;&nbsp;
          <a href="javascript:void(0)" onclick="f_exportar_excel(<?=$cod_navegacion?>,event);">Exportar Excel</a>
        </div>
    
    <?=$tabla_resultado?>

    <?=$tabla_paginas?>
                  
         

      <input name="cod_pk"            type="hidden">
      <input name="ind_buscar"          type="hidden">
      <input name="num_pagina"          type="hidden" />
      <input name="ord_por"           type="hidden"   value="<?=$ord_por?>"/>
      <input name="txt_nombre_columna_iframe" type="hidden">    
      <input name="cod_ventana_emergente"   type="hidden">
      <input name="cod_atenciones"        type="hidden">
      <input name="ind_limpiar_ord"       type="hidden">
      <input name="cod_autorizacion_pk"       type="hidden">
    <input name="cod_paciente_pk"       type="hidden">
            <input name="num_procesos_adicionales"  type="hidden" value="<?php echo $num_procesos_adicionales?>">

      <iframe  name="frame_oculto" marginwidth="0"  width="0" height="0"   frameborder="0" id="frame_oculto" ></iframe>
      
<script language="javascript">



// MANTIENE LA POSICION DEL SCROLL AL RECARGAR LA PAGINA
window.onload=function(){
  var pos=window.name || 0;
  window.scrollTo(0,pos);
}
window.onunload=function(){
  window.name=self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
}

document.getElementById('tabla_filtros').width = screen.width;

</script>
<script>
function f_imprimir_reporte(){
  f     = document.form1;
  f.ind_buscar.value  = 1;
  f.ind_imprimir_reporte.checked=true;
  f.target  = "_blank";
  navegar(41);
  f.submit();
  f.target  = "_self";
  f.ind_imprimir_reporte.checked=false;   
}   
    </script>



<? require('../../Templates/layout_2/footer.inc.php'); ?>