<?
require "cAutorizacion.php";
unset($_SESSION[tutores]);
$modo_depuracion=false;
$max_horas=120; //máximo de horas acumulables en un proyecto de servicio comunitario
	$sql =	"SELECT * FROM bono ORDER BY id DESC LIMIT 0, 1";
	if ($modo_depuracion) echo "$sql<br>";
	else{
		$resultado=ejecutarConsulta($sql, $conexion);
		$fila=obtenerResultados($resultado);
		$bono=$fila[monto];
	}
	$sql =	"SELECT ut.nombre tut_nombre, ".
		"ut.apellido tut_apellido, ".
		"p.codigo codigo, ".
		"ue.nombre est_nombre, ".
		"ue.apellido est_apellido, ".
		"i.periodo periodo, ".
		"i.anio anio, ".
		"i.horas_acumuladas horas, ". //aqui deben ir las horas
		"p.codigo ". //aqui debe ir el bono
	"FROM 	inscripcion i, ".
		"proyecto p, ".
		"usuario ut, ".
		"usuario ue, ".
		"usuario_miembro_usb t, ".
		"usuario_estudiante e ".
	"WHERE i.aprobado='SI'  ".
		"AND i.usbid_estudiante=e.usbid_usuario ".
		"AND e.usbid_usuario=ue.usbid ".
		"AND i.tutor=t.usbid_usuario ".
		"AND t.usbid_usuario=ut.usbid ".
		"AND i.id_proyecto=p.id ".
	"ORDER BY ut.apellido, ut.nombre ";
	if ($modo_depuracion) echo "$sql<br>";
	else{
		$resultado=ejecutarConsulta($sql, $conexion);
		$i=0;
		while ($fila=obtenerResultados($resultado)){
			$_SESSION[tutores][nombreT][$i]=$fila[tut_nombre];
			$_SESSION[tutores][apellidoT][$i]=$fila[tut_apellido];
			$_SESSION[tutores][codigo][$i]=$fila[codigo];
			$_SESSION[tutores][nombreE][$i]=$fila[est_nombre];
			$_SESSION[tutores][apellidoE][$i]=$fila[est_apellido];
			$_SESSION[tutores][anio][$i]=$fila[anio];
			$_SESSION[tutores][periodo][$i]=$fila[periodo];
			$_SESSION[tutores][horas][$i]=$fila[horas];
			$porcentaje=$fila[horas]/$max_horas;
			$_SESSION[tutores][bono][$i]=$porcentaje*$bono;
			$i++;	
		}
		$_SESSION[max_tutores]=$i;
	}
cerrarConexion($conexion);
?>



