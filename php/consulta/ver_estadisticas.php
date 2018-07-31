<?
include_once ("../librerias/parametro_sistema.php");
//=== Instancias requeridas >>>
$seg_navegacion_estadistica		= 	new seg_navegacion_estadistica;
$cursor_estadistica				=	$seg_navegacion_estadistica->f_get_estadisticas();
$cursor_estadistica				=	$seg_navegacion_estadistica->f_get_by_cod_navegacion(
									'1000	,
									1002	,
									1006	,
									1007	,
									1009	,
									1008	,
									1025	,
									1026	,
									1011	,
									1034	,
									1012	,
									1018	,
									1027	,
									1032	,
									1028	,
									1013	,
									1016	,
									1019	,
									1020	
									');

?>