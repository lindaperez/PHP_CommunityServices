<?
require "cAutorizacion.php";

$modo_depuracion=false;

	//Se buscan los datos de los tutores
	$sql ="SELECT u.nombre nombre, u.apellido, u.ci ci, u.usbid, m.dependencia, m.email_sec, m.telf, m.celular ";
	$sql.="FROM usuario u, usuario_miembro_usb m, tutor_proy t ";
	$sql.="WHERE t.id_proyecto='$_GET[$proyecto_lista]' AND t.usbid_miembro=u.usbid AND t.usbid_miembro=m.usbid_usuario ";

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
	$script.="function cambiar_tutor(){\n";
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