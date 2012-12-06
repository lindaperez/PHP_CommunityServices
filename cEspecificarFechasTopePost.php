<?php
require "cAutorizacion.php";
$modo_depuracion=false;

    //////////////////////////////////////////////////// 
    //Convierte fecha de normal a mysql 
    //////////////////////////////////////////////////// 

    function cambiaf_a_mysql($fecha) {
        ereg("([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
        $lafecha = $mifecha[3] . "-" . $mifecha[2] . "-" . $mifecha[1];
        return $lafecha;
    }

$inicio = cambiaf_a_mysql($_POST[desde1]);
$fin = cambiaf_a_mysql($_POST[hasta1]);

$sql = "UPDATE evento " .
        "SET fecha_inicio='$inicio',fecha_fin='$fin', nombre_trimestre_actual='$_POST[trimestre]' " .
        "WHERE codigo='$_POST[evento]'";

    $resultado = ejecutarConsulta($sql, $conexion);


cerrarConexion($conexion);
?>
    <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
    <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
    <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
    <body>
        <script>
        $.prompt('El evento ha sido cambiado exitosamente.', 
        { buttons: { Ok: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vEspecificarFechasTope.php" }  })
        </script>	
    </body>
