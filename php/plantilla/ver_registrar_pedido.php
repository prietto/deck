<? require('../../Templates/layout_2/header.inc.php'); ?>



          <h1 class="page-header"><?=$alias_tabla_detalle?> DE <?=$alias_tabla_autonoma?> Nro. <?=$cod_pk?></h1>

          <div id="tabla_maestro">

              <div class="row">
                
                 
                <?=$row_imputs['cod_pedido']['input']?>
                
                <div class=" col-md-6" style='margin-bottom:20px;'>
                  <label for="<?=$row_imputs['cod_cliente']['txt_nombre']?>" class="control-label"><?=ucwords(strtolower($row_imputs['cod_cliente']['txt_alias']))?></label>
                  <?=$row_imputs['cod_cliente']['input']?>
                </div>

                 <div class=" col-md-6" style='margin-bottom:20px;'>
                  <label for="<?=$row_imputs['cod_forma_pago']['txt_nombre']?>" class="control-label"><?=ucwords(strtolower($row_imputs['cod_forma_pago']['txt_alias']))?></label>
                  <?=$row_imputs['cod_forma_pago']['input']?>
                </div>
              </div>

              <div class="row">
                <div class=" col-md-6" style='margin-bottom:20px;'>
                  <label for="<?=$row_imputs['cod_empleado']['txt_nombre']?>" class="control-label"><?=ucwords(strtolower($row_imputs['cod_empleado']['txt_alias']))?></label>
                  <?=$row_imputs['cod_empleado']['input']?>
                </div>

                 <div class=" col-md-6" style='margin-bottom:20px;'>
                  <label for="<?=$row_imputs['txt_observacion']['txt_nombre']?>" class="control-label"><?=ucwords(strtolower($row_imputs['txt_observacion']['txt_alias']))?></label>
                  <?=$row_imputs['txt_observacion']['input']?>
                </div>


              </div>
              <?=$tabla_imputs_detalle?>
              <div class="row">
                <div class="col-md-8" style="background-color:#D9EDF7;border:1px solid">
                  <div class="col-md-6">
                    <label for="<?=$row_imputs['val_recibido']['txt_nombre']?>" class="control-label"><?=ucwords(strtolower($row_imputs['val_recibido']['txt_alias']))?></label>
                    <?=$row_imputs['val_recibido']['input']?>

                    <div class="row">
                      <div class="col-md-6" style='margin-bottom:20px;'>
                        <label for="<?=$row_imputs['fec_registro']['txt_nombre']?>" class="control-label"><?=ucwords(strtolower($row_imputs['fec_registro']['txt_alias']))?></label>
                        <?=$row_imputs['fec_registro']['input']?>
                      </div>

                      <div class="col-md-6" style='margin-bottom:20px;'>
                        <label for="<?=$row_imputs['cod_estado_pedido']['txt_nombre']?>" class="control-label"><?=ucwords(strtolower($row_imputs['cod_estado_pedido']['txt_alias']))?></label>
                        <?=$row_imputs['cod_estado_pedido']['input']?>
                      </div>
                    </div>

                  </div>
                </div>

                <div class="col-md-4">
                  <div class="col-md-12">
                    <div class="row">
                      <div class=" col-md-12">
                        <label for="<?=$row_imputs['val_real']['txt_nombre']?>" class="control-label"><?=ucwords(strtolower($row_imputs['val_real']['txt_alias']))?></label>
                        <?=$row_imputs['val_real']['input']?>  
                      </div>
                    </div>
                    

                    <div class="row">
                      <div class=" col-md-12" >
                        <label for="<?=$row_imputs['val_saldo']['txt_nombre']?>" class="control-label"><?=ucwords(strtolower($row_imputs['val_saldo']['txt_alias']))?></label>
                        <?=$row_imputs['val_saldo']['input']?>
                      </div>   
                    </div>
                  </div>
                </div>
              </div>


              <br>

              <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td align="left"><input type="button" class="btn" name="esc" value="&lt;&lt; Atras" onclick="f_esc()"/></td>
                  <td align="center">&nbsp;</td>
                  <td align="right"><? if($ind_mostrar_boton_guardar){?>
                    <input name="enter"  type="button" class="pure-button" 
                      id="enter" onclick="f_enter()" value="Guardar &gt;&gt;" />
                    <? } ?></td>
                </tr>
              </table>
          </div>

        <div id="resultado"></div>
        <input name="cod_pk"                type="hidden"     value="<?=$cod_pk?>" />
        
        <input name="ind_new_row"             type="hidden"     value="<?=$ind_new_row?>" />
        <input name="cod_tabla_iframe"          type="hidden"     value="<?=$cod_tabla_iframe?>" />
        <input name="ind_guardar_datos_tabla_autonoma"  type="hidden"/>
        <input name="txt_nombre_columna_iframe"     type="hidden"    />
        <input name="nom_columna_con_foto"        type="hidden"/>    
        <input name="cod_ventana_emergente"       type="hidden">        
        <input name="val_campo"             type="hidden">    
        <input name="ind_buscar"              type="hidden">  
        <input name="array_request_reporte"       type="hidden"     value="<?=$array_request_reporte?>">            
        <iframe  name="frame_oculto" width="1" marginwidth="0"  height="1"   frameborder="0" id="frame_oculto" ></iframe>


<? require('../../Templates/layout_2/footer.inc.php'); ?>