<?
	require "cAutorizacion.php";

	$modo_depuracion=false;
	//Se buscan los datos de la inscripcion
	$sql =	"SELECT periodo, anio, nombre, apellido, tutor, objetivos, i.id id_insc ".
			"FROM inscripcion i, usuario ".
			"WHERE  id_proyecto='$_GET[id]' AND usbid_estudiante='$_GET[usbid]' AND usbid=tutor";
	
	$resultado = ejecutarConsulta($sql, $conexion);	
	while ($fila = obtenerResultados($resultado)){
		$_SESSION[inscripcion][periodo]=$fila[periodo];
		$_SESSION[inscripcion][anio]=$fila[anio];
		$_SESSION[inscripcion][t_nombre]=$fila[nombre];
		$_SESSION[inscripcion][t_apellido]=$fila[apellido];
		$_SESSION[inscripcion][t_login]=$fila[tutor];
		$_SESSION[inscripcion][objetivos]=$fila[objetivos];
		$_SESSION[inscripcion][id]=$fila[id_insc];
	}
	
	//Se buscan los datos del estudiante
	$USBID = $_GET[usbid];
	$sql =  "SELECT u.nombre nombre, ".
				"u.apellido apellido, ".
				"u.usbid usbid, ".
				"u.ci ci, ".
				"c.nombre carrera, ".
				"e.email_sec email2, ".
				"e.telf_hab telf_hab, ".
				"e.telf_cel telf_cel, ".
				"e.direccion dir ".
		"FROM carrera c, usuario u LEFT JOIN usuario_estudiante e ON (u.usbid=e.usbid_usuario) ".
		"WHERE usbid='$USBID' AND c.codigo =e.carrera";
		
	$resultado = ejecutarConsulta($sql, $conexion);	
	while ($fila = obtenerResultados($resultado)){
		$_SESSION[estudiante][nombre]=$fila[nombre];
		$_SESSION[estudiante][apellido]=$fila[apellido];
		$_SESSION[estudiante][usbid]=$fila[usbid];	
		$_SESSION[estudiante][ci]=$fila[ci];
		$_SESSION[estudiante][carrera]=$fila[carrera];
		$_SESSION[estudiante][email2]=$fila[email2];
		$_SESSION[estudiante][telf_hab]=$fila[telf_hab];
		$_SESSION[estudiante][telf_cel]=$fila[telf_cel];
		$_SESSION[estudiante][direccion]=$fila[dir];
	}

	//Se buscan los datos del proyecto
	$sql =	"SELECT py.titulo titulo, ".
		"py.codigo codigo, ".
		"c.nombre nombreC, ".
		"r.nombres nombreR, ".
		"r.apellidos apellidoR, ".
		"r.direccion dirR,  ".
		"r.ci ciR, ".
		"r.celular celR, ".
		"r.telefono tlfR, ".
		"r.email emailR ".
	"FROM proyecto py, representante r, comunidad c ".
	"WHERE  py.id='$_GET[id]' AND py.id_comunidad=c.id AND py.id_representante=r.id ";
	
	if ($modo_depuracion) echo "$sql<br>";

	$resultado=ejecutarConsulta($sql, $conexion);
	$fila=obtenerResultados($resultado);
		$_SESSION[proyecto][codigo]=$fila[codigo];
		$_SESSION[proyecto][titulo]=$fila[titulo];
		$_SESSION[proyecto][nombreC]=$fila[nombreC];	
		$_SESSION[proyecto][nombreR]=$fila[nombreR];
		$_SESSION[proyecto][ciR]=$fila[ciR];
		$_SESSION[proyecto][celR]=$fila[celR];
		$_SESSION[proyecto][apellidoR]=$fila[apellidoR];	
		$_SESSION[proyecto][dirR]=$fila[dirR];
		$_SESSION[proyecto][tlfR]=$fila[tlfR];
		$_SESSION[proyecto][emailR]=$fila[emailR];

	$sql ="SELECT o.nombre nombreO, o.direccion dirO, o.email emailO, o.telefono tlfO, o.fax ";
	$sql.="FROM proyecto py, organizacion o ";
	$sql.="WHERE py.id_organizacion=o.id";
	if ($modo_depuracion) echo "$sql<br>";

	$resultado=ejecutarConsulta($sql, $conexion);
	$fila=obtenerResultados($resultado);

		$_SESSION[proyecto][nombreO]=$fila[nombreO];
		$_SESSION[proyecto][dirO]=$fila[dirO];	
		$_SESSION[proyecto][emailO]=$fila[emailO];
		$_SESSION[proyecto][tlfO]=$fila[tlfO];
		$_SESSION[proyecto][fax]=$fila[fax];
	
	//Se buscan los datos de los tutores
	$sql ="SELECT u.nombre nombre, u.apellido, u.ci ci, u.usbid, m.dependencia, m.email_sec, m.telf, m.celular ";
	$sql.="FROM usuario u, usuario_miembro_usb m, tutor_proy t ";
	$sql.="WHERE t.id_proyecto='$_GET[id]' AND t.usbid_miembro=u.usbid AND t.usbid_miembro=m.usbid_usuario AND t.usbid_miembro!='".$_SESSION[inscripcion][t_login]."'";

	if ($modo_depuracion) echo "$sql<br>";

	$resultado=ejecutarConsulta($sql, $conexion);
	$campos="function campos_0(){}\n";
	$i=0;
	while ($fila=obtenerResultados($resultado)){
		$_SESSION[tutores][$i]=$fila;
		$j=$i+1;
		//para cada tutor se hace una funcion en javascript que rellena los campos dependientes
		$campos.="function campos_$j(){\n";
		$campos.="\tvar d=document.datos;\n";
		$campos.="\td.dependencia.value='$fila[dependencia]';\n";
		$campos.="\td.emailT.value='$fila[usbid]@usb.ve';\n";
		$campos.="}\n";
		$i++;
	}
	$_SESSION[max_tutores]=$i;
	if ($modo_depuracion) echo "SESSION[max_tutores]=$_SESSION[max_tutores]<br>";
	//se crea la funcion que se activa cuando se elige un tutor de la lista desplegable
	$script ="<script>\n";
	$script.="function cambiar(){\n";
	$script.="\tvar index=document.datos.tutor.selectedIndex;\n";
	$script.="\tvar d=document.datos;\n";
	$script.="\td.dependencia.value='';\n";
	$script.="\td.emailT.value='';\n";

	for($i=0;$i<=$_SESSION[max_tutores];$i++){
		$script.="\tif(index==$i) campos_$i();\n";
	}
	$script.="}\n";
	$script.=$campos;
	$script.="</script>\n";
	echo $script;

//-------------------Datos de las actividades------------------//        
   
	$sql ="SELECT * ";
	$sql.="FROM plan_inscripcion ";
	$sql.="WHERE id_inscripcion=".$_SESSION[inscripcion][id]; //<?=$_SESSION[max_actividades]

	if ($modo_depuracion) echo "$sql<br>";
	$i = 0;
	$resultado=ejecutarConsulta($sql, $conexion);
	while ($fila=obtenerResultados($resultado)){
		$_SESSION[actividades][$i]=$fila;
		$i++;
	}
    $_SESSION[max_actividades]=$i;
?>