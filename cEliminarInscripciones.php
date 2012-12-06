<?
require "cAutorizacion.php";
$modo_depuracion=false;

        $sql_temp="DELETE i.*, p.* "
		. " FROM inscripcion i "
		. " LEFT JOIN proyecto p ON (i.id_proyecto = p.id) "
                . " LEFT JOIN usuario_miembro_usb e ON (i.tutor = e.usbid_usuario) "
                . " LEFT JOIN usuario u ON (i.usbid_estudiante = u.usbid) "
		. " WHERE p.id IS NULL ";

        if ($modo_depuracion) echo "$sql_temp<br>";
        else $resultado=ejecutarConsulta($sql_temp, $conexion);

cerrarConexion($conexion);

?>
    <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
    <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
    <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
    <body>
        <script>
        $.prompt('Las inscripciones han sido eliminado satisfactoriamente', 
        { buttons: { Ok: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vLimpiarInscripciones.php" }  })
        </script>	
    </body>