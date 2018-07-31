<html>
<head>
<title>Redireccionando...</title>
</head>

<body>
</body>

<script>

	var cod_pk				= '<?=$_REQUEST['cod_pk']?>';
	var nom_elemento_dom	= '<?=$_REQUEST['txt_nombre_columna_iframe']?>';
	
	window.onload = function() {
		send_data(cod_pk,nom_elemento_dom);
	}
	
	function send_data(cod_pk,nom_elemento_dom){
		
		window.opener.recibir_dato(cod_pk,nom_elemento_dom);	
		window.close();
	}
	
	
	
</script>

</html>
