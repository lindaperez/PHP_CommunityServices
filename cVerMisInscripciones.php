<?php
	session_start();
	$sql1 = " SELECT py.id id, py.codigo codigo, py.titulo titulo, i.aprobado aprobado, i.id id_insc FROM proyecto py, inscripcion i
			  WHERE i.id_proyecto = py.id AND i.usbid_estudiante = '$_SESSION[USBID]'
			  AND i.culminacion_validada<>'SI'";

	// echo "$sql1<br>";
	if ($modo_depuracion) echo "$sql1<br>";
	else{
		$resultado=ejecutarConsulta($sql1, $conexion);
	}
	
	$i=0;
	
	while ($fila=obtenerResultados($resultado)){
		$_SESSION[proyecto_inscrito][id][$i]=$fila[id];
		$_SESSION[proyecto_inscrito][codigo][$i]=$fila[codigo];
		$_SESSION[proyecto_inscrito][titulo][$i]=$fila[titulo];
		$_SESSION[proyecto_inscrito][id_insc][$i]=$fila[id_insc];
		$_SESSION[proyecto_inscrito][aprobado][$i]=$fila[aprobado];
		// $_SESSION['proyecto_inscrito']['_todo_'][$i] = $fila;
		$i++;
	}
	
	$_SESSION[max_proyecto_inscrito]=$i;
	
	cerrarConexion($conexion);

?>