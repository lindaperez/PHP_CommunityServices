<?
require_once "cConstantes.php";
unset($_SESSION[proyecto]);
unset($_SESSION[nombre_area]);
$modo_depuracion=false;
	
	$sql1 = "SELECT p.codigo, p.titulo, p.id id, a.nombre area 
			FROM proyecto p, area_proyecto a
			WHERE p.id_area_proy=a.id 
			AND p.aprobado='SI' AND p.culminado<>'SI' 
			ORDER BY a.nombre, p.codigo";

	$sql2 = "SELECT nombre FROM area_proyecto ORDER BY nombre";


	if ($modo_depuracion) echo "$sql1<br>$sql2";
	//else{
		$resultado=ejecutarConsulta($sql1, $conexion); //se buscan todos los proyectos aprobados
		$i=0;
		while ($fila=obtenerResultados($resultado)){ //por cada proyecto se guarda el codigo, titulo, id y area 
			$_SESSION[proyecto][codigo][$i]=$fila[codigo];
			$_SESSION[proyecto][titulo][$i]=$fila[titulo];
			$_SESSION[proyecto][area][$i]=$fila[area];
			$_SESSION[proyecto][id][$i]=$fila[id];	
			$id=$fila[id];

			$sql3 = "SELECT u.nombre nombre_tutor, 
			u.apellido apellido_tutor, um.email_sec email_tutor, t.usbid_miembro usbid_tutor
			FROM  tutor_proy t, usuario u, usuario_miembro_usb um
			WHERE t.id_proyecto='$fila[id]' AND u.usbid=t.usbid_miembro 
			AND t.usbid_miembro=um.usbid_usuario
			ORDER BY u.apellido";

			if ($modo_depuracion) echo "<br><br>---$sql3<br>";
			$resultado3=ejecutarConsulta($sql3, $conexion); // se buscan los tutores por cada proyecto
			$j=0;
			$link="";
			while ($fila3=obtenerResultados($resultado3)){ //se arma el link de cada tutor
				if ($j>0) $link.=", ";
				$link.="<a href='mailto:$fila3[usbid_tutor]'>$fila3[nombre_tutor] $fila3[apellido_tutor]</a>";	
				$j++;
			}
			$_SESSION[proyecto][tutores][$i]=$link;
			$_SESSION[proyecto][maxtutores][$i]=$j;
			$i++;
		}
		$_SESSION[max_proyectos]=$i;	
		$resultado2=ejecutarConsulta($sql2, $conexion);
		$j=0;
		while ($fila2=obtenerResultados($resultado2)){
			$_SESSION[nombre_area][$j]=$fila2[nombre];
			$j++;
		}
		$_SESSION[max_proy]=$i;
		$_SESSION[max_area]=$j;
	//}
cerrarConexion($conexion);
?>
