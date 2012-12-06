<?
require "cAutorizacion.php";
if (!isset($_GET[id])){
	echo "Codigo de proyecto errado";
	exit();
} 
$modo_depuracion=false;
	//Se buscan los datos de las carrera	
	$sql ="SELECT * FROM carrera order by nombre  ";
	if ($modo_depuracion) echo "$sql<br>";
	$resultado=ejecutarConsulta($sql, $conexion);
	$i=0;
	while ($fila=obtenerResultados($resultado)){
		$_SESSION[carreras][$i]=$fila;
		$i++;
	}
	$_SESSION[max_carreras]=$i;

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
	$sql.="WHERE t.id_proyecto='$_GET[id]' AND t.usbid_miembro=u.usbid AND t.usbid_miembro=m.usbid_usuario ";

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
		// $campos.="\td.cedulaT.value='$fila[ci]';\n";
		$campos.="\td.dependencia.value='$fila[dependencia]';\n";
		// $campos.="\td.celT.value='$fila[celular]';\n";
		// $campos.="\td.tlf_oficT.value='$fila[telf]';\n";
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
	// $script.="\td.cedulaT.value='';\n";
	$script.="\td.dependencia.value='';\n";
	// $script.="\td.celT.value='';\n";
	// $script.="\td.tlf_oficT.value='';\n";
	$script.="\td.emailT.value='';\n";

	for($i=0;$i<=$_SESSION[max_tutores];$i++){
		$script.="\tif(index==$i) campos_$i();\n";
	}
	$script.="}\n";
	$script.=$campos;
	$script.="</script>\n";
	echo $script;

//-------------------Datos de las actividades------------------//        
    $k = 0;
            // Cuento las actividades
        foreach ($_POST as $nombre_campo => $valor) {
        if ($nombre_campo == 'actividad' . $k) {
            $numero_actividades++;
            $k++;
        }
    }
    if ($modo_depuracion)
        echo "Numero Actividades= $numero_actividades<br>";

    for ($j = 0; $j < $numero_actividades; $j++) {

        $act = "actividad" . $j;
        $cro = "fecha" . $j;
        $hor = "horas" . $j;

        $sql = "INSERT INTO plan_inscripcion (id_inscripcion, actividad, fecha, horas) VALUES(" .
                "'$id_inscripcion', " . //id
                "'$_POST[$act]', " . //actividad
                "'$_POST[$cro]' " . //cronograma
                "'$_POST[$hor]' " . //horas  
                ")";
        if ($modo_depuracion) {
            echo "$sql<br>";
        }
            echo "$sql<br>";
        $resultado = ejecutarConsulta($sql, $conexion);
    }
    $numero_actividades = 0;
  
?>