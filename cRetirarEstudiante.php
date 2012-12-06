
<?
require "cAutorizacion.php";
$modo_depuracion=false;

        $sql_temp = "UPDATE inscripcion ".
					"SET culminacion_validada = 'SI', horas_acumuladas = 0, observaciones = 'Retirado por el Sistema' ".
					"WHERE id =".$_GET['id_insc'];
		
		if ($modo_depuracion) echo "$sql_temp<br>";
        else $resultado=ejecutarConsulta($sql_temp, $conexion);

cerrarConexion($conexion);

?>
    <script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
    <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
    <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
    <body>
        <script>
        $.prompt('El estudiante ha sido retirado del proyecto satisfactoriamente', 
        { buttons: { Ok: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vBuscarProyecto.php" }  })
        </script>	
    </body>