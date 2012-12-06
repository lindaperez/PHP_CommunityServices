<?php
require "cAutorizacion.php";

/*
 * Validaciones necesarias
 */
extract($_GET);
extract($_POST);

$_ERRORES = array();
$_WARNING = array();
$_SUCCESS = array();

if( isset($accion) AND $accion = 'actualizar_estudiante')
{
	// email
	if( !comprobar_email($email_sec)){
		$_ERRORES[] = 'El email que uso es incorrecto';
	}
        
	if( !$ci OR !$email_sec OR !$telf_hab OR ! $telf_cel
			OR !$sexo OR !$direccion OR !$estudiante_sede OR !$carrera ){
		// este formulario lo usan dos tipos de usuarios: estudiante y cctds
		// si lo usa el estudiante, no peude modificar su nombre
		// si lo usa la cctds, si puede modificar el nombre, por lo tanto no puede estar vacio el nombre
		if (isAdmin()){
			if ($_POST[nombre]=="" or $_POST[apellido]==""){
				$_ERRORES[] = 'Todos los campos son obligatorios';
			}
		}
		$_ERRORES[] = 'Todos los campos son obligatorios';
	}
        
        if (!is_numeric($ci) ){
            $_ERRORES[] = 'Error de formato, por favor revise.';
        }
        
        if (!comprobar_telefono($telf_hab) OR !comprobar_telefono($telf_cel)) {
            $_ERRORES[] = 'Error de formato en los campos de tel&eacute;fono, debe ser (0412)123-4567 por favor revise.';
        }

	if(empty($_ERRORES)){
		$modo_depuracion=false;

		if( isset($usbid) AND $usbid AND isAdmin()){
			$USBID = $usbid;
		} else {
			$USBID = $_SESSION['USBID'];
		}
                
                $cedula=trim(str_replace('.','', $_POST[ci]));
		$sql_temp="UPDATE usuario SET ";
				if (isAdmin()){
							$sql_temp.="nombre='$_POST[nombre]', ";
							$sql_temp.="apellido='$_POST[apellido]', ";
				}
				$sql_temp.="ci=$cedula ";
				$sql_temp.="WHERE usbid='$USBID'";

		if ($modo_depuracion) echo "$sql_temp<br>";
		$resultado=ejecutarConsulta($sql_temp, $conexion);

		$sql_temp="UPDATE usuario_estudiante SET ";
		$sql_temp.="carrera='$_POST[carrera]', ";
		$sql_temp.="estudiante_sede='$_POST[estudiante_sede]', ";
		$sql_temp.="email_sec='$_POST[email_sec]', ";
		$sql_temp.="telf_hab='$_POST[telf_hab]', ";
		$sql_temp.="telf_cel='$_POST[telf_cel]', ";
		$sql_temp.="direccion='$_POST[direccion]', ";
		$sql_temp.="sexo='$_POST[sexo]' ";
		$sql_temp.="WHERE usbid_usuario='$USBID'";

		if ($modo_depuracion) echo "$sql_temp<br>";
		$resultado=ejecutarConsulta($sql_temp, $conexion);

		$_SESSION[ci]=$_POST[ci];
		$_SESSION[dependencia]=$_POST[dependencia];
		$_SESSION[email_sec]=$_POST[email_sec];
		$_SESSION[telf]=$_POST[telf];
		$_SESSION[cel]=$_POST[cel];

		$_SUCCESS[] = 'Sus datos fueron actualizados satisfactoriamente';
	} else {
		$_WARNING[] = 'Sus datos NO fueron actualizados';
	}
}

include('vActualizarDatosEstudiante.php');

?>
