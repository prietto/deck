<?
$paciente					=	new paciente();
$profesional_salud			=	new profesional_salud();
$sis_genericos				=	new sis_genericos();
$antecedente_paciente		=	new antecedente_paciente();
$descripcion_antecedente	=	new descripcion_antecedente();
$obj_listbox				=	new obj_listbox();
$atencion					=	new atencion();
$tipo_atencion				=	new	tipo_atencion();
$hora_minuto				=	new	hora_minuto();
$parametro_sistema			=	new parametro_sistema();
$autorizacion				=	new autorizacion;
$autorizacion_tipo_atencion	=	new autorizacion_tipo_atencion;
$paciente_categoria			=	new paciente_categoria;
$booleano					=	new booleano;


// conserva las variables para los filtros en caso de que devuelva
$array_request_reporte			= $sis_genericos->f_genera_variables_anteriores($_REQUEST);


//=== Asigna el codigo de la cita medica (valoracion) >>>
$profesional_salud			=	new profesional_salud();
$row_profesional_salud		=	$profesional_salud->f_get_by_user($cod_usuario);
$cod_profesional_salud		= 	$row_profesional_salud['cod_profesional_salud'];

if(!$cod_atencion){			
	$cod_atencion	=	$atencion->p_get_next_pk($cod_profesional_salud);
	$ind_new_row	=	1;
}

//=== Obtiene la informacion de un paciente especifico >>>
if(!$cod_paciente)				$cod_paciente	=	$reg_seleccionado[0];
$row_paciente					= $paciente->f_get_row_detallado($cod_paciente);
$txt_nombre 					= ucwords(strtolower($row_paciente['txt_nombre']));
$txt_apellido 					= ucwords(strtolower($row_paciente['txt_apellido']));
$txt_tipo_identificacion 		= ucwords(strtolower($row_paciente['txt_tipo_identificacion']));
$txt_identificacion 			= $row_paciente['txt_identificacion'];
$fec_nacimiento					= $row_paciente['fec_nacimiento'];
$txt_entidad 					= ucwords(strtolower($row_paciente['txt_entidad']));
$txt_tipo_vinculacion 			= ucwords(strtolower($row_paciente['txt_tipo_vinculacion']));
$txt_acompanante 				= ucwords(strtolower($row_paciente['txt_acompanante']));
$txt_parentesco 				= ucwords(strtolower($row_paciente['txt_parentesco']));
$txt_telefono_acompanante 		= $row_paciente['txt_telefono_acompanante'];
$txt_edad						= $sis_genericos->f_calcular_edad($fec_nacimiento);

//=== Obtiene la informacion de un profesional de la salud especifico >>>
$txt_nombre_profesional			= ucwords(strtolower($row_profesional_salud['txt_nombre'])); 
$txt_apellido_profesional		= ucwords(strtolower($row_profesional_salud['txt_apellido']));
$txt_especialidad				= ucwords(strtolower($row_profesional_salud['txt_especialidad']));
$cod_especialidad				= ucwords(strtolower($row_profesional_salud['cod_especialidad']));
$cod_especialidad_2				= ucwords(strtolower($row_profesional_salud['cod_especialidad_2']));


//=== Combo tipo de atencion >>>

$cursor						= $tipo_atencion->f_get_by_especialidad_evolucion($cod_especialidad,$cod_especialidad_2);
$cursor_tipo_atencion		= $cursor;
$cant_tipo_atencion			= $db->num_registros($cursor_tipo_atencion);
if(!$cod_tipo_atencion && $cant_tipo_atencion == 1){$cod_tipo_atencion = $tipo_atencion->f_get_by_especialidad_row($cod_especialidad);
	$cod_tipo_atencion_evolucion = $cod_tipo_atencion;
}

$row_tipo_atencion_confirm	= $tipo_atencion->f_get_row($cod_tipo_atencion);
$txt_tipo_atencion_confirm 	= $row_tipo_atencion_confirm['txt_nombre'];	

