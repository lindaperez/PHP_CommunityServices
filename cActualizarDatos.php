<?
require "cAutorizacion.php";

/*
 * Validaciones necesarias
 */
extract($_GET);
extract($_POST);

$_ERRORES = array();
$_WARNING = array();
$_SUCCESS = array();

// email
if( !comprobar_email($email_sec)){
	$_ERRORES[] = 'El email que uso es incorrecto';
}
if( !$email_sec OR !$ci OR !$dependencia OR !$email_sec OR !$telf_hab OR !$telf_cel ){
	$_ERRORES[] = 'Todos los campos son obligatorios';
}
if (!is_numeric($ci) ){
            $_ERRORES[] = 'Error de formato en la CI, por favor revise.';
}
$telf_hab = "(0412)123-4567";
$telf_cel = "(0412)123-4567";
if (!comprobar_telefono($telf_hab) OR !comprobar_telefono($telf_cel)) {
    $_ERRORES[] = 'Error de formato en los campos de tel&eacute;fono, debe ser (0412)123-4567 por favor revise.';
}
if (isAdmin())
    if (strlen ($password)<4)
        $_ERRORES[] = 'Error de tamaño de la contraseña, por favor verifique.';
if( isset($accion) AND $accion = 'actualizar_tutor')
{
        if(empty($_ERRORES)){
		$modo_depuracion=false;

		if( isset($usbid) AND $usbid AND isAdmin()){
			$USBID = $usbid;
		} else {
			$USBID = $_SESSION['USBID'];
		}
                
                if (isAdmin()){
                    $cedula=trim(str_replace('.','', $_POST[ci]));
                    $sql_temp="UPDATE usuario SET ".
				"nombre='$nombre', ".
				"apellido='$apellido', ".
				"password='$password', ".
				"ci=$cedula ".
				"WHERE usbid='$USBID'";
                }
                else {
                    $cedula=trim(str_replace('.','', $_POST[ci]));
                    $sql_temp="UPDATE usuario SET ".
                                    "ci=$ci ".
                                    "WHERE usbid='$USBID'";
                }
                
		if ($modo_depuracion) echo "$sql_temp<br>";
		$resultado=ejecutarConsulta($sql_temp, $conexion);

		$sql_temp="UPDATE usuario_miembro_usb SET ".
				"dependencia='$_POST[dependencia]', ".
				"email_sec='$_POST[email_sec]', ".
				"telf='$_POST[telf_hab]', ".
				"celular='$_POST[telf_cel]' ".
				"WHERE usbid_usuario='$USBID'";

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

include('vActualizarDatos.php');