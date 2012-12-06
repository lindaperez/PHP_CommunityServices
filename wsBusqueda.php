<?php
/*
/////////////////////////////////////////////////////////////////////
    Web Server para exportar datos e informacion
    de la CCTDS en formato JSON.

	Paramatros de entrada para la busqueda
	
	0. Comunes
		- filtro = {proyecto, estudiante, profesor}
		- sede = {Sartenejas, Litoral}
		
	1. Proyecto
		- desde = {yyyy-mm-dd} (Fecha de Ingreso inicial)              
		- hasta = {yyyy-mm-dd} (Fecha de Ingreso final)
		- tipo_proy = {CONTINUO, PUNTUAL}
		- codigo_proyecto = {cod_proy}
		- area_proyecto = {id_area}
		- comunidad = {id_comunidad}
		- organizacion = {id_organizacion}
		- aprobado = {SI, NO}
		- culminado = {SI, NO}
		- palabras_claves
	
	2. Estudiante
		- insc_desde {yyyy-mm-dd} (Fecha de Inscripcion inicial)              
		- insc_hasta = {yyyy-mm-dd} (Fecha de Inscripcion final)
		- culminacion_desde {yyyy-mm-dd} (Fecha de culminacion inicial)              
		- culminacion_hasta = {yyyy-mm-dd} (Fecha de culminacion final)
		- byest_culminado = {SI, NO}
		- inscrito = {SI, NO}
		- est_carnet = {Carnet con el caracter "-"}
		- est_cohorte = {xx dond c/x es un nro del 0 al 9}
		- est_carrera = {cod_carrera}
		- est_email
		- est_sexo = {F, M}
		- est_nombre
		- est_carrera_duracion = {Corta, Larga}
	
	3. Profesor
		- tutor_usbid
		- tutor_dependencia = {id_dependencia}
		- tutor_email
		- tutor_nombre
		- culminado
		
	llamada
	http://localhost/SC/wsBusqueda2.php?jsoncallback?sede=Sartenejas&filtro=estudiante&carnet=99-31546
	
////////////////////////////////////////////////////
*/
	
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Consultas de busqueda
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
 
 //session_start();
 //require "cAutorizacion.php";
require_once "cConstantes.php";

