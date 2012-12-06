<?
require "cAutorizacion.php";
unset($_SESSION[tutores]);
$modo_depuracion=false;
	
	$sql ="SELECT u.nombre, u.apellido, u.usbid, ";
	$sql.="p.codigo, e.carrera, e.carnet, i.periodo, i.anio ";
	$sql.="FROM inscripcion i, proyecto p, ";
	$sql.="usuario u, usuario_estudiante e ";	
	$sql.="WHERE 1=1 ";	
	$sql.="AND i.id_proyecto=p.id ";
	$sql.="AND i.usbid_estudiante=e.usbid_usuario ";	
	$sql.="AND e.usbid_usuario=u.usbid ";
	$sql.="AND i.fecha_fin_real!='0000-00-00' ";	
	$sql.="ORDER BY e.carrera, u.apellido, u.nombre ";
	if ($modo_depuracion) echo "$sql<br>";
	else{
		$resultado=ejecutarConsulta($sql, $conexion);
		$i=0;
		while ($fila=obtenerResultados($resultado)){
			$_SESSION[estudiantes][nombre][$i]=$fila[nombre];
			$_SESSION[estudiantes][apellido][$i]=$fila[apellido];
			$_SESSION[estudiantes][usbid][$i]=$fila[usbid];
			$_SESSION[estudiantes][codigo][$i]=$fila[codigo];
			$_SESSION[estudiantes][carrera][$i]=$fila[carrera];
			$_SESSION[estudiantes][carnet][$i]=$fila[carnet];
			$_SESSION[estudiantes][periodo][$i]=$fila[periodo];
			$_SESSION[estudiantes][anio][$i]=$fila[anio];
			$i++;	
		}
		$_SESSION[max_estudiantes]=$i;
	}
cerrarConexion($conexion);
?>



