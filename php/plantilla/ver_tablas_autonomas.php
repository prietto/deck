<? require('../../Templates/head_home.inc.php'); ?>

      <div style="margin: 0 auto -50px; min-height: 100vh;">
        <div class="panel text-right">        
          <div class="bg-info">
            <?php if($cod_usuario){ 
                $txt_login = $_SESSION['nom_user'];
            ?>
                Hola, <a href="javascript:void(0);" id="btn_opc_user" ><?=$txt_login;?></a> 
            <? } ?> 
          </div>
        </div>



      
        

        <div class="container">
          <span class="col-md-12 col-xs-12 panel panel-primary text-center">
            <h1>Modulos del Sistema</h1>
          </span>
          <? 

          while($rowModule = $db->sacar_registro($cursor_modulos)){          
            $codModule    = $rowModule['cod_tabla'];
            $iconModule   = $rowModule['icon'] ? $rowModule['icon'] : 'fa-bullseye'; 
            $detailModule = $rowModule['cod_tabla_detalle'] ? $rowModule['cod_tabla_detalle'] : 'null' ; 



            

            if(in_array($codModule, $arrayModules)){ ?>

              <div class="col-md-3 text-center col-xs-12 col-sm-12">
                <button class="btn btn-md btn-hover btn-default col-xs-12 col-sm-12 col-md-12" style="margin-bottom:10px;" onclick="goToModule(<?=$codModule?>,<?=$detailModule?>);" >
                  <div class="ellipsis">
                    <label><?=$rowModule['txt_alias']?></label>
                  </div>

                  <div class="text-center" >
                    <i class="fas <?=$iconModule?> fa-5x"></i>                
                  </div>
                </button>
              </div>
                  
                

                


          <?
            } 

          }

          ?>
        


          <? if($cod_perfil == 1) { ?>
            <div class="col-md-3 text-center col-xs-12 col-sm-12">
              <button class="btn btn-md btn-hover btn-default col-xs-12 col-sm-12 col-md-12" style="margin-bottom:10px;" onclick="navegar(1062);">
                <div class="ellipsis">
                  <label>Ajustes</label>
                </div>
                <i class="fas fa-globe fa-5x"></i>                
              </button>
            </div>
            
            <div class="col-md-3 text-center col-xs-12 col-sm-12">
              <button class="btn btn-md btn-hover btn-default col-xs-12 col-sm-12 col-md-12" style="margin-bottom:10px;" onclick="navegar(200);">
                <div class="ellipsis">
                  <label>Anexos</label>
                </div>

                <div class="text-center">
                  <i class="fas <?=$iconModule?> fa-5x"></i>                
                </div>
              </button>                
            </div>

          <? } ?>   
        </div>

      </div>
      


      <footer class="footer text-center">
        <? if($_COOKIE['cod_empresa']){ ?>
          <p>Sistema de informacion desarrollado para <?=$_COOKIE['txt_seg_empresa']?> | Todos los derechos reservados © 2018</p>
        <? }else{ ?>
          <p>Todos los derechos reservados © 2018</p>
        <? } ?>
      </footer>
	 		    
          
    
<script>
f		=	document.form1;
function f_ver_estadisicas (){
	//f.target = "_blank";
	ventana_emergente 	= window.open ('',	'SubWind','statusbar,scrollbars,resizable,height=600,width=780, top=100,Left=600');			
	f.target						= 'SubWind';
	navegar(1045);
	f.target = "_self";	
	
}
</script>		  
<script>
function f_ver_consultar_maetro_detalle(cod_tabla,	cod_tabla_detalle){
	f	=	document.form1;
	f.cod_tabla.value			=	cod_tabla;
	f.cod_tabla_detalle.value	=	cod_tabla_detalle;	
	f.ind_buscar.value	=	1;	
	
	navegar_limpiando_variables(78);
}
</script>		  
<script>
function f_ver_consultar_tabla(cod_tabla){
	f	=	document.form1;
	f.cod_tabla.value	=	cod_tabla;
	f.ind_buscar.value	=	1;	
	navegar(39);
}
          </script>
<script>
function f_sincronizar(){
	confirmacion = confirm("Su panel quedara suspendido mientras sincroniza los servidores \n ?Desea Continuar?");
	if(confirmacion) navegar (1020);
}
</script>
            <script>
function f_esc(){
	navegar_limpiando_variables(10)
}
          </script>


          
                       
                        
    <!-- modal content -->
    <div id='click_confirm'></div>
    <div id='confirm'>
      <div class='header'><span>Mensaje de confirmacion</span></div>
      <div class='message'></div>
      <div class='buttons'>
          <div class='no simplemodal-close'>No</div><div class='yes'>Si</div>
      </div>
    </div>

    <input name="ind_buscar"      type="hidden" />                         
    <input type="hidden" 					name="cod_usuario" value="<?=$cod_usuario?>" />
    <input name="cod_navegacion" 			type="hidden" id="cod_navegacion"  />
    <input name="cod_navegacion_anterior" 	type="hidden" id="cod_navegacion_anterior" value="<?=$cod_navegacion?>" />
    <input type="hidden" 					name="ind_limpiar_variables" />
    <input name="cod_tabla" 				type="hidden"	value="<?=$cod_tabla?>" />
    <input name="cod_tabla_detalle"			value="<?=$cod_tabla_detalle?>" type="hidden" />
    <input name="ind_cierre_sesion"			type="hidden" />
      
       
  </div>
</form>
<script>

window.onload=function(){
	var pos=window.name || 0;
	window.scrollTo(0,pos);
}
window.onunload=function(){
	window.name=self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
}

/*function  evalua_tecla_body(cuerpo ,evento){
	var tecla_presionada= (window.event) ? evento.which : evento.keyCode; //captura la tecla que fue precionada
	
	if(tecla_presionada== 13 ){
		f_enter();
	}
	else if(tecla_presionada== 27 ){
		f_esc();
	}
}*/

function f_navegar_menu(cod_navegacion,cod_tabla,cod_tabla_detalle){
	f=document.form1;
	f.cod_tabla.value			=	cod_tabla;
	f.cod_tabla_detalle.value	=	cod_tabla_detalle;	
	navegar_limpiando_variables(cod_navegacion);
}
</script>


</body>
<!-- InstanceEnd --></html>