$cmb_tipo_atencion			= $obj_listbox->f_crear_lista_limite_caracteres($cursor, $cod_tipo_atencion, 85);


//==== Antecedentes FAMILIARES>>>
$antecedente_fami			= $antecedente_paciente->f_get_cadena_selccionados(1, $cod_paciente); //antecedente seleccionado
$otro_antecedente_fami		= $descripcion_antecedente->f_get_by_paciente(1, $cod_paciente);//otros antecedentes de un paciente


//==== Antecedentes PATOLOGICOS>>>
$antecedente_pato			= $antecedente_paciente->f_get_cadena_selccionados(2, $cod_paciente); //antecedente seleccionado
$otro_antecedente_pato		= $descripcion_antecedente->f_get_by_paciente(2, $cod_paciente);//otros antecedentes de un paciente


//==== Antecedentes QUIRURGICOS>>>
$antecedente_quiru			= $antecedente_paciente->f_get_cadena_selccionados(3, $cod_paciente); //antecedente seleccionado
$otro_antecedente_quiru		= $descripcion_antecedente->f_get_by_paciente(3, $cod_paciente);//otros antecedentes de un paciente


//==== Antecedentes FARMACOLOGICOS>>>
$antecedente_farma			= $antecedente_paciente->f_get_cadena_selccionados(4, $cod_paciente); //antecedente seleccionado
if($antecedente_farma)		  $antecedente_farma = "Alergias:  $antecedente_farma";
$otro_antecedente_farma		= $descripcion_antecedente->f_get_by_paciente(4, $cod_paciente);//otros antecedentes de un paciente

//==== Relacion de las ATENCIONES que ha recibido un paciente de forma detallada>>>
$cursor_atencion			=	$atencion->f_get_all_detallado($cod_paciente);

//=== combo de las horas de atencion >>>
$cursor_hora				= $hora_minuto->f_get_all();
$cmb_hora					= $obj_listbox->f_crear_lista_limite_caracteres($cursor_hora, $cod_hora, 80);

$cursor_ind_am_pm			= $parametro_sistema->f_get_parametros_combo('1,2');
$cmb_ind_am_pm				= $obj_listbox->f_crear_lista_limite_caracteres($cursor_ind_am_pm, $ind_am_pm, 80);


// -------------------------------------------------------
// === DATOS REFERENTES A LA AUTORIZACION =====
// -------------------------------------------------------	


//=== Combo descuenta>>>
$cursor_descuenta 	= 	$booleano->f_get_all();
$cmb_descuenta		=	$obj_listbox->f_crear_lista($cursor_descuenta, $ind_descuenta);
	
	
//=== Combo tipo de atencion >>>
//$cod_tipo_atencion	= $tipo_atencion->f_get_by_especialidad_evolucion($cod_especialidad);	


// saca el codigo de autorizacion mas reciente por paciente
$cod_autorizacion = $autorizacion->f_get_autorizacion_reciente($cod_paciente,$cod_tipo_atencion);	


// combo de la autorizacion

$cursor					=	$autorizacion->f_get_codigos_autorizacion($cod_paciente,$cod_especialidad,$cod_tipo_atencion);
$cmb_cod_autorizacion	=	$obj_listbox->f_crear_lista($cursor, $cod_autorizacion);


//Obtiene el nombre del paciente>>>
if($cod_autorizacion && $ind_recargar_pantalla == ''){

	$row_autorizacion			=$autorizacion->f_get_row_detallado($cod_autorizacion);
//	$cod_tipo_atencion			=$tipo_atencion->f_get_by_cod_autorizacion($cod_autorizacion);
	$txt_estado_autorizacion	=$row_autorizacion['txt_estado_autorizacion'];
}	


// si el campo que actualiza es el codigo de autorizacion  
if($_REQUEST['txt_campo_actualizado'] == 'cod_autorizacion'){
		$ind_recargar_tipo_atencion = '';
	$_REQUEST['ind_recargar_tipo_atencion'] = '';
}


