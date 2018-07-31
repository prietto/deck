  
        
    </div>
    
        <!-- modal content -->
        <div id='click_confirm'></div>
        <div id='confirm'>
            <div class='header'><span>Mensaje de confirmacion</span></div>
            <div class='message'></div>
            <div class='buttons'>
                <div class='no simplemodal-close'>No</div><div class='yes'>Si</div>
            </div>
        </div>
                         
        <input type="hidden"    name="ind_cierre_sesion"/>    
        <input type="hidden"    name="cod_navegacion"            id="cod_navegacion"  />        
        <input type="hidden" 	name="ind_limpiar_variables" />
        <input type="hidden"    name="cod_navegacion_anterior"    value="<?=$cod_navegacion?>" id="cod_navegacion_anterior"/>
        <input type="hidden"    name="cod_tabla"            	  value="<?=$cod_tabla?>" />
        <input type="hidden"    name="cod_usuario"                value="<?=$cod_usuario?>" />
        <input type="hidden"    name="cod_tabla_detalle"          value="<?=$cod_tabla_detalle?>"  />
        
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
</html>