<?php
require "cAutorizacion.php";
echo "Redirigiendo ...";
$modo_depuracion = false;

//Sartenejas
$sql = "UPDATE rol_sistema SET nombre= '$_POST[nombre_coor]',
apellido='$_POST[apellido_coor]',
usbid='$_POST[usbid_coor]'
WHERE rol='coordinador' AND sede='Sartenejas' ";
$resultado = ejecutarConsulta($sql, $conexion);

$sql = "UPDATE rol_sistema SET nombre= '$_POST[nombre_asistente]',
apellido='$_POST[apellido_asistente]',
usbid='$_POST[usbid_asistente]'
WHERE rol='asistente' AND sede='Sartenejas' ";
$resultado = ejecutarConsulta($sql, $conexion);

$sql = "UPDATE rol_sistema SET nombre= '$_POST[nombre_secretaria]',
apellido='$_POST[apellido_secretaria]',
usbid='$_POST[usbid_secretaria]'
WHERE rol='secretaria' AND sede='Sartenejas' ";
$resultado = ejecutarConsulta($sql, $conexion);

//Litoral
$sql = "UPDATE rol_sistema SET nombre= '$_POST[nombre_coor_lit]',
apellido='$_POST[apellido_coor_lit]',
usbid='$_POST[usbid_coor_lit]'
WHERE rol='coordinador' AND sede='Litoral' ";
$resultado = ejecutarConsulta($sql, $conexion);

$sql = "UPDATE rol_sistema SET nombre= '$_POST[nombre_asistente_lit]',
apellido='$_POST[apellido_asistente_lit]',
usbid='$_POST[usbid_asistente_lit]'
WHERE rol='asistente' AND sede='Litoral' ";
$resultado = ejecutarConsulta($sql, $conexion);

$sql = "UPDATE rol_sistema SET nombre= '$_POST[nombre_secretaria_lit]',
apellido='$_POST[apellido_secretaria_lit]',
usbid='$_POST[usbid_secretaria_lit]'
WHERE rol='secretaria' AND sede='Litoral' ";
$resultado = ejecutarConsulta($sql, $conexion);

cerrarConexion($conexion);
?>
    <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
    <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
    <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
    <body>
        <script>
        $.prompt('La solicitud ha sido procesada exitosamente.', 
        { buttons: { Ok: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vEspecificarRoles.php" }  })
        </script>	
    </body>
