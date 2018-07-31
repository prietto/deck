<? require('../../Templates/layout_2/header.inc.php'); ?>

<table width="100%" border="0" align="center" cellpadding="0">
    <tr>
        <td align="center" class="titulo_principal">REGISTRO DE
            <?=$alias_tabla_autonoma?>
            Nro.
            <?=$cod_pk?>
        </td>
    </tr>
</table>

<?=$fields_box?>

<table width="100%" border="0" cellspacing="2" cellpadding="2">
    <tr>
        <td align="left"><input
            type="button"
            name="esc"
            class="contenido"
            value="&lt;&lt; Atras"
            onclick="f_esc()"/></td>
        <td align="center">&nbsp;</td>
        <td align="right"><? if($ind_mostrar_boton_guardar && $cod_pk){?>
            <input
                name="enter"
                class="contenido"
                type="button"
                id="enter"
                onclick="f_enter()"
                value="Guardar&gt;&gt;"/>
            <? } ?>
        </td>
    </tr>
</table>

<table
    width="10%"
    border="1"
    cellpadding="2"
    cellspacing="2"
    bordercolor="#999999">
    <tr>
        <td align="center" nowrap="nowrap" bgcolor="#E2F1FE">
            <a href="javascript:f_eliminar_registro()">Eliminar Registro</a>
        </td>
    </tr>
</table>


      <input name="cod_pk" 								type="hidden" 		value="<?=$cod_pk?>" />
      <input name="ind_new_row" 						type="hidden" 		value="<?=$ind_new_row?>" />
      <input name="ind_guardar_datos_tabla_autonoma" 	type="hidden"/>
      <input name="nom_columna_con_foto" 			type="hidden"/>
      <input name="txt_nombre_columna_iframe"		type="hidden">	  
      <input name="txt_ruta_mp3"					type="hidden">	  	  
      <input name="cod_ventana_emergente"			type="hidden">	 
      <input name="array_request_reporte"					type="hidden" 		value="<?=$array_request_reporte?>">   	  
      <iframe  name="frame_oculto" width="1" marginwidth="0"  height="1"   frameborder="0" id="frame_oculto" ></iframe>
	  

<script>
  function f_eliminar_registro(){
    confirmacion = confirm ("El registro sera eliminado completamente del sistema \n\n ?Desea Continuar?");
    if(confirmacion==true)	navegar(40)
  }
        </script>
          <script>
  f = document.form1;
  function f_enter(){
    f.enter.disabled = true;
    f.ind_guardar_datos_tabla_autonoma.value = 1;
    navegar(38);
  }
  function f_esc(){
    f.esc.disabled = true;
    navegar_limpiando_variables(39);
  }
</script>

<? require('../../Templates/layout_2/footer.inc.php'); ?>
