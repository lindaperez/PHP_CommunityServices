<?php
require "cAutorizacion.php";
if (!isEmpleadoCCTDS()){
	echo "<center>Usted no está autorizado para ver esta p&aacute;gina</center>";
	exit();
}

require "cMensajesCorreos.php";

$modo_depuracion=FALSE;
if ($_GET[status]=="SI"){
	$sql ="UPDATE inscripcion SET aprobado='$_GET[status]' ".
	$sql.="WHERE id='$_GET[id]'";
	
	if ($modo_depuracion) echo "$sql<br>";
	else{
	

		$resultado=ejecutarConsulta($sql, $conexion);
		
                $sql_temp ="SELECT ue.usbid_usuario, ue.email_sec, u.nombre, u.apellido ".
				$sql_temp.="FROM usuario u, usuario_estudiante ue, inscripcion i ";
				$sql_temp.="WHERE ue.usbid_usuario=i.usbid_estudiante AND ue.usbid_usuario=u.usbid ";
				$sql_temp.="AND i.id='$_GET[id]' ";
				
				$sql_temp2 ="SELECT ue.usbid_usuario, ue.email_sec, u.nombre, u.apellido ".
				$sql_temp2.="FROM usuario u, usuario_miembro_usb ue, inscripcion i ";
				$sql_temp2.="WHERE ue.usbid_usuario=i.tutor AND ue.usbid_usuario=u.usbid ";
				$sql_temp2.="AND i.id='$_GET[id]' ";

				if ($modo_depuracion) echo "$sql_temp<br>";
				else {
					$estudiante="";
					$msj="";
					$correo=0;
					
					// Envio de correo al estudiante y al tutor
					while($correo<2){
						if(!$correos){
							$resultado=ejecutarConsulta($sql_temp, $conexion);
						}else{
							$resultado=ejecutarConsulta($sql_temp2, $conexion);
						}
						$fila=obtenerResultados($resultado);
						$contenidoCorreo = "Buen día ".$fila[nombre]." ".$fila[apellido].',\r\n';
						if(!$correos){
							$msj = $correo_ins_apr."Estudiante: ".$fila[nombre]." ".$fila[apellido]." (".$fila[usbid_usuario].")".',\r\n'.$firma;
						}
						$contenidoCorreo.= $msj;			
						$correo=$correo + 1;
						$enviado=mail($fila[email_sec], 
										break_line($asunto_ins_apr), 
										break_line($contenidoCorreo),
										$cabeceras);
						if(!$correos){
							if (!$enviado) $aviso = 'No se logro enviar el correo electronico al destinatario "'.$fila[email_sec].'"<br/>RECUERDE NOTIFICAR AL ESTUDIANTE.';
							else $aviso = 'Se logro enviar el correo electronico al destinatario "'.$fila[email_sec].'" ';
						}
					}        
				}

        ?>
        <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
        <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
        <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
        <body>
            <script>
            $.prompt('La evaluacion ha sido almacenada satisfactoriamente<br/><?php echo "$aviso"; ?>.', 
            { buttons: { Ok: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vListarInscripciones.php" }  })
            </script>	
        </body>
	<?php
                cerrarConexion($conexion);
	}

}

if ($_GET[status]=="NO"){
	$sql ="UPDATE inscripcion SET aprobado='$_GET[status]' ".
	$sql.="WHERE id='$_GET[id]'";
	
	if ($modo_depuracion) echo "$sql<br>";
	else{
		$resultado=ejecutarConsulta($sql, $conexion);
		
                $sql_temp ="SELECT ue.usbid_usuario, ue.email_sec, u.nombre, u.apellido ".
                $sql_temp.="FROM usuario u, usuario_estudiante ue, inscripcion i ";
                $sql_temp.="WHERE ue.usbid_usuario=i.usbid_estudiante AND ue.usbid_usuario=u.usbid ";
                $sql_temp.="AND i.id='$_GET[id]' ";
                
                if ($modo_depuracion) echo "$sql_temp<br>";
                else {
                    $resultado=ejecutarConsulta($sql_temp, $conexion);
                    $fila=obtenerResultados($resultado);
                    $contenidoCorreo = "Buen día ".$fila[nombre]." ".$fila[apellido].',\r\n';
                    $contenidoCorreo.= $correo_ins_no_apr;
                    $enviado=mail($fila[email_sec], 
                                  break_line($asunto_ins_no_apr), 
                                  break_line($contenidoCorreo),
                                  $cabeceras);
                    if (!$enviado) $aviso = 'No se logro enviar el correo electronico al destinatario "'.$fila[email_sec].'"<br/>RECUERDE NOTIFICAR AL ESTUDIANTE.';
                    else $aviso = 'Se logro enviar el correo electronico al destinatario "'.$fila[email_sec].'" ';
                }

        ?>
        <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
        <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
        <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
        <body>
            <script>
            $.prompt('La evaluacion ha sido almacenada satisfactoriamente<br/><?php echo "$aviso"; ?>.', 
            { buttons: { Ok: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vListarInscripciones.php" }  })
            </script>	
        </body>
	<?php
                cerrarConexion($conexion);
	}

}

if ($_GET[status]=="eliminado"){
	?>
        <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
        <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
        <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
        <body>
            <script>
            $.prompt('La inscripcion sera eliminada de la Base de datos. Esta seguro(a)?', 
            { buttons: { Si: true, No: false}, show:'slideDown' , submit: function (e,v,m,f){  
                    if (v) window.location="cEvaluarInscripcion.php?id=<?=$_GET[id]?>&status=eliminado-confirmado&tok=<?=$_SESSION[csrf]?>"
                    else {$.prompt.close();window.location="vListarInscripciones.php"}
                }  })
            </script>	
        </body>
	<?php
}

if ($_GET[status]=="eliminado-confirmado"){
    
        $sql_temp ="SELECT ue.usbid_usuario, ue.email_sec, u.nombre, u.apellido ".
        $sql_temp.="FROM usuario u, usuario_estudiante ue, inscripcion i ";
        $sql_temp.="WHERE ue.usbid_usuario=i.usbid_estudiante AND ue.usbid_usuario=u.usbid ";
        $sql_temp.="AND i.id='$_GET[id]' ";

        if ($modo_depuracion) echo "$sql_temp<br>";
        else {
            $resultado=ejecutarConsulta($sql_temp, $conexion);
            $fila=obtenerResultados($resultado);
            $contenidoCorreo = "Buen día ".$fila[nombre]." ".$fila[apellido].',\r\n';
            $contenidoCorreo.= $correo_ins_no_apr;
            $enviado=mail($fila[email_sec], 
                            break_line($asunto_ins_no_apr), 
                            break_line($contenidoCorreo),
                            $cabeceras);
            if (!$enviado) $aviso = 'No se logro enviar el correo electronico al destinatario "'.$fila[email_sec].'"<br/>RECUERDE INFORMAR AL ESTUDIANTE.';
            else $aviso = 'Se logro enviar el correo electronico al destinatario "'.$fila[email_sec].'" ';
        }
    
	$sql ="DELETE FROM inscripcion ";
	$sql.="WHERE id='$_GET[id]'";
	
	if ($modo_depuracion) echo "$sql<br>";
	else{
		$resultado=ejecutarConsulta($sql, $conexion);
	}

	$sql ="DELETE FROM plan_inscripcion ";
	$sql.="WHERE id_inscripcion='$_GET[id]'";
	
	if ($modo_depuracion) echo "$sql<br>";
	else{
		$resultado=ejecutarConsulta($sql, $conexion);
        }
	?>
        <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
        <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
        <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
        <body>
            <script>
            $.prompt('La inscripcion del estudiante fue eliminada de la Base de Datos.<br/><?php echo "$aviso"; ?>', 
            { buttons: { Ok: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vListarInscripciones.php" }  })
            </script>	
        </body>
	<?php
	cerrarConexion($conexion);
}
?>



