<?php
require "cAutorizacion.php";
if (!isEmpleadoCCTDS()){
	echo "<center>Usted no está autorizado para ver esta p&aacute;gina</center>";
	exit();
}
include "cMensajesCorreos.php";
$modo_depuracion=false;

	$sql1 = "SELECT usbid_estudiante FROM inscripcion WHERE id='".$_GET[id]."' ;";
	$resultado1=ejecutarConsulta($sql1, $conexion);
	$carnet_array=obtenerResultados($resultado1);
	$carnet = $carnet_array[usbid_estudiante];
	
	$sql2 = "SELECT SUM(horas_acumuladas) AS horas FROM inscripcion WHERE usbid_estudiante = '$carnet' ;";
	$resultado2 = ejecutarConsulta($sql2, $conexion);
	$horas_array = obtenerResultados($resultado2);
	$horas = $horas_array[horas];
	
	$sql3 = "SELECT COUNT(*) AS proyectos FROM inscripcion WHERE usbid_estudiante = '$carnet' ORDER BY id;";
	$resultado3 = ejecutarConsulta($sql3, $conexion);
	$nro_proy = obtenerResultados($resultado3);
	$proyectos = $nro_proy[proyectos];
	
	if ($modo_depuracion) echo "$sql<br>$sql1<br><br>$sql2<br>";
/*
	if($horas >= 120) {
		$sql3 = "INSERT INTO estudiantes_culminados(usbid_estudiante, horas) VALUES ('".$carnet."', ".$horas.");";
		$sql4 = "UPDATE estudiantes_culminados SET fecha_culminacion=now() WHERE usbid_estudiante='".$carnet."'";
		$resultado3 = ejecutarConsulta($sql3, $conexion);
		$resultado4 = ejecutarConsulta($sql4, $conexion);
	}
*/

if ($_GET[status]=='SI'){	

	$sql ="UPDATE inscripcion SET culminacion_validada='".$_GET[status]."' WHERE id='".$_GET[id]."' ;";
	$resultado=ejecutarConsulta($sql, $conexion);

	$modulo = $proyectos % 2;
	if ($horas < 120 and  $modulo == 0){
		$proy_1 = $proyectos ;
		$proy_2 = $proyectos -2;
		$sql_temp3 ="SELECT id, horas_acumuladas ".
		$sql_temp3.="FROM inscripcion ";
		$sql_temp3.="WHERE usbid_estudiante = '$carnet' ORDER BY id ";
		$sql_temp3.="LIMIT $proy_2, $proy_1 ";
		$resultado3=ejecutarConsulta($sql_temp3, $conexion);
		while($insc=obtenerResultados($resultado3)){
			$obs = "Anulado por normas de inscripcion de 2 SC. Horas Acumuladas = $insc[horas_acumuladas]";
			$sql_temp4 = "UPDATE inscripcion SET horas_acumuladas=0, observaciones='$obs' WHERE id = $insc[id]";
			$resultado4=ejecutarConsulta($sql_temp4, $conexion);
		}
		//SELECT id FROM `inscripcion` WHERE `usbid_estudiante` = '03-36606' 
	}
    
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
				$msj = $correo_cert_apr."Estudiante: ".$fila[nombre]." ".$fila[apellido]." (".$fila[usbid_usuario].")".',\r\n'.$firma;
			}
			$contenidoCorreo.= $msj;			
			$correo=$correo + 1;
			$enviado=mail($fila[email_sec], 
							break_line($asunto_cert_apr), 
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
            $.prompt('La validacion de culminacion de servicio ha sido almacenada satisfactoriamente.<br/><?php echo "$aviso"; ?>', 
            { buttons: { Ok: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vListarInscripciones.php?opcion=validar_culminacion" }  })
            </script>	
        </body>
	<?php
	
} else { //status = NO
    
	$sql ="UPDATE inscripcion SET culminacion_validada='NO', fecha_fin_real='000-00-00', horas_acumuladas=0 WHERE id='".$_GET[id]."' ;";
	if ($modo_depuracion) echo "$sql<br>";
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
        $contenidoCorreo.= $correo_cert_no_apr;
        $enviado=mail($fila[email_sec], 
                        break_line($asunto_cert_no_apr), 
                        break_line($contenidoCorreo),
                        $cabeceras);
        if (!$enviado) $aviso = 'No se logro enviar el correo electronico al destinatario "'.$fila[email_sec].'"<br/>RECUERDE NOTIFICAR AL ESTUDIANTE.';
        else $aviso .= 'Se logro enviar el correo electronico al destinatario "'.$fila[email_sec].'" ';

			$archivo="upload/informe_final/".$carnet."_".$_GET[id].".pdf"; 
			if(file_exists($archivo)) 
			{ 
				if(unlink($archivo)) 
					$aviso .= "El informe del estudiante fue borrado"; 
			} 
			else 
				$aviso .= "El informe del estudiante no se encontraba en el servidor"; 

    }
	?>
        <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
        <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
        <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
        <body>
            <script>
            $.prompt('La culminacion ha sido eliminada de la BD asi como el PDF del informe.<br/><?php echo "$aviso"; ?>', 
            { buttons: { Ok: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vListarInscripciones.php?opcion=validar_culminacion" }  })
            </script>	
        </body>
	<?php

}

cerrarConexion($conexion);
?>