//=== OBTIENE EL COMBO PARA TIPO DE ATENCION Y EL NUMERO DE REGISTROS EN ARRAY >>>
$datos						= $tipo_atencion->f_get_by_autorizacion($cod_autorizacion);
if($datos['NUM_REGISTROS'] > 1 && $ind_recargar_tipo_atencion == '')$cod_tipo_atencion = -1;
$num_tipo_atencion			= $datos['NUM_REGISTROS'];



//Obtiene la informacion de la autorizacion cuando el usuario cambia el dato
if($cod_autorizacion && $ind_recargar_pantalla == 1 ){
	$row_autorizacion			=$autorizacion->f_get_row_detallado($cod_autorizacion);
//	if($ind_recargar_tipo_atencion == '' && $num_tipo_atencion ==1){$cod_tipo_atencion =$tipo_atencion->f_get_by_cod_autorizacion($cod_autorizacion);}
	$txt_estado_autorizacion	=$row_autorizacion['txt_estado_autorizacion'];
	
}

$cmb_tipo_atencion_autorizacion	= $obj_listbox->f_crear_lista_limite_caracteres($datos['DATOS'], $cod_tipo_atencion, 85);


// cantidad de sesiones autorizadas y faltantes acrode a la autorizacion y por tipo de atencion

if(!$cod_tipo_atencion_evolucion)$cod_tipo_atencion_evolucion = $_REQUEST['cod_tipo_atencion'];
if(!$cod_tipo_atencion_evolucion) $cod_tipo_atencion_evolucion = $cod_tipo_atencion;


$row_autorizacion_tipo_atencion	=	$autorizacion_tipo_atencion->f_get_by_tipo_atencion_evolucion($cod_autorizacion,$cod_tipo_atencion_evolucion);

$cant_sesiones_autorizadas 		= 	$row_autorizacion_tipo_atencion['cant_sesiones_autorizadas'];

// calcula la cnatidad de sesiones faltantes acorde a las atencion relacionadas con la autorizacion en cuestion
$cant_sesiones_realizadas	=	$atencion->f_get_by_autorizacion($cod_autorizacion);
$cant_sesiones_faltantes	=	$row_autorizacion_tipo_atencion['cant_sesiones_faltantes'];
if($cant_sesiones_faltantes == NULL)$cant_sesiones_faltantes = $cant_sesiones_autorizadas; 


// cursor que trae uno o varios diagnosticos asociados a la autorizacion
$cursor_diagnosticos		=	$autorizacion->f_get_all_diagnosticos($cod_autorizacion);

$txt_entidad_autorizacion	= 	$row_autorizacion['txt_entidad'];
$txt_ips_que_solicita		= 	$row_autorizacion['ips_que_solicita'];
$fec_expedicion				= 	$row_autorizacion['fec_expedicion'];
$dias_vigencia				= 	$row_autorizacion['dias_vigencia'];
$txt_usuario_autorizacion	=	$row_autorizacion['txt_usuario_autorizacion'];

// cuota moderadora del paciente / autorizacion
$cod_cuota_moderadora		=	$row_autorizacion['cod_paciente_categoria'];
$txt_cuota_moderadora		=	$paciente_categoria->f_get_by_cuota($cod_cuota_moderadora);

$fec_actual					=	date("Y-n-j H:i:s");
$tiempo_transcurrido 		= (strtotime($fec_actual)-strtotime($fec_expedicion));
$tiempo_transcurrido		= (($tiempo_transcurrido / 60)/60)/24; // se divide por segundos(60), minutos(60), horas(24) finalmente da el numero de dias
$tiempo_transcurrido		=  floor($tiempo_transcurrido);


if($fec_expedicion)$dias_faltantes				=	$dias_vigencia - $tiempo_transcurrido;




?>