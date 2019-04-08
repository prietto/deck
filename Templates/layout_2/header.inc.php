<!DOCTYPE HTML>
<html lang="es"><!-- InstanceBegin template="/Templates/contenido_interno.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">-->
<link href="../../estilos/multiselect.css" rel="stylesheet" type="text/css" />
<link href="../../estilos/hover_master.css" rel="stylesheet" type="text/css" />
<link href="../../estilos/estilo_tabla.css" rel="stylesheet" type="text/css" />
<link href="../../estilos/buttons.css" rel="stylesheet" type="text/css" />
<link href="../../estilos/jquery-ui.css" rel="stylesheet" type="text/css"  />

<link href="../../estilos/select2.css" rel="stylesheet" type="text/css"  />
<link href="../../estilos/select2-bootstrap.css" rel="stylesheet" type="text/css"  />
<link href="../../estilos/timepicker.css" rel="stylesheet" type="text/css" />
<link href="../../estilos/estilo_general.css" rel="stylesheet" type="text/css" />

<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<script defer src="../../js/fontawesome/js/fontawesome-all.js"></script>
<script src="../../js/jquery-1.11.2.min.js"></script>
<script src="../../js/jquery.cookie.js"></script>
<script src="../../js/jquery-ui.js" ></script>

<!-- CDN BOOTSTRAP -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="../../js/jquery.simplemodal.js" ></script>
<script src="../../js/timepicker.js"></script>
<script src="../../js/select2.js"></script>
<script src="../../js/jquery_multiselect.js" ></script>
<script src="../../js/ajax_navegacion.js" ></script>
<script src="../../js/jquery.serializefullarray.js" ></script>
<script src="../../js/js_general.js"></script>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Registro de <?=$alias_tabla_autonoma?> Nro. <?=$cod_pk?> </title>

<script src="../../js/formato_fecha.js"></script>
<script src="../../js/dhtml_calendario.js" ></script>
<script src="../../js/opera_numeros.js" ></script>
<script src="../../js/opera_combos.js"></script>
<script src="../../js/opera_cadenas.js"></script>
<!-- Our Custom CSS -->
<link rel="stylesheet" href="../../estilos/style4.css">
<?=$js_navegacion?>
<?=$js_extra?>
<!-- InstanceEndEditable -->

<!--<meta http-equiv="Pragma" content="no-cache" />-->

<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body >
	<div id="ventana_general"></div>
		<form id="form1" name="form1" role="form" data-toggle="validator" method="post" class="wrapper form-horizontal" action="" enctype="multipart/form-data"> 
	 		
      <!-- Sidebar Holder -->
            <nav id="sidebar" class="<?=$_COOKIE['sideBarMenu']=="false" ? 'active' : '' ?>" >
                <div class="sidebar-header">
                    <h3><?=$_COOKIE['txt_seg_empresa']?></h3>
                    <!--<strong>BS</strong>-->
                </div>

                <ul class="list-unstyled components">
                    <!--<li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">
                            <i class="glyphicon glyphicon-home"></i>
                            Home
                        </a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li><a href="#">Home 1</a></li>
                            <li><a href="#">Home 2</a></li>
                            <li><a href="#">Home 3</a></li>
                        </ul>
                    </li>-->

                    <li>
                        <a href="#" aria-expanded="false" onclick="navegar(36);">
                            <i class="glyphicon glyphicon-home"></i>
                            DashBoard
                        </a>
                        
                    </li>
                    

                    <? 

                      while($rowModule = $db->sacar_registro($cursor_modulos)){          
                        $codModule    = $rowModule['cod_tabla'];
                        $iconModule   = $rowModule['icon'] ? $rowModule['icon'] : 'fa-bullseye'; 
                        $detailModule = $rowModule['cod_tabla_detalle'] ? $rowModule['cod_tabla_detalle'] : 'null' ; 
                        $active         = $cod_tabla == $codModule ? "active" : '';

                        if(in_array($codModule, $arrayModules)){ ?>
                            <li class="<?=$active?> row">
                                <div class="form-inline">
                                    <a href="#" class="col-md-12" onclick="goToModule(<?=$codModule?>,<?=$detailModule?>);">
                                        <div class="col-md-3" >
                                            <i class="fas <?=$iconModule?> fa-2x"></i> 
                                        </div>
                                        <div class="col-md-9">
                                            <?=ucfirst(strtolower($rowModule['txt_alias']))?>
                                        </div>
                                    </a>
                                </div>


                            </li>
                          
                      <?
                        } 

                      }

                      ?>

                 
                </ul>
            </nav>

            <!-- Page Content Holder -->
            <div id="content" class="">

                <nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                                <i class="glyphicon glyphicon-align-left"></i>
                                <span>Mostrar/Ocultar</span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#" onclick="navegar(36);">DashBoard</a></li>
                                
                            </ul>
                        </div>
                    </div>
                </nav>