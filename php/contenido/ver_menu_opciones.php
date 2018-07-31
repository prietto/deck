<? require('../consulta/version_sistema.php'); ?>

<style>
/* ESTILOS PARA LA VENTANA DE MENU OPCIONES USUARIO */

.arrow_box {
	margin-top: -10px;
	position: relative;
    background: red;
}
.arrow_box:after {
	bottom: 100%;
	border: solid transparent;
	content: " ";
	height: 0;
	width: 0;
	position: absolute;
	pointer-events: none;
}

.arrow_box:after {
	border-bottom-color: white;
	border-width: 5px;
	left: 50%;
	margin-left: -5px;
}

.boton, .info{
	background-color: white;
	-webkit-box-shadow: 1px 1px 10px rgba(0,0,0,0.5);
    -moz-box-shadow: 1px 1px 10px rgba(0,0,0,0.5);
    -o-box-shadow: 1px 1px 10px rgba(0,0,0,0.5);
    box-shadow: 1px 1px 10px rgba(0,0,0,0.5);
	color: black;
	/*display: none;*/
	/*margin-left: -60px;*/
	margin-top: 20px;
	position: absolute;
	width: 200px;
	text-align: left;
	z-index:10000000000200;
	right:0;
	font-family:Arial, Helvetica, sans-serif;
	font-size:13px;
	padding:0 !important;
	
}

.boton, .content{
	padding: 10px;
}
.boton, .info, .content, .titulo{
	border-bottom: solid 1px #ccc;
	font-weight: bold;
	padding-top: 10px;
	padding-bottom: 10px;
	text-align: center;
}
.boton, .info, .content, ul{
	padding: 0;
}
.boton, .info, .content ul li{
	list-style: none;
	padding: 10px;
}
.boton, .info, .content, ul li:hover{
	background: #eee;
}

.boton, .info, .content ul li a:hover{
	color: black;
	text-decoration: none;
}

.btn_li:hover{
	background-color:#666;
	cursor:pointer;
	color:#fff;
	
}

</style>



<div class="info">
	
    <div class="content">
	
    	<div class="arrow_box"></div>
	
	    <div class="titulo">Opciones</div>
		<ul>
			<li onclick="navegar_limpiando_variables(1013);" class="btn_li"><span>Cambiar Password</span></li>
			<li onClick="window.location='../proceso/logout.php';return false;" class="btn_li">Cerrar Sesion</li>
       		<li>Versión. <span>&nbsp; <?=$val_version?></span></li>
		</ul>	
	</div>
</div>

<script>
$(function(){
	
	
	function a(callback){
		var btn_a =	$('#btn_opc_user');
	
		// calcula la posicion top del boton 
		var pos_top_btn = $(btn_a).position().top;
		
		
		var w_document = $(document).outerWidth(true); // clcula el ancho del documento total sin contar scroll
		
		var w_ventana_info = $('.info').outerWidth(true);
		
		// altura del elemento padre 
		var h_btn = $(btn_a).outerHeight(true);
		
		$('.info').css('top',pos_top_btn+Number(h_btn));
		
		$('.info').css('left',w_document-Number(w_ventana_info+10));
		
		// informo que termino la funcion
		callback();
	}
	

	
	
	
	// al realizar zoom o moviemiento de la ventana se ejecuta la funcion
	$(window).resize(function(){
		$('.info').hide();
		
		// ejecuto el codigo a continuacion depues de ejecutar la funcion a
		a(function(){
			//console.log('termino la funcion');
			$('.info').show();
				
		});	
		
	})
	
	
	// ejecutamos la funcion para acomodar la ventana de opciones contra el navegador
	a(function(){});
	
	
	
	// crea evento para que al dar click fuera de la ventana esta se cierre
	// si hace click fuera de la lista entonces la esconde
	$('html').click(function(e) {
		//e.preventDefault();
		//e.stopPropagation();
		$('.info').slideUp("normal", function() { $(this).remove(); } );

	});

	
	
	
})


</script>