function verificarParametros ($filtro,$params){
	$arr;
	$ok = true;
	$arr2 = array();
	
	if ($filtro == "proyecto"){
		$arr = array("filtro","sede","hasta","tipo_proy","codigo_proyecto","area_proyecto","comunidad","organizacion","aprobado","culminado","palabras_clave");		
	}
	elseif ($filtro == "estudiante"){
		$arr = array("filtro","sede","insc_desde","insc_hasta","culminacion_desde","culminacion_hasta",
					"byest_culminado","inscrito","est_carnet","est_cohorte","est_carrera",
					"est_email","est_sexo","est_nombre","est_carrera_duracion");
	}
	elseif ($filtro == "tutor"){
		$arr = array("filtro","sede","tutor_usbid","tutor_dependencia","tutor_email","tutor_nombre","culminado");	
	}
	
	foreach ($params as $p){
		if (!(in_array($p,$arr))){
			$arr2[] = $p;			
		}
	}
	return $arr2;
}
 
	extract($_GET);
	
	//////////////////////////////////////////
	//      PRIVILEGIOS DE LA CCTDS         //
	//////////////////////////////////////////
		
	// Se obtienen los criterios de busqueda 
	
	if (!isset($_GET['filtro']))
		$busqueda_por = "proyecto";
	else
		$busqueda_por = $_GET['filtro'];
	
	
	if (!isset($_GET['sede']))
		$sede = "Sartenejas";
	else
		$sede= $_GET['sede'];
		
	// Fecha de inscripción YY-MM-DD
	if ($_GET['insc_desde']!=" ") $desde_est = $_GET['insc_desde'];
	if ($_GET['insc_hasta']!=" ") $hasta_est = $_GET['insc_hasta'];
	
	// Fecha de Culminación YY-MM-DD
	if ($_GET['culminacion_desde']!=" ") $desde_culmina = $_GET['culminacion_desde'];
	if ($_GET['culminacion_hasta']!=" ") $hasta_culmina = $_GET['culminacion_hasta'];
	
	//////////////////////////////////////////
	
	
	$myReturnData = array();
	// Se Verifica si la busqueda es por proy, est o prof
	
	if($busqueda_por == "proyecto"){
		$por_proyecto = 1;
		$ver_usb = 0;
	}elseif($busqueda_por == 'estudiante'){
		$por_estudiante = 1;
		$ver_usb = 0;
	}elseif($busqueda_por == 'tutor'){
		$por_tutor = 1;
		$ver_usb = 1;
	}
	
	// Se verifican los parametros de entrada
	$errores = verificarParametros ($busqueda_por,array_keys($_GET));
	if(in_array("jsoncallback",array_keys($_GET))) $aux = 1;
	else $aux = 0;
	if  (count($errores)>$aux){		
		$myReturnData[] = array ("Errores" => count($errores));
		foreach ($errores as $e){
			$myReturnData[] = array ("paramentroInvalido" => $e);
		}
	}else{

		
		require_once("cBuscarProyecto.php"); 	 

		//$myReturnData[] = array ("proy" => $por_proyecto, "est" => $por_estudiante, "tutor" => $por_tutor);	 
		$myReturnData[] = array ("total" => count($RESULT_ALL_PROYECTOS));	

		foreach($RESULT_ALL_PROYECTOS as $value){
			if($busqueda_por == 'estudiante'){
			
				// Se busca la carrera segun el codigo y la sede correspondiente
				$sql = "SELECT * FROM carrera WHERE codigo='".$value['carrera']."' AND carrera_sede='".$sede."'";
				$resultado = ejecutarConsulta($sql, $conexion);
				$row = obtenerResultados($resultado);
				
				// Se busca el nombre completo del turor segun su usbid correspondiente
				$sql = "SELECT nombre, apellido FROM usuario_miembro_usb, usuario WHERE usbid_usuario='".$value['tutor']."' AND usbid = usbid_usuario";
				$resultado = ejecutarConsulta($sql, $conexion);
				$row2 = obtenerResultados($resultado);
				
				// Se obtiene el estado del SC del estudiante
				if ($value['culminacion_validada']=="SI"){
					if($value['obs']=="Retirado por el Sistema"){
						$estado = "Retirado";
					}else{
						$estado = "Culminado";
					}
				}else{
					if($value['fecha_fin_real']=='0000-00-00'){
						$estado = "Activo";
					}else{
						$estado = "Culminado(No validado por la CCTDS)";
					}								
				}
								
				$myReturnData[] = array ("nombre" => $value['usuario_nombre'],
										 "apellido" => $value['usuario_apellido'],
										 "usbid"  => $value['usbid_estudiante'],
										 "carnet" => $value['carnet'],
										 "carrera" => $row['nombre'] . " (" . $row['codigo'] . ")",
										 "proyecto" => $value['codigo'],
										 "tutor" => $row2['nombre']." ".$row2['apellido'],
										 "fecha_inscip" => $value['fecha_inscip'],
										 "estado" => $estado
										);
										
			}elseif($busqueda_por == 'tutor'){
			
				// Obtenemos la cantidad de estudiantes tutoreados
				$sql = "SELECT COUNT(*) totales FROM inscripcion WHERE tutor='".$value['usbid']."'";
				$resultado = ejecutarConsulta($sql, $conexion);
				$row3 = obtenerResultados($resultado);
				$totales = $row3['totales'];
									
				$myReturnData[] = array ("nombre" => $value['usuario_nombre'],
										 "apellido" => $value['usuario_apellido'],
										 "usbid"  => $value['tutor'],
										 "est_total_tutoreados" => $totales									 
										);
										
			}elseif($busqueda_por == 'proyecto'){
				if (!empty($value['codigo'])) {
					$codigo = $value['codigo'];
					$tipo = $value['tipo'];
				}
				else{ 
					$codigo = "Codigo no asignado"; 
					$tipo = "No asignado";
				}
			
				// Obtenemos la cantidad de estudiantes inscritos en el proyecto
				$sql = "SELECT COUNT(*) totales FROM inscripcion WHERE id_proyecto='".$value['id']."'";
				$resultado = ejecutarConsulta($sql, $conexion);
				$row = obtenerResultados($resultado);
				$totales = $row['totales'];
														
				$myReturnData[] = array ("codigo"  => $codigo,
										 "titulo" => $value['titulo'],
										 "tipo" => $tipo,
										 "est_totales_insc" => $totales								 
										);
			}
		}
	}
	print $_GET['jsoncallback'].'('.json_encode($myReturnData).')';
	
	
