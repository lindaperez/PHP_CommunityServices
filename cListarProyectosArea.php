<?
require "cAutorizacion.php";
unset($_SESSION[proyecto]);
$modo_depuracion=false;

$desde = $_SESSION[desde];
$hasta = $_SESSION[hasta];

	$sql="select * FROM area_proyecto ORDER BY id";
	if ($modo_depuracion) echo "$sql<br>";
	$resultado=ejecutarConsulta($sql, $conexion);
	$i=0;
	while ($fila=obtenerResultados($resultado)){
		$id_area=$fila[id];
		
		$_SESSION[proyectos][siglas][$i]=$fila[siglas];
		$_SESSION[proyectos][nombre][$i]=$fila[nombre];

		//SE CALCULAN LOS PROYECTOS APROBADOS
		$sql2="SELECT count(*) c ".
		"FROM proyecto p ".
		"WHERE p.id_area_proy=$id_area AND p.aprobado='SI' AND fecha_ingreso BETWEEN '$desde' AND '$hasta' ".
		"GROUP BY id_area_proy";
		if ($modo_depuracion) echo "$sql2<br>";
		else{
			$resultado2=ejecutarConsulta($sql2, $conexion);
			$fila2=obtenerResultados($resultado2);
			$_SESSION[proyectos][aprobados][$i]=$fila2[c];
		}

		//SE CALCULAN LOS PROYECTOS POR APROBAR
		$sql2="SELECT count(*) c ".
		"FROM proyecto p ".
		"WHERE p.id_area_proy=$id_area AND p.aprobado='0' AND fecha_ingreso BETWEEN '$desde' AND '$hasta' ".
		"GROUP BY id_area_proy";
		if ($modo_depuracion) echo "$sql2<br>";
		else{
			$resultado2=ejecutarConsulta($sql2, $conexion);
			$fila2=obtenerResultados($resultado2);
			if ($fila2[c]=="") $fila2[c]=0;
			$_SESSION[proyectos][por_aprobar][$i]=$fila2[c];
		}

		//SE CALCULAN LOS PROYECTOS DE TIPO CONTINUO
		$sql2="SELECT count(*) c ".
		"FROM proyecto p, evaluacion e ".
		"WHERE p.id_area_proy=$id_area AND e.id_proyecto=p.id AND e.tipo='CONTINUO' AND fecha_ingreso BETWEEN '$desde' AND '$hasta' ".
		"GROUP BY id_area_proy";
		if ($modo_depuracion) echo "$sql2<br>";
		else{
			$resultado2=ejecutarConsulta($sql2, $conexion);
			$fila2=obtenerResultados($resultado2);
			if ($fila2[c]=="") $fila2[c]=0;
			$_SESSION[proyectos][continuo][$i]=$fila2[c];
		}
		//SE CALCULAN LOS PROYECTOS DE TIPO PUNTUAL
		$sql2="SELECT count(*) c ".
		"FROM proyecto p, evaluacion e ".
		"WHERE p.id_area_proy=$id_area AND e.id_proyecto=p.id AND e.tipo='PUNTUAL' AND fecha_ingreso BETWEEN '$desde' AND '$hasta' ".
		"GROUP BY id_area_proy";
		if ($modo_depuracion) echo "$sql2<br>";
		else{
			$resultado2=ejecutarConsulta($sql2, $conexion);
			$fila2=obtenerResultados($resultado2);
			if ($fila2[c]=="") $fila2[c]=0;
			$_SESSION[proyectos][puntual][$i]=$fila2[c];
		}
		$i++;
	}
	
$_SESSION[max_proy]=$i;

cerrarConexion($conexion);
?>




