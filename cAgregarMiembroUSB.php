<?
require "cAutorizacion.php";

$modo_depuracion=false;

// Se debe primero verificar que no exista otro usuario con el mismo usbid

$sql_temp="SELECT usbid FROM usuario WHERE usbid='$_POST[usbid]' ";
if ($modo_depuracion) echo "$sql_temp<br>"; 
$resultado=ejecutarConsulta($sql_temp, $conexion);
if (numResultados($resultado)>0){
	?>
        <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
        <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
        <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
        <body>
	<script>
            $.prompt('El USBID especificado ya esta registrado en el sistema, por favor vuelva a intentarlo.',  
            { buttons: { Aceptar: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) history.back() }  })
        </script>	
        </body>
	<?
	exit();
}else{

	//se inserta un registro en la tabla usuario
	$sql_temp="INSERT INTO usuario VALUES (".
	"'$_POST[usbid]', ".//usbid
	"'$_POST[nombre]', ".//nombre
	"'$_POST[apellido]', ".//apellido
	"'', ".//password		
	"'".$_POST[ci]."', ". //ci
	"'$_POST[tipo]' ".//tipo
	")"; 

	if ($modo_depuracion) echo "linea 30 $sql_temp<br>"; 
	else $resultado=ejecutarConsulta($sql_temp, $conexion);

	if ($_POST[tipo]=="profesores" or $_POST[tipo]=="empleados"){
		$sql_temp="INSERT INTO usuario_miembro_usb VALUES (".
		"'$_POST[usbid]', ".//usbid
		"'$_POST[dep]', ".//nombre
		"'$_POST[email_sec]', ".//email_sec
		"'$_POST[tlf_ofic]', ".//telf		
		"'$_POST[cel]' ". //celular
		")"; 
		if ($modo_depuracion) echo "linea 41 $sql_temp<br>"; 
		else $resultado=ejecutarConsulta($sql_temp, $conexion);
	}

	if ($_POST[tipo]=="pregrado"){
		$sql_temp="INSERT INTO usuario_estudiante VALUES (".
		"'$_POST[usbid]', ".//usbid
		"'$_POST[usbid]', ".//carnet
		"'', ".//cohorte
		"'$_POST[carrera]', ".//carrera
		"'', ".//estudiante sede
		"'$_POST[email_sec_est]', ".//email_sec
		"'$_POST[tlf_hab]', ". //tlf_hab
		"'$_POST[cel_est]', ". //celular
		"'', ". //direccion
		"'$_POST[sexo]' ".//sexo		
		")"; 
		if ($modo_depuracion) echo "$sql_temp<br>"; 
		else $resultado=ejecutarConsulta($sql_temp, $conexion);
	}
}
cerrarConexion($conexion);
if (!$modo_depuracion){
	?>
        <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
        <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
        <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
        <body>
	<script>
            $.prompt('Los datos han sido registrados satisfactoriamente.',  
            { buttons: { Aceptar: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vListarOpciones.php" }  })
        </script>	
        </body>
	<?
}
?>
